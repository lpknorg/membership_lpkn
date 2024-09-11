<?php
namespace App\Http\Controllers\api\general;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Admin\KodePos as KodePosModel;

class Kodepos extends Controller
{
	public function main(Request $request) {
        $data = $request->all();

		$table = KodePosModel::select( 'kode_pos.id', 'kode_pos' )->orderby('kode_pos','asc');
								
		if ( isset($data['limit']) ) {
			$table->take($data['limit']);
			
			if ( isset($data['offset']) ) {
				$table->skip($data['offset']);
			}
		}

		if ( isset($data['id_kecamatan']) ) {
			$table->where( "id_kecamatan" , "LIKE" ,$data['id_kecamatan'] );
		}

		if ( isset($data['filter']) ) {
			$table->where( "kode_pos" , "LIKE" ,($data['filter'] ? '%'.$data['filter'].'%' : '%%') );
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
