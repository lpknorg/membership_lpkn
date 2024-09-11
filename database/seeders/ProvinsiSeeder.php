<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Imports\ProvinsiImport;
use Maatwebsite\Excel\Facades\Excel;

class ProvinsiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Excel::import(new ProvinsiImport, public_path('/excel/provinsi_new.xlsx'));
    }
}
