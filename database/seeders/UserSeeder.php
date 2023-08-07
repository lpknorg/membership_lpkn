<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Admin\{Member, MemberKantor};

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
            'is_confirm' => 1,
        	'password' => \Hash::make(123123)
        ]);
        $admin->syncRoles('admin');

        $member1 = User::create([
            'name' => 'Dinda',
            'email' => 'wdinda375@gmail.com',
            'is_confirm' => 1,
            'password' => \Hash::make(123123)
        ]);
        $m1 = Member::create([
            'user_id' => $member1->id,
            'no_hp' => '0811901121312'
        ]);
        MemberKantor::create([
            'member_id' => $m1->id
        ]);
        $member1->syncRoles('member');

        $member2 = User::create([
            'name' => 'Member 1',
            'email' => 'member@mail.com',
            'is_confirm' => 1,
            'password' => \Hash::make(123123)
        ]);
        $m2 = Member::create([
            'user_id' => $member2->id,
            'no_hp' => '0812312120123'
        ]);
        MemberKantor::create([
            'member_id' => $m2->id
        ]);
        $member2->syncRoles('member');
    }
}
