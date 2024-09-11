<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use File,DB,ZipArchive;

class BackupController extends Controller
{
    private $DS = DIRECTORY_SEPARATOR;
    public function __construct()
    {
        $this->middleware('permission:read-backup')->only('json','index');
        $this->middleware('permission:create-backup')->only('create','store');
        $this->middleware('permission:edit-backup')->only('edit', 'update');
        $this->middleware('permission:delete-backup')->only('destroy');
    }

    public function index()
    {
        $path = storage_path('app'.$this->DS.'Backup');
        if (!file_exists($path)) {
            mkdir($path, 0755, true);
        }
        $backupFiles = File::allFiles($path);
        return view('admin.backup.index', compact('backupFiles'));
    }

    public function create()
    {   
        // $path = storage_path('app'.$this->DS.'Backup');
        // File::deleteDirectory($path);
    	Artisan::call('backup:run --only-db --disable-notifications');
    	return redirect()->back()->with('success', __('global.Backup_created_successfully'));
    }

    public function download($file)
    {
    	$path = storage_path('app'.$this->DS.'Backup'.$this->DS.$file);
    	if( File::exists($path)):
            $headers = [
                'Content-Type' => 'application/zip',
            ];
            return response()->download($path, $file, $headers);
        endif;
        abort(404);
    }

    // public function delete($file)
    public function delete(Request $request)
    {
        $validatedData = $request->validate([
            'data' => 'required|array',
        ]);
        foreach( $request->data as $file ):
            $path = storage_path('app'.$this->DS.'Backup'.$this->DS.$file);
            if( File::exists($path) ):
                File::delete($path);
            endif;
        endforeach;
        return redirect('/admin/backup')->with('success', __('global.alert_done_delete'));
    }


    public function restore(Request $request)
	{
        $filePath = storage_path('app'.$this->DS.'Backup'.$this->DS.$request->file);
        $dir = storage_path('app'.$this->DS.'Backup'.$this->DS.'db-dumps');
        if (file_exists($filePath)) {
            
            $zip = new ZipArchive;
            if ($zip->open($filePath) === TRUE) {
                $zip->extractTo(storage_path('app'.$this->DS.'Backup'));
                $zip->close();
            }
            $sql_name = 'mysql-'.env("DB_DATABASE").'.sql';
            $full_path_file = $dir.$this->DS.$sql_name;
            if (file_exists($full_path_file)) {
                Artisan::call('db:wipe', ['--force' => true]);
                DB::unprepared(file_get_contents($full_path_file));
                File::deleteDirectory($dir);
                return back()->with('success', __('global.confirm_database_restore'));
            }
            File::deleteDirectory($dir);
            return back()->with('error', __('global.file_not_found'));
        }
        File::deleteDirectory($dir);
        return back()->with('error', __('global.file_not_found'));
	}



}
