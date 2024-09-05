<div class="con_full posting-back mt-4">
    <div class="your-posting-class">
        @foreach($artikel as $d)
        <div class="posting-card">
            <div style="background: linear-gradient(180deg,hsla(0,0%,100%,0) 0,rgba(0,0,0,.45) 0,#000),url(
                '{{\Helper::showImage($d->cover, 'artikel/cover')}}'
            ) no-repeat center / cover; height:200px;
            "class="d-flex align-items-center">
            <div class="px-4">
                <div class="posting-out-topik"><span class="posting_short_topik">{{$d->kategoris->nama ?? '-'}}</span></div>
                <div class="d-flex align-items-center my-2">
                    <div>
                        <a href="{{route('artikel.indexProfile', ['uname' => \Helper::getUname($d->user)])}}" class="posting_out"><img class="posting_in" src="{{\Helper::showImage($d->user->member->foto_profile, 'foto_profile')}}" alt="User profile picture"></a>
                    </div>
                    <a href="{{route('artikel.indexProfile', ['uname' => \Helper::getUname($d->user)])}}" style="color: #fff">
                        <div class="posting_short_name px-2">{{ucfirst(\Helper::cutString($d->user->name, 50))}}</div>
                    </a>
                    <div class=""><i class="fa-solid fa-circle-check posting_checklist"></i></div>
                </div>
                <a href="{{route('artikel.detail', ['uname' => \Helper::getUname($d->user), 'slug' => $d->slug])}}" class="posting_short_desc">{{\Helper::cutString($d->judul, 70)}}</a>
            </div>
        </div>
    </div>
    @endforeach

</div>
<div class="beauty_prev">
    <span><i class="fa-solid fa-angle-left"></i></span>
</div>
<div class="beauty_next">
    <span><i class="fa-solid fa-angle-right"></i></span>
</div>
</div>
