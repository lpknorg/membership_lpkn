<?php
namespace App\Http\Controllers\api\general;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\Kecamatan as KecamatanModel;

class Kecamatan extends Controller
{
	public function main(Request $request) {
        $data = $request->all();

			$table = KecamatanModel::select( 'id', 'kecamatan' )->orderby('kecamatan','asc');

			if ( isset($data['limit']) ) {
				$table->take($data['limit']);
				
				if ( isset($data['offset']) ) {
					$table->skip($data['offset']);
				}
			}

			if ( isset($data['id_kota']) ) {
				$table->where( "id_kota" , "LIKE" ,$data['id_kota'] );
			} 

			if ( isset($data['filter']) ) {
				$table->where( "kecamatan" , "LIKE" ,($data['filter'] ? '%'.$data['filter'].'%' : '%%') );
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
