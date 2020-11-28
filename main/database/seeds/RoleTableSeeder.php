<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\USer;
use Illuminate\Support\Facades\Hash;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role = new Role();
        $role->name = 'admin';
        $role->description = 'Administrator';
        $role->save();
        $role = new Role();
        $role->name = 'user';
        $role->description = 'User';
        $role->save();

        $user = new User();
        $user->name = 'Admin';
        $user->email = 'admin@gmail.com';
        $user->email_verified_at = now();
        $user->password = Hash::make('secret'); // password
        $user->remember_token = Hash::make('secret');
        $user->save();
        $user->roles()->attach(Role::where('name', 'admin')->first());
    }
}
