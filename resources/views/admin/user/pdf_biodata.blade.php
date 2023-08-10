<!DOCTYPE html>
<html>
<head>
</head>
<style>
	#table {
		font-family: Arial, Helvetica, sans-serif;
		border-collapse: collapse;
		width: 98%;
	}

	#table td, #table th {
		border: 1px solid #ddd;
		padding: 4px 5px;
	}


	#table th {
		padding-top: 12px;
		padding-bottom: 12px;
		text-align: left;
		color: black;
	}
	#table th{
		font-size: 13px;
		width: 25%;
		text-align: center;
	}
</style>
<body>
	<img src="{{public_path('img/koplpkn.jpg')}}" style="width: 104%">
	<!-- <img src="{{asset('img/koplpkn.jpg')}}" alt=""> -->
	<h3 style="margin: 20px auto;text-align: center;">BIODATA PESERTA PELATIHAN DAN UJIAN SERTIFIKASI</h3>
	<table id="table">
		<thead>
			<tr>
				<th>NAMA LENGKAP</th>
				<td>{{$data->name}}</td>
			</tr>
			<tr>
				<th>NIP</th>
				<td>{{$data->nip}}</td>
			</tr>
			<tr>
				<th>NOMOR KTP</th>
				<td>{{$data->nik}}</td>
			</tr>
			<tr>
				<th>TEMPAT / TINGGAL LAHIR</th>
				<td>{{$data->member->tempat_dan_tgl_lahir}}</td>
			</tr>
			<tr>
				<th>INSTANSI ASAL</th>
				<td>{{$data->member->memberKantor->nama_instansi}}</td>
			</tr>
			<tr>
				<th>PEMERINTAH</th>
				<td>{{$data->member->memberKantor->pemerintah_instansi}}</td>
			</tr>
			<tr>
				<th>NOMOR HP</th>
				<td>{{$data->member->no_hp}}</td>
			</tr>
			<tr>
				<th>EMAIL AKTIF</th>
				<td>{{$data->email}}</td>
			</tr>
			<tr>
				<th>PENDIDIKAN TERAKHIR</th>
				<td>{{$data->member->pendidikan_terakhir}}</td>
			</tr>
			<tr>
				<th>STATUS KEPEGAWAIAN</th>
				<td>{{$data->member->memberKantor->status_kepegawaian}}</td>
			</tr>
			<tr>
				<th>ALAMAT KANTOR</th>
				<td>{{$data->member->memberKantor->alamat_kantor_lengkap}}</td>
			</tr>
			<tr>
				<th>KODE POS</th>
				<td>{{$data->member->alamatKelurahan->kodePos->kode_pos ?? '-'}}</td>
			</tr>
		</thead>
	</table>
</body>
</html>