<?php

namespace Database\Seeders;

use App\Models\Permission; 
use App\Models\Role;       
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Create or find the super_admin role
        $roleSuperAdmin = Role::firstOrCreate([
            'name'          => "super_admin",
            'display_name'  => "super admin",
            'description'   => "you can make anything",
        ]);

        // Retrieve all permissions and pluck their ids
        $permissions = Permission::get()->pluck('id')->toArray();

        // Attach permissions to the super_admin role
        $roleSuperAdmin->permissions()->sync($permissions);

        // Create or find the user role
        $roleUser = Role::firstOrCreate([
            'name'          => "user",
            'display_name'  => "user",
            'description'   => "you can not make anything",
        ]);
    }
}