<div class="col-md-3">
	<div class="card card-primary card-outline">
		<div class="card-body box-profile">
			<div class="out_img mb-2" style="padding: 0px; margin: 0 auto">
				<img class="in_img" src="{{\Helper::showImage(\Auth::user()->member->foto_profile, 'poto_profile')}}" alt="User profile picture">
			</div>
			<div class="text-center">
				<button type="button" class="text-dark btn btn-transparent btn-sm" data-toggle="modal" data-target="#update_foto">
					<i class="fa fa-camera"></i> Ganti fotos
				</button>
			</div>

			<h3 class="profile-username text-center">{{\Auth::user()->name}}  </h3>

			<ul class="list-group list-group-unbordered mb-3">
				<li class="list-group-item">
					<b>Ikut Event</b> <a class="float-right">{{\Auth::user()->total_event}}</a>
				</li>
				<li class="list-group-item">
					<b>Data Sertifikat</b> <a class="float-right">{{\Auth::user()->total_sertifikat}}</a>
				</li>
			</ul>

			<a href="{{ route('member_profile.download_kta') }}" class="btn btn-primary btn-block"><b>Download KTA</b></a>
		</div>
		<!-- /.card-body -->
	</div>
	<div class="card card-primary mt-3">
		<div class="card-header">
			<h5 class="card-title">About Me</h5>
		</div>
		<div class="card-body">
			<strong><i class="fa fa-at mr-1"></i> Email</strong>
			<p class="text-muted">{{\Auth::user()->email}}</p>
			<hr>
			<strong><i class="fa fa-phone mr-1"></i> No. Tlp</strong>
			<p class="text-muted">{{\Auth::user()->member->no_hp ?? '-'}}</p>
			<hr>
			<strong><i class="fa fa-building mr-1"></i> Instansi</strong>
			<p class="text-muted">{{\Auth::user()->member->memberKantor->nama_instansi ?? '-'}}</p>
			<hr>
			<strong><i class="fa fa-map-marker mr-1"></i> Alamat</strong>
			<p class="text-muted">{{\Auth::user()->member->alamat_lengkap ?? '-'}}
			</p>
		</div>
	</div>
</div>