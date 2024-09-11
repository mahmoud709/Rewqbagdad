<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\admin::factory(1)->create();

        \App\Models\Group::factory()->create([
            'name' => 'Full',
            'main' => 'main',
        ]);
      
        
        // \App\Models\Setting::factory()->create([
        //     'name' => 'Site Name',
        //     'description' => 'Site description',
        //     'phone' => '00201021464469',
        //     'email' => 'thebeststory0@gmail.com',
        //     'address' => 'Egypt',
        //     'logo' => '/admin/demo.svg',
        //     'icon' => '/admin/demo.svg',
        // ]);

        $this->call(LaratrustSeeder::class);
        $this->call(RoleSeeder::class);
         
        \App\Models\Admin::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt(123456),
            'main' => 'main',
            'is_superadmin' => 1,
            'group_id' => 1,
        ]);
        
    }
}
