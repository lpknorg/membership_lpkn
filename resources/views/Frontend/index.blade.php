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
    <script  src="{{asset('frontend/js/testimoni.js')}}"></script>
  </body>
</html>
