<div class="x_panel table-responsive">
	<h5>Rekap Event Bulanan Tahun {{$selectedYear}}</h5>
	<table class="table table-bordered" id="table-rekap rekapp2">
		<tr>
			<td rowspan="2" style="vertical-align: middle;text-align: center;">KEGIATAN</td>
			@foreach($months as $m)
			<td colspan="2" style="vertical-align: middle;text-align: center;">{{$m}}</td>
			@endforeach
			<td rowspan="2" style="vertical-align: middle;">Total Data</td>
		</tr>
		<tr>
			@for($i=0;$i<12;$i++)
			@foreach($listStatus as $l)
			<td style="vertical-align: middle;text-align: center;">{{$l}}</td>
			@endforeach
			@endfor					
		</tr>
		@foreach($newArrayBulan as $k => $v)
		<tr>
			<td>{{$k}}</td>
			@foreach($v as $value)
			<td>{{$value}}</td>
			@endforeach					
			<td>12345</td>
		</tr>
		@endforeach
	</table>
</div>