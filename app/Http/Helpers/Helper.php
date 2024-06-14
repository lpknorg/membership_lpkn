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
			//$image     = str_replace("data:image/{$ext};base64,", '', $file);
			$image = explode(',', $file);
			$image = $image[1];
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

	public function generateRandString($length=10){
		$characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
		$charactersLength = strlen($characters);
		$randomString = '';

		for ($i = 0; $i < $length; $i++) {
			$randomString .= $characters[rand(0, $charactersLength - 1)];
		}

		return $randomString;
	}

	public static function deleteFile($folder, $oldFile){
		if (file_exists(public_path("uploaded_files/{$folder}/").$oldFile)) {
			unlink("uploaded_files/{$folder}/{$oldFile}");
		}
	}

	public static function showImage($img, $fold=null){
		// akses foto dari google drive
		if (substr($img, 0, 13) == 'https://drive') {
			$getId = explode("id=", $img);
			$getId = $getId[1];
			return "https://drive.google.com/thumbnail?id={$getId}&sz=w1000";
		}
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

	public static function convertFromBulanIndo($bulan, $a){
		if($bulan == 'januari'){
			$fixTglLahir = $a[2].'-01-'.$a[0];
		}elseif($bulan == 'februari'){
			$fixTglLahir = $a[2].'-02-'.$a[0];
		}elseif($bulan == 'maret'){
			$fixTglLahir = $a[2].'-03-'.$a[0];
		}elseif($bulan == 'april'){
			$fixTglLahir = $a[2].'-04-'.$a[0];
		}elseif($bulan == 'mei'){
			$fixTglLahir = $a[2].'-05-'.$a[0];
		}elseif($bulan == 'juni'){
			$fixTglLahir = $a[2].'-06-'.$a[0];
		}elseif($bulan == 'juli'){
			$fixTglLahir = $a[2].'-07-'.$a[0];
		}elseif($bulan == 'agustus'){
			$fixTglLahir = $a[2].'-08-'.$a[0];
		}elseif($bulan == 'september'){
			$fixTglLahir = $a[2].'-09-'.$a[0];
		}elseif($bulan == 'oktober'){
			$fixTglLahir = $a[2].'-10-'.$a[0];
		}elseif($bulan == 'november'){
			$fixTglLahir = $a[2].'-11-'.$a[0];
		}elseif($bulan == 'desember'){
			$fixTglLahir = $a[2].'-12-'.$a[0];
		}else{
			$fixTglLahir = null;
		}
		return $fixTglLahir;
	}

	public static function bulanIndo($bulan){
		switch ($bulan){
			case 1 : $bulan="Januari";
			Break;
			case 2 : $bulan="Februari";
			Break;
			case 3 : $bulan="Maret";
			Break;
			case 4 : $bulan="April";
			Break;
			case 5 : $bulan="Mei";
			Break;
			case 6 : $bulan="Juni";
			Break;
			case 7 : $bulan="Juli";
			Break;
			case 8 : $bulan="Agustus";
			Break;
			case 9 : $bulan="September";
			Break;
			case 10 : $bulan="Oktober";
			Break;
			case 11 : $bulan="November";
			Break;
			case 12 : $bulan="Desember";
			Break;
		}
		return $bulan;
	}

	public static function getRespApiWithParam($url, $type='get', $datapost=[]){
		$client = new \GuzzleHttp\Client(['verify' => false]);
		$userAgent = isset($_SERVER['HTTP_USER_AGENT']) 
		? strtolower($_SERVER['HTTP_USER_AGENT']) : '';
		$request = $client->$type($url, [
			'form_params' => $datapost,
			'headers' => [
				'User-Agent' => $userAgent,
				'Authorization'  => 'Bearer eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEiLCJ1c2VybmFtZSI6ImFkbWluaXN0cmF0b3IiLCJ1c2VyX2dyb3VwIjoiYWRtaW4iLCJpYXQiOjE2NTg4MzQzMzN9.dhoLWPcm4cpXOUouX4GEMFrQBmIz5-RRaMACMUW0wxs',
				'Cookie' => 'ci_session=e40e0d7d948983435b6949a4df8efbfaf2238c4b'
			]
		]);

		$response = $request->getBody()->getContents();
		$data = json_decode($response, true);
		return $data;
	}
}