<div class="con_full">
		<div class="blog-main mt-2 mb-5">
            <div class="d-flex justify-content-between align-items-center">
				<h4 class="blog-post-title text-white">Total Event : <?= (isset($event['count'])) ? $event['count'] : ''?></h4>

                <ol class="breadcrumb" style="background-color: transparent;">
                    <li clayss="breadcrumb-item">
                        <form class="form-inline ml-0 ml-md-3" action="">
                            <div class="input-group">
                                <input type="text" class="form-control" placeholder="Cari event" name="keyword" >
                                <div class="input-group-append">
                                    <button class="btn btn-danger" type="button" id="serch_event">
                                        <i class="fa fa-search"></i>
                                    </button>
                                </div>
                            </div>
                        </form>
                    </li>
                </ol>
            </div>
			<div class="blog-post">
                <h3 class="text-light text-center">JANUARI 2023</h3>
				<div class="row" id="content-event">
					@foreach($event['event'] as $e)
					<div class="col-lg-3 col-12 card-wrapper-special">
						<div class="card card-special img__wrap">
							<img class="card-img-top card-img-top-special" src="{{$e['brosur_img']}}" alt="Card image cap">
							<div class="img__description_layer">
								<p style="padding: 6px">
                                    <button type="button" id="btnSelengkapnya" slug="{{$e['slug']}}" class="btn btn-primary btn-sm">Selengkapnya</button>
                                </p>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
                <div class="ml-2">
            <nav aria-label="...">
                <ul class="pagination">
                    <li class="page-item disabled">
                    <a class="page-link" href="#" tabindex="-1">Previous</a>
                    </li>
                    <!-- <li class="page-item active">
                    <a class="page-link" href="#">2 <span class="sr-only">(current)</span></a>
                    </li> -->
                    <?php $bagi = round($event['count'] / 9 + 1); $seg = \Request::segment(3); ?>
                    @for($i=1;$i<=$bagi;$i++)
                    <li class="page-item {{$seg == $i ? 'active' : ''}}">
                  @if(\Request::get('keyword'))
                  <a class="page-link" href="{{route('allevent', ['id' => $i, 'keyword' => \Request::get('keyword')])}}">
                    @else
                    <a class="page-link" href="{{route('allevent', ['id' => $i])}}">
                      @endif
                      {{$i}}
                      @if($seg == $i)
                      <span class="sr-only">(current)</span>
                      @endif
                    </a>
                  </li>
                  @endfor

                  <li class="page-item">
                    <a class="page-link" href="#">Next</a>
                  </li>
                </ul>
            </nav>
        </div>

          </div>
      </div>


</div>
