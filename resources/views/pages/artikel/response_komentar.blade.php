@foreach($data as $d)
<div class="row my-2">
    <div class="col-2 col-sm-1 d-none d-sm-block">
        <div class="artikel_comment_out_image">
            <img class="artikel_comment_in_image" src="{{\Helper::showImage($d->user->member->foto_profile, 'foto_profile')}}" alt="User profile picture">
        </div>
    </div>
    <div class="col-10 col-sm-11">
        <a href="{{route('artikel.indexProfile', ['uname' => \Helper::getUname($d->user)])}}" style="color: #fff;">
            <div class="small">{{$d->user->name}}</div>
        </a>
        <div class="artikel_short_date px-2">{{$d->created_at}} | {{$d->updated_at->diffForHumans()}}</div>
        <div>{{$d->isi_komentar}}</div>
    </div>
</div>
@endforeach