<script type="text/javascript" src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script type="text/javascript" src="//code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.9.0/slick.js"></script>
<script type="text/javascript">
        $(window).on('load',function(){
            $('.your-posting-class').slick({
                    slidesToShow: 4,
                    slidesToScroll: 1,
                    arrows: true,
                    prevArrow:'.beauty_prev',
                    nextArrow:'.beauty_next',
                    responsive: [
                    {
                    breakpoint: 850,
                    settings: {
                        arrows: false,
                        slidesToShow: 3
                        }
                    },{
                    breakpoint: 780,
                    settings: {
                        arrows: false,
                        slidesToShow: 2
                        }
                    },{
                    breakpoint: 480,
                    settings: {
                        arrows: false,
                        slidesToShow: 1.1
                    }
                }
            ]
        });
            $('.posting-back').fadeIn();
        })
</script>
