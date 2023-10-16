@extends('member.layouts.template')
@section('styles')
<link rel="stylesheet" type="text/css" href="{{ asset('template/select2/css/select2.css') }}">
<style>
	#modalTransferEvent .select2-results__option{
		border-top: 1px solid #afa6afaa;
		border-bottom: 1px solid #afa6afaa;
		color: #424744;
	}
</style>
@endsection
@section('content')
<div class="tab-pane fade show active" id="pills-rekomendasievent" role="tabpanel" aria-labelledby="pills-home-tab">
	<h5 class="font-italic">
		Event yang Kamu ikuti <small><a class="badge badge-primary" href="{{route('allevent', ['id' => 0])}}">Semua Event</a></small>
	</h5>
	<a href="javascript:void(0);" data-toggle="modal" data-target="#modalTransferEvent" class="btn btn-outline-primary btn-sm mb-1">Transfer Event</a>
	<br>
	<small class="text-warning mb-2"> * Jika ingin melakukan perpindahan event dengan email yang berbeda</small>
	<div class="modal fade" id="modalTransferEvent" tabindex="-1" aria-labelledby="modalTransferEventLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="modalTransferEventLabel">Transfer Event</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<form id="formTransferEvent" method="POST" action="{{route('member_profile.event_kamu.transferEvent')}}">
					@csrf
					<div class="modal-body">
						<div class="form-group">
							<label for="exampleFormControlInput1">Email</label>
							<input type="email" class="form-control" placeholder="Masukkan email" name="email">
							<small class="text-warning" style="font-size: 12px;">Isi dengan email lama anda yang pernah mengikuti kegiatan di LPKN</small>
						</div>
						<div class="form-group">
							<label for="exampleFormControlInput1">Event</label>
							<select name="event" class="form-control">
								<option value="">Pilih Event</option>
								@foreach($list_event as $l)
								<option value="{{$l['id']}}" data-brosur="{{$l['brosur_img']}}" data-judul="{{$l['judul']}}" >{{$l['judul'].', '.\Helper::changeFormatDate($l['tgl_start'], 'd-M-Y').' s/d '.\Helper::changeFormatDate($l['tgl_end'], 'd-M-Y').' - '.$l['id'] }}</option>
								@endforeach
							</select>
							<div id="div-detailEvent" style="display: none;">
								Judul Event : <p id="p-judul" class="mb-1"></p>
								Tanggal Event : <p id="p-tgl" class="mb-1"></p>
								Brosur : <a href="" target="_blank">Lihat Brosur</a>
							</div>
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Transfer</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<table class="table table-hover table-bordered table-responsive-sm tableEventKamu" id="tableEventKamu" style="width: 100%;">
				<thead class="thead-dark">
					<tr>
						<th scope="col">No</th>
						<th scope="col">Nama Event</th>
						<th scope="col">Testimoni</th>
						<th scope="col">Tanggal Pelaksanaan</th>
						<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($my_event['event'] as $key => $e)
					<tr>
						<td>{{ $key+1 }}</td>
						<td>{{ $e['judul']}}</td>
						<td>{{ $e['testimoni'] ?? '-'}}</td>
						<td>{{ \Helper::changeFormatDate($e['tgl_start']).' s/d '.\Helper::changeFormatDate($e['tgl_end']) }}</td>
						<td>
							<button type="button" onclick="getEvent('{{$e['slug']}}');" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal" data-toggle="tooltip" data-placement="top" title="Lihat Event"><i class="fa fa-eye"></i></button>
							@if(is_null($e['testimoni']))
							<button type="button" class="btn btn-info btn-sm" data-slug="{{$e['slug']}}" id="btnTestimoni" data-toggle="tooltip" data-placement="top" title="Masukan Testimoni"><i class="fa fa-book"></i></button>
							@endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
	</div>
</div>
<div class="modal fade" id="modalTestimoni" tabindex="-1" role="dialog" aria-labelledby="modalTestimoniLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="modalTestimoniLabel">Testimoni</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
			</div>
			<form action="{{route('member_profile.testimoni.storeTestimoni')}}" method="POST" id="formTestimoni">
				<div class="modal-body">
					@csrf
					<input type="hidden" name="slug">
					<input type="hidden" name="email" value="{{\Auth::user()->email}}">
					<div class="form-group">
						<textarea name="testimoni" rows="3" class="form-control" placeholder="Masukkan testimoni"></textarea>
					</div>
					<div class="form-group">
						<div class="rating d-flex justify-content-center">
							<input type="hidden" name="star_rating">
							<i class="rating__star far fa-star"></i>
							<i class="rating__star far fa-star"></i>
							<i class="rating__star far fa-star"></i>
							<i class="rating__star far fa-star"></i>
							<i class="rating__star far fa-star"></i>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
					<button type="submit" class="btn btn-primary">Kirim</button>
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
@section('scripts')
@include('js/custom_script')
<script type="text/javascript" src="{{ asset('template/select2/js/select2.js') }}"></script>
<script>
	$(document).ready(function(){
		$('body').on('change', '[name=event]', function(e) {
			let v = $(this).find(':selected').text()
			let _img = $(this).find(':selected').data('brosur')
			v = v.split(',')
			if (v.length > 1) {
				$('#div-detailEvent').show(300)
				$('#div-detailEvent a').attr('href', _img)
				$('#p-judul').text(v[0])
				$('#p-tgl').text(v[1])
			}else{
				$('#div-detailEvent').hide(300)
				$('#div-detailEvent a').attr('href', '#')
				$('#p-judul').text('')
				$('#p-tgl').text('')
			}

		})
		// $('#modalTransferEvent [name=event]').select2({
		// 	dropdownParent: $('#modalTransferEvent .modal-content'),
		// 	width : '100%'
		// })
		$('body').on('click', '#btnTestimoni', function(){
			let _slug = $(this).attr('data-slug')
			// alert(_slug)
			$('[name=slug]').val(_slug)
			$('#modalTestimoni').modal('show')
		})
		const ratingStars = [...document.getElementsByClassName("rating__star")];

		function executeRating(stars) {
			const starClassActive = "rating__star fas fa-star";
			const starClassInactive = "rating__star far fa-star";
			const starsLength = stars.length;
			let i;
			stars.map((star) => {
				star.onclick = () => {
					i = stars.indexOf(star);
					$('[name=star_rating]').val(i+1)
					if (star.className===starClassInactive) {
						for (i; i >= 0; --i) stars[i].className = starClassActive;
					} else {
						for (i; i < starsLength; ++i) stars[i].className = starClassInactive;
					}
			};
		});
		}
		executeRating(ratingStars);

		$('#formTestimoni').submit(function(e) {
			e.preventDefault();

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('input[name="_token"]').val()
				}
			});
			$.ajax({
				type: 'POST',
				url: $(this).attr('action'),
				data: $(this).serialize(),
				success: function(d){
					showAlert(d.msg)
					setTimeout(function() {
						location.reload()
					}, 1000);
				},
				error: function(data){
					var data = data.responseJSON;
					showAlert(data.messages, "error")
				}
			})
		})

		$('#formTransferEvent').submit(function(e) {
			e.preventDefault();

			$.ajaxSetup({
				headers: {
					'X-CSRF-TOKEN': $('input[name="_token"]').val()
				}
			});
			$.ajax({
				type: 'POST',
				url: $(this).attr('action'),
				data: $(this).serialize(),
				beforeSend: function() {
					sendAjax('#formTransferEvent button[type=submit]', false)
				},
				success: function(d){
					console.log(d)
					if (d.status == 'Failed') {
						showAlert(d.message, "error")
					}else{
						showAlert("Berhasil transfer event ke akun anda.")
					}
					setTimeout(function() {
						location.reload()
					}, 1000);
				},
				error: function(data){
					var data = data.responseJSON;
					if (data.status == "fail") {
						showAlert(data.messages, "error")
					}
					sendAjax('#formTransferEvent button[type=submit]', true, 'Transfer')
				},
				complete: function(data){
					sendAjax('#formTransferEvent button[type=submit]', true, 'Transfer')
				}
			})
		})
	})
</script>
@endsection
