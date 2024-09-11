<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\Instansi;

class InstansiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Instansi::insert([
        	[
        		'nama' => 'Kementerian'
        	],
        	[
        		'nama' => 'Lembaga Pemerintahan Non Kementerian'
        	],
        	[
        		'nama' => 'Alat Negara'
        	],
        	[
        		'nama' => 'Sekretariat Jenderal Lembaga Negara'
        	],
        	[
        		'nama' => 'Lembaga Penyiaran Publik'
        	],
        	[
        		'nama' => 'Sekretariat/Sekretariat Jenderal Lembaga Non Struktural (JPT Madya)'
        	],
        	[
        		'nama' => 'Sekretariat Lembaga Non Struktural (JPT Pratama/JA)'
        	],
        	[
        		'nama' => 'Lembaga Pemerintahan Lainnya'
        	],
        	[
        		'nama' => 'Lembaga Non Struktural'
        	],
            [
                'nama' => 'Perangkat Daerah'
            ]
        ]);
    }
}
