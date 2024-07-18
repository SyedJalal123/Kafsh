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
        @if(Session::has('success-subscribed'))
            <input type="hidden" id="success-subscribed" value="1">
        @else
            <input type="hidden" id="success-subscribed" value="0">
        @endif
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
    <script src="{{asset('frontend/js/sweetalert2.js')}}"></script>

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
            
            if($('#success-subscribed').val() == 1){
                Swal.fire({
                    icon: "success",
                    title: "Successfully Subscribed",
                    showConfirmButton: false,
                    timer: 3000,
                    showCloseButton: true,
                    footer: '<a href="'+PR_URL+'/collections/all" class="btn-3">GO TO SHOP</a>'
                });
            }
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
        function load_search_content(){
            $('.search-bar-content').removeClass('d-none');
            $('.loading').removeClass('d-none');
            $('.search-bar-body').addClass('d-none');
            $('.empty-data').addClass('d-none');
            val = $('#search-bar').val();
            
            if(val == ""){
                $('.search-bar-content').addClass('d-none');
                $('.loading').addClass('d-none');
            }else{
                $.ajax({
                    url: PR_URL+"/search_data",
                    type: "POST",
                    data:{ 
                        val: val,
                    },
                    success: function(response){
                        if(response[0].length == 0 && response[1].length == 0){
                            $('.empty-data').removeClass('d-none');
                            $('.loading').addClass('d-none');
                        }else{
                            $('.search-bar-body').removeClass('d-none');
                            $('.loading').addClass('d-none');
                            $('.search-bar-item').remove();

                            html = '';
                            for(i=0; i<response[0].length; i++){
                                html += '<a href="'+PR_URL+'/products/'+response[0][i]['slug']+'" class="d-flex flex-row align-items-center search-bar-item p-1">'+
                                            '<img src="'+PR_URL+'/'+response[0][i]['images'][0]+'" width="40" alt="">'+
                                            '<h6 class="poppins-all ms-3">'+response[0][i]['title']+'</h6>'+
                                        '</a>';
                            }
                            $('.search-bar-products').append(html);

                            html = '';
                            for(i=0; i<response[1].length; i++){
                                html += '<a href="'+PR_URL+'/collections/'+response[1][i]['slug']+'" class="d-flex flex-row align-items-center search-bar-item p-1">'+
                                            '<img src="'+PR_URL+'/'+response[1][i]['image']+'" width="60" alt="">'+
                                            '<h6 class="poppins-all ms-3">'+response[1][i]['title']+'</h6>'+
                                        '</a>';
                            }
                            $('.search-bar-collections').append(html);
                        }
                    }
                });
            }
        }
        function close_search_content(){
            $('.search-bar-content').addClass('d-none');
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
    <div class="modal fade poppins-all" tabindex="-1" id="searchbar_modal">
        <div class="modal-dialog w-100 modal-xl" style="margin:0px !important;max-width:100%;">
            <div class="modal-content rounded-0">

                <div class="modal-body cart-modal" style="padding:16px;background:#c3c3c3;">
                     <!--begin::Close-->
                     
                    <!--end::Close-->
                    <div>
                        <div class="d-flex flex-row align-items-center">
                            <input onkeyup="load_search_content()" type="text" name="search-bar" id="search-bar" class="w-100 input-1" placeholder="Search">
                            <svg onclick="close_search_content()" width="38" height="38" style="margin-left: 10px;cursor: pointer;" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16" data-bs-dismiss="modal" aria-label="Close">
                                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                            </svg>
                        </div>
                        <div class="search-bar-content d-none">
                            <span class="loading d-none">Loading ...</span>
                            <span class="empty-data d-none">No Data Found</span>
                            <div class="search-bar-body d-none row">
                                <div class="search-bar-products p-3 col-md-7">
                                    <h5 class="poppins-all">PRODUCTS</h5><hr>
                                </div>
                                <div class="search-bar-collections p-3 col-md-4 ms-md-3">
                                    <h5 class="poppins-all">COLLECTIONS</h5><hr>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</body>

</html>