<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::firstOrCreate(['name'=>'View Roles','slug'=>'view_roles']);
        Permission::firstOrCreate(['name'=>'Create Role','slug'=>'create_role']);
        Permission::firstOrCreate(['name'=>'Edit Role','slug'=>'edit_role']);
        Permission::firstOrCreate(['name'=>'Delete Role','slug'=>'delete_role']);
    }
}
