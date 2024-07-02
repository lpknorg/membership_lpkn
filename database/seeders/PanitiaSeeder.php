<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class PanitiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::create(['name' => 'panitia']);
        $arrPanitia = ['aji', 'amel_makassar', 'rahmi', 'mitha', 'salma', 'tari', 'dinda', 'riska', 'bella', 'elsyn', 'diana', 'audi', 'sofi', 'ana', 'syafira'];
        foreach ($arrPanitia as $key => $value) {
            $panitia = User::create([
                'name' => ucfirst($value),
                'email' => "{$value}@mail.com",
                'is_confirm' => 1,
                'password' => \Hash::make(123123)
            ]);
            $panitia->syncRoles('panitia');
        }
    }
}
