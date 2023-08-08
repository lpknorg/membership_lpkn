<?php

namespace App\Http\Controllers\api\general;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Provinsi as ProvinsiModel;

class Provinsi extends Controller
{
	public function main(Request $request) {
        $data = $request->all();

		$table = ProvinsiModel::select( 'id', 'nama' )->orderby('nama','asc');

		if ( isset($data['limit']) ) {
			$table->take($data['limit']);
			
			if ( isset($data['offset']) ) {
				$table->skip($data['offset']);
			}
		}

		if ( isset($data['filter']) ) {
			$table->where( "nama" , "LIKE" ,($data['filter'] ? '%'.$data['filter'].'%' : '%%') );
		}
		if ( isset($data['id_provinsi']) ) {
			$table->where( "id" , "LIKE" ,$data['id_provinsi'] );
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
