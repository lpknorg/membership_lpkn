<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-v4-rtl/4.6.2-1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/2.0.5/css/dataTables.dataTables.css" />

	<title></title>
	<style>
		body{
			margin-top:20px;
			color: #1a202c;
			text-align: left;
			background-color: #e2e8f0;    
		}
		.table td{
			padding: 7px;
		}
		.table td:nth-child(1){
			width: 40%;
		}
		.main-body {
			padding: 15px;
		}
		.card {
			box-shadow: 0 1px 3px 0 rgba(0,0,0,.1), 0 1px 2px 0 rgba(0,0,0,.06);
		}

		.card {
			position: relative;
			display: flex;
			flex-direction: column;
			min-width: 0;
			word-wrap: break-word;
			background-color: #fff;
			background-clip: border-box;
			border: 0 solid rgba(0,0,0,.125);
			border-radius: .25rem;
		}

		.card-body {
			flex: 1 1 auto;
			min-height: 1px;
			padding: 1rem;
		}

		.gutters-sm {
			margin-right: -8px;
			margin-left: -8px;
		}

		.gutters-sm>.col, .gutters-sm>[class*=col-] {
			padding-right: 8px;
			padding-left: 8px;
		}
		.mb-3, .my-3 {
			margin-bottom: 1rem!important;
		}

		.bg-gray-300 {
			background-color: #e2e8f0;
		}
		.h-100 {
			height: 100%!important;
		}
		.shadow-none {
			box-shadow: none!important;
		}
	</style>
</head>
<body>
	<div class="container">
		<div class="main-body">
			<div class="row gutters-sm">
				<div class="col-md-4 mb-3">
					<div class="card">
						<div class="card-body">
							<div class="d-flex flex-column align-items-center text-center">
								<img src="https://bootdey.com/img/Content/avatar/avatar7.png" alt="Admin" class="rounded-circle" width="150">
								<div class="mt-1">
									<h4>{{$user->name}} / L</h4>
									<p class="text-secondary mb-1">{{$user->member->memberKantor->nama_jabatan}}</p>
									<p class="text-secondary mt-1" style="text-align: left;">{{$user->deskripsi_diri}}</p>
								</div>
							</div>
						</div>
					</div>
					<div class="card mt-3">
						<ul class="list-group list-group-flush">
							<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
								<h6 class="mb-0">Email</h6>
								<span class="text-secondary">{{$user->email}}</span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
								<h6 class="mb-0">No Telpon</h6>
								<span class="text-secondary">{{$user->member->no_hp}}</span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
								<h6 class="mb-0">NIP / NRP</h6>
								<span class="text-secondary">{{$user->nip}}</span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
								<h6 class="mb-0">NIK</h6>
								<span class="text-secondary">{{$user->nik}}</span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
								<h6 class="mb-0">Pendidikan Terakhir</h6>
								<span class="text-secondary">{{$user->member->pendidikan_terakhir}}</span>
							</li>
							<li class="list-group-item d-flex justify-content-between align-items-center flex-wrap">
								<h6 class="mb-0">Tempat / Tanggal Lahir</h6>
								<span class="text-secondary">{{$user->member->tempat_lahir.' / '.$user->member->tgl_lahir}}</span>
							</li>
						</ul>
					</div>
				</div>
				<div class="col-md-8">
					<div class="card mb-3">
						<div class="card-body">
							<h5>Data Tempat Tinggal</h5>
							<table class="table table-bordered">
								<tr>
									<td>Alamat Lengkap</td>
									<td colspan="3">{{$user->member->alamat_lengkap ?? '-'}}</td>
								</tr>
								<tr>
									<td>Provinsi</td>
									<td>Kota/Kabupaten</td>
									<td>Kecamatan</td>
									<td>Kelurahan</td>
								</tr>
								<tr>
									<td>{{$user->member->prov_id ? $user->member->alamatProvinsi->nama : '-'}}</td>
									<td>{{$user->member->kota_id ? $user->member->alamatKota->kota : '-'}}</td>
									<td>{{$user->member->kecamatan_id ? $user->member->alamatKecamatan->kecamatan : '-'}}</td>
									<td>{{$user->member->kelurahan_id ? $user->member->alamatKelurahan->kelurahan : '-'}}</td>
								</tr>
							</table>
							<hr>
							<h5>Data Pekerjaan</h5>
							<table class="table table-bordered">
								<tr>
									<td>Status Kepegawaian</td>
									<td colspan="3">{{$user->member->memberKantor->status_kepegawaian ?? '-'}}</td>
								</tr>
								<tr>
									<td>Posisi Pelaku Pengadaan</td>
									<td colspan="3">{{$user->member->memberKantor->posisi_pelaku_pengadaan ?? '-'}}</td>
								</tr>
								<tr>
									<td>Jenis Jabatan</td>
									<td colspan="3">{{$user->member->memberKantor->jenis_jabatan ?? '-'}}</td>
								</tr>
								<tr>
									<td>Nama Jabatan</td>
									<td colspan="3">{{$user->member->memberKantor->nama_jabatan ?? '-'}}</td>
								</tr>
								<tr>
									<td>Golongan Terakhir</td>
									<td colspan="3">{{$user->member->memberKantor->golongan_terakhir ?? '-'}}</td>
								</tr>
								<tr>
									<td>Tempat Kerja/Instansi</td>
									<td colspan="3">{{$user->member->memberKantor->nama_instansi ?? '-'}}</td>
								</tr>
								<tr>
									<td>Pemerintah (Kota/Kabupaten)</td>
									<td colspan="3">{{$user->member->memberKantor->pemerintah_instansi ?? '-'}}</td>
								</tr>
								<tr>
									<td>Alamat Lengkap</td>
									<td colspan="3">{{$user->member->memberKantor->alamat_kantor_lengkap ?? '-'}}</td>
								</tr>
								<tr>
									<td>Provinsi</td>
									<td>Kota/Kabupaten</td>
									<td>Kecamatan</td>
									<td>Kelurahan</td>
								</tr>
								<tr>
									<td>{{$user->member->memberKantor->prov_prov_id ? $user->member->memberKantor->alamatKantorProvinsi->nama : '-'}}</td>
									<td>{{$user->member->memberKantor->prov_kota_id ? $user->member->memberKantor->alamatKantorKota->kota : '-'}}</td>
									<td>{{$user->member->memberKantor->prov_kecamatan_id ? $user->member->memberKantor->alamatKantorKecamatan->kecamatan : '-'}}</td>
									<td>{{$user->member->memberKantor->prov_kelurahan_id ? $user->member->memberKantor->alamatKantorKelurahan->kelurahan : '-'}}</td>
								</tr>
							</table>
							<hr>
							<h5>Dokumen - Dokumen</h5>
							<table class="table table-bordered">
								<tr>
									<td>Foto KTP</td>
									<td>
										@if($user->member->foto_ktp)
										<a target="_blank" href="{{\Helper::showImage($user->member->foto_ktp, 'foto_ktp')}}">Lihat KTP</a>
										@else
										<span class="text-warning">Belum upload ktp</span>
										@endif
									</td>
								</tr>
								<tr>
									<td>SK Pengangkatan ASN</td>
									<td>
										@if($user->member->file_sk_pengangkatan_asn)
										<a class="btn btn-primary btn-sm mt-2" href="{{\Helper::showImage($user->member->file_sk_pengangkatan_asn, 'sk_pengangkatan_asn')}}" target="_blank">Lihat Dokumen</a>
										@else
										<span class="text-warning">Belum upload SK Pengangkatan</span>
										@endif
									</td>
								</tr>
							</table>
						</div>
					</div>
				</div> 
				<div class="col-md-12">
					<div class="card">
						<div class="card-body">
							<h5>Pelatihan Yang Pernah Diikuti</h5>
							<table class="table table-bordered table-hover" id="table-pelatihanDiIkuti">
								<thead>
									<tr>
										<th>No</th>
										<th>Nama Event</th>
										<th>Tanggal Pelaksanaan</th>
										<th>Lihat Web</th>
									</tr>
								</thead>
								<tbody>
									@foreach($my_event['event'] as $key => $e)
									<tr>
										<td style="width: 5%">{{ $key+1 }}</td>
										<td style="width: 60%;">
											<a target="_blank" href="{{route('dashboard2.get_user_by_event', $e['id_eventt'] )}}">{{ $e['judul']}}</a>
										</td>
										<td>{{ \Helper::changeFormatDate($e['tgl_start']).' s/d '.\Helper::changeFormatDate($e['tgl_end']) }}</td>
										<td><a class="btn btn-outline-primary btn-sm" href="{{env('URL_EVENT').'event/'.$e['slug']}}" target="_blank">Menuju website</a></td>
									</tr>
									@endforeach
								</tbody>
							</table>
						</div>
					</div>
				</div>         
			</div>

		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
	<script src="https://cdn.datatables.net/2.0.5/js/dataTables.js"></script>
	@include('js/custom_script')
	<script>
		$(document).ready( function () {
			$('#table-pelatihanDiIkuti').DataTable();
		} );
	</script>
</body>
</html>