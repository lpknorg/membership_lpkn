<!doctype html>

<?php $event = $detail_event['event']; ?>
<div class="modal-content">
	<div class="modal-body">
		<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true"><i class="fa fa-times"></i></span></button>
		<div class="row">
			<div class="col-sm-6">
				<img class="img-fluid" src="https://event.lpkn.id/uploads/brosur/{{$event['brosur']}}">
			</div>
			<div class="col-sm-6">
				<div class="container-fluid">
					<br/>
					<div class="text-center">
						<h1>{{$member->name}}</h1>
						<p>Silahkan melakukan pembayaran ke : </p>
						<img width="150" src="https://event.lpkn.id/assets/img/{{$detail_event['akun_bank']['logo']}}">
						<h5>a/n {{$detail_event['akun_bank']['atas_nama']}}<br/>No.rek : {{$detail_event['akun_bank']['no_rek']}}</h5>
						<h3><small>Sebesar : </small>Rp. {{number_format($detail_event['biaya_event']['nominal_biaya']+$detail_event['unik_code'])}},-</h3>
						<form method="post" class="upload_bukti" id="upload_bukti">
							@csrf
							<input type="hidden" id="slug" name="slug" value="{{$event['slug']}}">
							<hr style="background-color: #fff;"></hr>
							<input type="hidden" name="id_regis" value="{{$detail_event['id_regis']}}">
							<h5> {{$detail_event['bukti'] == null ? 'Upload' : 'Upload Ulang'}} Bukti</h5>
							<input type="file" name="bukti" class="form-control"><br/>
							<button type="submit" class="btn btn-primary">
								Upload {{$detail_event['bukti'] == null ? '' : 'Ulang'}}
							</button>
						</form>
						<hr style="background-color: #fff;"></hr>
						@if(is_null($detail_event['bukti']))
						<h5>Atau memlalui pembayaran Online</h5>
						<button type="submit" class="btn btn-primary">Bayar Online</button>
						@else
						<p>Terimakasih telah mengirim bukti transfer,<br/>Selanjutnya Panitia akan memverifikasi pembayaran Anda <br/> Verifikasi pembayaran paling lambat 2x24 jam</p>
						@endif
					</div>
					<hr style="background-color: #fff;"></hr>
					<p class="modal-title w-100 text-center">
						WhatsApp Panitia :<br/>
						<?php $no = 1; foreach ($detail_event['panitia'] as $row) {?>
							<a class="btn btn-success btn-sm mb-2" style="border-radius: 40px;" target="blank_" href="https://wa.me/<?=$row['phone']?>">
								<i class="fa fa-whatsapp"></i> Panitia <?=$no++?>
							</a>
						<?php } ?>
						<br/>
						Kontak Panitia :<br/>
						<?php foreach ($detail_event['panitia'] as $row) {
							echo substr_replace($row['phone'],'0','0',2).', ';
						} ?>
					</p>
				</div>
			</div>
		</div>
	</div>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script>
	$('.upload_bukti').on('submit', function(e){
        	// alert('berhasil');
        	e.preventDefault();
        	var data = new FormData(this);
        	$.ajax({
        		url: "{{route('member_profile.upload_bukti')}}",
        		data: data,
        		cache: false,
        		contentType: false,
        		processData: false,
        		type: 'POST',
        		dataType: "json",
        	})
        	.done(function(res) {
        		if(res.success) {
        			toastr.success(res.msg, 'Success', 
        			{
        				"positionClass": "toast-top-right",
        				"preventDuplicates": false,
        				"showDuration": "300",
        				"hideDuration": "1000",
        				"timeOut": "2000",
        				"extendedTimeOut": "1000",
        				"showEasing": "swing",
        				"hideEasing": "linear",
        				"showMethod": "fadeIn",
        				"hideMethod": "fadeOut"
        			})
                    getEvent($('#slug').val());
                } else {
                	toastr.error(res.msg, 'Failed', 
                	{
                		"positionClass": "toast-top-right",
                		"preventDuplicates": false,
                		"showDuration": "300",
                		"hideDuration": "1000",
                		"timeOut": "2000",
                		"extendedTimeOut": "1000",
                		"showEasing": "swing",
                		"hideEasing": "linear",
                		"showMethod": "fadeIn",
                		"hideMethod": "fadeOut"
                	})
                    // alert('gagal');
                }
            })                
        });
    </script>
