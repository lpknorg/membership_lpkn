<?php

namespace App\Http\Controllers\api\general;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Kelurahan as KelurahanModel;

class Kelurahan extends Controller
{
	public function main(Request $request) {
        $data = $request->all();

		$table = KelurahanModel::with('kodePos:id,kode_pos')->orderby('kelurahan','asc')
		->select(
			'kelurahans.id', 
			'kelurahan',
			'id_kode_pos'
		);

		if ( isset($data['limit']) ) {
			$table->take($data['limit']);
			
			if ( isset($data['offset']) ) {
				$table->skip($data['offset']);
			}
		}

		if ( isset($data['id_kecamatan']) ) {
			$table->where( "kelurahans.id_kecamatan" , "LIKE" ,$data['id_kecamatan'] );
		} 

		if ( isset($data['kode_pos']) ) {
			$table->where( "kode_pos" , "LIKE" , ($data['kode_pos'] ? '%'.$data['kode_pos'].'%' : '%%') );
		} 

		if ( isset($data['filter']) ) {
			$table->where( "kelurahan" , "LIKE" ,($data['filter'] ? '%'.$data['filter'].'%' : '%%') );
		}
		
		$table = $table->get();

		if (count($table) == 0 ) {
			return response()->json([
                'status_code' => 204,
                'data' => $table
            ],200);
		} else {
            return response()->json([
                'status_code' => 200,
                'data' => $table
            ],200);
		}
	}
}
