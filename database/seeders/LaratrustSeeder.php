<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class LaratrustSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach(config('permissions.roles') as $key => $values){
            foreach($values['permission'] as $value){
                $sub_role = Permission::firstOrCreate([
                    'name'          => $value['permission'] . '-' . $key,
                    'display_name'  => $value['permission'] . ' ' . $key,
                    'description'   => $value['permission'] . ' ' . $key,
                ]);
            }
        }
    }
}
