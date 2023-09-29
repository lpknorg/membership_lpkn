@include('template.head')
<title>LPKN</title>
@include('member.layouts.navbar')
@include('Frontend.slider')
@include('Frontend.posting.index')
@include('Frontend.event')
@include('Frontend.body.testimoni')
@include('Frontend.body.footer')
<!-- Optional JavaScript; choose one of the two! -->
<!-- Option 1: jQuery and Bootstrap Bundle (includes Popper) -->
@include('template.footer')
@include('Frontend.posting.js')
@include('member.layouts.modals')
@include('js/custom_script')
<script  src="{{asset('frontend/js/testimoni.js')}}"></script>
<script>
        // alert(123)
    $('body').on('click', '[id="btnSelengkapnya"]', function(e) {
        let sl = $(this).attr('slug')
        $('#exampleModal').modal('show')
        getEvent(sl)        
    })
    @if(session('key_slug'))
    setTimeout(function() {
        $('#exampleModal').modal('show')
        getEvent('{{session('key_slug')}}')
        {{session()->forget('key_slug')}}
    }, 500);
    @endif
</script>
</body>
</html>
