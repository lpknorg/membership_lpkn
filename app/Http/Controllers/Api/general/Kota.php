<?php

namespace App\Http\Controllers\api\general;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Kota as KotaModel;
use Illuminate\Support\Arr;

class Kota extends Controller
{
	public function main(Request $request) {
		$data = $request->all();

		$table = KotaModel::select( 'id', 'kota' )->orderby('kota','asc');
		if ( isset($data['limit']) ) {
			$table->take($data['limit']);

			if ( isset($data['offset']) ) {
				$table->skip($data['offset']);
			}
		}

		if ( isset($data['id_provinsi']) ) {
			$table->where( "id_provinsi" , "LIKE" ,$data['id_provinsi'] );
		}

		if ( isset($data['filter']) ) {
			$table->where( "kota" , "LIKE" ,($data['filter'] ? '%'.$data['filter'].'%' : '%%') );
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
