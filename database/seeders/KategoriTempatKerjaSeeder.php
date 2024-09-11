<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\KategoriTempatKerja;

class KategoriTempatKerjaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = ['admin', 'member'];
        foreach ($arr as $key => $value) {
            KategoriTempatKerja::create(['name' => $value]);
        }
    }
}
