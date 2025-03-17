@extends('frontend.app')

@section('styles')
    <style>
        @font-face {
            font-family: ArterioNonCommercial;
            src: url('../frontend/fonts/ArterioNonCommercial.otf');
        }
        @font-face {
            font-family: ABChanel Corpo Regular;
            src: url('../frontend/fonts/ABChanel Corpo Regular.ttf');
        }
        @font-face {
            font-family: Poppins;
            src: url('../frontend/fonts/Poppins-Regular.ttf');
        }
        @media only screen and (max-width: 991px) { /* Phones */
            .home-grid {
                padding: 0px;
                margin: 0px;
            }
            .grid-buttons {
                top: 73% !important;
                left: 70% !important;
            }
        }
    </style>
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{url('frontend/css/splide.min.css')}}">
    <link rel="stylesheet" href="{{url('frontend/css/product.css')}}">
    <link rel="stylesheet" href="{{url('frontend/css/splide-core.min.css')}}">
@endsection

@section('content')
    <section class="main col-12">
        <div class="row">
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                        <li>Order not completed</li>
                    </ul>
                </div>
            @endif
            <div class="thumbnail-prnt col-md-1 ms-5">
                @php $product_images = []; @endphp
                <ul id="thumbnails" class="thumbnails">
                    @foreach($product->images as $key => $image)
                    @php array_push($product_images, url($image)); @endphp
                    <li class="thumbnail">
                      <img src="{{url($image)}}" />
                    </li>
                    @endforeach
                </ul>
            </div>
            <div class="col-md-3 pb-3 me-5">
                <div id="thumbnail-slider" class="splide">
                    <div class="splide__track">
                        <ul class="splide__list">
                            @foreach($product->images as $key => $image)
                            <li class="splide__slide">
                                <img src="{{url($image)}}">
                            </li>
                            @endforeach
                        </ul>
                    </div>
                </div>   
            </div>
            <div class="col-md-6 p-4">
                <div class="product-box">
                    @if(Session::has('modal_value'))
                        <input type="hidden" id="modal_value" value="{{Session::get('modal_value')}}">
                    @endif
                    <a href="#">
                        <input type="hidden" id="modal_productId" value="{{$product->id}}">
                        <h1 class="product-model-title" id="product-model-title">{{$product->title}}</h1>
                    </a>
                    <div class="price-box">
                        <del>
                            <input type="hidden" id="modal_productImage" value="{{$product->images[0]}}">
                            <input type="hidden" id="modal_price_input" value="{{$product->price}}">
                            <span class="sub-price money" id="modal_sub_price">Rs.{{number_format($product->compare_price, 2)}}</span>
                        </del> 
                        <ins>
                            <span class="price money ms-2" id="modal_price">Rs.{{number_format($product->price, 2)}}</span>
                        </ins> 
                        <span class="badge-price">SAVE <span class="money" id="save_price">Rs.{{number_format($product->compare_price - $product->price)}}</span></span>
                    </div>     
                    <div class="variation-box mb-3">
                        <div class="variation-list">
                            @foreach ($product->variations as $i => $variation)
                                @if($i == 0)
                                    <input type="hidden" id="variation-title-{{$variation->value}}" class="variation-item-title" value="{{$variation->title}}">
                                    <div class="variation-item selected">{{$variation->value}}</div>
                                @else
                                    <input type="hidden" id="variation-title-{{$variation->value}}" class="variation-item-title" value="{{$variation->title}}">
                                    <div class="variation-item">{{$variation->value}}</div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div class="quantity-box mb-3">
                        <div class="quantity-selector is-minus">
                            -
                        </div>
                        <input type="number" class="quanity-input" id="quantity_input" name="quantity_input" step="1" min="1" max="10" value="1" size="4" pattern="[0-9]*" inputmode="numeric">
                        <div class="quantity-selector is-plus">
                            +
                        </div>
                    </div>
                    <a href="#" class="hover-icon d-none">
                        <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                            <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                        </svg>
                        <span class="hover-tag">Add to Wishlist</span>
                    </a>
                    <div class="d-flex flex-column modal-buttons mt-3">
                        <button type="submit" onclick="addtocart()" class="btn-6 mb-3">ADD TO CART</button>
                        <button type="submit" onclick="buynow()" class="shaking-btn btn-7 mb-3 home-modal-order-btn" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#buynow_modal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-fill me-2 mb-1" viewBox="0 0 16 16">
                                <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z"/>
                            </svg>
                            Order Now - Cash on Delivery
                        </button>
                    </div>
                </div>
            </div>
            <hr>
            <div class="d-flex flex-column align-items-center">
                {{-- <!-- Tabs navs -->
                <ul class="nav nav-tabs mb-3" id="ex1" role="tablist">
                    <li class="nav-item" role="presentation">
                    <a
                        data-mdb-tab-init
                        class="nav-link active"
                        id="ex1-tab-1"
                        href="#ex1-tabs-1"
                        role="tab"
                        aria-controls="ex1-tabs-1"
                        aria-selected="true"
                        >Description</a
                    >
                    </li>
                    <li class="nav-item" role="presentation">
                    <a
                        data-mdb-tab-init
                        class="nav-link"
                        id="ex1-tab-2"
                        href="#ex1-tabs-2"
                        role="tab"
                        aria-controls="ex1-tabs-2"
                        aria-selected="false"
                        >Reviews</a
                    >
                </ul>
                <!-- Tabs navs --> --}}
                
                <!-- Tabs content -->
                <div class="tab-content w-100" id="ex1-content">
                    <div class="tab-pane fade show active" id="ex1-tabs-1" role="tabpanel" aria-labelledby="ex1-tab-1">
                        <?php echo $product->description; ?>
                    </div>
                    <div class="tab-pane fade" id="ex1-tabs-2" role="tabpanel" aria-labelledby="ex1-tab-2">
                        Reviews
                    </div>
                </div>
                <!-- Tabs content -->
            </div>
            <div class="mt-4">
                <hr>
                <h3 class="main-heading mt-4">You may also like</h3>
                <div class="row container-fluid mt-4 home-grid featured-product-grid">
                    @foreach($products as $key => $product_d)
                    @if($key == 3) @break @endif
                    <div class="col-md-3 col-sm-4 col-8 product-grid">
                        <div class="image-box">
                            <a href="{{url('products')}}/{{$product_d->slug}}"  class="image-box-2">
                                <img class="image-1" src="{{asset($product_d->images[0])}}" alt="{{$product_d->title}}">
                                <img class="image-2" src="{{asset($product_d->images[1])}}" alt="{{$product_d->title}}">
                            </a>
                            <div class="badge">
                                @php $per = ($product_d->price * 100) / $product_d->compare_price; @endphp
                                <span>{{number_format(100 - $per, 0)}}%</span>
                            </div>
                            <div class="grid-buttons">
                                <a data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#quickview_model" onclick="quick_view({{$product_d}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M16 8s-3-5.5-8-5.5S0 8 0 8s3 5.5 8 5.5S16 8 16 8M1.173 8a13 13 0 0 1 1.66-2.043C4.12 4.668 5.88 3.5 8 3.5s3.879 1.168 5.168 2.457A13 13 0 0 1 14.828 8q-.086.13-.195.288c-.335.48-.83 1.12-1.465 1.755C11.879 11.332 10.119 12.5 8 12.5s-3.879-1.168-5.168-2.457A13 13 0 0 1 1.172 8z"/>
                                        <path d="M8 5.5a2.5 2.5 0 1 0 0 5 2.5 2.5 0 0 0 0-5M4.5 8a3.5 3.5 0 1 1 7 0 3.5 3.5 0 0 1-7 0"/>
                                    </svg>
                                    <span class="grid-buttons-text">Quick view</span>
                                </a>
                                <a data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#quickshop_model" onclick="quick_shop({{$product_d}})">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="M0 2.5A.5.5 0 0 1 .5 2H2a.5.5 0 0 1 .485.379L2.89 4H14.5a.5.5 0 0 1 .485.621l-1.5 6A.5.5 0 0 1 13 11H4a.5.5 0 0 1-.485-.379L1.61 3H.5a.5.5 0 0 1-.5-.5M3.14 5l1.25 5h8.22l1.25-5zM5 13a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0m9-1a1 1 0 1 0 0 2 1 1 0 0 0 0-2m-2 1a2 2 0 1 1 4 0 2 2 0 0 1-4 0"/>
                                    </svg>
                                    <span class="grid-buttons-text">Quick Shop</span>
                                </a>
                            </div>
                            <div class="grid-buttons-2">
                                {{-- <a href="#">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="22" height="22" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                                    </svg>
                                    <span class="t4s-text-pr">Add to Wishlist</span>
                                </a> --}}
                            </div>
                        </div>
                        <div class="text-box">
                            <a class="brand-text" href="#">Kafsh</a>
                            <h3>
                                <a href="#">{{$product_d->title}}</a>
                            </h3>
                            <span>PKR {{$product_d->price}}</span>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </section>
@endsection

@section('models')
    <div class="modal fade poppins-all" tabindex="-1" id="buynow_modal">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">

                <div class="modal-body cart-modal" style="padding:26px;">
                     <!--begin::Close-->
                     <div class="btn model-close-btn btn-icon btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                        </svg>
                    </div>
                    <!--end::Close-->
                    <form action="{{url('cart')}}" method="post" id="main_buynow_form">
                        @csrf
                        <input type="hidden" id="product" name="product[]" value="">
                        <input type="hidden" id="product_id" name="product_id[]" value="{{$product->id}}">
                        <input type="hidden" id="product_variation_title" name="product_variation_title[]" value="">
                        <input type="hidden" id="product_variation_value" name="product_variation_value[]" value="">
                        <input type="hidden" id="product_quantity" name="product_quantity[]" value="">
                        <input type="hidden" id="product_price" name="product_price[]" value="{{$product->price}}">
                        <input type="hidden" id="product_sub_total" name="product_sub_total[]" value="">
                        <div class="item d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center text-start">
                                <img class="me-4" src="{{url($product->images[0])}}" width="50px" alt="{{$product->title}}">
                                <div class="product-details d-flex flex-column">
                                    <a href="#" class="product-name">{{$product->title}}</a>
                                    <span class="product-variation" id="product-variation"></span>
                                    {{-- <a href="" class="py-1 cart-box-delete" id="cart-box-delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#e60000" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                        </svg>
                                    </a> --}}
                                </div>
                            </div>
                            <div class="price me-1 d-flex align-items-center justify-content-center">
                                <p class="m-0 nor-text" id="price_and_quantity"></p>
                            </div>
                        </div>

                        <div class="modal-total-box mb-2 p-2 d-flex flex-row justify-content-between align-items-center">
                            <p class="text-3 m-0">Total</p>
                            <input type="hidden" name="total" id="total" value="">
                            <p class="text-3 m-0" id="total_show"></p>
                        </div>
                        <div class="row d-flex align-items-center mb-2 mr-sm-2">
                            <div class="col-sm-3">
                                <span class="required text-3">Name</span><span class="text-danger">*</span>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="bi bi-person-circle"></i></div>
                                    </div>
                                    <input type="text" class="form-control name" name="name" placeholder="Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex align-items-center mb-2 mr-sm-2">
                            <div class="col-sm-3">
                                <span class="required text-3">Phone</span><span class="text-danger">*</span>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="bi bi-telephone-fill"></i></div>
                                    </div>
                                    <input type="integer" class="form-control phone" name="phone" placeholder="Phone" required>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex align-items-center mb-2 mr-sm-2">
                            <div class="col-sm-3">
                                <span class="required text-3">Whatsapp</span>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="bi bi-whatsapp"></i></div>
                                    </div>
                                    <input type="integer" class="form-control whatsapp" name="whatsapp" placeholder="Whatsapp (optional)">
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex align-items-center mb-2 mr-sm-2">
                            <div class="col-sm-3">
                                <span class="required text-3">Email<span class="text-danger">*</span></span>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="bi bi-envelope-fill"></i></div>
                                    </div>
                                    <input type="email" class="form-control email" name="email" placeholder="Email" required>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex align-items-center mb-2 mr-sm-2">
                            <div class="col-sm-3">
                                <span class="required text-3">Address</span><span class="text-danger">*</span>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="bi bi-geo-alt-fill"></i></div>
                                    </div>
                                    <input type="text" class="form-control address" name="address" placeholder="Delivery Address" required>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex align-items-center mb-2 mr-sm-2">
                            <div class="col-sm-3">
                                <span class="required text-3">City</span><span class="text-danger">*</span>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <select id="city-select" name="city" class="city-select form-control" required>
                                        <option value="" disabled selected>Select The City</option>
                                        <option>Abbottabad</option>
                                        <option>BAGNOTER</option>
                                        <option>GOHARABAD</option>
                                        <option>HARNO</option>
                                        <option>JHUGIAN</option>
                                        <option>JINNAHABAD</option>
                                        <option>KAKOOL ( PMA)</option>
                                        <option>KALA BAGH (P.A.</option>
                                        <option>MALIK PURA</option>
                                        <option>MANDIAN</option>
                                        <option>MUSLIMABAD</option>
                                        <option>NAWAN SHER</option>
                                        <option>REHMATABAD</option>
                                        <option>SHIMLA HILL</option>
                                        <option>Attock</option>
                                        <option>ATTOCK KHURD</option>
                                        <option>BROTHA</option>
                                        <option>GHAZI</option>
                                        <option>GONDAL</option>
                                        <option>HATTIAN</option>
                                        <option>Hazro</option>
                                        <option>Kamra</option>
                                        <option>LAWRENCEPUR</option>
                                        <option>MALAN MANSOOR</option>
                                        <option>MANSHERA CAMP</option>
                                        <option>RANGO</option>
                                        <option>SHINKA</option>
                                        <option>Tarbela Dam</option>
                                        <option>WAISA</option>
                                        <option>Badin</option>
                                        <option>GOLARCHI</option>
                                        <option>KHOSKI</option>
                                        <option>Matli</option>
                                        <option>TALHAR</option>
                                        <option>TANDO BAGO</option>
                                        <option>TANDO GHULAM AL</option>
                                        <option>Tando Mohd.khan</option>
                                        <option>Bahawalnagar</option>
                                        <option>Chistian</option>
                                        <option>Haroonabad</option>
                                        <option>CHAK ABDULLAH</option>
                                        <option>DHARANWALA</option>
                                        <option>Faqir Wali</option>
                                        <option>FORT ABBAS</option>
                                        <option>MANDI SADIQ GUN</option>
                                        <option>MINCHIN ABAD</option>
                                        <option>MOHAR SHARIF</option>
                                        <option>Bahawalpur</option>
                                        <option>Ahmad Pur East</option>
                                        <option>Dunya Pur</option>
                                        <option>KAHROR PAKKA</option>
                                        <option>KHAIRPUR TAMIAN</option>
                                        <option>Lodhran</option>
                                        <option>NOORPUR NORANGA</option>
                                        <option>SATIYANA</option>
                                        <option>SYED WALA</option>
                                        <option>UCH SHARIF</option>
                                        <option>Yazman Mandi</option>
                                        <option>Bannu</option>
                                        <option>MIRAN SHAH</option>
                                        <option>DOMAIL</option>
                                        <option>Lakki Marwat</option>
                                        <option>SARAI NAURANG</option>
                                        <option>Batkhela</option>
                                        <option>ABOHA</option>
                                        <option>AMAN DARA</option>
                                        <option>BARIKOT</option>
                                        <option>CHAKDARA</option>
                                        <option>DARBAR(HAJIABAD</option>
                                        <option>DHERI JULAGRAM</option>
                                        <option>GULABAD</option>
                                        <option>KHAR (BATKHELA)</option>
                                        <option>KOTA</option>
                                        <option>Malakand</option>
                                        <option>Bhai Pheru</option>
                                        <option>Manga Mandi</option>
                                        <option>CHANGA MANGA</option>
                                        <option>HEAD BALOKI ROA</option>
                                        <option>Bhakkar</option>
                                        <option>BEHAL</option>
                                        <option>DULEWALA</option>
                                        <option>HYDER ABAD THAL</option>
                                        <option>NAWAN JANDANWAL</option>
                                        <option>Bhimber A. K</option>
                                        <option>AMBRIALA CHOWK</option>
                                        <option>BARNALA (A.K)</option>
                                        <option>BHRING (A.K)</option>
                                        <option>CHOWKI (A.K)</option>
                                        <option>DHANDER (KALAN)</option>
                                        <option>DHOK DAURA (A.K</option>
                                        <option>KADHALA (A.K)</option>
                                        <option>KALARY MORE(A.K</option>
                                        <option>KOT JAMEL (A.K)</option>
                                        <option>LIAQATABAD(A.K)</option>
                                        <option>SMAHNI (A.K)</option>
                                        <option>BUNNER</option>
                                        <option>BAZARGAI</option>
                                        <option>Burewala</option>
                                        <option>GAGGO MANDI</option>
                                        <option>Chakwal</option>
                                        <option>AMIN ABAD</option>
                                        <option>AMIR PUR MANGAN</option>
                                        <option>BHAGWAL</option>
                                        <option>BHAUN</option>
                                        <option>BHIKARI KALAN</option>
                                        <option>BHUBBAR</option>
                                        <option>CHAK BAQAR SHAH</option>
                                        <option>CHAK BELI KHAN</option>
                                        <option>CHAMBI</option>
                                        <option>Choa Saidan Sha</option>
                                        <option>DAHEWAL</option>
                                        <option>DALWAL</option>
                                        <option>DHODA</option>
                                        <option>DHOKE BADIAL</option>
                                        <option>DHOKE MAKEN</option>
                                        <option>DHUDIAL</option>
                                        <option>DHURKANA</option>
                                        <option>DOREY</option>
                                        <option>KALAR KAHAR</option>
                                        <option>KERYALA</option>
                                        <option>MAGHAL</option>
                                        <option>MIANI</option>
                                        <option>MOHARA GULSHER</option>
                                        <option>MOHUTA MOHRA</option>
                                        <option>MULHAL MUGHALAN</option>
                                        <option>MURID</option>
                                        <option>PERIAL</option>
                                        <option>PINDI GUJRAN</option>
                                        <option>SALOI</option>
                                        <option>SARAI CHOWK</option>
                                        <option>SARKALAN</option>
                                        <option>SIRGUDHAN</option>
                                        <option>SOHAWA DEWALIAN</option>
                                        <option>TATRAL</option>
                                        <option>THANIL FATOI</option>
                                        <option>VEHALIZER</option>
                                        <option>Chicha Watni</option>
                                        <option>GHAZIABAD</option>
                                        <option>HARAPPA STATION</option>
                                        <option>KAMALIA</option>
                                        <option>Chiniot</option>
                                        <option>Chitral</option>
                                        <option>DARROSH</option>
                                        <option>Dadu</option>
                                        <option>BHAN SAEED ABAD</option>
                                        <option>PHULJI STATION</option>
                                        <option>Sehwan</option>
                                        <option>SITA ROAD(REHMA</option>
                                        <option>Dadyal (a.k)</option>
                                        <option>AKAL GARH (A.K)</option>
                                        <option>BATHRUI (A.K)</option>
                                        <option>CHAK SWARI(A.K)</option>
                                        <option>DHANGRI BALA (A</option>
                                        <option>EISER (A.K)</option>
                                        <option>HAMID PUR (A.K)</option>
                                        <option>ISLAM GARH(A.K)</option>
                                        <option>KARKRA TOWN(A.K</option>
                                        <option>KHANABAD (A.K)</option>
                                        <option>PANYAM (A.K)</option>
                                        <option>PIND KALAN(A.K)</option>
                                        <option>PIND KHURD(A.K)</option>
                                        <option>PLAK (A.K)</option>
                                        <option>SARANDA (A.K)</option>
                                        <option>TANGDEW (A.K)</option>
                                        <option>TRUTTA (A.K)</option>
                                        <option>Daska</option>
                                        <option>GLOTIAN MORR</option>
                                        <option>JAISERWALA</option>
                                        <option>KANDAL SAYAN</option>
                                        <option>Mandranwala</option>
                                        <option>MITRANWALI</option>
                                        <option>RANJHI</option>
                                        <option>Sohawa</option>
                                        <option>Dera Ghazi Khan</option>
                                        <option>CHOTI</option>
                                        <option>FAZILPUR DHUNDH</option>
                                        <option>Jampur</option>
                                        <option>KOT MITHAN</option>
                                        <option>MOHMMADPUR DIWA</option>
                                        <option>PAIGAH</option>
                                        <option>Rajanpur</option>
                                        <option>Dera Ismail Khan</option>
                                        <option>PAROVA</option>
                                        <option>TANK</option>
                                        <option>Faisalabad</option>
                                        <option>Khurrianwala</option>
                                        <option>CHAK JHUMRA</option>
                                        <option>Sangla Hill</option>
                                        <option>GADOON AMAZAI</option>
                                        <option>GILGIT</option>
                                        <option>CHILAS</option>
                                        <option>ASTORE</option>
                                        <option>BHONE</option>
                                        <option>Gojra</option>
                                        <option>ADDA PENSRA</option>
                                        <option>ADDA THIKRIWALA</option>
                                        <option>Gujar Khan</option>
                                        <option>BEWAL</option>
                                        <option>DAUL TALA</option>
                                        <option>HARNAL</option>
                                        <option>ISLAM PURA JABB</option>
                                        <option>JAND NAGAR</option>
                                        <option>KALLAR SAYDIAN</option>
                                        <option>KANYAL</option>
                                        <option>Mandra</option>
                                        <option>MOHRA NOORI</option>
                                        <option>PAKKA KHUH</option>
                                        <option>Rawat</option>
                                        <option>SACOTE</option>
                                        <option>SAGRI</option>
                                        <option>SHAH BAGH</option>
                                        <option>Gujranwala</option>
                                        <option>alipur chattha</option>
                                        <option>Hafizabad</option>
                                        <option>JALAL PUR BHATT</option>
                                        <option>Kamoki</option>
                                        <option>NOWSHERA VIRKAN</option>
                                        <option>QILA DEDAR SING</option>
                                        <option>GHUMAN WALA</option>
                                        <option>JIBBRAN MANDI</option>
                                        <option>KOT JE SING</option>
                                        <option>KOULO TARRAR</option>
                                        <option>MURALI WALA</option>
                                        <option>Rahwali</option>
                                        <option>RAJA SADOKEY</option>
                                        <option>RASOOL PUR TARR</option>
                                        <option>VANKY TARER</option>
                                        <option>Gujrat</option>
                                        <option>BAHUWAL</option>
                                        <option>BOKEN MORE</option>
                                        <option>DAULATPUR SAFAN</option>
                                        <option>Fatehpur</option>
                                        <option>HARIYAWALA</option>
                                        <option>Kotla Arab Ali</option>
                                        <option>SABOOR SHARIF</option>
                                        <option>SAROKI</option>
                                        <option>Haripur</option>
                                        <option>HATTAR IND. EST</option>
                                        <option>HAVELIAN</option>
                                        <option>KANGRA</option>
                                        <option>KHALABAT SECTOR</option>
                                        <option>KOT NAJEEB ULLA</option>
                                        <option>PANIAN</option>
                                        <option>PIND HASHIM KHA</option>
                                        <option>SARAI NAYMAT KH</option>
                                        <option>Hyderabad</option>
                                        <option>Tando Adam</option>
                                        <option>BHIT SHAH</option>
                                        <option>HALA</option>
                                        <option>Jamshoro</option>
                                        <option>Kotri</option>
                                        <option>Matiyari</option>
                                        <option>SAEEDABAD</option>
                                        <option>Shadadpur</option>
                                        <option>Islamabad</option>
                                        <option>BHARA KHU</option>
                                        <option>Jalal Pur Jattan</option>
                                        <option>BHAGOWAL KALAN</option>
                                        <option>HAJIWALA</option>
                                        <option>Karianwala</option>
                                        <option>MOHINUDIN PUR</option>
                                        <option>TANDA</option>
                                        <option>Jaranwala</option>
                                        <option>AWAGUT</option>
                                        <option>Jauhrabad</option>
                                        <option>GROAT SHEHAR/CA</option>
                                        <option>KATTHA SUGHRAL</option>
                                        <option>KHABEKI</option>
                                        <option>KHORRA</option>
                                        <option>Khushab</option>
                                        <option>MITHA TIWANA</option>
                                        <option>NOORPUR THAL</option>
                                        <option>NOWSHERA DT. KH</option>
                                        <option>PADRAR</option>
                                        <option>QAIDABAD</option>
                                        <option>SHAHPUR CITY</option>
                                        <option>SHAHPUR SADDAR</option>
                                        <option>VEGOWAL</option>
                                        <option>WADHI</option>
                                        <option>Jehangira</option>
                                        <option>AKORA KHATTAQ</option>
                                        <option>KHAIRABAD</option>
                                        <option>Jhang</option>
                                        <option>Ahmad Pur Sial</option>
                                        <option>CHUND</option>
                                        <option>GARH MORE</option>
                                        <option>MALHOONA MORE</option>
                                        <option>MANDI SHAH JUIN</option>
                                        <option>ROODO SULTAN</option>
                                        <option>Jhelum</option>
                                        <option>BHOWANJ</option>
                                        <option>CHAK JAMAL</option>
                                        <option>Deena</option>
                                        <option>GUJARPUR</option>
                                        <option>PAKHWAL</option>
                                        <option>PANDORE</option>
                                        <option>PURAN</option>
                                        <option>Sarai Alamgir</option>
                                        <option>SOHAWA (CITY ON</option>
                                        <option>Karachi</option>
                                        <option>Gawadar</option>
                                        <option>Turbat</option>
                                        <option>Hub Chowki</option>
                                        <option>Panjgour</option>
                                        <option>UTHAL</option>
                                        <option>WINDER</option>
                                        <option>BELA</option>
                                        <option>GIDANI</option>
                                        <option>Lasbela</option>
                                        <option>Kark</option>
                                        <option>Kasur</option>
                                        <option>MANDI USMANWALA</option>
                                        <option>KHAIR PUR MEERU</option>
                                        <option>Kandiaro</option>
                                        <option>KOT DIGEE</option>
                                        <option>Mehrabpur</option>
                                        <option>PIR JO GOTH</option>
                                        <option>Rani Pur</option>
                                        <option>THERI MIR WAH</option>
                                        <option>Khanewal</option>
                                        <option>CHAK 168/10R</option>
                                        <option>JAHANIA</option>
                                        <option>Kabir Wala</option>
                                        <option>PANG KASI</option>
                                        <option>SARDARPUR</option>
                                        <option>SHAMKOT</option>
                                        <option>THATTA (SADIQAB</option>
                                        <option>Khanpur</option>
                                        <option>ZAHIR PEER</option>
                                        <option>Kharian</option>
                                        <option>ATTOWALA</option>
                                        <option>BIDDER MARJAN</option>
                                        <option>DHORIA</option>
                                        <option>DHUNNI</option>
                                        <option>Dinga</option>
                                        <option>NOONAWALI</option>
                                        <option>Khewra</option>
                                        <option>DANDOT</option>
                                        <option>Kohat</option>
                                        <option>HANGU</option>
                                        <option>ALI ZAI KURRAM</option>
                                        <option>BABRI BANDA</option>
                                        <option>BAGGAN</option>
                                        <option>CHAKAR KOT KOHA</option>
                                        <option>GUMBAT</option>
                                        <option>LACHI</option>
                                        <option>MANDURI KURRAM</option>
                                        <option>PARACHINAR</option>
                                        <option>SARO ZAI</option>
                                        <option>TAPPI</option>
                                        <option>THALL</option>
                                        <option>Kot Addu</option>
                                        <option>DAIRA DIN PANNA</option>
                                        <option>MIR PUR BAGHAL</option>
                                        <option>SANAWAN</option>
                                        <option>Taunsa Sharif</option>
                                        <option>Kotli (a. K)</option>
                                        <option>AGHAR JAMALPUR</option>
                                        <option>BRUND BATHA(A.K</option>
                                        <option>CHORAI (A.K)</option>
                                        <option>DAMMAS (A.K)</option>
                                        <option>DANDLI (A.K)</option>
                                        <option>DONGI (A.K)</option>
                                        <option>GOI</option>
                                        <option>GULPUR (A.K)</option>
                                        <option>HAJIABAD (A.K)</option>
                                        <option>HOLAR (A.K)</option>
                                        <option>JUNA (A.K)</option>
                                        <option>KALAH</option>
                                        <option>KAMROTTY (A.K)</option>
                                        <option>KERALA MAJHAN</option>
                                        <option>KHAD GUJRAN(A.K</option>
                                        <option>KHURATTA (A.K)</option>
                                        <option>NAKIYAL (A.K)</option>
                                        <option>NAR (A.K.)</option>
                                        <option>NEW AFZALPUR(AK</option>
                                        <option>PANJEERA (A.K.)</option>
                                        <option>POTHA (A.K.)</option>
                                        <option>PULENDRI (A.K)</option>
                                        <option>SARSAWA (A.K.)</option>
                                        <option>SEHAR MANDI(A.K</option>
                                        <option>SEHNSA (A.K.)</option>
                                        <option>SUPPLY (A.K.)</option>
                                        <option>TALIAN (A.K.)</option>
                                        <option>TATA PANI (A.K)</option>
                                        <option>Lahore</option>
                                        <option>Muridke</option>
                                        <option>CHUNG</option>
                                        <option>Ferozwala</option>
                                        <option>KAHNA NAO</option>
                                        <option>KALA SHAH KAKU</option>
                                        <option>KOT ABDUL MALIK</option>
                                        <option>Shahdara</option>
                                        <option>Lalamusa</option>
                                        <option>Larkana</option>
                                        <option>ARIJA</option>
                                        <option>BADAH</option>
                                        <option>DOKRI</option>
                                        <option>GARIH KHAIRO</option>
                                        <option>KAMBER ALI KHAN</option>
                                        <option>KHAIRPUR NATHAN</option>
                                        <option>LALU RAWANK</option>
                                        <option>Mehar</option>
                                        <option>MIROKHAN</option>
                                        <option>NAUDERO</option>
                                        <option>RADHAN</option>
                                        <option>RATODERO</option>
                                        <option>Shahdadkot</option>
                                        <option>WAGGON</option>
                                        <option>WARAH</option>
                                        <option>Layyah</option>
                                        <option>FATEHPUR (CHAK</option>
                                        <option>HERA (CHAK 134</option>
                                        <option>JAMAN SHAH(SURS</option>
                                        <option>KAROR LAL EASAN</option>
                                        <option>KOT SULTAN(BHAI</option>
                                        <option>LADHANA</option>
                                        <option>LALA ZAR(CHAK 1</option>
                                        <option>PIR JAGI(CHAK 1</option>
                                        <option>JAUNPUR</option>
                                        <option>KHAN BELA</option>
                                        <option>Liaqatpur</option>
                                        <option>TRANDA MOHD. PA</option>
                                        <option>Mandi Bahauddin</option>
                                        <option>BADSHAHPUR</option>
                                        <option>BHIKI SHARIF</option>
                                        <option>BHIKO MORE</option>
                                        <option>GOJRA ( MANDI B</option>
                                        <option>HARIAH RAILWAY</option>
                                        <option>KUTHIALA SHEIKH</option>
                                        <option>LAIDHER</option>
                                        <option>PAHRIANWALI ADD</option>
                                        <option>PHALIA</option>
                                        <option>QADIRABAD</option>
                                        <option>WASU</option>
                                        <option>MOHLANWAL</option>
                                        <option>Mansehra</option>
                                        <option>ATTAR SHISHA</option>
                                        <option>BALAKOT</option>
                                        <option>Batgram</option>
                                        <option>BEESHAM</option>
                                        <option>GARHI HABIB ULL</option>
                                        <option>GHAZIKOT TOWNSH</option>
                                        <option>HAJIABAD ICHRIA</option>
                                        <option>NEWDARBAND TOWN</option>
                                        <option>OUGHI</option>
                                        <option>Qalandarabad</option>
                                        <option>SHANKIARI</option>
                                        <option>Mardan</option>
                                        <option>Charsadda</option>
                                        <option>BALA GARHI</option>
                                        <option>GARHI DOULAT ZA</option>
                                        <option>GUJAR GARHI</option>
                                        <option>JAMAL GARI</option>
                                        <option>KATLANG</option>
                                        <option>MAYAR</option>
                                        <option>RAJAR</option>
                                        <option>RASHAKAI</option>
                                        <option>SARDHERI</option>
                                        <option>SHEWA ADDA</option>
                                        <option>UMAR ZAI</option>
                                        <option>Mian Channu</option>
                                        <option>ABDUL HAKIM</option>
                                        <option>AGWANA</option>
                                        <option>ARIFABAD</option>
                                        <option>KOT ISLAM</option>
                                        <option>KOT SUJAN SING</option>
                                        <option>MAKADOOMPUR POK</option>
                                        <option>PULL BAGER</option>
                                        <option>PULL NO. 12 MEL</option>
                                        <option>TULAMBA</option>
                                        <option>Mianwali</option>
                                        <option>BALOKHEL CITY</option>
                                        <option>CHASHMA</option>
                                        <option>DAUDKHEL</option>
                                        <option>EASAKHEL</option>
                                        <option>GULAN KHEL</option>
                                        <option>KALA BAGH</option>
                                        <option>KALOR KOT</option>
                                        <option>KOT CHANDNAN</option>
                                        <option>KUNDIAN</option>
                                        <option>LIAQATABAD(PIPL</option>
                                        <option>PHAKI SHAH MARD</option>
                                        <option>Mingora (swat)</option>
                                        <option>CHAR BAGH (SWAT</option>
                                        <option>GUMBAT MERA</option>
                                        <option>JOR (BUNNER)</option>
                                        <option>MATTA (SWAT)</option>
                                        <option>SAIDU SHARIF (S</option>
                                        <option>Mirpur (a. K)</option>
                                        <option>CHECHIAN (A.K.)</option>
                                        <option>CHITTAR PARI</option>
                                        <option>JATLAN (A.K.)</option>
                                        <option>KHALIQ ABAD(A.K</option>
                                        <option>Mangla Hamlet (a.k.)</option>
                                        <option>MANGLA DAM</option>
                                        <option>PANDI SABARWAL</option>
                                        <option>PULL MANDA (A.K</option>
                                        <option>TARIQ ABAD (A.K</option>
                                        <option>Mirpur Khas</option>
                                        <option>BACHA BAND</option>
                                        <option>DIGRI</option>
                                        <option>HINGORNO</option>
                                        <option>JHUDO</option>
                                        <option>KHIPRO</option>
                                        <option>KOT GHULAM MOHD</option>
                                        <option>Kunri</option>
                                        <option>MITHI</option>
                                        <option>PITHORO</option>
                                        <option>SAMARO</option>
                                        <option>TANDO JAN MOHD.</option>
                                        <option>THARPARKER</option>
                                        <option>Umer Kot</option>
                                        <option>Mirpur Mathelo</option>
                                        <option>Ghotki</option>
                                        <option>ADIL PUR</option>
                                        <option>DAD LAGHARI</option>
                                        <option>Dharki</option>
                                        <option>JARWAR</option>
                                        <option>KHANPUR MEHER</option>
                                        <option>Moro</option>
                                        <option>MITHIANI</option>
                                        <option>NEW JATOI</option>
                                        <option>Multan</option>
                                        <option>JHARIAN</option>
                                        <option>Narang Mandi</option>
                                        <option>Murree</option>
                                        <option>BHURBAN PEARL C</option>
                                        <option>LOWER TOPA</option>
                                        <option>SEHER BAGLA</option>
                                        <option>Muzaffarabad(ak)</option>
                                        <option>AMBOR AREA</option>
                                        <option>Bagh (a.k.)</option>
                                        <option>CHAKOTHI (A.K.)</option>
                                        <option>CHAMANKOT (A.K)</option>
                                        <option>CHATTAR AREA</option>
                                        <option>CHELLA BANDI (A</option>
                                        <option>DHANI BOMBIAN</option>
                                        <option>EIDGAH ROAD</option>
                                        <option>GARHI DOPATTA</option>
                                        <option>HARI GHEL</option>
                                        <option>JALABAD (A.K.)</option>
                                        <option>KOHRI (A.K.)</option>
                                        <option>NOMANPURA</option>
                                        <option>PATTIKA (A.K.)</option>
                                        <option>RANGLA (A.K.)</option>
                                        <option>SARRAN (A.K.)</option>
                                        <option>SHOUKAT LINES</option>
                                        <option>Muzaffargarh</option>
                                        <option>Alipur</option>
                                        <option>Chowk Sarwar Sh</option>
                                        <option>Khangarh</option>
                                        <option>KHANPUR SHOMALI</option>
                                        <option>LALPIR (THERMA</option>
                                        <option>Mehmoodkot</option>
                                        <option>QADIRPUR RAWAN</option>
                                        <option>QASBA GRT. CHAK</option>
                                        <option>narowal</option>
                                        <option>ALIPUR SAYYADAN</option>
                                        <option>SHAKAR GARH</option>
                                        <option>ZAFARWAL</option>
                                        <option>Nawab Shah</option>
                                        <option>SANGHAR</option>
                                        <option>AKRI</option>
                                        <option>BUCHERI</option>
                                        <option>DAUR</option>
                                        <option>KAROONDI</option>
                                        <option>KHADRO</option>
                                        <option>PACCA CHANG</option>
                                        <option>QAZI AHMAD</option>
                                        <option>SAKRAND</option>
                                        <option>SHAH PUR CHAKAR</option>
                                        <option>REHMANI NAGAR</option>
                                        <option>Nowshera</option>
                                        <option>KHAT KALI</option>
                                        <option>PAR NOWSHERA</option>
                                        <option>Risal Pur</option>
                                        <option>TARNAB FARM(AGR</option>
                                        <option>DARBELLO</option>
                                        <option>DARYA KHAN MARI</option>
                                        <option>Nowshero Feroz</option>
                                        <option>THARU SHAH</option>
                                        <option>Okara</option>
                                        <option>BASSER PUR</option>
                                        <option>Depalpur</option>
                                        <option>HUJRA SHAH MUKE</option>
                                        <option>MANDI HEERA SIN</option>
                                        <option>RENALAKHURD</option>
                                        <option>CHAWINDA</option>
                                        <option>KALASWALA</option>
                                        <option>Pasrur</option>
                                        <option>Pattoki</option>
                                        <option>KANGANPUR</option>
                                        <option>TALVANDI</option>
                                        <option>THEENG MORE(ALL</option>
                                        <option>Peshawar</option>
                                        <option>DARA ADAM KHEL</option>
                                        <option>SHABQADAR</option>
                                        <option>Pind Dadan Khan</option>
                                        <option>JALALPUR SHARIF</option>
                                        <option>Quetta</option>
                                        <option>Khuzdar</option>
                                        <option>PISHIN</option>
                                        <option>CHAMAN</option>
                                        <option>KALAT</option>
                                        <option>LORALAI</option>
                                        <option>MASTUNG</option>
                                        <option>NUSHKI</option>
                                        <option>Zhob</option>
                                        <option>AWARAN</option>
                                        <option>JIWANI</option>
                                        <option>KHARAN</option>
                                        <option>MACH</option>
                                        <option>MUSLIM BAGH</option>
                                        <option>OREMARA TOWN</option>
                                        <option>Rabwa</option>
                                        <option>Rahim Yar Khan</option>
                                        <option>Raiwind</option>
                                        <option>KOT RADHA KISHA</option>
                                        <option>Rawalakot (a.k)</option>
                                        <option>ABBASPUR (A.K)</option>
                                        <option>AWAN ABAD(BATHI</option>
                                        <option>AZIZ ABAD (A.K.</option>
                                        <option>BLOOUCH (A.K.)</option>
                                        <option>CHAK BAZAAR(A.K</option>
                                        <option>CHOTTAGLA (A.K)</option>
                                        <option>GALA KNATHA</option>
                                        <option>HAJIRA (A.K.)</option>
                                        <option>JUNDATHI (A.K)</option>
                                        <option>KHAIGALA (A.K.)</option>
                                        <option>KHARICK</option>
                                        <option>MONG (A.K.)</option>
                                        <option>MUJAHID ABAD (A</option>
                                        <option>NAKKAH BAZAR(A.</option>
                                        <option>PANYIOLA (A.K.)</option>
                                        <option>QILLAN (A.K.)</option>
                                        <option>SINGOLA (A.K.)</option>
                                        <option>TANGI GALA (A.</option>
                                        <option>THORAR (A.K.)</option>
                                        <option>TOPA (A.K.)</option>
                                        <option>TRARKHAIL (A.K)</option>
                                        <option>Rawalpindi</option>
                                        <option>Fateh Jang</option>
                                        <option>Jand</option>
                                        <option>Pindi Gheb</option>
                                        <option>CHAKLALA</option>
                                        <option>IKHLAS (DIST. A</option>
                                        <option>Kahuta</option>
                                        <option>KHORE</option>
                                        <option>Tarnol</option>
                                        <option>Sadiqabad</option>
                                        <option>GOTH MACHI</option>
                                        <option>KASHMOOR</option>
                                        <option>SUI</option>
                                        <option>Sahiwal</option>
                                        <option>Arifwala</option>
                                        <option>Pakpattan</option>
                                        <option>BONGA HAYAT</option>
                                        <option>NOOR SHAH</option>
                                        <option>QABOOLA SHARIF</option>
                                        <option>Samundri</option>
                                        <option>ADDA PHLOOR ONL</option>
                                        <option>DIJKOT</option>
                                        <option>KHIDAR WALA</option>
                                        <option>MAMON KANJAN</option>
                                        <option>MURID WALA</option>
                                        <option>TANDLIANWALA</option>
                                        <option>Sargodha</option>
                                        <option>ALI PUR SYEDAN</option>
                                        <option>BHAGATANWALA</option>
                                        <option>Bhalwal</option>
                                        <option>BHERA</option>
                                        <option>FAROOQA</option>
                                        <option>HAZOOR PUR</option>
                                        <option>Kot Momin</option>
                                        <option>Lallian</option>
                                        <option>NEHANG</option>
                                        <option>PHULLARWAN</option>
                                        <option>PULL 111 CHAK</option>
                                        <option>RADHEN</option>
                                        <option>SAHIWAL (NAWAN</option>
                                        <option>Sial Sharif</option>
                                        <option>SILLANWALI</option>
                                        <option>Sheikhupura</option>
                                        <option>BURG ATTARI</option>
                                        <option>DERA MALLA SIN</option>
                                        <option>FAIZPUR KHURD</option>
                                        <option>Farooqabad</option>
                                        <option>Feroz Watwan</option>
                                        <option>KHAN GAH DOGRAN</option>
                                        <option>Manawala</option>
                                        <option>MANDI DHABA SIN</option>
                                        <option>MANDI SAFDAR AB</option>
                                        <option>Nankana Sahib</option>
                                        <option>Pindi Bhattian</option>
                                        <option>SAFDARABAD</option>
                                        <option>Shahkot</option>
                                        <option>SHARAQPUR SHARI</option>
                                        <option>KHAN KA SHARIF</option>
                                        <option>Shujabad</option>
                                        <option>JALALPUR PIRWAL</option>
                                        <option>Sialkot</option>
                                        <option>BHOPALWALA</option>
                                        <option>GHUENKE</option>
                                        <option>JHETEKE</option>
                                        <option>KOTLI LOHARAN</option>
                                        <option>QILA SAIFULLAH</option>
                                        <option>Sambrial</option>
                                        <option>Jacobabad</option>
                                        <option>Shikarpur</option>
                                        <option>Sukkur</option>
                                        <option>Dera ala yar</option>
                                        <option>Dera Murad Jama</option>
                                        <option>DHADAR</option>
                                        <option>GAMBAT</option>
                                        <option>GARHI KHERO</option>
                                        <option>GARHI YASIN</option>
                                        <option>HALANI</option>
                                        <option>HARNAI</option>
                                        <option>JOHI</option>
                                        <option>KHAN PUR DISTT.</option>
                                        <option>KOT DEJI</option>
                                        <option>LAKHI GHULAM SH</option>
                                        <option>Pano Aqil</option>
                                        <option>Rohri</option>
                                        <option>SIBBI</option>
                                        <option>Sultan Kot</option>
                                        <option>THEHRI</option>
                                        <option>THULL</option>
                                        <option>USTA MUHAMMAD</option>
                                        <option>SWABI</option>
                                        <option>KALABAT</option>
                                        <option>KHOTA</option>
                                        <option>MARGAZ</option>
                                        <option>TAND KOI</option>
                                        <option>TOPI</option>
                                        <option>Takht-e-Bhai</option>
                                        <option>DARGAI</option>
                                        <option>HARI CHAND</option>
                                        <option>JALALA</option>
                                        <option>Talagang</option>
                                        <option>Tamirgaraha</option>
                                        <option>Dir</option>
                                        <option>DARRORA</option>
                                        <option>HAJI ABAD</option>
                                        <option>HAYA SERAI</option>
                                        <option>KHAAL</option>
                                        <option>KHAR (BAJORE AG</option>
                                        <option>SAHIB ABAD</option>
                                        <option>SHER KHANIE</option>
                                        <option>Tando ala yar</option>
                                        <option>Tando Jam</option>
                                        <option>Thatha</option>
                                        <option>CHOHAR JAMALI</option>
                                        <option>DHABEJI</option>
                                        <option>Gharo</option>
                                        <option>MAKLI</option>
                                        <option>MIR PUR SAKRO</option>
                                        <option>SUJAWAL</option>
                                        <option>Toba Tek Sing</option>
                                        <option>Pirmahal</option>
                                        <option>RAJANA</option>
                                        <option>SANDHIANWALI</option>
                                        <option>Shorkot Cantt.</option>
                                        <option>Vehari</option>
                                        <option>ADDA PAKHI MORE</option>
                                        <option>DOKOTA</option>
                                        <option>Hasilpur</option>
                                        <option>LUDDAN</option>
                                        <option>MACHIWAL</option>
                                        <option>Mailsi</option>
                                        <option>THAINGI</option>
                                        <option>TIBBA SULTAN PU</option>
                                        <option>Wah Cantt</option>
                                        <option>Hassan Abdal</option>
                                        <option>POURMIANA</option>
                                        <option>Taxila</option>
                                        <option>Wazirabad</option>
                                        <option>ADDA AUJLA KALA</option>
                                        <option>AHMAD NAGAR</option>
                                        <option>Elahabad</option>
                                        <option>AZIZ CHAK</option>
                                        <option>Gakkhar Mandi</option>
                                        <option>KARMABAD</option>
                                        <option>KHAIW WALI</option>
                                        <option>Nizamabad</option>
                                        <option>NOORIABAD</option>
                                        <option>DOLTA</option>
                                        <option>SHER SHAH</option>
                                        <option>MIRUPR BATHORO</option>
                                        <option>HAYATABAD</option>
                                        <option>BADOMALHI</option>
                                        <option>QILA KALLARWALA</option>
                                        <option>JHAWARIYA</option>
                                        <option>MOUCH</option>
                                        <option>BHABRRA</option>
                                        <option>ZIABAD</option>
                                        <option>SARA-E- KARISHAN</option>
                                        <option>HABIBABAD</option>
                                        <option>DHURNAL</option>
                                        <option>FAQIRABAD</option>
                                        <option>SANGHI</option>
                                        <option>DAULAT PUR</option>
                                        <option>MALAKWAL</option>
                                        <option>Ghous Pur</option>
                                        <option>Sobho Dero</option>
                                        <option>Chak</option>
                                        <option>SHADUN LUND</option>
                                        <option>KARAM PUR</option>
                                        <option>JAMAL PUR</option>
                                        <option>DHANOT</option>
                                        <option>MUBARAK PUR</option>
                                        <option>DERA BAKHA</option>
                                        <option>JAFFARABAD</option>
                                        <option>CHOWK MUNDA</option>
                                        <option>MITRO</option>
                                        <option>JAMAL DIN WALI</option>
                                        <option>JHAMPEER</option>
                                        <option>ISLAMKOT</option>
                                        <option>Khairpur</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button class="btn-7 w-100 mt-3" id="submit-button" 
                        onclick="disabled_button('buynow_modal','submit-button')" 
                        type="submit"></button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade poppins-all" tabindex="-1" id="buynow_view_modal">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">

                <div class="modal-body cart-modal" style="padding:26px;">
                     <!--begin::Close-->
                     <div class="btn model-close-btn btn-icon btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                        </svg>
                    </div>
                    <!--end::Close-->
                    <form action="{{url('cart')}}" method="post">
                        @csrf
                        <input type="hidden" id="product" name="product[]" value="">
                        <input type="hidden" id="product_id" name="product_id[]" value="">
                        <input type="hidden" id="product_variation_title" name="product_variation_title[]" value="">
                        <input type="hidden" id="product_variation_value" name="product_variation_value[]" value="">
                        <input type="hidden" id="product_quantity" name="product_quantity[]" value="">
                        <input type="hidden" id="product_price" name="product_price[]" value="">
                        <input type="hidden" id="product_sub_total" name="product_sub_total[]" value="">
                        <div class="item d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center text-start">
                                <img class="me-4" src="" id="product_image" width="50px">
                                <div class="product-details d-flex flex-column">
                                    <a href="#" class="product-name"></a>
                                    <span class="product-variation" id="product-variation"></span>
                                    {{-- <a href="" class="py-1 cart-box-delete" id="cart-box-delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#e60000" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                        </svg>
                                    </a> --}}
                                </div>
                            </div>
                            <div class="price me-1 d-flex align-items-center justify-content-center">
                                <p class="m-0 nor-text" id="price_and_quantity"></p>
                            </div>
                        </div>

                        <div class="modal-total-box mb-2 p-2 d-flex flex-row justify-content-between align-items-center">
                            <p class="text-3 m-0">Total</p>
                            <input type="hidden" name="total" id="total" value="">
                            <p class="text-3 m-0" id="total_show"></p>
                        </div>
                        <div class="row d-flex align-items-center mb-2 mr-sm-2">
                            <div class="col-sm-3">
                                <span class="required text-3">Name</span><span class="text-danger">*</span>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="bi bi-person-circle"></i></div>
                                    </div>
                                    <input type="text" class="form-control name" name="name" placeholder="Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex align-items-center mb-2 mr-sm-2">
                            <div class="col-sm-3">
                                <span class="required text-3">Phone</span><span class="text-danger">*</span>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="bi bi-telephone-fill"></i></div>
                                    </div>
                                    <input type="integer" class="form-control phone" name="phone" placeholder="Phone" required>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex align-items-center mb-2 mr-sm-2">
                            <div class="col-sm-3">
                                <span class="required text-3">Whatsapp</span>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="bi bi-whatsapp"></i></div>
                                    </div>
                                    <input type="integer" class="form-control whatsapp" name="whatsapp" placeholder="Whatsapp (optional)">
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex align-items-center mb-2 mr-sm-2">
                            <div class="col-sm-3">
                                <span class="required text-3">Email<span class="text-danger">*</span></span>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="bi bi-envelope-fill"></i></div>
                                    </div>
                                    <input type="email" class="form-control email" name="email" placeholder="Email" required>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex align-items-center mb-2 mr-sm-2">
                            <div class="col-sm-3">
                                <span class="required text-3">Address</span><span class="text-danger">*</span>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="bi bi-geo-alt-fill"></i></div>
                                    </div>
                                    <input type="text" class="form-control address" name="address" placeholder="Delivery Address" required>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex align-items-center mb-2 mr-sm-2">
                            <div class="col-sm-3">
                                <span class="required text-3">City</span><span class="text-danger">*</span>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <select id="city-select-3" name="city" class="city-select form-control" required>
                                        <option value="" disabled selected>Select The City</option>
                                        <option>Abbottabad</option>
                                        <option>BAGNOTER</option>
                                        <option>GOHARABAD</option>
                                        <option>HARNO</option>
                                        <option>JHUGIAN</option>
                                        <option>JINNAHABAD</option>
                                        <option>KAKOOL ( PMA)</option>
                                        <option>KALA BAGH (P.A.</option>
                                        <option>MALIK PURA</option>
                                        <option>MANDIAN</option>
                                        <option>MUSLIMABAD</option>
                                        <option>NAWAN SHER</option>
                                        <option>REHMATABAD</option>
                                        <option>SHIMLA HILL</option>
                                        <option>Attock</option>
                                        <option>ATTOCK KHURD</option>
                                        <option>BROTHA</option>
                                        <option>GHAZI</option>
                                        <option>GONDAL</option>
                                        <option>HATTIAN</option>
                                        <option>Hazro</option>
                                        <option>Kamra</option>
                                        <option>LAWRENCEPUR</option>
                                        <option>MALAN MANSOOR</option>
                                        <option>MANSHERA CAMP</option>
                                        <option>RANGO</option>
                                        <option>SHINKA</option>
                                        <option>Tarbela Dam</option>
                                        <option>WAISA</option>
                                        <option>Badin</option>
                                        <option>GOLARCHI</option>
                                        <option>KHOSKI</option>
                                        <option>Matli</option>
                                        <option>TALHAR</option>
                                        <option>TANDO BAGO</option>
                                        <option>TANDO GHULAM AL</option>
                                        <option>Tando Mohd.khan</option>
                                        <option>Bahawalnagar</option>
                                        <option>Chistian</option>
                                        <option>Haroonabad</option>
                                        <option>CHAK ABDULLAH</option>
                                        <option>DHARANWALA</option>
                                        <option>Faqir Wali</option>
                                        <option>FORT ABBAS</option>
                                        <option>MANDI SADIQ GUN</option>
                                        <option>MINCHIN ABAD</option>
                                        <option>MOHAR SHARIF</option>
                                        <option>Bahawalpur</option>
                                        <option>Ahmad Pur East</option>
                                        <option>Dunya Pur</option>
                                        <option>KAHROR PAKKA</option>
                                        <option>KHAIRPUR TAMIAN</option>
                                        <option>Lodhran</option>
                                        <option>NOORPUR NORANGA</option>
                                        <option>SATIYANA</option>
                                        <option>SYED WALA</option>
                                        <option>UCH SHARIF</option>
                                        <option>Yazman Mandi</option>
                                        <option>Bannu</option>
                                        <option>MIRAN SHAH</option>
                                        <option>DOMAIL</option>
                                        <option>Lakki Marwat</option>
                                        <option>SARAI NAURANG</option>
                                        <option>Batkhela</option>
                                        <option>ABOHA</option>
                                        <option>AMAN DARA</option>
                                        <option>BARIKOT</option>
                                        <option>CHAKDARA</option>
                                        <option>DARBAR(HAJIABAD</option>
                                        <option>DHERI JULAGRAM</option>
                                        <option>GULABAD</option>
                                        <option>KHAR (BATKHELA)</option>
                                        <option>KOTA</option>
                                        <option>Malakand</option>
                                        <option>Bhai Pheru</option>
                                        <option>Manga Mandi</option>
                                        <option>CHANGA MANGA</option>
                                        <option>HEAD BALOKI ROA</option>
                                        <option>Bhakkar</option>
                                        <option>BEHAL</option>
                                        <option>DULEWALA</option>
                                        <option>HYDER ABAD THAL</option>
                                        <option>NAWAN JANDANWAL</option>
                                        <option>Bhimber A. K</option>
                                        <option>AMBRIALA CHOWK</option>
                                        <option>BARNALA (A.K)</option>
                                        <option>BHRING (A.K)</option>
                                        <option>CHOWKI (A.K)</option>
                                        <option>DHANDER (KALAN)</option>
                                        <option>DHOK DAURA (A.K</option>
                                        <option>KADHALA (A.K)</option>
                                        <option>KALARY MORE(A.K</option>
                                        <option>KOT JAMEL (A.K)</option>
                                        <option>LIAQATABAD(A.K)</option>
                                        <option>SMAHNI (A.K)</option>
                                        <option>BUNNER</option>
                                        <option>BAZARGAI</option>
                                        <option>Burewala</option>
                                        <option>GAGGO MANDI</option>
                                        <option>Chakwal</option>
                                        <option>AMIN ABAD</option>
                                        <option>AMIR PUR MANGAN</option>
                                        <option>BHAGWAL</option>
                                        <option>BHAUN</option>
                                        <option>BHIKARI KALAN</option>
                                        <option>BHUBBAR</option>
                                        <option>CHAK BAQAR SHAH</option>
                                        <option>CHAK BELI KHAN</option>
                                        <option>CHAMBI</option>
                                        <option>Choa Saidan Sha</option>
                                        <option>DAHEWAL</option>
                                        <option>DALWAL</option>
                                        <option>DHODA</option>
                                        <option>DHOKE BADIAL</option>
                                        <option>DHOKE MAKEN</option>
                                        <option>DHUDIAL</option>
                                        <option>DHURKANA</option>
                                        <option>DOREY</option>
                                        <option>KALAR KAHAR</option>
                                        <option>KERYALA</option>
                                        <option>MAGHAL</option>
                                        <option>MIANI</option>
                                        <option>MOHARA GULSHER</option>
                                        <option>MOHUTA MOHRA</option>
                                        <option>MULHAL MUGHALAN</option>
                                        <option>MURID</option>
                                        <option>PERIAL</option>
                                        <option>PINDI GUJRAN</option>
                                        <option>SALOI</option>
                                        <option>SARAI CHOWK</option>
                                        <option>SARKALAN</option>
                                        <option>SIRGUDHAN</option>
                                        <option>SOHAWA DEWALIAN</option>
                                        <option>TATRAL</option>
                                        <option>THANIL FATOI</option>
                                        <option>VEHALIZER</option>
                                        <option>Chicha Watni</option>
                                        <option>GHAZIABAD</option>
                                        <option>HARAPPA STATION</option>
                                        <option>KAMALIA</option>
                                        <option>Chiniot</option>
                                        <option>Chitral</option>
                                        <option>DARROSH</option>
                                        <option>Dadu</option>
                                        <option>BHAN SAEED ABAD</option>
                                        <option>PHULJI STATION</option>
                                        <option>Sehwan</option>
                                        <option>SITA ROAD(REHMA</option>
                                        <option>Dadyal (a.k)</option>
                                        <option>AKAL GARH (A.K)</option>
                                        <option>BATHRUI (A.K)</option>
                                        <option>CHAK SWARI(A.K)</option>
                                        <option>DHANGRI BALA (A</option>
                                        <option>EISER (A.K)</option>
                                        <option>HAMID PUR (A.K)</option>
                                        <option>ISLAM GARH(A.K)</option>
                                        <option>KARKRA TOWN(A.K</option>
                                        <option>KHANABAD (A.K)</option>
                                        <option>PANYAM (A.K)</option>
                                        <option>PIND KALAN(A.K)</option>
                                        <option>PIND KHURD(A.K)</option>
                                        <option>PLAK (A.K)</option>
                                        <option>SARANDA (A.K)</option>
                                        <option>TANGDEW (A.K)</option>
                                        <option>TRUTTA (A.K)</option>
                                        <option>Daska</option>
                                        <option>GLOTIAN MORR</option>
                                        <option>JAISERWALA</option>
                                        <option>KANDAL SAYAN</option>
                                        <option>Mandranwala</option>
                                        <option>MITRANWALI</option>
                                        <option>RANJHI</option>
                                        <option>Sohawa</option>
                                        <option>Dera Ghazi Khan</option>
                                        <option>CHOTI</option>
                                        <option>FAZILPUR DHUNDH</option>
                                        <option>Jampur</option>
                                        <option>KOT MITHAN</option>
                                        <option>MOHMMADPUR DIWA</option>
                                        <option>PAIGAH</option>
                                        <option>Rajanpur</option>
                                        <option>Dera Ismail Khan</option>
                                        <option>PAROVA</option>
                                        <option>TANK</option>
                                        <option>Faisalabad</option>
                                        <option>Khurrianwala</option>
                                        <option>CHAK JHUMRA</option>
                                        <option>Sangla Hill</option>
                                        <option>GADOON AMAZAI</option>
                                        <option>GILGIT</option>
                                        <option>CHILAS</option>
                                        <option>ASTORE</option>
                                        <option>BHONE</option>
                                        <option>Gojra</option>
                                        <option>ADDA PENSRA</option>
                                        <option>ADDA THIKRIWALA</option>
                                        <option>Gujar Khan</option>
                                        <option>BEWAL</option>
                                        <option>DAUL TALA</option>
                                        <option>HARNAL</option>
                                        <option>ISLAM PURA JABB</option>
                                        <option>JAND NAGAR</option>
                                        <option>KALLAR SAYDIAN</option>
                                        <option>KANYAL</option>
                                        <option>Mandra</option>
                                        <option>MOHRA NOORI</option>
                                        <option>PAKKA KHUH</option>
                                        <option>Rawat</option>
                                        <option>SACOTE</option>
                                        <option>SAGRI</option>
                                        <option>SHAH BAGH</option>
                                        <option>Gujranwala</option>
                                        <option>alipur chattha</option>
                                        <option>Hafizabad</option>
                                        <option>JALAL PUR BHATT</option>
                                        <option>Kamoki</option>
                                        <option>NOWSHERA VIRKAN</option>
                                        <option>QILA DEDAR SING</option>
                                        <option>GHUMAN WALA</option>
                                        <option>JIBBRAN MANDI</option>
                                        <option>KOT JE SING</option>
                                        <option>KOULO TARRAR</option>
                                        <option>MURALI WALA</option>
                                        <option>Rahwali</option>
                                        <option>RAJA SADOKEY</option>
                                        <option>RASOOL PUR TARR</option>
                                        <option>VANKY TARER</option>
                                        <option>Gujrat</option>
                                        <option>BAHUWAL</option>
                                        <option>BOKEN MORE</option>
                                        <option>DAULATPUR SAFAN</option>
                                        <option>Fatehpur</option>
                                        <option>HARIYAWALA</option>
                                        <option>Kotla Arab Ali</option>
                                        <option>SABOOR SHARIF</option>
                                        <option>SAROKI</option>
                                        <option>Haripur</option>
                                        <option>HATTAR IND. EST</option>
                                        <option>HAVELIAN</option>
                                        <option>KANGRA</option>
                                        <option>KHALABAT SECTOR</option>
                                        <option>KOT NAJEEB ULLA</option>
                                        <option>PANIAN</option>
                                        <option>PIND HASHIM KHA</option>
                                        <option>SARAI NAYMAT KH</option>
                                        <option>Hyderabad</option>
                                        <option>Tando Adam</option>
                                        <option>BHIT SHAH</option>
                                        <option>HALA</option>
                                        <option>Jamshoro</option>
                                        <option>Kotri</option>
                                        <option>Matiyari</option>
                                        <option>SAEEDABAD</option>
                                        <option>Shadadpur</option>
                                        <option>Islamabad</option>
                                        <option>BHARA KHU</option>
                                        <option>Jalal Pur Jattan</option>
                                        <option>BHAGOWAL KALAN</option>
                                        <option>HAJIWALA</option>
                                        <option>Karianwala</option>
                                        <option>MOHINUDIN PUR</option>
                                        <option>TANDA</option>
                                        <option>Jaranwala</option>
                                        <option>AWAGUT</option>
                                        <option>Jauhrabad</option>
                                        <option>GROAT SHEHAR/CA</option>
                                        <option>KATTHA SUGHRAL</option>
                                        <option>KHABEKI</option>
                                        <option>KHORRA</option>
                                        <option>Khushab</option>
                                        <option>MITHA TIWANA</option>
                                        <option>NOORPUR THAL</option>
                                        <option>NOWSHERA DT. KH</option>
                                        <option>PADRAR</option>
                                        <option>QAIDABAD</option>
                                        <option>SHAHPUR CITY</option>
                                        <option>SHAHPUR SADDAR</option>
                                        <option>VEGOWAL</option>
                                        <option>WADHI</option>
                                        <option>Jehangira</option>
                                        <option>AKORA KHATTAQ</option>
                                        <option>KHAIRABAD</option>
                                        <option>Jhang</option>
                                        <option>Ahmad Pur Sial</option>
                                        <option>CHUND</option>
                                        <option>GARH MORE</option>
                                        <option>MALHOONA MORE</option>
                                        <option>MANDI SHAH JUIN</option>
                                        <option>ROODO SULTAN</option>
                                        <option>Jhelum</option>
                                        <option>BHOWANJ</option>
                                        <option>CHAK JAMAL</option>
                                        <option>Deena</option>
                                        <option>GUJARPUR</option>
                                        <option>PAKHWAL</option>
                                        <option>PANDORE</option>
                                        <option>PURAN</option>
                                        <option>Sarai Alamgir</option>
                                        <option>SOHAWA (CITY ON</option>
                                        <option>Karachi</option>
                                        <option>Gawadar</option>
                                        <option>Turbat</option>
                                        <option>Hub Chowki</option>
                                        <option>Panjgour</option>
                                        <option>UTHAL</option>
                                        <option>WINDER</option>
                                        <option>BELA</option>
                                        <option>GIDANI</option>
                                        <option>Lasbela</option>
                                        <option>Kark</option>
                                        <option>Kasur</option>
                                        <option>MANDI USMANWALA</option>
                                        <option>KHAIR PUR MEERU</option>
                                        <option>Kandiaro</option>
                                        <option>KOT DIGEE</option>
                                        <option>Mehrabpur</option>
                                        <option>PIR JO GOTH</option>
                                        <option>Rani Pur</option>
                                        <option>THERI MIR WAH</option>
                                        <option>Khanewal</option>
                                        <option>CHAK 168/10R</option>
                                        <option>JAHANIA</option>
                                        <option>Kabir Wala</option>
                                        <option>PANG KASI</option>
                                        <option>SARDARPUR</option>
                                        <option>SHAMKOT</option>
                                        <option>THATTA (SADIQAB</option>
                                        <option>Khanpur</option>
                                        <option>ZAHIR PEER</option>
                                        <option>Kharian</option>
                                        <option>ATTOWALA</option>
                                        <option>BIDDER MARJAN</option>
                                        <option>DHORIA</option>
                                        <option>DHUNNI</option>
                                        <option>Dinga</option>
                                        <option>NOONAWALI</option>
                                        <option>Khewra</option>
                                        <option>DANDOT</option>
                                        <option>Kohat</option>
                                        <option>HANGU</option>
                                        <option>ALI ZAI KURRAM</option>
                                        <option>BABRI BANDA</option>
                                        <option>BAGGAN</option>
                                        <option>CHAKAR KOT KOHA</option>
                                        <option>GUMBAT</option>
                                        <option>LACHI</option>
                                        <option>MANDURI KURRAM</option>
                                        <option>PARACHINAR</option>
                                        <option>SARO ZAI</option>
                                        <option>TAPPI</option>
                                        <option>THALL</option>
                                        <option>Kot Addu</option>
                                        <option>DAIRA DIN PANNA</option>
                                        <option>MIR PUR BAGHAL</option>
                                        <option>SANAWAN</option>
                                        <option>Taunsa Sharif</option>
                                        <option>Kotli (a. K)</option>
                                        <option>AGHAR JAMALPUR</option>
                                        <option>BRUND BATHA(A.K</option>
                                        <option>CHORAI (A.K)</option>
                                        <option>DAMMAS (A.K)</option>
                                        <option>DANDLI (A.K)</option>
                                        <option>DONGI (A.K)</option>
                                        <option>GOI</option>
                                        <option>GULPUR (A.K)</option>
                                        <option>HAJIABAD (A.K)</option>
                                        <option>HOLAR (A.K)</option>
                                        <option>JUNA (A.K)</option>
                                        <option>KALAH</option>
                                        <option>KAMROTTY (A.K)</option>
                                        <option>KERALA MAJHAN</option>
                                        <option>KHAD GUJRAN(A.K</option>
                                        <option>KHURATTA (A.K)</option>
                                        <option>NAKIYAL (A.K)</option>
                                        <option>NAR (A.K.)</option>
                                        <option>NEW AFZALPUR(AK</option>
                                        <option>PANJEERA (A.K.)</option>
                                        <option>POTHA (A.K.)</option>
                                        <option>PULENDRI (A.K)</option>
                                        <option>SARSAWA (A.K.)</option>
                                        <option>SEHAR MANDI(A.K</option>
                                        <option>SEHNSA (A.K.)</option>
                                        <option>SUPPLY (A.K.)</option>
                                        <option>TALIAN (A.K.)</option>
                                        <option>TATA PANI (A.K)</option>
                                        <option>Lahore</option>
                                        <option>Muridke</option>
                                        <option>CHUNG</option>
                                        <option>Ferozwala</option>
                                        <option>KAHNA NAO</option>
                                        <option>KALA SHAH KAKU</option>
                                        <option>KOT ABDUL MALIK</option>
                                        <option>Shahdara</option>
                                        <option>Lalamusa</option>
                                        <option>Larkana</option>
                                        <option>ARIJA</option>
                                        <option>BADAH</option>
                                        <option>DOKRI</option>
                                        <option>GARIH KHAIRO</option>
                                        <option>KAMBER ALI KHAN</option>
                                        <option>KHAIRPUR NATHAN</option>
                                        <option>LALU RAWANK</option>
                                        <option>Mehar</option>
                                        <option>MIROKHAN</option>
                                        <option>NAUDERO</option>
                                        <option>RADHAN</option>
                                        <option>RATODERO</option>
                                        <option>Shahdadkot</option>
                                        <option>WAGGON</option>
                                        <option>WARAH</option>
                                        <option>Layyah</option>
                                        <option>FATEHPUR (CHAK</option>
                                        <option>HERA (CHAK 134</option>
                                        <option>JAMAN SHAH(SURS</option>
                                        <option>KAROR LAL EASAN</option>
                                        <option>KOT SULTAN(BHAI</option>
                                        <option>LADHANA</option>
                                        <option>LALA ZAR(CHAK 1</option>
                                        <option>PIR JAGI(CHAK 1</option>
                                        <option>JAUNPUR</option>
                                        <option>KHAN BELA</option>
                                        <option>Liaqatpur</option>
                                        <option>TRANDA MOHD. PA</option>
                                        <option>Mandi Bahauddin</option>
                                        <option>BADSHAHPUR</option>
                                        <option>BHIKI SHARIF</option>
                                        <option>BHIKO MORE</option>
                                        <option>GOJRA ( MANDI B</option>
                                        <option>HARIAH RAILWAY</option>
                                        <option>KUTHIALA SHEIKH</option>
                                        <option>LAIDHER</option>
                                        <option>PAHRIANWALI ADD</option>
                                        <option>PHALIA</option>
                                        <option>QADIRABAD</option>
                                        <option>WASU</option>
                                        <option>MOHLANWAL</option>
                                        <option>Mansehra</option>
                                        <option>ATTAR SHISHA</option>
                                        <option>BALAKOT</option>
                                        <option>Batgram</option>
                                        <option>BEESHAM</option>
                                        <option>GARHI HABIB ULL</option>
                                        <option>GHAZIKOT TOWNSH</option>
                                        <option>HAJIABAD ICHRIA</option>
                                        <option>NEWDARBAND TOWN</option>
                                        <option>OUGHI</option>
                                        <option>Qalandarabad</option>
                                        <option>SHANKIARI</option>
                                        <option>Mardan</option>
                                        <option>Charsadda</option>
                                        <option>BALA GARHI</option>
                                        <option>GARHI DOULAT ZA</option>
                                        <option>GUJAR GARHI</option>
                                        <option>JAMAL GARI</option>
                                        <option>KATLANG</option>
                                        <option>MAYAR</option>
                                        <option>RAJAR</option>
                                        <option>RASHAKAI</option>
                                        <option>SARDHERI</option>
                                        <option>SHEWA ADDA</option>
                                        <option>UMAR ZAI</option>
                                        <option>Mian Channu</option>
                                        <option>ABDUL HAKIM</option>
                                        <option>AGWANA</option>
                                        <option>ARIFABAD</option>
                                        <option>KOT ISLAM</option>
                                        <option>KOT SUJAN SING</option>
                                        <option>MAKADOOMPUR POK</option>
                                        <option>PULL BAGER</option>
                                        <option>PULL NO. 12 MEL</option>
                                        <option>TULAMBA</option>
                                        <option>Mianwali</option>
                                        <option>BALOKHEL CITY</option>
                                        <option>CHASHMA</option>
                                        <option>DAUDKHEL</option>
                                        <option>EASAKHEL</option>
                                        <option>GULAN KHEL</option>
                                        <option>KALA BAGH</option>
                                        <option>KALOR KOT</option>
                                        <option>KOT CHANDNAN</option>
                                        <option>KUNDIAN</option>
                                        <option>LIAQATABAD(PIPL</option>
                                        <option>PHAKI SHAH MARD</option>
                                        <option>Mingora (swat)</option>
                                        <option>CHAR BAGH (SWAT</option>
                                        <option>GUMBAT MERA</option>
                                        <option>JOR (BUNNER)</option>
                                        <option>MATTA (SWAT)</option>
                                        <option>SAIDU SHARIF (S</option>
                                        <option>Mirpur (a. K)</option>
                                        <option>CHECHIAN (A.K.)</option>
                                        <option>CHITTAR PARI</option>
                                        <option>JATLAN (A.K.)</option>
                                        <option>KHALIQ ABAD(A.K</option>
                                        <option>Mangla Hamlet (a.k.)</option>
                                        <option>MANGLA DAM</option>
                                        <option>PANDI SABARWAL</option>
                                        <option>PULL MANDA (A.K</option>
                                        <option>TARIQ ABAD (A.K</option>
                                        <option>Mirpur Khas</option>
                                        <option>BACHA BAND</option>
                                        <option>DIGRI</option>
                                        <option>HINGORNO</option>
                                        <option>JHUDO</option>
                                        <option>KHIPRO</option>
                                        <option>KOT GHULAM MOHD</option>
                                        <option>Kunri</option>
                                        <option>MITHI</option>
                                        <option>PITHORO</option>
                                        <option>SAMARO</option>
                                        <option>TANDO JAN MOHD.</option>
                                        <option>THARPARKER</option>
                                        <option>Umer Kot</option>
                                        <option>Mirpur Mathelo</option>
                                        <option>Ghotki</option>
                                        <option>ADIL PUR</option>
                                        <option>DAD LAGHARI</option>
                                        <option>Dharki</option>
                                        <option>JARWAR</option>
                                        <option>KHANPUR MEHER</option>
                                        <option>Moro</option>
                                        <option>MITHIANI</option>
                                        <option>NEW JATOI</option>
                                        <option>Multan</option>
                                        <option>JHARIAN</option>
                                        <option>Narang Mandi</option>
                                        <option>Murree</option>
                                        <option>BHURBAN PEARL C</option>
                                        <option>LOWER TOPA</option>
                                        <option>SEHER BAGLA</option>
                                        <option>Muzaffarabad(ak)</option>
                                        <option>AMBOR AREA</option>
                                        <option>Bagh (a.k.)</option>
                                        <option>CHAKOTHI (A.K.)</option>
                                        <option>CHAMANKOT (A.K)</option>
                                        <option>CHATTAR AREA</option>
                                        <option>CHELLA BANDI (A</option>
                                        <option>DHANI BOMBIAN</option>
                                        <option>EIDGAH ROAD</option>
                                        <option>GARHI DOPATTA</option>
                                        <option>HARI GHEL</option>
                                        <option>JALABAD (A.K.)</option>
                                        <option>KOHRI (A.K.)</option>
                                        <option>NOMANPURA</option>
                                        <option>PATTIKA (A.K.)</option>
                                        <option>RANGLA (A.K.)</option>
                                        <option>SARRAN (A.K.)</option>
                                        <option>SHOUKAT LINES</option>
                                        <option>Muzaffargarh</option>
                                        <option>Alipur</option>
                                        <option>Chowk Sarwar Sh</option>
                                        <option>Khangarh</option>
                                        <option>KHANPUR SHOMALI</option>
                                        <option>LALPIR (THERMA</option>
                                        <option>Mehmoodkot</option>
                                        <option>QADIRPUR RAWAN</option>
                                        <option>QASBA GRT. CHAK</option>
                                        <option>narowal</option>
                                        <option>ALIPUR SAYYADAN</option>
                                        <option>SHAKAR GARH</option>
                                        <option>ZAFARWAL</option>
                                        <option>Nawab Shah</option>
                                        <option>SANGHAR</option>
                                        <option>AKRI</option>
                                        <option>BUCHERI</option>
                                        <option>DAUR</option>
                                        <option>KAROONDI</option>
                                        <option>KHADRO</option>
                                        <option>PACCA CHANG</option>
                                        <option>QAZI AHMAD</option>
                                        <option>SAKRAND</option>
                                        <option>SHAH PUR CHAKAR</option>
                                        <option>REHMANI NAGAR</option>
                                        <option>Nowshera</option>
                                        <option>KHAT KALI</option>
                                        <option>PAR NOWSHERA</option>
                                        <option>Risal Pur</option>
                                        <option>TARNAB FARM(AGR</option>
                                        <option>DARBELLO</option>
                                        <option>DARYA KHAN MARI</option>
                                        <option>Nowshero Feroz</option>
                                        <option>THARU SHAH</option>
                                        <option>Okara</option>
                                        <option>BASSER PUR</option>
                                        <option>Depalpur</option>
                                        <option>HUJRA SHAH MUKE</option>
                                        <option>MANDI HEERA SIN</option>
                                        <option>RENALAKHURD</option>
                                        <option>CHAWINDA</option>
                                        <option>KALASWALA</option>
                                        <option>Pasrur</option>
                                        <option>Pattoki</option>
                                        <option>KANGANPUR</option>
                                        <option>TALVANDI</option>
                                        <option>THEENG MORE(ALL</option>
                                        <option>Peshawar</option>
                                        <option>DARA ADAM KHEL</option>
                                        <option>SHABQADAR</option>
                                        <option>Pind Dadan Khan</option>
                                        <option>JALALPUR SHARIF</option>
                                        <option>Quetta</option>
                                        <option>Khuzdar</option>
                                        <option>PISHIN</option>
                                        <option>CHAMAN</option>
                                        <option>KALAT</option>
                                        <option>LORALAI</option>
                                        <option>MASTUNG</option>
                                        <option>NUSHKI</option>
                                        <option>Zhob</option>
                                        <option>AWARAN</option>
                                        <option>JIWANI</option>
                                        <option>KHARAN</option>
                                        <option>MACH</option>
                                        <option>MUSLIM BAGH</option>
                                        <option>OREMARA TOWN</option>
                                        <option>Rabwa</option>
                                        <option>Rahim Yar Khan</option>
                                        <option>Raiwind</option>
                                        <option>KOT RADHA KISHA</option>
                                        <option>Rawalakot (a.k)</option>
                                        <option>ABBASPUR (A.K)</option>
                                        <option>AWAN ABAD(BATHI</option>
                                        <option>AZIZ ABAD (A.K.</option>
                                        <option>BLOOUCH (A.K.)</option>
                                        <option>CHAK BAZAAR(A.K</option>
                                        <option>CHOTTAGLA (A.K)</option>
                                        <option>GALA KNATHA</option>
                                        <option>HAJIRA (A.K.)</option>
                                        <option>JUNDATHI (A.K)</option>
                                        <option>KHAIGALA (A.K.)</option>
                                        <option>KHARICK</option>
                                        <option>MONG (A.K.)</option>
                                        <option>MUJAHID ABAD (A</option>
                                        <option>NAKKAH BAZAR(A.</option>
                                        <option>PANYIOLA (A.K.)</option>
                                        <option>QILLAN (A.K.)</option>
                                        <option>SINGOLA (A.K.)</option>
                                        <option>TANGI GALA (A.</option>
                                        <option>THORAR (A.K.)</option>
                                        <option>TOPA (A.K.)</option>
                                        <option>TRARKHAIL (A.K)</option>
                                        <option>Rawalpindi</option>
                                        <option>Fateh Jang</option>
                                        <option>Jand</option>
                                        <option>Pindi Gheb</option>
                                        <option>CHAKLALA</option>
                                        <option>IKHLAS (DIST. A</option>
                                        <option>Kahuta</option>
                                        <option>KHORE</option>
                                        <option>Tarnol</option>
                                        <option>Sadiqabad</option>
                                        <option>GOTH MACHI</option>
                                        <option>KASHMOOR</option>
                                        <option>SUI</option>
                                        <option>Sahiwal</option>
                                        <option>Arifwala</option>
                                        <option>Pakpattan</option>
                                        <option>BONGA HAYAT</option>
                                        <option>NOOR SHAH</option>
                                        <option>QABOOLA SHARIF</option>
                                        <option>Samundri</option>
                                        <option>ADDA PHLOOR ONL</option>
                                        <option>DIJKOT</option>
                                        <option>KHIDAR WALA</option>
                                        <option>MAMON KANJAN</option>
                                        <option>MURID WALA</option>
                                        <option>TANDLIANWALA</option>
                                        <option>Sargodha</option>
                                        <option>ALI PUR SYEDAN</option>
                                        <option>BHAGATANWALA</option>
                                        <option>Bhalwal</option>
                                        <option>BHERA</option>
                                        <option>FAROOQA</option>
                                        <option>HAZOOR PUR</option>
                                        <option>Kot Momin</option>
                                        <option>Lallian</option>
                                        <option>NEHANG</option>
                                        <option>PHULLARWAN</option>
                                        <option>PULL 111 CHAK</option>
                                        <option>RADHEN</option>
                                        <option>SAHIWAL (NAWAN</option>
                                        <option>Sial Sharif</option>
                                        <option>SILLANWALI</option>
                                        <option>Sheikhupura</option>
                                        <option>BURG ATTARI</option>
                                        <option>DERA MALLA SIN</option>
                                        <option>FAIZPUR KHURD</option>
                                        <option>Farooqabad</option>
                                        <option>Feroz Watwan</option>
                                        <option>KHAN GAH DOGRAN</option>
                                        <option>Manawala</option>
                                        <option>MANDI DHABA SIN</option>
                                        <option>MANDI SAFDAR AB</option>
                                        <option>Nankana Sahib</option>
                                        <option>Pindi Bhattian</option>
                                        <option>SAFDARABAD</option>
                                        <option>Shahkot</option>
                                        <option>SHARAQPUR SHARI</option>
                                        <option>KHAN KA SHARIF</option>
                                        <option>Shujabad</option>
                                        <option>JALALPUR PIRWAL</option>
                                        <option>Sialkot</option>
                                        <option>BHOPALWALA</option>
                                        <option>GHUENKE</option>
                                        <option>JHETEKE</option>
                                        <option>KOTLI LOHARAN</option>
                                        <option>QILA SAIFULLAH</option>
                                        <option>Sambrial</option>
                                        <option>Jacobabad</option>
                                        <option>Shikarpur</option>
                                        <option>Sukkur</option>
                                        <option>Dera ala yar</option>
                                        <option>Dera Murad Jama</option>
                                        <option>DHADAR</option>
                                        <option>GAMBAT</option>
                                        <option>GARHI KHERO</option>
                                        <option>GARHI YASIN</option>
                                        <option>HALANI</option>
                                        <option>HARNAI</option>
                                        <option>JOHI</option>
                                        <option>KHAN PUR DISTT.</option>
                                        <option>KOT DEJI</option>
                                        <option>LAKHI GHULAM SH</option>
                                        <option>Pano Aqil</option>
                                        <option>Rohri</option>
                                        <option>SIBBI</option>
                                        <option>Sultan Kot</option>
                                        <option>THEHRI</option>
                                        <option>THULL</option>
                                        <option>USTA MUHAMMAD</option>
                                        <option>SWABI</option>
                                        <option>KALABAT</option>
                                        <option>KHOTA</option>
                                        <option>MARGAZ</option>
                                        <option>TAND KOI</option>
                                        <option>TOPI</option>
                                        <option>Takht-e-Bhai</option>
                                        <option>DARGAI</option>
                                        <option>HARI CHAND</option>
                                        <option>JALALA</option>
                                        <option>Talagang</option>
                                        <option>Tamirgaraha</option>
                                        <option>Dir</option>
                                        <option>DARRORA</option>
                                        <option>HAJI ABAD</option>
                                        <option>HAYA SERAI</option>
                                        <option>KHAAL</option>
                                        <option>KHAR (BAJORE AG</option>
                                        <option>SAHIB ABAD</option>
                                        <option>SHER KHANIE</option>
                                        <option>Tando ala yar</option>
                                        <option>Tando Jam</option>
                                        <option>Thatha</option>
                                        <option>CHOHAR JAMALI</option>
                                        <option>DHABEJI</option>
                                        <option>Gharo</option>
                                        <option>MAKLI</option>
                                        <option>MIR PUR SAKRO</option>
                                        <option>SUJAWAL</option>
                                        <option>Toba Tek Sing</option>
                                        <option>Pirmahal</option>
                                        <option>RAJANA</option>
                                        <option>SANDHIANWALI</option>
                                        <option>Shorkot Cantt.</option>
                                        <option>Vehari</option>
                                        <option>ADDA PAKHI MORE</option>
                                        <option>DOKOTA</option>
                                        <option>Hasilpur</option>
                                        <option>LUDDAN</option>
                                        <option>MACHIWAL</option>
                                        <option>Mailsi</option>
                                        <option>THAINGI</option>
                                        <option>TIBBA SULTAN PU</option>
                                        <option>Wah Cantt</option>
                                        <option>Hassan Abdal</option>
                                        <option>POURMIANA</option>
                                        <option>Taxila</option>
                                        <option>Wazirabad</option>
                                        <option>ADDA AUJLA KALA</option>
                                        <option>AHMAD NAGAR</option>
                                        <option>Elahabad</option>
                                        <option>AZIZ CHAK</option>
                                        <option>Gakkhar Mandi</option>
                                        <option>KARMABAD</option>
                                        <option>KHAIW WALI</option>
                                        <option>Nizamabad</option>
                                        <option>NOORIABAD</option>
                                        <option>DOLTA</option>
                                        <option>SHER SHAH</option>
                                        <option>MIRUPR BATHORO</option>
                                        <option>HAYATABAD</option>
                                        <option>BADOMALHI</option>
                                        <option>QILA KALLARWALA</option>
                                        <option>JHAWARIYA</option>
                                        <option>MOUCH</option>
                                        <option>BHABRRA</option>
                                        <option>ZIABAD</option>
                                        <option>SARA-E- KARISHAN</option>
                                        <option>HABIBABAD</option>
                                        <option>DHURNAL</option>
                                        <option>FAQIRABAD</option>
                                        <option>SANGHI</option>
                                        <option>DAULAT PUR</option>
                                        <option>MALAKWAL</option>
                                        <option>Ghous Pur</option>
                                        <option>Sobho Dero</option>
                                        <option>Chak</option>
                                        <option>SHADUN LUND</option>
                                        <option>KARAM PUR</option>
                                        <option>JAMAL PUR</option>
                                        <option>DHANOT</option>
                                        <option>MUBARAK PUR</option>
                                        <option>DERA BAKHA</option>
                                        <option>JAFFARABAD</option>
                                        <option>CHOWK MUNDA</option>
                                        <option>MITRO</option>
                                        <option>JAMAL DIN WALI</option>
                                        <option>JHAMPEER</option>
                                        <option>ISLAMKOT</option>
                                        <option>Khairpur</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button class="btn-7 w-100 mt-3 submit-button" onclick="disabled_button('buynow_view_modal','submit-button-buynow-view')" id="submit-button-buynow-view" type="submit"></button>
                    </form>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="quickshop_model">
        <div class="modal-dialog" style="max-width: 420px;">
            <div class="modal-content rounded-0">

                <div class="modal-body" style="padding:26px;">
                     <!--begin::Close-->
                     <div class="btn model-close-btn btn-icon btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                        </svg>
                    </div>
                    <!--end::Close-->
                    <input type="hidden" id="cart_modal_productId">
                    <input type="hidden" id="cart_modal_productImage">
                    <div class="cart_product-box">
                        <a href="#">
                            <h1 class="cart_product-model-title" id="cart_product-model-title">Fishermen Slip on Leather Slides</h1>
                        </a>
                        <div class="cart_price-box">
                            <del>
                                <input type="hidden" id="cart_modal_price_input">
                                <span class="sub-price money" id="cart_modal_sub_price">Rs.7,999.00</span>
                            </del> 
                            <ins>
                                <span class="price money ms-2" id="cart_modal_price">Rs.6,800.00</span>
                            </ins> 
                            <span class="badge-price">SAVE <span class="money" id="cart_save_price">Rs.1,199.00</span></span>
                        </div>                  
                        <div class="quantity-box mb-3">
                            <div class="quantity-selector cart-is-minus is-minus">
                                -
                            </div>
                            <input type="number" class="quanity-input" id="cart_quantity_input" step="1" min="1" max="10" value="1" size="4" pattern="[0-9]*" inputmode="numeric">
                            <div class="quantity-selector cart-is-plus is-plus">
                                +
                            </div>
                        </div>
                        <a href="#" class="hover-icon d-none">
                            <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                            </svg>
                            <span class="hover-tag">Add to Wishlist</span>
                        </a>
                        <div class="row modal-buttons mt-3">
                            <button type="submit" onclick="modal_addtocart()" class="btn-4 h-42 mb-3">ADD TO CART</button>
                            <button type="submit" class="shaking-btn btn-5 h-42 mb-3 home-modal-order-btn" onclick="quick_buynow()" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#quick_buynow_modal">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-fill me-2 mb-1" viewBox="0 0 16 16">
                                    <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z"/>
                                </svg>
                                Order Now - Cash on Delivery
                            </button>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <div class="modal fade" tabindex="-1" id="quickview_model">
        <div class="modal-dialog modal-lg">
            <div class="modal-content rounded-0">

                <div class="modal-body" style="padding:26px;">
                     <!--begin::Close-->
                     <div class="btn model-close-btn btn-icon btn-active-light-primary ms-2" onclick="splide_main_fun('#thumbnail-slider');" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                        </svg>
                    </div>
                    <!--end::Close-->
                    <div class="row">
                        <div class="col-md-5 pb-3 me-5">
                            <div id="thumbnail-slider-2" class="splide">
                                <div class="splide__track">
                                    <ul class="splide__list" id="splide__list_id">
                                        
                                    </ul>
                                </div>
                            </div>   
                        </div>
                        <div class="col-md-6 p-2">
                            <div class="product-box">
                                <a href="#">
                                    <input type="hidden" id="view_modal_productId" value="">
                                    <h1 class="product-model-title" id="view_product-model-title"></h1>
                                </a>
                                <div class="price-box">
                                    <del>
                                        <input type="hidden" id="view_modal_productImage" value="">
                                        <input type="hidden" id="view_modal_price_input" value="">
                                        <span class="sub-price money" id="view_modal_sub_price"></span>
                                    </del> 
                                    <ins>
                                        <span class="price money ms-2" id="view_modal_price"></span>
                                    </ins> 
                                    <span class="badge-price">SAVE <span class="money" id="view_save_price"></span></span>
                                </div>     
                                {{-- <div class="variation-box variation-box-style mb-3">
                                    <div class="variation-list">
                                        @foreach ($product->variations as $i => $variation)
                                            @if($i == 0)
                                                <input type="hidden" id="view_variation-title-{{$variation->value}}" class="variation-item-title" value="{{$variation->title}}">
                                                <div class="view_variation-item variation-item-style selected">{{$variation->value}}</div>
                                            @else
                                                <input type="hidden" id="variation-title-{{$variation->value}}" class="variation-item-title" value="{{$variation->title}}">
                                                <div class="view_variation-item variation-item-style">{{$variation->value}}</div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div> --}}
                                <div class="quantity-box mb-3">
                                    <div class="quantity-selector is-minus">
                                        -
                                    </div>
                                    <input type="number" class="quanity-input" id="view_quantity_input" step="1" min="1" max="10" value="1" size="4" pattern="[0-9]*" inputmode="numeric">
                                    <div class="quantity-selector is-plus">
                                        +
                                    </div>
                                </div>
                                <a href="#" class="hover-icon d-none">
                                    <svg class="icon" xmlns="http://www.w3.org/2000/svg" width="36" height="36" fill="currentColor" class="bi bi-eye" viewBox="0 0 16 16">
                                        <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                                    </svg>
                                    <span class="hover-tag">Add to Wishlist</span>
                                </a>
                                <div class="d-flex flex-column modal-buttons mt-3">
                                    <button type="submit" onclick="addtocart_view()" class="btn-6 mb-3">ADD TO CART</button>
                                    <button type="submit" onclick="buynow_view()" class="shaking-btn btn-7 mb-3 home-modal-order-btn" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#buynow_view_modal">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-bag-fill me-2 mb-1" viewBox="0 0 16 16">
                                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4z"/>
                                        </svg>
                                        Order Now - Cash on Delivery
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            </div>
        </div>
    </div>
    <div class="modal fade poppins-all" tabindex="-1" id="quick_buynow_modal">
        <div class="modal-dialog">
            <div class="modal-content rounded-0">

                <div class="modal-body cart-modal" style="padding:26px;">
                     <!--begin::Close-->
                     <div class="btn model-close-btn btn-icon btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                            <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708"/>
                        </svg>
                    </div>
                    <!--end::Close-->
                    <form action="{{url('cart')}}" method="post">
                        @csrf
                        <input type="hidden" id="product" name="product[]" value="">
                        <input type="hidden" id="product_id" name="product_id[]" value="">
                        <input type="hidden" id="product_variation_title" name="product_variation_title[]" value="">
                        <input type="hidden" id="product_variation_value" name="product_variation_value[]" value="">
                        <input type="hidden" id="product_quantity" name="product_quantity[]" value="">
                        <input type="hidden" id="product_price" name="product_price[]" value="">
                        <input type="hidden" id="product_sub_total" name="product_sub_total[]" value="">
                        <div class="item d-flex align-items-center justify-content-between">
                            <div class="d-flex align-items-center text-start">
                                <img class="me-4" src="" id="product_image" width="50px">
                                <div class="product-details d-flex flex-column">
                                    <a href="#" class="product-name"></a>
                                    <span class="product-variation" id="product-variation"></span>
                                    {{-- <a href="" class="py-1 cart-box-delete" id="cart-box-delete">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="#e60000" class="bi bi-trash" viewBox="0 0 16 16">
                                            <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                                            <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1-1h2a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                                        </svg>
                                    </a> --}}
                                </div>
                            </div>
                            <div class="price me-1 d-flex align-items-center justify-content-center">
                                <p class="m-0 nor-text" id="price_and_quantity"></p>
                            </div>
                        </div>

                        <div class="modal-total-box mb-2 p-2 d-flex flex-row justify-content-between align-items-center">
                            <p class="text-3 m-0">Total</p>
                            <input type="hidden" name="total" id="total" value="">
                            <p class="text-3 m-0" id="total_show"></p>
                        </div>
                        <div class="row d-flex align-items-center mb-2 mr-sm-2">
                            <div class="col-sm-3">
                                <span class="required text-3">Name</span><span class="text-danger">*</span>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="bi bi-person-circle"></i></div>
                                    </div>
                                    <input type="text" class="form-control name" name="name" placeholder="Name" required>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex align-items-center mb-2 mr-sm-2">
                            <div class="col-sm-3">
                                <span class="required text-3">Phone</span><span class="text-danger">*</span>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="bi bi-telephone-fill"></i></div>
                                    </div>
                                    <input type="integer" class="form-control phone" name="phone" placeholder="Phone" required>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex align-items-center mb-2 mr-sm-2">
                            <div class="col-sm-3">
                                <span class="required text-3">Whatsapp</span>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="bi bi-whatsapp"></i></div>
                                    </div>
                                    <input type="integer" class="form-control whatsapp" name="whatsapp" placeholder="Whatsapp (optional)">
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex align-items-center mb-2 mr-sm-2">
                            <div class="col-sm-3">
                                <span class="required text-3">Email</span>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="bi bi-envelope-fill"></i></div>
                                    </div>
                                    <input type="email" class="form-control email" name="email" placeholder="Email" required>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex align-items-center mb-2 mr-sm-2">
                            <div class="col-sm-3">
                                <span class="required text-3">Address</span><span class="text-danger">*</span>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <div class="input-group-prepend">
                                        <div class="input-group-text"><i class="bi bi-geo-alt-fill"></i></div>
                                    </div>
                                    <input type="text" class="form-control address" name="address" placeholder="Delivery Address" required>
                                </div>
                            </div>
                        </div>
                        <div class="row d-flex align-items-center mb-2 mr-sm-2">
                            <div class="col-sm-3">
                                <span class="required text-3">City</span><span class="text-danger">*</span>
                            </div>
                            <div class="col-sm-9">
                                <div class="input-group">
                                    <select id="city-select-2" name="city" class="city-select form-control" required>
                                        <option value="" disabled selected>Select The City</option>
                                        <option>Abbottabad</option>
                                        <option>BAGNOTER</option>
                                        <option>GOHARABAD</option>
                                        <option>HARNO</option>
                                        <option>JHUGIAN</option>
                                        <option>JINNAHABAD</option>
                                        <option>KAKOOL ( PMA)</option>
                                        <option>KALA BAGH (P.A.</option>
                                        <option>MALIK PURA</option>
                                        <option>MANDIAN</option>
                                        <option>MUSLIMABAD</option>
                                        <option>NAWAN SHER</option>
                                        <option>REHMATABAD</option>
                                        <option>SHIMLA HILL</option>
                                        <option>Attock</option>
                                        <option>ATTOCK KHURD</option>
                                        <option>BROTHA</option>
                                        <option>GHAZI</option>
                                        <option>GONDAL</option>
                                        <option>HATTIAN</option>
                                        <option>Hazro</option>
                                        <option>Kamra</option>
                                        <option>LAWRENCEPUR</option>
                                        <option>MALAN MANSOOR</option>
                                        <option>MANSHERA CAMP</option>
                                        <option>RANGO</option>
                                        <option>SHINKA</option>
                                        <option>Tarbela Dam</option>
                                        <option>WAISA</option>
                                        <option>Badin</option>
                                        <option>GOLARCHI</option>
                                        <option>KHOSKI</option>
                                        <option>Matli</option>
                                        <option>TALHAR</option>
                                        <option>TANDO BAGO</option>
                                        <option>TANDO GHULAM AL</option>
                                        <option>Tando Mohd.khan</option>
                                        <option>Bahawalnagar</option>
                                        <option>Chistian</option>
                                        <option>Haroonabad</option>
                                        <option>CHAK ABDULLAH</option>
                                        <option>DHARANWALA</option>
                                        <option>Faqir Wali</option>
                                        <option>FORT ABBAS</option>
                                        <option>MANDI SADIQ GUN</option>
                                        <option>MINCHIN ABAD</option>
                                        <option>MOHAR SHARIF</option>
                                        <option>Bahawalpur</option>
                                        <option>Ahmad Pur East</option>
                                        <option>Dunya Pur</option>
                                        <option>KAHROR PAKKA</option>
                                        <option>KHAIRPUR TAMIAN</option>
                                        <option>Lodhran</option>
                                        <option>NOORPUR NORANGA</option>
                                        <option>SATIYANA</option>
                                        <option>SYED WALA</option>
                                        <option>UCH SHARIF</option>
                                        <option>Yazman Mandi</option>
                                        <option>Bannu</option>
                                        <option>MIRAN SHAH</option>
                                        <option>DOMAIL</option>
                                        <option>Lakki Marwat</option>
                                        <option>SARAI NAURANG</option>
                                        <option>Batkhela</option>
                                        <option>ABOHA</option>
                                        <option>AMAN DARA</option>
                                        <option>BARIKOT</option>
                                        <option>CHAKDARA</option>
                                        <option>DARBAR(HAJIABAD</option>
                                        <option>DHERI JULAGRAM</option>
                                        <option>GULABAD</option>
                                        <option>KHAR (BATKHELA)</option>
                                        <option>KOTA</option>
                                        <option>Malakand</option>
                                        <option>Bhai Pheru</option>
                                        <option>Manga Mandi</option>
                                        <option>CHANGA MANGA</option>
                                        <option>HEAD BALOKI ROA</option>
                                        <option>Bhakkar</option>
                                        <option>BEHAL</option>
                                        <option>DULEWALA</option>
                                        <option>HYDER ABAD THAL</option>
                                        <option>NAWAN JANDANWAL</option>
                                        <option>Bhimber A. K</option>
                                        <option>AMBRIALA CHOWK</option>
                                        <option>BARNALA (A.K)</option>
                                        <option>BHRING (A.K)</option>
                                        <option>CHOWKI (A.K)</option>
                                        <option>DHANDER (KALAN)</option>
                                        <option>DHOK DAURA (A.K</option>
                                        <option>KADHALA (A.K)</option>
                                        <option>KALARY MORE(A.K</option>
                                        <option>KOT JAMEL (A.K)</option>
                                        <option>LIAQATABAD(A.K)</option>
                                        <option>SMAHNI (A.K)</option>
                                        <option>BUNNER</option>
                                        <option>BAZARGAI</option>
                                        <option>Burewala</option>
                                        <option>GAGGO MANDI</option>
                                        <option>Chakwal</option>
                                        <option>AMIN ABAD</option>
                                        <option>AMIR PUR MANGAN</option>
                                        <option>BHAGWAL</option>
                                        <option>BHAUN</option>
                                        <option>BHIKARI KALAN</option>
                                        <option>BHUBBAR</option>
                                        <option>CHAK BAQAR SHAH</option>
                                        <option>CHAK BELI KHAN</option>
                                        <option>CHAMBI</option>
                                        <option>Choa Saidan Sha</option>
                                        <option>DAHEWAL</option>
                                        <option>DALWAL</option>
                                        <option>DHODA</option>
                                        <option>DHOKE BADIAL</option>
                                        <option>DHOKE MAKEN</option>
                                        <option>DHUDIAL</option>
                                        <option>DHURKANA</option>
                                        <option>DOREY</option>
                                        <option>KALAR KAHAR</option>
                                        <option>KERYALA</option>
                                        <option>MAGHAL</option>
                                        <option>MIANI</option>
                                        <option>MOHARA GULSHER</option>
                                        <option>MOHUTA MOHRA</option>
                                        <option>MULHAL MUGHALAN</option>
                                        <option>MURID</option>
                                        <option>PERIAL</option>
                                        <option>PINDI GUJRAN</option>
                                        <option>SALOI</option>
                                        <option>SARAI CHOWK</option>
                                        <option>SARKALAN</option>
                                        <option>SIRGUDHAN</option>
                                        <option>SOHAWA DEWALIAN</option>
                                        <option>TATRAL</option>
                                        <option>THANIL FATOI</option>
                                        <option>VEHALIZER</option>
                                        <option>Chicha Watni</option>
                                        <option>GHAZIABAD</option>
                                        <option>HARAPPA STATION</option>
                                        <option>KAMALIA</option>
                                        <option>Chiniot</option>
                                        <option>Chitral</option>
                                        <option>DARROSH</option>
                                        <option>Dadu</option>
                                        <option>BHAN SAEED ABAD</option>
                                        <option>PHULJI STATION</option>
                                        <option>Sehwan</option>
                                        <option>SITA ROAD(REHMA</option>
                                        <option>Dadyal (a.k)</option>
                                        <option>AKAL GARH (A.K)</option>
                                        <option>BATHRUI (A.K)</option>
                                        <option>CHAK SWARI(A.K)</option>
                                        <option>DHANGRI BALA (A</option>
                                        <option>EISER (A.K)</option>
                                        <option>HAMID PUR (A.K)</option>
                                        <option>ISLAM GARH(A.K)</option>
                                        <option>KARKRA TOWN(A.K</option>
                                        <option>KHANABAD (A.K)</option>
                                        <option>PANYAM (A.K)</option>
                                        <option>PIND KALAN(A.K)</option>
                                        <option>PIND KHURD(A.K)</option>
                                        <option>PLAK (A.K)</option>
                                        <option>SARANDA (A.K)</option>
                                        <option>TANGDEW (A.K)</option>
                                        <option>TRUTTA (A.K)</option>
                                        <option>Daska</option>
                                        <option>GLOTIAN MORR</option>
                                        <option>JAISERWALA</option>
                                        <option>KANDAL SAYAN</option>
                                        <option>Mandranwala</option>
                                        <option>MITRANWALI</option>
                                        <option>RANJHI</option>
                                        <option>Sohawa</option>
                                        <option>Dera Ghazi Khan</option>
                                        <option>CHOTI</option>
                                        <option>FAZILPUR DHUNDH</option>
                                        <option>Jampur</option>
                                        <option>KOT MITHAN</option>
                                        <option>MOHMMADPUR DIWA</option>
                                        <option>PAIGAH</option>
                                        <option>Rajanpur</option>
                                        <option>Dera Ismail Khan</option>
                                        <option>PAROVA</option>
                                        <option>TANK</option>
                                        <option>Faisalabad</option>
                                        <option>Khurrianwala</option>
                                        <option>CHAK JHUMRA</option>
                                        <option>Sangla Hill</option>
                                        <option>GADOON AMAZAI</option>
                                        <option>GILGIT</option>
                                        <option>CHILAS</option>
                                        <option>ASTORE</option>
                                        <option>BHONE</option>
                                        <option>Gojra</option>
                                        <option>ADDA PENSRA</option>
                                        <option>ADDA THIKRIWALA</option>
                                        <option>Gujar Khan</option>
                                        <option>BEWAL</option>
                                        <option>DAUL TALA</option>
                                        <option>HARNAL</option>
                                        <option>ISLAM PURA JABB</option>
                                        <option>JAND NAGAR</option>
                                        <option>KALLAR SAYDIAN</option>
                                        <option>KANYAL</option>
                                        <option>Mandra</option>
                                        <option>MOHRA NOORI</option>
                                        <option>PAKKA KHUH</option>
                                        <option>Rawat</option>
                                        <option>SACOTE</option>
                                        <option>SAGRI</option>
                                        <option>SHAH BAGH</option>
                                        <option>Gujranwala</option>
                                        <option>alipur chattha</option>
                                        <option>Hafizabad</option>
                                        <option>JALAL PUR BHATT</option>
                                        <option>Kamoki</option>
                                        <option>NOWSHERA VIRKAN</option>
                                        <option>QILA DEDAR SING</option>
                                        <option>GHUMAN WALA</option>
                                        <option>JIBBRAN MANDI</option>
                                        <option>KOT JE SING</option>
                                        <option>KOULO TARRAR</option>
                                        <option>MURALI WALA</option>
                                        <option>Rahwali</option>
                                        <option>RAJA SADOKEY</option>
                                        <option>RASOOL PUR TARR</option>
                                        <option>VANKY TARER</option>
                                        <option>Gujrat</option>
                                        <option>BAHUWAL</option>
                                        <option>BOKEN MORE</option>
                                        <option>DAULATPUR SAFAN</option>
                                        <option>Fatehpur</option>
                                        <option>HARIYAWALA</option>
                                        <option>Kotla Arab Ali</option>
                                        <option>SABOOR SHARIF</option>
                                        <option>SAROKI</option>
                                        <option>Haripur</option>
                                        <option>HATTAR IND. EST</option>
                                        <option>HAVELIAN</option>
                                        <option>KANGRA</option>
                                        <option>KHALABAT SECTOR</option>
                                        <option>KOT NAJEEB ULLA</option>
                                        <option>PANIAN</option>
                                        <option>PIND HASHIM KHA</option>
                                        <option>SARAI NAYMAT KH</option>
                                        <option>Hyderabad</option>
                                        <option>Tando Adam</option>
                                        <option>BHIT SHAH</option>
                                        <option>HALA</option>
                                        <option>Jamshoro</option>
                                        <option>Kotri</option>
                                        <option>Matiyari</option>
                                        <option>SAEEDABAD</option>
                                        <option>Shadadpur</option>
                                        <option>Islamabad</option>
                                        <option>BHARA KHU</option>
                                        <option>Jalal Pur Jattan</option>
                                        <option>BHAGOWAL KALAN</option>
                                        <option>HAJIWALA</option>
                                        <option>Karianwala</option>
                                        <option>MOHINUDIN PUR</option>
                                        <option>TANDA</option>
                                        <option>Jaranwala</option>
                                        <option>AWAGUT</option>
                                        <option>Jauhrabad</option>
                                        <option>GROAT SHEHAR/CA</option>
                                        <option>KATTHA SUGHRAL</option>
                                        <option>KHABEKI</option>
                                        <option>KHORRA</option>
                                        <option>Khushab</option>
                                        <option>MITHA TIWANA</option>
                                        <option>NOORPUR THAL</option>
                                        <option>NOWSHERA DT. KH</option>
                                        <option>PADRAR</option>
                                        <option>QAIDABAD</option>
                                        <option>SHAHPUR CITY</option>
                                        <option>SHAHPUR SADDAR</option>
                                        <option>VEGOWAL</option>
                                        <option>WADHI</option>
                                        <option>Jehangira</option>
                                        <option>AKORA KHATTAQ</option>
                                        <option>KHAIRABAD</option>
                                        <option>Jhang</option>
                                        <option>Ahmad Pur Sial</option>
                                        <option>CHUND</option>
                                        <option>GARH MORE</option>
                                        <option>MALHOONA MORE</option>
                                        <option>MANDI SHAH JUIN</option>
                                        <option>ROODO SULTAN</option>
                                        <option>Jhelum</option>
                                        <option>BHOWANJ</option>
                                        <option>CHAK JAMAL</option>
                                        <option>Deena</option>
                                        <option>GUJARPUR</option>
                                        <option>PAKHWAL</option>
                                        <option>PANDORE</option>
                                        <option>PURAN</option>
                                        <option>Sarai Alamgir</option>
                                        <option>SOHAWA (CITY ON</option>
                                        <option>Karachi</option>
                                        <option>Gawadar</option>
                                        <option>Turbat</option>
                                        <option>Hub Chowki</option>
                                        <option>Panjgour</option>
                                        <option>UTHAL</option>
                                        <option>WINDER</option>
                                        <option>BELA</option>
                                        <option>GIDANI</option>
                                        <option>Lasbela</option>
                                        <option>Kark</option>
                                        <option>Kasur</option>
                                        <option>MANDI USMANWALA</option>
                                        <option>KHAIR PUR MEERU</option>
                                        <option>Kandiaro</option>
                                        <option>KOT DIGEE</option>
                                        <option>Mehrabpur</option>
                                        <option>PIR JO GOTH</option>
                                        <option>Rani Pur</option>
                                        <option>THERI MIR WAH</option>
                                        <option>Khanewal</option>
                                        <option>CHAK 168/10R</option>
                                        <option>JAHANIA</option>
                                        <option>Kabir Wala</option>
                                        <option>PANG KASI</option>
                                        <option>SARDARPUR</option>
                                        <option>SHAMKOT</option>
                                        <option>THATTA (SADIQAB</option>
                                        <option>Khanpur</option>
                                        <option>ZAHIR PEER</option>
                                        <option>Kharian</option>
                                        <option>ATTOWALA</option>
                                        <option>BIDDER MARJAN</option>
                                        <option>DHORIA</option>
                                        <option>DHUNNI</option>
                                        <option>Dinga</option>
                                        <option>NOONAWALI</option>
                                        <option>Khewra</option>
                                        <option>DANDOT</option>
                                        <option>Kohat</option>
                                        <option>HANGU</option>
                                        <option>ALI ZAI KURRAM</option>
                                        <option>BABRI BANDA</option>
                                        <option>BAGGAN</option>
                                        <option>CHAKAR KOT KOHA</option>
                                        <option>GUMBAT</option>
                                        <option>LACHI</option>
                                        <option>MANDURI KURRAM</option>
                                        <option>PARACHINAR</option>
                                        <option>SARO ZAI</option>
                                        <option>TAPPI</option>
                                        <option>THALL</option>
                                        <option>Kot Addu</option>
                                        <option>DAIRA DIN PANNA</option>
                                        <option>MIR PUR BAGHAL</option>
                                        <option>SANAWAN</option>
                                        <option>Taunsa Sharif</option>
                                        <option>Kotli (a. K)</option>
                                        <option>AGHAR JAMALPUR</option>
                                        <option>BRUND BATHA(A.K</option>
                                        <option>CHORAI (A.K)</option>
                                        <option>DAMMAS (A.K)</option>
                                        <option>DANDLI (A.K)</option>
                                        <option>DONGI (A.K)</option>
                                        <option>GOI</option>
                                        <option>GULPUR (A.K)</option>
                                        <option>HAJIABAD (A.K)</option>
                                        <option>HOLAR (A.K)</option>
                                        <option>JUNA (A.K)</option>
                                        <option>KALAH</option>
                                        <option>KAMROTTY (A.K)</option>
                                        <option>KERALA MAJHAN</option>
                                        <option>KHAD GUJRAN(A.K</option>
                                        <option>KHURATTA (A.K)</option>
                                        <option>NAKIYAL (A.K)</option>
                                        <option>NAR (A.K.)</option>
                                        <option>NEW AFZALPUR(AK</option>
                                        <option>PANJEERA (A.K.)</option>
                                        <option>POTHA (A.K.)</option>
                                        <option>PULENDRI (A.K)</option>
                                        <option>SARSAWA (A.K.)</option>
                                        <option>SEHAR MANDI(A.K</option>
                                        <option>SEHNSA (A.K.)</option>
                                        <option>SUPPLY (A.K.)</option>
                                        <option>TALIAN (A.K.)</option>
                                        <option>TATA PANI (A.K)</option>
                                        <option>Lahore</option>
                                        <option>Muridke</option>
                                        <option>CHUNG</option>
                                        <option>Ferozwala</option>
                                        <option>KAHNA NAO</option>
                                        <option>KALA SHAH KAKU</option>
                                        <option>KOT ABDUL MALIK</option>
                                        <option>Shahdara</option>
                                        <option>Lalamusa</option>
                                        <option>Larkana</option>
                                        <option>ARIJA</option>
                                        <option>BADAH</option>
                                        <option>DOKRI</option>
                                        <option>GARIH KHAIRO</option>
                                        <option>KAMBER ALI KHAN</option>
                                        <option>KHAIRPUR NATHAN</option>
                                        <option>LALU RAWANK</option>
                                        <option>Mehar</option>
                                        <option>MIROKHAN</option>
                                        <option>NAUDERO</option>
                                        <option>RADHAN</option>
                                        <option>RATODERO</option>
                                        <option>Shahdadkot</option>
                                        <option>WAGGON</option>
                                        <option>WARAH</option>
                                        <option>Layyah</option>
                                        <option>FATEHPUR (CHAK</option>
                                        <option>HERA (CHAK 134</option>
                                        <option>JAMAN SHAH(SURS</option>
                                        <option>KAROR LAL EASAN</option>
                                        <option>KOT SULTAN(BHAI</option>
                                        <option>LADHANA</option>
                                        <option>LALA ZAR(CHAK 1</option>
                                        <option>PIR JAGI(CHAK 1</option>
                                        <option>JAUNPUR</option>
                                        <option>KHAN BELA</option>
                                        <option>Liaqatpur</option>
                                        <option>TRANDA MOHD. PA</option>
                                        <option>Mandi Bahauddin</option>
                                        <option>BADSHAHPUR</option>
                                        <option>BHIKI SHARIF</option>
                                        <option>BHIKO MORE</option>
                                        <option>GOJRA ( MANDI B</option>
                                        <option>HARIAH RAILWAY</option>
                                        <option>KUTHIALA SHEIKH</option>
                                        <option>LAIDHER</option>
                                        <option>PAHRIANWALI ADD</option>
                                        <option>PHALIA</option>
                                        <option>QADIRABAD</option>
                                        <option>WASU</option>
                                        <option>MOHLANWAL</option>
                                        <option>Mansehra</option>
                                        <option>ATTAR SHISHA</option>
                                        <option>BALAKOT</option>
                                        <option>Batgram</option>
                                        <option>BEESHAM</option>
                                        <option>GARHI HABIB ULL</option>
                                        <option>GHAZIKOT TOWNSH</option>
                                        <option>HAJIABAD ICHRIA</option>
                                        <option>NEWDARBAND TOWN</option>
                                        <option>OUGHI</option>
                                        <option>Qalandarabad</option>
                                        <option>SHANKIARI</option>
                                        <option>Mardan</option>
                                        <option>Charsadda</option>
                                        <option>BALA GARHI</option>
                                        <option>GARHI DOULAT ZA</option>
                                        <option>GUJAR GARHI</option>
                                        <option>JAMAL GARI</option>
                                        <option>KATLANG</option>
                                        <option>MAYAR</option>
                                        <option>RAJAR</option>
                                        <option>RASHAKAI</option>
                                        <option>SARDHERI</option>
                                        <option>SHEWA ADDA</option>
                                        <option>UMAR ZAI</option>
                                        <option>Mian Channu</option>
                                        <option>ABDUL HAKIM</option>
                                        <option>AGWANA</option>
                                        <option>ARIFABAD</option>
                                        <option>KOT ISLAM</option>
                                        <option>KOT SUJAN SING</option>
                                        <option>MAKADOOMPUR POK</option>
                                        <option>PULL BAGER</option>
                                        <option>PULL NO. 12 MEL</option>
                                        <option>TULAMBA</option>
                                        <option>Mianwali</option>
                                        <option>BALOKHEL CITY</option>
                                        <option>CHASHMA</option>
                                        <option>DAUDKHEL</option>
                                        <option>EASAKHEL</option>
                                        <option>GULAN KHEL</option>
                                        <option>KALA BAGH</option>
                                        <option>KALOR KOT</option>
                                        <option>KOT CHANDNAN</option>
                                        <option>KUNDIAN</option>
                                        <option>LIAQATABAD(PIPL</option>
                                        <option>PHAKI SHAH MARD</option>
                                        <option>Mingora (swat)</option>
                                        <option>CHAR BAGH (SWAT</option>
                                        <option>GUMBAT MERA</option>
                                        <option>JOR (BUNNER)</option>
                                        <option>MATTA (SWAT)</option>
                                        <option>SAIDU SHARIF (S</option>
                                        <option>Mirpur (a. K)</option>
                                        <option>CHECHIAN (A.K.)</option>
                                        <option>CHITTAR PARI</option>
                                        <option>JATLAN (A.K.)</option>
                                        <option>KHALIQ ABAD(A.K</option>
                                        <option>Mangla Hamlet (a.k.)</option>
                                        <option>MANGLA DAM</option>
                                        <option>PANDI SABARWAL</option>
                                        <option>PULL MANDA (A.K</option>
                                        <option>TARIQ ABAD (A.K</option>
                                        <option>Mirpur Khas</option>
                                        <option>BACHA BAND</option>
                                        <option>DIGRI</option>
                                        <option>HINGORNO</option>
                                        <option>JHUDO</option>
                                        <option>KHIPRO</option>
                                        <option>KOT GHULAM MOHD</option>
                                        <option>Kunri</option>
                                        <option>MITHI</option>
                                        <option>PITHORO</option>
                                        <option>SAMARO</option>
                                        <option>TANDO JAN MOHD.</option>
                                        <option>THARPARKER</option>
                                        <option>Umer Kot</option>
                                        <option>Mirpur Mathelo</option>
                                        <option>Ghotki</option>
                                        <option>ADIL PUR</option>
                                        <option>DAD LAGHARI</option>
                                        <option>Dharki</option>
                                        <option>JARWAR</option>
                                        <option>KHANPUR MEHER</option>
                                        <option>Moro</option>
                                        <option>MITHIANI</option>
                                        <option>NEW JATOI</option>
                                        <option>Multan</option>
                                        <option>JHARIAN</option>
                                        <option>Narang Mandi</option>
                                        <option>Murree</option>
                                        <option>BHURBAN PEARL C</option>
                                        <option>LOWER TOPA</option>
                                        <option>SEHER BAGLA</option>
                                        <option>Muzaffarabad(ak)</option>
                                        <option>AMBOR AREA</option>
                                        <option>Bagh (a.k.)</option>
                                        <option>CHAKOTHI (A.K.)</option>
                                        <option>CHAMANKOT (A.K)</option>
                                        <option>CHATTAR AREA</option>
                                        <option>CHELLA BANDI (A</option>
                                        <option>DHANI BOMBIAN</option>
                                        <option>EIDGAH ROAD</option>
                                        <option>GARHI DOPATTA</option>
                                        <option>HARI GHEL</option>
                                        <option>JALABAD (A.K.)</option>
                                        <option>KOHRI (A.K.)</option>
                                        <option>NOMANPURA</option>
                                        <option>PATTIKA (A.K.)</option>
                                        <option>RANGLA (A.K.)</option>
                                        <option>SARRAN (A.K.)</option>
                                        <option>SHOUKAT LINES</option>
                                        <option>Muzaffargarh</option>
                                        <option>Alipur</option>
                                        <option>Chowk Sarwar Sh</option>
                                        <option>Khangarh</option>
                                        <option>KHANPUR SHOMALI</option>
                                        <option>LALPIR (THERMA</option>
                                        <option>Mehmoodkot</option>
                                        <option>QADIRPUR RAWAN</option>
                                        <option>QASBA GRT. CHAK</option>
                                        <option>narowal</option>
                                        <option>ALIPUR SAYYADAN</option>
                                        <option>SHAKAR GARH</option>
                                        <option>ZAFARWAL</option>
                                        <option>Nawab Shah</option>
                                        <option>SANGHAR</option>
                                        <option>AKRI</option>
                                        <option>BUCHERI</option>
                                        <option>DAUR</option>
                                        <option>KAROONDI</option>
                                        <option>KHADRO</option>
                                        <option>PACCA CHANG</option>
                                        <option>QAZI AHMAD</option>
                                        <option>SAKRAND</option>
                                        <option>SHAH PUR CHAKAR</option>
                                        <option>REHMANI NAGAR</option>
                                        <option>Nowshera</option>
                                        <option>KHAT KALI</option>
                                        <option>PAR NOWSHERA</option>
                                        <option>Risal Pur</option>
                                        <option>TARNAB FARM(AGR</option>
                                        <option>DARBELLO</option>
                                        <option>DARYA KHAN MARI</option>
                                        <option>Nowshero Feroz</option>
                                        <option>THARU SHAH</option>
                                        <option>Okara</option>
                                        <option>BASSER PUR</option>
                                        <option>Depalpur</option>
                                        <option>HUJRA SHAH MUKE</option>
                                        <option>MANDI HEERA SIN</option>
                                        <option>RENALAKHURD</option>
                                        <option>CHAWINDA</option>
                                        <option>KALASWALA</option>
                                        <option>Pasrur</option>
                                        <option>Pattoki</option>
                                        <option>KANGANPUR</option>
                                        <option>TALVANDI</option>
                                        <option>THEENG MORE(ALL</option>
                                        <option>Peshawar</option>
                                        <option>DARA ADAM KHEL</option>
                                        <option>SHABQADAR</option>
                                        <option>Pind Dadan Khan</option>
                                        <option>JALALPUR SHARIF</option>
                                        <option>Quetta</option>
                                        <option>Khuzdar</option>
                                        <option>PISHIN</option>
                                        <option>CHAMAN</option>
                                        <option>KALAT</option>
                                        <option>LORALAI</option>
                                        <option>MASTUNG</option>
                                        <option>NUSHKI</option>
                                        <option>Zhob</option>
                                        <option>AWARAN</option>
                                        <option>JIWANI</option>
                                        <option>KHARAN</option>
                                        <option>MACH</option>
                                        <option>MUSLIM BAGH</option>
                                        <option>OREMARA TOWN</option>
                                        <option>Rabwa</option>
                                        <option>Rahim Yar Khan</option>
                                        <option>Raiwind</option>
                                        <option>KOT RADHA KISHA</option>
                                        <option>Rawalakot (a.k)</option>
                                        <option>ABBASPUR (A.K)</option>
                                        <option>AWAN ABAD(BATHI</option>
                                        <option>AZIZ ABAD (A.K.</option>
                                        <option>BLOOUCH (A.K.)</option>
                                        <option>CHAK BAZAAR(A.K</option>
                                        <option>CHOTTAGLA (A.K)</option>
                                        <option>GALA KNATHA</option>
                                        <option>HAJIRA (A.K.)</option>
                                        <option>JUNDATHI (A.K)</option>
                                        <option>KHAIGALA (A.K.)</option>
                                        <option>KHARICK</option>
                                        <option>MONG (A.K.)</option>
                                        <option>MUJAHID ABAD (A</option>
                                        <option>NAKKAH BAZAR(A.</option>
                                        <option>PANYIOLA (A.K.)</option>
                                        <option>QILLAN (A.K.)</option>
                                        <option>SINGOLA (A.K.)</option>
                                        <option>TANGI GALA (A.</option>
                                        <option>THORAR (A.K.)</option>
                                        <option>TOPA (A.K.)</option>
                                        <option>TRARKHAIL (A.K)</option>
                                        <option>Rawalpindi</option>
                                        <option>Fateh Jang</option>
                                        <option>Jand</option>
                                        <option>Pindi Gheb</option>
                                        <option>CHAKLALA</option>
                                        <option>IKHLAS (DIST. A</option>
                                        <option>Kahuta</option>
                                        <option>KHORE</option>
                                        <option>Tarnol</option>
                                        <option>Sadiqabad</option>
                                        <option>GOTH MACHI</option>
                                        <option>KASHMOOR</option>
                                        <option>SUI</option>
                                        <option>Sahiwal</option>
                                        <option>Arifwala</option>
                                        <option>Pakpattan</option>
                                        <option>BONGA HAYAT</option>
                                        <option>NOOR SHAH</option>
                                        <option>QABOOLA SHARIF</option>
                                        <option>Samundri</option>
                                        <option>ADDA PHLOOR ONL</option>
                                        <option>DIJKOT</option>
                                        <option>KHIDAR WALA</option>
                                        <option>MAMON KANJAN</option>
                                        <option>MURID WALA</option>
                                        <option>TANDLIANWALA</option>
                                        <option>Sargodha</option>
                                        <option>ALI PUR SYEDAN</option>
                                        <option>BHAGATANWALA</option>
                                        <option>Bhalwal</option>
                                        <option>BHERA</option>
                                        <option>FAROOQA</option>
                                        <option>HAZOOR PUR</option>
                                        <option>Kot Momin</option>
                                        <option>Lallian</option>
                                        <option>NEHANG</option>
                                        <option>PHULLARWAN</option>
                                        <option>PULL 111 CHAK</option>
                                        <option>RADHEN</option>
                                        <option>SAHIWAL (NAWAN</option>
                                        <option>Sial Sharif</option>
                                        <option>SILLANWALI</option>
                                        <option>Sheikhupura</option>
                                        <option>BURG ATTARI</option>
                                        <option>DERA MALLA SIN</option>
                                        <option>FAIZPUR KHURD</option>
                                        <option>Farooqabad</option>
                                        <option>Feroz Watwan</option>
                                        <option>KHAN GAH DOGRAN</option>
                                        <option>Manawala</option>
                                        <option>MANDI DHABA SIN</option>
                                        <option>MANDI SAFDAR AB</option>
                                        <option>Nankana Sahib</option>
                                        <option>Pindi Bhattian</option>
                                        <option>SAFDARABAD</option>
                                        <option>Shahkot</option>
                                        <option>SHARAQPUR SHARI</option>
                                        <option>KHAN KA SHARIF</option>
                                        <option>Shujabad</option>
                                        <option>JALALPUR PIRWAL</option>
                                        <option>Sialkot</option>
                                        <option>BHOPALWALA</option>
                                        <option>GHUENKE</option>
                                        <option>JHETEKE</option>
                                        <option>KOTLI LOHARAN</option>
                                        <option>QILA SAIFULLAH</option>
                                        <option>Sambrial</option>
                                        <option>Jacobabad</option>
                                        <option>Shikarpur</option>
                                        <option>Sukkur</option>
                                        <option>Dera ala yar</option>
                                        <option>Dera Murad Jama</option>
                                        <option>DHADAR</option>
                                        <option>GAMBAT</option>
                                        <option>GARHI KHERO</option>
                                        <option>GARHI YASIN</option>
                                        <option>HALANI</option>
                                        <option>HARNAI</option>
                                        <option>JOHI</option>
                                        <option>KHAN PUR DISTT.</option>
                                        <option>KOT DEJI</option>
                                        <option>LAKHI GHULAM SH</option>
                                        <option>Pano Aqil</option>
                                        <option>Rohri</option>
                                        <option>SIBBI</option>
                                        <option>Sultan Kot</option>
                                        <option>THEHRI</option>
                                        <option>THULL</option>
                                        <option>USTA MUHAMMAD</option>
                                        <option>SWABI</option>
                                        <option>KALABAT</option>
                                        <option>KHOTA</option>
                                        <option>MARGAZ</option>
                                        <option>TAND KOI</option>
                                        <option>TOPI</option>
                                        <option>Takht-e-Bhai</option>
                                        <option>DARGAI</option>
                                        <option>HARI CHAND</option>
                                        <option>JALALA</option>
                                        <option>Talagang</option>
                                        <option>Tamirgaraha</option>
                                        <option>Dir</option>
                                        <option>DARRORA</option>
                                        <option>HAJI ABAD</option>
                                        <option>HAYA SERAI</option>
                                        <option>KHAAL</option>
                                        <option>KHAR (BAJORE AG</option>
                                        <option>SAHIB ABAD</option>
                                        <option>SHER KHANIE</option>
                                        <option>Tando ala yar</option>
                                        <option>Tando Jam</option>
                                        <option>Thatha</option>
                                        <option>CHOHAR JAMALI</option>
                                        <option>DHABEJI</option>
                                        <option>Gharo</option>
                                        <option>MAKLI</option>
                                        <option>MIR PUR SAKRO</option>
                                        <option>SUJAWAL</option>
                                        <option>Toba Tek Sing</option>
                                        <option>Pirmahal</option>
                                        <option>RAJANA</option>
                                        <option>SANDHIANWALI</option>
                                        <option>Shorkot Cantt.</option>
                                        <option>Vehari</option>
                                        <option>ADDA PAKHI MORE</option>
                                        <option>DOKOTA</option>
                                        <option>Hasilpur</option>
                                        <option>LUDDAN</option>
                                        <option>MACHIWAL</option>
                                        <option>Mailsi</option>
                                        <option>THAINGI</option>
                                        <option>TIBBA SULTAN PU</option>
                                        <option>Wah Cantt</option>
                                        <option>Hassan Abdal</option>
                                        <option>POURMIANA</option>
                                        <option>Taxila</option>
                                        <option>Wazirabad</option>
                                        <option>ADDA AUJLA KALA</option>
                                        <option>AHMAD NAGAR</option>
                                        <option>Elahabad</option>
                                        <option>AZIZ CHAK</option>
                                        <option>Gakkhar Mandi</option>
                                        <option>KARMABAD</option>
                                        <option>KHAIW WALI</option>
                                        <option>Nizamabad</option>
                                        <option>NOORIABAD</option>
                                        <option>DOLTA</option>
                                        <option>SHER SHAH</option>
                                        <option>MIRUPR BATHORO</option>
                                        <option>HAYATABAD</option>
                                        <option>BADOMALHI</option>
                                        <option>QILA KALLARWALA</option>
                                        <option>JHAWARIYA</option>
                                        <option>MOUCH</option>
                                        <option>BHABRRA</option>
                                        <option>ZIABAD</option>
                                        <option>SARA-E- KARISHAN</option>
                                        <option>HABIBABAD</option>
                                        <option>DHURNAL</option>
                                        <option>FAQIRABAD</option>
                                        <option>SANGHI</option>
                                        <option>DAULAT PUR</option>
                                        <option>MALAKWAL</option>
                                        <option>Ghous Pur</option>
                                        <option>Sobho Dero</option>
                                        <option>Chak</option>
                                        <option>SHADUN LUND</option>
                                        <option>KARAM PUR</option>
                                        <option>JAMAL PUR</option>
                                        <option>DHANOT</option>
                                        <option>MUBARAK PUR</option>
                                        <option>DERA BAKHA</option>
                                        <option>JAFFARABAD</option>
                                        <option>CHOWK MUNDA</option>
                                        <option>MITRO</option>
                                        <option>JAMAL DIN WALI</option>
                                        <option>JHAMPEER</option>
                                        <option>ISLAMKOT</option>
                                        <option>Khairpur</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <button class="btn-7 w-100 mt-3 submit-button" onclick="disabled_button('quick_buynow_modal','submit-button-quick-buynow')"  id="submit-button-quick-buynow" type="submit"></button>
                    </form>
                </div>

            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{asset('frontend/js/splide.min.js')}}"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script type="text/javascript" src="{{asset('frontend/js/mdb.umd.min.js')}}"></script>
    {{-- <script src="{{asset('frontend/js/bootstrap-cart.bundle.min.js')}}"></script> --}}
    <script>
        document.addEventListener( 'DOMContentLoaded', function () {
            var splide = new Splide( '#thumbnail-slider', {
                    gap         : 10,
                    rewind      : true,
                    focus       : 'center',
                    pagination  : false,
            });
            var thumbnails = $('.thumbnail');
            var current;

            for ( var i = 0; i < thumbnails.length; i++ ) {
                initThumbnail( thumbnails[ i ], i );
            }

            function initThumbnail( thumbnail, index ) {
                thumbnail.addEventListener( 'click', function () {
                    splide.go( index );
                } );
            }

            splide.on( 'mounted move', function () {
                var thumbnail = thumbnails[ splide.index ];

                if ( thumbnail ) {
                    if ( current ) {
                        current.classList.remove( 'is-active' );
                    }

                    thumbnail.classList.add( 'is-active' );
                    current = thumbnail;
                }
            } );

            splide.mount();
        });
        $(document).ready(function() {
            $(document).on('click', '.view_variation-item', function(){
                if($('.view_variation-item').hasClass('selected')){
                    $(".view_variation-item").removeClass("selected");
                }
                $(this).addClass("selected");   
            });

            $(document).on('click', '.is-minus', function(){
                val = parseInt($('#view_quantity_input').val()) - 1;
                if(val > 0){
                    $('#view_quantity_input').val(parseInt(val));
                }
            });

            $(document).on('click', '.is-plus', function(){
                val = parseInt($('#view_quantity_input').val()) + 1;
                $('#view_quantity_input').val(parseInt(val));
            });

            $(document).on('click', '.cart-is-minus', function(){
                val = parseInt($('#cart_quantity_input').val()) - 1;
                if(val > 0){
                    $('#cart_quantity_input').val(parseInt(val));
                }
            });

            $(document).on('click', '.cart-is-plus', function(){
                val = parseInt($('#cart_quantity_input').val()) + 1;
                $('#cart_quantity_input').val(parseInt(val));
            });

            $(document).on('click', '.variation-item', function(){
                if($('.variation-item').hasClass('selected')){
                    $(".variation-item").removeClass("selected");
                }
                $(this).addClass("selected");   
            });

            $(document).on('click', '.cart_variation-item', function(){
                if($('.cart_variation-item').hasClass('selected')){
                    $(".cart_variation-item").removeClass("selected");
                }
                $(this).addClass("selected");   
            });

            $('#city-select').select2({
                dropdownParent: $('#buynow_modal .modal-body')
            });

            $('#city-select-2').select2({
                dropdownParent: $('#quick_buynow_modal .modal-body')
            });

            $('#city-select-3').select2({
                dropdownParent: $('#buynow_view_modal .modal-body')
            });
            
            window.onload = function() { 
                if($('#modal_value').val() == 'open'){
                    $('#buynow_modal').modal('show');
                }
            }
        });
        function splide_main_fun(id){
            product_images = "{{json_encode($product_images)}}".split(',');
            html = '';
            for(i = 0; i < product_images.length; ++i){    
                html += '<li class="splide__slide">'+
                            '<img src="'+product_images[i].replace("[&quot;", "").replace("&quot;","").replace("&quot;]","")+'">'+
                        '</li>';
            }
            $('#thumbnail-slider-list').append(html);

            var splide = new Splide( '#thumbnail-slider', {
                    gap         : 10,
                    rewind      : true,
                    focus       : 'center',
                    pagination  : false,
            });
            var thumbnails = $('.thumbnail');
            var current;

            for ( var i = 0; i < thumbnails.length; i++ ) {
                initThumbnail( thumbnails[ i ], i );
            }

            function initThumbnail( thumbnail, index ) {
                thumbnail.addEventListener( 'click', function () {
                    splide.go( index );
                } );
            }

            splide.on( 'mounted move', function () {
                var thumbnail = thumbnails[ splide.index ];

                if ( thumbnail ) {
                    if ( current ) {
                        current.classList.remove( 'is-active' );
                    }

                    thumbnail.classList.add( 'is-active' );
                    current = thumbnail;
                }
            } );

            splide.mount();
        }
        function splide_fun(id){
            var splide = new Splide( id, {
                gap         : 10,
                rewind      : true,
                focus       : 'center',
                pagination  : false,
            });
            var thumbnails = $('.thumbnail');
            var current;

            for ( var i = 0; i < thumbnails.length; i++ ) {
                initThumbnail( thumbnails[ i ], i );
            }

            function initThumbnail( thumbnail, index ) {
                thumbnail.addEventListener( 'click', function () {
                    splide.go( index );
                } );
            }

            splide.on( 'mounted move', function () {
                var thumbnail = thumbnails[ splide.index ];

                if ( thumbnail ) {
                    if ( current ) {
                        current.classList.remove( 'is-active' );
                    }

                    thumbnail.classList.add( 'is-active' );
                    current = thumbnail;
                }
            });

            splide.mount();
        }
        function addtocart(){
            variation = null;
            variation_title = null;
            id = $('#modal_productId').val();
            title = $('#product-model-title').text();
            quantity = $('#quantity_input').val();
            price = $('#modal_price_input').val();
            image = $('#modal_productImage').val();

            $(".variation-item").each(function () {
                if($(this).hasClass("selected")){
                    variation = $(this).text();
                    return false;
                }
            });

            // variation_title = $('#variation-title-'+variation).val();
            variation_title = document.getElementById('variation-title-'+variation).value;
            
            // Get Data
            $.ajax({
                url: "{{ URL('addToCart') }}",
                type: "POST",
                data:{ 
                    _token:'{{ csrf_token() }}',
                    id: id,
                    title: title,
                    quantity: quantity,
                    price: price,
                    variation: [variation_title, variation],
                    image: image
                },
                success: function(response){
                    Swal.fire({
                        icon: "success",
                        title: "Item Added to Cart",
                        showConfirmButton: false,
                        timer: 3000,
                        showCloseButton: true,
                        footer: '<a href="{{ URL("cart") }}" class="btn-3">GO TO CART</a>'
                    });
                    console.log(response);
                }
            });
        }
        function addtocart_view(){
            // alert();
            variation = null;
            variation_title = null;
            id = $('#view_modal_productId').val();
            title = $('#view_product-model-title').text();
            quantity = $('#view_quantity_input').val();
            price = $('#view_modal_price_input').val();
            image = $('#view_modal_productImage').val();

            $(".view_variation-item").each(function () {
                if($(this).hasClass("selected")){
                    variation = $(this).text();
                    return false;
                }
            });

            // variation_title = $('#view_variation-title-'+variation).val();
            variation_title = document.getElementById('view_variation-title-'+variation).value;
            
            // Get Data
            $.ajax({
                url: PR_URL+"/addToCart",
                type: "POST",
                data:{ 
                    id: id,
                    title: title,
                    quantity: quantity,
                    price: price,
                    variation: [variation_title, variation],
                    image: image
                },
                success: function(response){
                    Swal.fire({
                        icon: "success",
                        title: "Item Added to Cart",
                        showConfirmButton: false,
                        timer: 3000,
                        showCloseButton: true,
                        footer: '<a href="'+PR_URL+'/cart" class="btn-3">GO TO CART</a>'
                    });
                }
            });
        }
        function modal_addtocart(){
            variation = null;
            variation_title = null;
            id = $('#cart_modal_productId').val();
            title = $('#cart_product-model-title').text();
            quantity = $('#cart_quantity_input').val();
            price = $('#cart_modal_price_input').val();
            image = $('#cart_modal_productImage').val();

            $(".cart_variation-item").each(function () {
                if($(this).hasClass("selected")){
                    variation = $(this).text();
                    return false;
                }
            });
            // alert(variation);
            variation_title = $('#cart_variation-title-'+variation).val();
            
            // Get Data
            $.ajax({
                url: "{{ URL('addToCart') }}",
                type: "POST",
                data:{ 
                    _token:'{{ csrf_token() }}',
                    id: id,
                    title: title,
                    quantity: quantity,
                    price: price,
                    variation: [variation_title, variation],
                    image: image
                },
                success: function(response){
                    Swal.fire({
                        icon: "success",
                        title: "Item Added to Cart",
                        showConfirmButton: false,
                        timer: 3000,
                        showCloseButton: true,
                        footer: '<a href="{{ URL("cart") }}" class="btn-3">GO TO CART</a>'
                    });
                }
            });
        }
        function quick_shop(product){
            // console.log(product);
            $('#cart_modal_productId').val(product['id']);
            $('#cart_modal_productImage').val(product['images'][0]);
            $('#cart_product-model-title').text(product['title']);
            $('#cart_modal_sub_price').text(addCommas(product['compare_price'])+'.00');
            $('#cart_modal_price').text(addCommas(product['price'])+'.00');
            $('#cart_modal_price_input').val(product['price']);
            $('#cart_save_price').text(addCommas(parseInt(product['compare_price']) - parseInt(product['price']))+'.00');

            $('.cart_variation-box').remove();
            html = '';
            for (i = 0; i < product['variations'].length; ++i) {
                if(i == 0){
                    html += '<input type="hidden" id="cart_variation-title-'+product['variations'][i]['value']+'" class="variation-item-title" value="'+product['variations'][i]['title']+'">'+
                    '<div class="cart_variation-item variation-item-style selected">'+product['variations'][i]['value']+'</div>';         
                }else{
                    html += '<input type="hidden" id="cart_variation-title-'+product['variations'][i]['value']+'" class="variation-item-title" value="'+product['variations'][i]['title']+'">'+
                    '<div class="cart_variation-item variation-item-style ">'+product['variations'][i]['value']+'</div>';         
                }
            }
            html = '<div class="cart_variation-box variation-box-style mb-3">'+
                        '<div class="variation-list">'+
                            html+
                        '</div>'+
                    '</div>';

            $('#quickshop_model .cart_product-box .cart_price-box').after(html);


        }
        function quick_view(product){
            // console.log(product);
            $('#view_modal_productId').val(product['id']);
            $('#view_modal_productImage').val(product['images'][0]);
            $('#view_product-model-title').text(product['title']);
            $('#view_modal_sub_price').text(addCommas(product['compare_price'])+'.00');
            $('#view_modal_price').text(addCommas(product['price'])+'.00');
            $('#view_modal_price_input').val(product['price']);
            $('#view_save_price').text(addCommas(parseInt(product['compare_price']) - parseInt(product['price']))+'.00');


            $('.splide__slide').remove();
            html = '';
            for(i = 0; i < product['images'].length; ++i){    
                html += '<li class="splide__slide">'+
                            '<img src="'+PR_URL+'/'+product['images'][i]+'">'+
                        '</li>';
            }
            $('#splide__list_id').append(html);
            splide_fun('#thumbnail-slider-2');

            $('.view_variation-box').remove();
            html = '';
            for (i = 0; i < product['variations'].length; ++i) {
                if(i == 0){
                    html += '<input type="hidden" id="view_variation-title-'+product['variations'][i]['value']+'" class="variation-item-title" value="'+product['variations'][i]['title']+'">'+
                    '<div class="view_variation-item variation-item-style selected">'+product['variations'][i]['value']+'</div>';         
                }else{
                    html += '<input type="hidden" id="view_variation-title-'+product['variations'][i]['value']+'" class="variation-item-title" value="'+product['variations'][i]['title']+'">'+
                    '<div class="view_variation-item variation-item-style">'+product['variations'][i]['value']+'</div>';         
                }
            }

            html = '<div class="view_variation-box variation-box-style mb-3">'+
                        '<div class="variation-list">'+
                            html+
                        '</div>'+
                    '</div>';

            $('#quickview_model .product-box .price-box').after(html);


        }
        function buynow() {
            variation = null;
            variation_title = null;
            $(".variation-item").each(function () {
                if($(this).hasClass("selected")){
                    variation = $(this).text();
                    return false;
                }
            });
            product_id = $('#product_id').val();
            variation_title = document.getElementById('variation-title-'+variation).value;
            // variation_title = $('#variation-title-'+variation).val();
            quantity = $('#quantity_input').val();
            price = $('#product_price').val();
            total = quantity * price;

            $('#product').val(product_id+'-'+variation_title+'-'+variation+'-'+quantity+'-'+price+'-'+total);
            $('#product_variation_title').val(variation_title);
            $('#product_variation_value').val(variation);
            $('#product_quantity').val(quantity);
            $('#product_sub_total').val(total);
            $('#total').val(total);
            $('#total_show').text('Rs'+addCommas(total)+'.00');
            $('#submit-button').text('BUY IT NOW - '+'Rs.'+addCommas(total)+'.00');
            $('#price_and_quantity').text('Rs.'+addCommas(price)+'.00 x '+quantity);
            html = '';
            html = variation_title+": <strong>"+variation+"</strong>";
            $('#product-variation').html(html);

            // del_url = "{{url('remove_from_cart')}}"+'/'+product_id+'/'+variation+'/open';
            // $('cart-box-delete').attr('href',del_url);

            
        }
        function buynow_view() {
            $(".modal-backdrop").last().css("z-index",1060);

            variation = null;
            variation_title = null;

            $(".view_variation-item").each(function () {
                if($(this).hasClass("selected")){
                    variation = $(this).text();
                    return false;
                }
            });

            // variation_title = $('#view_variation-title-'+variation).val();
            variation_title = document.getElementById('view_variation-title-'+variation).value;


            product_id = $('#view_modal_productId').val();
            quantity = $('#view_quantity_input').val();
            title = $('#view_product-model-title').text();
            price = $('#view_modal_price_input').val();
            image = $('#view_modal_productImage').val();
            total = quantity * price;

            $('#buynow_view_modal #product').val(product_id+'-'+variation_title+'-'+variation+'-'+quantity+'-'+price+'-'+total);
            $('#buynow_view_modal #product_id').val(product_id);
            $('#buynow_view_modal #product_price').val(price);
            $('#buynow_view_modal #product_image').attr('src',PR_URL+'/'+image);
            $('#buynow_view_modal .product-name').text(title);
            $('#buynow_view_modal #product_variation_title').val(variation_title);
            $('#buynow_view_modal #product_variation_value').val(variation);
            $('#buynow_view_modal #product_quantity').val(quantity);
            $('#buynow_view_modal #product_sub_total').val(total);
            $('#buynow_view_modal #total').val(total);
            $('#buynow_view_modal #total_show').text('Rs'+addCommas(total)+'.00');
            $('#buynow_view_modal #submit-button-buynow-view').text('BUY IT NOW - '+'Rs.'+addCommas(total)+'.00');
            $('#buynow_view_modal #price_and_quantity').text('Rs.'+addCommas(price)+'.00 x '+quantity);
            html = '';
            html = variation_title+": <strong>"+variation+"</strong>";
            $('#buynow_view_modal #product-variation').html(html);

            // del_url = "{{url('remove_from_cart')}}"+'/'+product_id+'/'+variation+'/open';
            // $('cart-box-delete').attr('href',del_url);

            
        }
        function quick_buynow() {
            $(".modal-backdrop").last().css("z-index",1060);

            variation = null;
            variation_title = null;

            $(".variation-item").each(function () {
                if($(this).hasClass("selected")){
                    variation = $(this).text();
                    return false;
                }
            });

            // variation_title = $('#variation-title-'+variation).val();
            variation_title = document.getElementById('variation-title-'+variation).value;


            product_id = $('#cart_modal_productId').val();
            quantity = $('#cart_quantity_input').val();
            title = $('#cart_product-model-title').text();
            price = $('#cart_modal_price_input').val();
            image = $('#cart_modal_productImage').val();
            total = quantity * price;

            $('#quick_buynow_modal #product').val(product_id+'-'+variation_title+'-'+variation+'-'+quantity+'-'+price+'-'+total);
            $('#quick_buynow_modal #product_id').val(product_id);
            $('#quick_buynow_modal #product_price').val(price);
            $('#quick_buynow_modal #product_image').attr('src',PR_URL+'/'+image);
            $('#quick_buynow_modal .product-name').text(title);
            $('#quick_buynow_modal #product_variation_title').val(variation_title);
            $('#quick_buynow_modal #product_variation_value').val(variation);
            $('#quick_buynow_modal #product_quantity').val(quantity);
            $('#quick_buynow_modal #product_sub_total').val(total);
            $('#quick_buynow_modal #total').val(total);
            $('#quick_buynow_modal #total_show').text('Rs'+addCommas(total)+'.00');
            $('#quick_buynow_modal #submit-button-quick-buynow').text('BUY IT NOW - '+'Rs.'+addCommas(total)+'.00');
            $('#quick_buynow_modal #price_and_quantity').text('Rs.'+addCommas(price)+'.00 x '+quantity);
            html = '';
            html = variation_title+": <strong>"+variation+"</strong>";
            $('#quick_buynow_modal #product-variation').html(html);

            // del_url = "{{url('remove_from_cart')}}"+'/'+product_id+'/'+variation+'/open';
            // $('cart-box-delete').attr('href',del_url);

            
        }
        // function submit_form(id) {
        //     if ($('#category').val() === '' || $('#category').val() === null) {
        //         alert('Please select a category!');
        //         return false; // Prevent form submission
        //     }else{

        //     }
        //     disabled_button('buynow_modal','submit-button')
        // }
    </script>
@endsection
