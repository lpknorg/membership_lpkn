<div class="con_full">
		<div class="blog-main mt-2 mb-5">
        <!-- <form class="form-inline ml-0 md-4" action="">
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Cari event" name="keyword" >
                                    <div class="input-group-append">
                                        <button class="btn btn-primary" type="button" id="serch_event">
                                            <i class="fa fa-search"></i>
                                        </button>
                                    </div>
                                </div>
                            </form> -->
			<div class="blog-post">
                @foreach($event['newArr'] as $evt)
                <h3 class="text-light text-center">{{\Helper::bulanIndo($evt['bulan']).' '.$evt['tahun']}}</h3>
                <div class="row" id="content-event">
                    @foreach($evt['data'] as $e)
                    <div class="col-lg-3 col-12 card-wrapper-special">
                        <div class="card card-special img__wrap">
                            <img class="card-img-top card-img-top-special" src="{{$e['brosur_img']}}" alt="Card image cap">
                            <div class="img__description_layer">
                                <p class="small mb-2">{{ $e['judul'] }}</p>
                                <button type="button" id="btnSelengkapnya" slug="{{$e['slug']}}" class="btn btn-primary btn-sm mb-1 py-0"><small>Selengkapnya</small></button></button>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                @endforeach
          </div>
      </div>
</div>
