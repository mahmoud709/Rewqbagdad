<?php

namespace App\Http\Controllers\Admin;

use App\Models\Role;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {
        // $this->middleware('authadmin:profile_edit')->only('profile', 'UpdateProfile');
        
        $this->middleware('permission:read-roles')->only('json','index');
        $this->middleware('permission:create-roles')->only('create','store');
        $this->middleware('permission:edit-roles')->only('edit', 'update');
        $this->middleware('permission:delete-roles')->only('destroy');
    }
    public function index(Request $request)
    {
       
        if ($request->ajax()) {
            $query = Role::get();
            return datatables($query)->editColumn('created_at', function ($row) {
                return $row->created_at;
            })->make(true);
        }

       return view('admin.roles.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.roles.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name'          => 'required|unique:roles,name',
            'permissions'   => "required|array",
        ]);

        // Validate and store the role
        $role = Role::create([
            'name' => $request->name,
            'description' => $request->description,
            'display_name' => $request->name,
        ]);
    
        // Assuming attachPermissions is a method on the Role model or related class
        $role->attachPermissions($request->permissions);
        
        // Redirect to the index page after successful creation
        return redirect()->route('roles.index')->with('success', __('global.alert_done_create'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::findOrFail($id);

        return view('admin.roles.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name'          => 'required|unique:roles,name,' . $id,
            'permissions'   => "required|array",
        ]);


        $role = Role::findOrFail($id);

        $role->update([
            'name' => $request->name,
            'display_name' => $request->name,
            'description' => $request->description,
        ]);

        $role->syncPermissions($request->permissions);

        return redirect()->route('roles.edit', $id)->with('success', __('global.alert_done_update'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {

        $role = Role::findOrFail($id);

        $role->delete();

        return redirect()->route('roles.index')->with('success', __('global.alert_done_delete'));
    }
}
