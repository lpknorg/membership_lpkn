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
<<<<<<< HEAD
@include('template.footer')
=======
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>
>>>>>>> ac986ae290e2d08d986b713dea23c9f016cc8534
    @include('Frontend.posting.js')
    <script  src="{{asset('frontend/js/testimoni.js')}}"></script>
  </body>
</html>
