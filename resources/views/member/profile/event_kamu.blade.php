@extends('member.layouts.template')
@section('styles')
@endsection
@section('content')
<div class="tab-pane fade show active" id="pills-rekomendasievent" role="tabpanel" aria-labelledby="pills-home-tab">
	<h5 class="font-italic">
		Event yang Kamu ikuti <small><a class="badge badge-primary" href="{{route('allevent', ['id' => 0])}}">Semua Event</a></small>
	</h5>
	<div class="row card-body">
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
						<button type="button" onclick="getEvent('{{$e['slug']}}');" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#exampleModal"><i class="fa fa-eye"></i></button>
						@if(is_null($e['testimoni']))
						<button type="button" class="btn btn-info btn-sm" data-slug="{{$e['slug']}}" id="btnTestimoni"><i class="fa fa-book"></i></button>
						@endif
					</td>
				</tr>
				@endforeach
			</tbody>
		</table>
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
<script>
	$(document).ready(function(){
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
	})
</script>
@endsection
