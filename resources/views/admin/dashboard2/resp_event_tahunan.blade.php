<tr>
	<td rowspan="2">KEGIATAN</td>
	@foreach($arrYear as $y)
	<td colspan="2" id="selYear-{{$y['tahun']}}" style="padding: 3px;background-color: #bdd7f7;"><a href="javascript:void" data-year="{{$y['tahun']}}" style="color: #000;text-decoration: underline;font-size: 15px;">{{$y['tahun']}}</a></td>
	@endforeach
</tr>
<tr>
	@for($i=0;$i<count($arrYear);$i++)
	@foreach($listStatus as $l)
	<td>{{$l}}</td>
	@endforeach
	@endfor
</tr>
@foreach($newArrayTahun as $k => $v)
<tr>
	<td>
		@if($k == 'KELAS PBJ')
		<a href="{{url('dashboard2/lulus_pbj')}}" target="_blank">{{$k}}</a>
		@else
		{{$k}}
		@endif
	</td>
	@foreach($v as $value)
	<td>{{$value}}</td>
	@endforeach
</tr>
@endforeach