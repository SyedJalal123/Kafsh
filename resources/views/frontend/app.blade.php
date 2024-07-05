<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Luxury Shoes | Kafsh</title>
    <!-- Bootstrap 5 CSS -->
    <link rel='stylesheet' href="{{asset('frontend/css/bootstrap.min.css')}}">
    <!-- Style CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/style_head.css')}}">
    <!-- Demo CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/demo_head.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/custom.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/fonts/SourceSansPro-Semibold.ttf')}}">
    <!-- Bootstrap Font Icon CSS -->
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap-icons.css')}}">
    <link rel="stylesheet" href="{{url('frontend/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{url('frontend/css/owl.theme.default.min.css')}}">
    @yield('styles')
    <style>
        @font-face {
            font-family: ArterioNonCommercial;
            src: url('frontend/fonts/ArterioNonCommercial.otf');
        }
        @font-face {
            font-family: ABChanel Corpo Regular;
            src: url('frontend/fonts/ABChanel Corpo Regular.ttf');
        }
        @font-face {
            font-family: Poppins;
            src: url('frontend/fonts/Poppins-Regular.ttf');
        }
    </style>
    <script>
        PR_URL = "{{URL('')}}";
    </script>
    @if (!isset($home))
        <link rel="stylesheet" href="{{url('frontend/css/mdb.min.css')}}" />
        <style>
            .body {
                overflow: hidden;
            }
            .header-bar > div {
                background: #fff;
                color: #000 !important;
                transition-duration: 200ms;
            }
            .header-bar > div .navbar-brand img {
                transition-duration: 200ms;
                filter: brightness(0.1);
            }
            .header-bar > div .nav-link {
                transition-duration: 200ms;
                color: #000;
            }
            .header-bar > div .header-buttons svg {
                color: black;
            }
            .nav-head .navbar {
                border-top: 1px solid black !important;
            }
            .main {
                /* background: #f8f8f8; */
                padding-top: 179px; 
            }
            .logo-box * {
                color: rgb(0, 0, 0);
            }
            .logo-box-phone * {
                color: rgb(0, 0, 0);
            }

            @media only screen and (max-width: 991px) { /* Phones */
                .main {
                    padding-top: 25px !important;
                }
            }
        </style>
    @endif
</head>
<body>
    @yield('sidebar')

    <header>
        <div class="Info__Bar">
            <a class="Info__Bar__Text" href="#">Free delivery on orders over £250</a>
            <ul class="Info__Bar__Menu">
                <li><a class="Info__Bar__Menu__Link" href="storelocator">Store Locator</a></li>
                <li><a class="Info__Bar__Menu__Link" href="sign-in">Sign In</a></li>
                <li><a class="Info__Bar__Menu__Link" href="register">Create an account</a></li>
            </ul>
        </div>
        <!-- Navbar Start -->
        @include('frontend.includes.navbar')
        <!-- Navbar End -->
        @yield('slider')
    </header>

    @yield('content')
    
    <!-- Footer Start -->
    @include('frontend.includes.footer')
    <!-- Footer End -->

    <!-- Bootstrap 5 JS -->
    @if(!isset($cart_page) && !isset($product_page))
    {{-- <script src="{{asset('frontend/js/bootstrap.bundle.min.js')}}"></script> --}}
    @endif
    <script src="{{asset('frontend/js/bootstrap-cart.bundle.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="{{asset('frontend/js/jQuery-3.7.1.js')}}"></script>
    <script src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
    
    <script>
        document.addEventListener('click',function(e){
            // Hamburger menu
            if(e.target.classList.contains('hamburger-toggle')){
                e.target.children[0].classList.toggle('active');
            }
        });
        $(document).ready(function(){
            if (window.matchMedia('(min-width: 991px)').matches) {
                $(".nav-link-parent, .dropdown-menu").mouseenter(function(){
                    $(this).addClass("show").next().addClass("show");
                });
                $(".nav-link-parent, .dropdown-menu").mouseleave(function(){
                    $(this).removeClass("show").next().removeClass("show");
                });
            }

            $(document).on('click', '.is-minus', function(){
                val = parseInt($('#quantity_input').val()) - 1;
                if(val > 0){
                    $('#quantity_input').val(parseInt(val));
                }
            });

            $(document).on('click', '.is-plus', function(){
                val = parseInt($('#quantity_input').val()) + 1;
                $('#quantity_input').val(parseInt(val));
            });

            setInterval(function() { 
                // alert();
                if($('.shaking-btn').hasClass('animation-active')){
                    $('.shaking-btn').removeClass('animation-active');
                }else{
                    $('.shaking-btn').addClass('animation-active');
                }
            }, 1000);

            $(".owl-carousel").owlCarousel({
                loop:true,
                margin:30,
                nav:false,
                responsive:{
                    0:{
                        items:1
                    },
                    600:{
                        items:3
                    },
                    1000:{
                        items:4
                    }
                }
            });
        });
        function addCommas(nStr){
            nStr += '';
            x = nStr.split('.');
            x1 = x[0];
            x2 = x.length > 1 ? '.' + x[1] : '';
            var rgx = /(\d+)(\d{3})/;
            while (rgx.test(x1)) {
                x1 = x1.replace(rgx, '$1' + ',' + '$2');
            }
            return x1 + x2;
        }
        function disabled_button(id,button){
            if ($('#'+id+' .name').val() != '' && $('#'+id+' .phone').val() != '' && $('#'+id+' .email').val() != '' && $('#'+id+' .city-select').val() != '' && $('#'+id+' .address').val() != ''){
                $('#'+id+' #'+button).prop('disabled', true);
                $('#'+id+' form').submit();
            }
            else{
                $('#'+button).prop('disabled', false);
            }
        }
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script> --}}
    @yield('scripts')
    @yield('models')
</body>

</html>