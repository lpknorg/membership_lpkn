@extends('member.layouts.template')
@section('content')
<div class="tab-pane fade show active" id="pills-rekomendasievent" role="tabpanel" aria-labelledby="pills-home-tab">
	<h5 class="font-italic">
		List Sertifikat <small><a class="badge badge-primary" href="{{route('member_profile.allevent', ['id' => 0])}}">Semua Event</a></small>
	</h5>
	<p class=" border-bottom">Sertifikat yang telah kamu peroleh di acara kami</p>
	<div class="row card-body">
		<table class="table table-hover table-bordered table-responsive-sm tableEventKamu" id="tableEventKamu" style="width: 100%;">
			<thead class="thead-dark">
				<tr>
					<th scope="col">No</th>
					<th scope="col">Nama Event</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($list_sertif['list'] as $key => $list)
				<tr>
					<td>{{ $key+1 }}</td>
					<td>{{ $list['judul']}}</td>
					<td>
					<?php 
						if(!empty($list['testimoni']) && is_null($list['testimoni'])){ ?>
								<form method="POST" action="<?=$this->config->item('url_api_sertifikat').'member/testimoni_peserta/'.$list['sertifikat_id']?>" id="formTestimoni">
									<textarea class="form-control" rows="3" placeholder="Masukkan testimoni anda" name="testimoni" required></textarea>
									<button type="submit" class="btn btn-success btn-sm mt-1">Kirim</button> <br>
										<span class="text-warning" style="font-size: 13px;">* download sertifikat dapat dilakukan setelah mengirim testimoni
										</span>
								</form>	
						<?php } else if(!empty($list['testimoni']) && $list['testimoni'] && $list['testimoni_status'] == 0){ ?>
							<a class="btn btn-success btn-sm disabled" disabled>Download</a>	
						<?php }else{ ?>
						<a class="btn btn-success btn-sm" target="blank_" href="<?=$list['download']?>">Download</a>
					<?php } ?>
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection
@section('scripts')
@include('js/custom_script')
@endsection