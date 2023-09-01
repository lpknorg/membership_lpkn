<!doctype html>
		    <?php $event = $detail_event['event']; ?>
		    <div class="modal-content" id="load_vocher">
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
		      				<h1>Yth, {{$member['name']}}</h1>
		      				<p>Pembayaran Anda telah dikonfirmasi<br/>Untuk mempermudah kordinasi, silahkan bergabung ke group event melalui link dibawah ini :</p>
		      				<a href="{{$event['link_group']}}" target="_blank" class="btn btn-success"><i class="fa fa-users"></i> Gabung ke group WhatsApp</a><br/>
		      				<a target="_blank" href="https://event.lpkn.id/event/kwitansi/{{$detail_event['id_regis']}}" class="btn btn-primary btn-sm mt-2"><i class="fa fa-file-pdf-o"></i> Download Kuitansi</a>
		      				<!-- <form method="post" class="regis_event" id="regis_event"> -->
	      					<!-- <form id="regis_event" method="post"> -->
			      				<hr style="background-color: #fff;"></hr>
			      				<input type="hidden" name="id_event" id="id_event" value="{{$event['id']}}">
			      				<h5>SELAMAT</h5>
	                            <?php
	                                $date = $event['tgl_start'];
	                                if(date($date) < date('2022-04-01')){
							            $diundi = "31 Maret 2022";
							        }elseif(date($date) >= date('2022-04-01') && date($date) < date('2022-07-01') ){
							            $diundi = "30 Juni 2022";
							        }elseif(date($date) >= date('2022-07-01') && date($date) < date('2022-10-01') ){
							            $diundi = "30 September 2022";
							        }elseif(date($date) >= date('2022-10-01') && date($date) < date('2023-01-01') ){
							            $diundi = "30 Desember 2022";
							        } elseif (date($date) >= date('2023-01-01') && date($date) < date('2023-03-01')) {
                                    $diundi = "28 Februari 2023";
                                } elseif (date($date) >= date('2023-03-01') && date($date) < date('2023-05-01')) {
                                    $diundi = "28 April 2023";
                                } elseif (date($date) >= date('2023-05-01') && date($date) < date('2023-07-01')) {
                                    $diundi = "30 Juni 2023";
                                } elseif (date($date) >= date('2023-07-01') && date($date) < date('2023-09-01')) {
                                    $diundi = "31 Agustus 2023";
                                }elseif (date($date) >= date('2023-09-01') && date($date) < date('2023-11-01')) {
                            		$diundi = "31 Oktober 2023";
                            	}
	                            ?>
					      		<p>Anda mendapatkan Voucher Undian yang<br/>akan di undi pada tanggal :
					      			<h5>
					      				<u>
					      					<b>
					      						{{$diundi}}
					      					</b>
					      				</u>
					      			</h5>
					      			<h2>
				      					<b class="text-primary">
				      						Kode Vocher : {{$detail_event['eventregis']['kode_vocher']}}
				      					</b>
					      			</h2>
					      		</p>
					      		<h4>Grand Prize 1 Unit Motor Yamaha NMAX<br/>Di Undi pada akhir tahun 2023</h4>
					      		</div>
					      	<!-- </form> -->
				      		<hr style="background-color: #fff;"></hr>
					      	<p class="modal-title w-100 text-center">
								WhatsApp Panitia :<br/>
								<?php $no = 1; foreach ($detail_event['panitia'] as $row) {?>
									<a class="btn btn-success btn-sm mb-2" style="border-radius: 40px;" target="blank_" href="https://wa.me/{{$row['phone']}}">
										<i class="fa-brands fa-whatsapp"></i> Panitia <?=$no++?>
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

