<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = User::create([
        	'name' => 'Admin 1',
        	'email' => 'admin@mail.com',
        	'password' => \Hash::make(123123)
        ]);
        $admin->syncRoles('admin');

        $member = User::create([
        	'name' => 'Member 1',
        	'email' => 'member@mail.com',
        	'password' => \Hash::make(123123)
        ]);
        $member->syncRoles('member');
    }
}
