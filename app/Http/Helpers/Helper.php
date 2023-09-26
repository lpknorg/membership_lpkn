<?php

namespace App\Http\Helpers;

class Helper {
	public static function storeFile($folder, $file, $oldFile=null){
		if ($file) {
			$time = time();
			$filename = "{$time}_{$file->getClientOriginalName()}";
			$userId = \Auth::user()->id;
			$file->move(public_path("uploaded_files/{$folder}"), $filename);
			return $filename;
		}
	}

	public static function showImage($img, $fold=null){
		if (is_null($img)) {
			return asset("default.png");
		}
		if ($fold) {
			return asset("uploaded_files/{$fold}/{$img}");
		}
		if (file_exists(public_path($img))) {
			return asset($img);
		}
		return asset("default.png");
	}

	public static function changeFormatDate($date, $format='d-m-Y'){
		if (is_null($date)) {
			return '-';
		}
		$d = date_create($date);
		return date_format($d, $format);
	}

	public static function getUname($user){
		$u = strtolower($user->email);
        $u = explode("@", $u);
        return $u[0].'-'.$user->id;
	}
}