<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::firstOrCreate(['name'=>'Super Admin','slug'=>'super_admin']);
        Role::firstOrCreate(['name'=>'Company Admin','slug'=>'company_admin']);
        Role::firstOrCreate(['name'=>'Admin','slug'=>'admin']);
        Role::firstOrCreate(['name'=>'Manager','slug'=>'manager']);
        Role::firstOrCreate(['name'=>'Participant','slug'=>'participant']);
    }
}
