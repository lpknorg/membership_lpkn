<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Admin\SosialMedia;

class SosialMediaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $arr = ['Instagram', 'Facebook', 'Youtube'];
        foreach ($arr as $key => $value) {
            SosialMedia::create(['nama' => $value]);
        }
    }
}
