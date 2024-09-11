<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Admin\Kodepos;

class KodePosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
    	$data = file_get_contents(public_path('json/kodepos.json'));
    	$data = json_decode($data);

    	foreach(array_chunk($data, 1000) as $orders){
    		$out = array();
    		foreach($orders as $i){
    			$out[] = array(
    				"id" => $i->id,
    				"kode_pos" => $i->kode_pos,
    				"id_kecamatan" => $i->id_kecamatan
    			);
    		}
    		DB::table('kode_pos')->insert($out);
    	}
    }
}