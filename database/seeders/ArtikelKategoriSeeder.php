<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Artikel\ArtikelKategori;

class ArtikelKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = ['Cerpen', 'Horor', 'Puisi', 'Filsafat', 'Pendidikan', 'Seni', 'Sosial Budaya', 'Otomotif', 'Film', 'Healthy', 'Home'];
        foreach ($arr as $key => $value) {
            ArtikelKategori::create(['nama' => $value]);
        }
    }
}
