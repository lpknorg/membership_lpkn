<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call([
            RoleSeeder::class,
            UserSeeder::class,
            ProvinsiSeeder::class,
            KotaSeeder::class,
            InstansiSeeder::class,
            LembagaPemerintahanSeeder::class,
            KecamatanSeeder::class,
            KelurahanSeeder::class,
            KodePosSeeder::class,
            SosialMediaSeeder::class,
            ArtikelKategoriSeeder::class
        ]);
    }
}
