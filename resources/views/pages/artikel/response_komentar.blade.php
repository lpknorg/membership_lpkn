@foreach($data as $d)
<div class="row my-2">
    <div class="col-2 col-sm-1 d-none d-sm-block">
        <div class="artikel_comment_out_image">
            <img class="artikel_comment_in_image" src="{{\Helper::showImage($d->user->member->foto_profile, 'poto_profile')}}" alt="User profile picture">
        </div>
    </div>
    <div class="col-10 col-sm-11">
        <div class="small">{{$d->user->name}}</div>
        <div class="artikel_short_date px-2">{{$d->created_at}} | {{$d->updated_at->diffForHumans()}}</div>
        <div>{{$d->isi_komentar}}</div>
    </div>
</div>
@endforeach