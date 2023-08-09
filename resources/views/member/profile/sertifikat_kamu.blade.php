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
					<th scope="col" width="60%">Nama Event</th>
					<th scope="col">Tanggal Pelaksanaan</th>
					<th scope="col">Action</th>
				</tr>
			</thead>
			<tbody>
				@foreach($list_sertif['list'] as $key => $list)
				<tr>
					<td>{{ $key+1 }}</td>
					<td>{{ $list['judul']}}</td>
					<td>{{ \Helper::changeFormatDate($list['tanggal_mulai']).' s/d '.\Helper::changeFormatDate($list['tanggal']) }}</td>
					<td>
						@if(!empty($list['testimoni']) && is_null($list['testimoni']))
						<form method="POST" action="<?=$this->config->item('url_api_sertifikat').'member/testimoni_peserta/'.$list['sertifikat_id']?>" id="formTestimoni">
							<textarea class="form-control" rows="3" placeholder="Masukkan testimoni anda" name="testimoni" required></textarea>
							<button type="submit" class="btn btn-success btn-sm mt-1">Kirim</button> <br>
							<span class="text-warning" style="font-size: 13px;">* download sertifikat dapat dilakukan setelah mengirim testimoni
							</span>
						</form>	
						@elseif(!empty($list['testimoni']) && $list['testimoni'] && $list['testimoni_status'] == 0)
						<a class="btn btn-success btn-sm disabled" disabled>Download</a>	
						@else
						<a class="btn btn-success btn-sm" target="blank_" href="<?=$list['download']?>">Download</a>
						@if($list['video'])
						<a href="javascript:void()" class="btn btn-info btn-sm" id="btnVideoMateri" data-slug="{{$list['slug']}}">Video & Materi</a>
						@endif
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
<div class="modal fade" id="modalMateri" tabindex="-1" role="dialog" aria-labelledby="modalMateriLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalMateriLabel">Link Materi & Video</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<div class="modal-body">

			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
				<button type="button" class="btn btn-primary">Save changes</button>
			</div>
		</div>
	</div>
</div>
@endsection
@section('scripts')
@include('js/custom_script')
<script>
	$(document).ready(function(){
		
		$('body').on('click', '[id="btnVideoMateri"]', function(e) {
			e.preventDefault()
			let _sl = $(this).attr('data-slug')
			$.ajax({
				url: "{{'page/get_video_materi'}}" + '/' + _sl,
				method: 'GET',
				success: function(d){
					var matt = JSON.parse(d)
					if (matt[0] == '') {
						alert('video & materi belum ada')
					}else{
						var cont = '<ul>'
						$.each(matt, function(k, v){
							console.log(v)
							_link = v.match(/\b(http|https)?(:\/\/)?(\S*)\.(\w{2,4})(.*)/g)
							// console.log(_link)
							if (_link) {
								_link = _link
							}else{
								_link = ''
							}
							_removal = v.replace(_link, '')
							if (v != '') {
								cont += `<li>${_removal}<a href="${_link}" target="_blank">${_link}</a></li>`
							}							
						})
						cont += '</ul>'
						$('#modalMateri').modal('show')
						$('#modalMateri .modal-body').html(cont)
					}
				},
				error: function(e){
					console.log(e)
				}
			})
		})
	})
</script>
@endsection