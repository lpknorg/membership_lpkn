<script>
	$(document).ready( function () {
		$('.tableMenungguPembayaran').DataTable();
		$('.tableEventKamu').DataTable();
	});

	function getEvent(slug) {
		alert(slug)
		if(slug.substring(0, 28) == 'https://event.lpkn.id/event/'){
			var l = slug.length
			slug = slug.substring(28,l);
		}
		var url = "{{url('member_profile/page/get_event')}}" + `/${slug}`
		console.log(url)
		$('.exampleModal').load(url);
	}
</script>