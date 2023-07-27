<script>
	function getEvent(slug) {
		var url = "{{url('member_profile/page/get_event')}}" + `/${slug}`
		$('.exampleModal').load(url);
	}
</script>