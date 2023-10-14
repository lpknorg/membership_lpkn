<?php

namespace App\Http\Helpers;

class Helper {
	public static function storeFile($folder, $file, $oldFile=null){
		if ($file) {
			if (!is_null($oldFile)) {
				self::deleteFile($folder, $oldFile);
			}
			$time = time();
			$filename = "{$time}_{$file->getClientOriginalName()}";
			// $userId = \Auth::user()->id;
			$file->move(public_path("uploaded_files/{$folder}"), $filename);
			return $filename;
		}
	}

	public static function storeBase64File($folder, $file, $namaFile='', $oldFile=null){
		if (!\File::exists(public_path("uploaded_files/{$folder}"))) {
			\File::makeDirectory(public_path("uploaded_files/{$folder}"), 0755, true, true);
		}
		if (substr($file, 0, 5) == "data:") {
			$ext       = explode('/', mime_content_type($file))[1];
			$image     = str_replace("data:image/{$ext};base64,", '', $file);
			$image     = str_replace(' ', '+', $image);
			if($namaFile){
				$imageName = $namaFile.'.'.$ext;
			}else{
				$imageName = strtotime("now").'.'.$ext;
			}
			$path      = public_path()."/uploaded_files/{$folder}/".$imageName;
			\File::put($path, base64_decode($image));
			return $imageName;
		}else{
			return self::storeFile($folder, $file, $namaFile, $oldFile);
		}
	}

	public function generateRandString(){
		return substr(strtotime('now'), 5, 9).substr(md5(mt_rand()), 0, 5);
	}

	public static function deleteFile($folder, $oldFile){
		if (file_exists(public_path("uploaded_files/{$folder}/").$oldFile)) {
			unlink("uploaded_files/{$folder}/{$oldFile}");
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

	public static function get_client_ip($ip = null, $deep_detect = TRUE){
		return gethostname();
	}

	public static function cutString($text, $limit=60, $use_dot=true){
		if (strlen($text) > $limit) {
			return $use_dot ? substr($text, 0, $limit).'...' : substr($text, 0, $limit);
		}else{
			return $text;
		}
	}
}