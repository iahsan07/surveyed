<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user1 = User::firstOrCreate([
            'name' => 'Super Admin',
            'email' => 'super_admin@mail.com',
            'password' => Hash::make('password')
        ]);
        $role1 = Role::where('slug','super_admin')->first();
        $user1->roles()->attach($role1->id);

        $user2 = User::firstOrCreate([
            'name' => 'Company Admin',
            'email' => 'company_admin@mail.com',
            'password' => Hash::make('password')
        ]);
        $role2 = Role::where('slug','company_admin')->first();
        $user2->roles()->attach($role2->id);

        $user3 = User::firstOrCreate([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => Hash::make('password')
        ]);
        $role3 = Role::where('slug','admin')->first();
        $user3->roles()->attach($role3->id);
    }
}
