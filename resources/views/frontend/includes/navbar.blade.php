<div class="header-bar">
    <div class="nav-head">
        <!-- Start Mega Menu HTML -->
        <!-- PC Header -->
        <div class="navbar-brand d-flex justify-content-between p-3">
            <div class="header-buttons" style="padding:0px 113px;"></div>
            <a href="{{url('/')}}">
                <div class="logo-box">
                    <p class="m-0 kafsh">KAFSH</p>
                    <P class="m-0 pakistan">PAKISTAN</P>
                </div>
                {{-- <img class="rlogo d-none" src="{{asset('frontend/img/rlogo-white-.png')}}" alt="Kafsh"> --}}
            </a>
            <div class="header-buttons">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" style="" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                        <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001q.044.06.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1 1 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0"/>
                    </svg>
                </a>
                <a href="{{url('account')}}">
                    <svg id="person_icon" xmlns="http://www.w3.org/2000/svg" width="44" height="44" fill="currentColor" class="bi bi-person" viewBox="0 0 16 16">
                        <path d="M8 8a3 3 0 1 0 0-6 3 3 0 0 0 0 6m2-3a2 2 0 1 1-4 0 2 2 0 0 1 4 0m4 8c0 1-1 1-1 1H3s-1 0-1-1 1-4 6-4 6 3 6 4m-1-.004c-.001-.246-.154-.986-.832-1.664C11.516 10.68 10.289 10 8 10s-3.516.68-4.168 1.332c-.678.678-.83 1.418-.832 1.664z"/>
                    </svg>
                </a>
                {{-- <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" fill="currentColor" class="bi bi-heart" viewBox="0 0 16 16">
                        <path d="m8 6.236-.894-1.789c-.222-.443-.607-1.08-1.152-1.595C5.418 2.345 4.776 2 4 2 2.324 2 1 3.326 1 4.92c0 1.211.554 2.066 1.868 3.37.337.334.721.695 1.146 1.093C5.122 10.423 6.5 11.717 8 13.447c1.5-1.73 2.878-3.024 3.986-4.064.425-.398.81-.76 1.146-1.093C14.446 6.986 15 6.131 15 4.92 15 3.326 13.676 2 12 2c-.777 0-1.418.345-1.954.852-.545.515-.93 1.152-1.152 1.595zm.392 8.292a.513.513 0 0 1-.784 0c-1.601-1.902-3.05-3.262-4.243-4.381C1.3 8.208 0 6.989 0 4.92 0 2.755 1.79 1 4 1c1.6 0 2.719 1.05 3.404 2.008.26.365.458.716.596.992a7.6 7.6 0 0 1 .596-.992C9.281 2.049 10.4 1 12 1c2.21 0 4 1.755 4 3.92 0 2.069-1.3 3.288-3.365 5.227-1.193 1.12-2.642 2.48-4.243 4.38z"/>
                    </svg>
                </a> --}}
                <a href="{{url('cart')}}">
                    <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                        <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                    </svg>
                </a>
            </div>
        </div>
        <!-- PC Header -->
        <!-- Phone Header -->
        <nav class="navbar navbar-expand-lg" id="header-nav">
            <div class="container-fluid">
                <div class="phone-menu-top">
                    <button class="navbar-toggler collapsed" onclick="background_color()" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-content">
                        <div class="hamburger-toggle">
                            <div class="hamburger">
                                <span></span>
                                <span></span>
                                <span></span>
                            </div>
                        </div>
                    </button>
                    <a class="navbar-brand m-0" href="{{url('/')}}">
                        <div class="logo-box-phone">
                            <p class="m-0 kafsh">KAFSH</p>
                            <P class="m-0 pakistan">PAKISTAN</P>
                        </div>
                        {{-- <img class="rlogo-brand" src="{{asset('frontend/img/rlogo-white-.png')}}" alt="Kafsh"> --}}
                    </a>
                    <a href="{{url('/cart')}}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="44" height="44" fill="currentColor" class="bi bi-bag" viewBox="0 0 16 16">
                            <path d="M8 1a2.5 2.5 0 0 1 2.5 2.5V4h-5v-.5A2.5 2.5 0 0 1 8 1m3.5 3v-.5a3.5 3.5 0 1 0-7 0V4H1v10a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V4zM2 5h12v9a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1z"/>
                        </svg>
                    </a>
                </div>
                <input type="hidden" value="0" id="navbar-background-input">
                <div class="collapse navbar-collapse" id="navbar-content">
                    <ul class="navbar-nav mr-auto mb-2 mb-lg-0">
                        <li class="nav-item dropdown dropdown-mega position-static">
                            <a class="d-flex justify-content-between nav-link nav-link-parent" data-bs-toggle="dropdown" data-bs-auto-close="outside" href="#">
                                <span class="nav-text">WOMEN</span>
                                <svg class="pc-d-none" xmlns="http://www.w3.org/2000/svg" width="7.495" height="15.219" version="1.1" viewBox="0 0 5.687 10.377">
                                    <g transform="translate(83.73 -130.038)">
                                        <path fill="#000" d="M-83.232 140.415l-.498-.5 4.689-4.689-4.69-4.69.5-.498 5.188 5.188z" fill-opacity="1"
                                            fill-rule="nonzero" stroke="none" stroke-dasharray="none" stroke-dashoffset="0" stroke-linecap="butt"
                                            stroke-linejoin="miter" stroke-miterlimit="10" stroke-opacity="1" stroke-width="0.706"
                                            baseline-shift="baseline" clip-rule="nonzero" color="#000" color-interpolation="sRGB"
                                            color-interpolation-filters="linearRGB" color-rendering="auto" direction="ltr" display="inline"
                                            dominant-baseline="auto" enable-background="accumulate" font-family="sans-serif" font-size="medium"
                                            font-stretch="normal" font-style="normal" font-variant="normal" font-weight="normal" image-rendering="auto"
                                            letter-spacing="normal" opacity="1" overflow="visible" shape-rendering="auto" text-anchor="start"
                                            text-decoration="none" text-rendering="auto" vector-effect="none" visibility="visible" word-spacing="normal"
                                            writing-mode="lr-tb"
                                            style="line-height: normal; font-variant-ligatures: normal; font-variant-position: normal; font-variant-caps: normal; font-variant-numeric: normal; font-variant-alternates: normal; font-feature-settings: normal; text-indent: 0px; text-align: start; text-decoration-line: none; text-decoration-style: solid; text-decoration-color: rgb(0, 0, 0); text-transform: none; text-orientation: mixed; white-space: normal; isolation: auto; mix-blend-mode: normal;">
                                        </path>
                                    </g>
                                </svg>
                            </a>
                            
                            <div class="dropdown-menu shadow">
                                <div class="mega-content px-4">
                                    <div class="container-fluid">
                                        <div class="row d-flex justify-content-center p-4">
                                            <div class="nav-sub-items col-12 mb-4 col-sm-4 col-md-2">
                                                <h6>TRENDING</h6>
                                                <div class="list-group">
                                                    <a class="list-group-item" href="#">New Arrivals</a>
                                                    <a class="list-group-item" href="#">Trending Styles</a>
                                                    <a class="list-group-item" href="#">Kitten Heels</a>
                                                    <a class="list-group-item" href="#">Holiday Edit</a>
                                                </div>
                                            </div>
                                            <div class="nav-sub-items col-12 mb-4 col-sm-4 col-md-2">
                                                <h6>SHOES</h6>
                                                <div class="list-group">
                                                    <a class="list-group-item" href="#">All Shoes</a>
                                                    <a class="list-group-item" href="#">Heels</a>
                                                    <a class="list-group-item" href="#">Flats</a>
                                                    <a class="list-group-item" href="#">Loafers</a>
                                                    <a class="list-group-item" href="#">Mary Jane Shoes</a>
                                                    <a class="list-group-item" href="#">Slippers</a>
                                                </div>
                                            </div>
                                            <div class="nav-sub-items col-12 mb-4 col-sm-4 col-md-2">
                                                <h6>SANDALS</h6>
                                                <div class="list-group">
                                                    <a class="list-group-item" href="#">All Sandals</a>
                                                    <a class="list-group-item" href="#">Flat Sandals</a>
                                                    <a class="list-group-item" href="#">Heeled Sandals</a>
                                                    <a class="list-group-item" href="#">Espadrilles</a>
                                                    <a class="list-group-item" href="#">Wedges</a>
                                                </div>
                                            </div>
                                            <div class="nav-sub-items col-12 mb-4 col-sm-4 col-md-2">
                                                <h6>SNEAKERS</h6>
                                                <div class="list-group">
                                                    <a class="list-group-item" href="#">All Sneakers</a>
                                                    <a class="list-group-item" href="#">Slip on Sneakers</a>
                                                    <a class="list-group-item" href="#">Lace-Up Sneakers</a>
                                                </div>
                                            </div>
                                            <div class="nav-sub-items col-12 mb-4 col-sm-4 col-md-2 nav-sub-last">
                                                <h6>BOOTS</h6>
                                                <div class="list-group">
                                                    <a class="list-group-item" href="#">All Boots</a>
                                                    <a class="list-group-item" href="#">Ankle Boots</a>
                                                    <a class="list-group-item" href="#">Knee Hign Boots</a>
                                                    <a class="list-group-item" href="#">Heeled Boots</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown dropdown-mega position-static">
                            <a class="d-flex justify-content-between nav-link nav-link-parent" data-bs-toggle="dropdown" data-bs-auto-close="outside" href="#">
                                <span class="nav-text">MEN</span>
                                <svg class="pc-d-none" xmlns="http://www.w3.org/2000/svg" width="7.495" height="15.219" version="1.1" viewBox="0 0 5.687 10.377">
                                    <g transform="translate(83.73 -130.038)">
                                        <path fill="#000" d="M-83.232 140.415l-.498-.5 4.689-4.689-4.69-4.69.5-.498 5.188 5.188z" fill-opacity="1"
                                            fill-rule="nonzero" stroke="none" stroke-dasharray="none" stroke-dashoffset="0" stroke-linecap="butt"
                                            stroke-linejoin="miter" stroke-miterlimit="10" stroke-opacity="1" stroke-width="0.706"
                                            baseline-shift="baseline" clip-rule="nonzero" color="#000" color-interpolation="sRGB"
                                            color-interpolation-filters="linearRGB" color-rendering="auto" direction="ltr" display="inline"
                                            dominant-baseline="auto" enable-background="accumulate" font-family="sans-serif" font-size="medium"
                                            font-stretch="normal" font-style="normal" font-variant="normal" font-weight="normal" image-rendering="auto"
                                            letter-spacing="normal" opacity="1" overflow="visible" shape-rendering="auto" text-anchor="start"
                                            text-decoration="none" text-rendering="auto" vector-effect="none" visibility="visible" word-spacing="normal"
                                            writing-mode="lr-tb"
                                            style="line-height: normal; font-variant-ligatures: normal; font-variant-position: normal; font-variant-caps: normal; font-variant-numeric: normal; font-variant-alternates: normal; font-feature-settings: normal; text-indent: 0px; text-align: start; text-decoration-line: none; text-decoration-style: solid; text-decoration-color: rgb(0, 0, 0); text-transform: none; text-orientation: mixed; white-space: normal; isolation: auto; mix-blend-mode: normal;">
                                        </path>
                                    </g>
                                </svg>
                            </a>                                    
                            <div class="dropdown-menu shadow">
                                <div class="mega-content px-4">
                                    <div class="container-fluid">
                                        <div class="row d-flex justify-content-center p-4">
                                            <div class="nav-sub-items col-12 mb-4 col-sm-4 col-md-2">
                                                <h6>TRENDING</h6>
                                                <div class="list-group">
                                                    <a class="list-group-item" href="#">New Arrivals</a>
                                                    <a class="list-group-item" href="#">Trending Styles</a>
                                                    <a class="list-group-item" href="#">Kitten Heels</a>
                                                    <a class="list-group-item" href="#">Holiday Edit</a>
                                                </div>
                                            </div>
                                            <div class="nav-sub-items col-12 mb-4 col-sm-4 col-md-2">
                                                <h6>SHOES</h6>
                                                <div class="list-group">
                                                    <a class="list-group-item" href="#">All Shoes</a>
                                                    <a class="list-group-item" href="#">Heels</a>
                                                    <a class="list-group-item" href="#">Flats</a>
                                                    <a class="list-group-item" href="#">Loafers</a>
                                                    <a class="list-group-item" href="#">Mary Jane Shoes</a>
                                                    <a class="list-group-item" href="#">Slippers</a>
                                                </div>
                                            </div>
                                            <div class="nav-sub-items col-12 mb-4 col-sm-4 col-md-2">
                                                <h6>SANDALS</h6>
                                                <div class="list-group">
                                                    <a class="list-group-item" href="#">All Sandals</a>
                                                    <a class="list-group-item" href="#">Flat Sandals</a>
                                                    <a class="list-group-item" href="#">Heeled Sandals</a>
                                                    <a class="list-group-item" href="#">Espadrilles</a>
                                                    <a class="list-group-item" href="#">Wedges</a>
                                                </div>
                                            </div>
                                            <div class="nav-sub-items col-12 mb-4 col-sm-4 col-md-2">
                                                <h6>SNEAKERS</h6>
                                                <div class="list-group">
                                                    <a class="list-group-item" href="#">All Sneakers</a>
                                                    <a class="list-group-item" href="#">Slip on Sneakers</a>
                                                    <a class="list-group-item" href="#">Lace-Up Sneakers</a>
                                                </div>
                                            </div>
                                            <div class="nav-sub-items col-12 mb-4 col-sm-4 col-md-2 nav-sub-last">
                                                <h6>BOOTS</h6>
                                                <div class="list-group">
                                                    <a class="list-group-item" href="#">All Boots</a>
                                                    <a class="list-group-item" href="#">Ankle Boots</a>
                                                    <a class="list-group-item" href="#">Knee Hign Boots</a>
                                                    <a class="list-group-item" href="#">Heeled Boots</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item dropdown dropdown-mega position-static">
                            <a class="d-flex justify-content-between nav-link nav-link-parent" data-bs-toggle="dropdown" data-bs-auto-close="outside" href="#">
                                <span class="nav-text">BAGS</span>
                                <svg class="pc-d-none" xmlns="http://www.w3.org/2000/svg" width="7.495" height="15.219" version="1.1" viewBox="0 0 5.687 10.377">
                                    <g transform="translate(83.73 -130.038)">
                                        <path fill="#000" d="M-83.232 140.415l-.498-.5 4.689-4.689-4.69-4.69.5-.498 5.188 5.188z" fill-opacity="1"
                                            fill-rule="nonzero" stroke="none" stroke-dasharray="none" stroke-dashoffset="0" stroke-linecap="butt"
                                            stroke-linejoin="miter" stroke-miterlimit="10" stroke-opacity="1" stroke-width="0.706"
                                            baseline-shift="baseline" clip-rule="nonzero" color="#000" color-interpolation="sRGB"
                                            color-interpolation-filters="linearRGB" color-rendering="auto" direction="ltr" display="inline"
                                            dominant-baseline="auto" enable-background="accumulate" font-family="sans-serif" font-size="medium"
                                            font-stretch="normal" font-style="normal" font-variant="normal" font-weight="normal" image-rendering="auto"
                                            letter-spacing="normal" opacity="1" overflow="visible" shape-rendering="auto" text-anchor="start"
                                            text-decoration="none" text-rendering="auto" vector-effect="none" visibility="visible" word-spacing="normal"
                                            writing-mode="lr-tb"
                                            style="line-height: normal; font-variant-ligatures: normal; font-variant-position: normal; font-variant-caps: normal; font-variant-numeric: normal; font-variant-alternates: normal; font-feature-settings: normal; text-indent: 0px; text-align: start; text-decoration-line: none; text-decoration-style: solid; text-decoration-color: rgb(0, 0, 0); text-transform: none; text-orientation: mixed; white-space: normal; isolation: auto; mix-blend-mode: normal;">
                                        </path>
                                    </g>
                                </svg>
                            </a>
                            <div class="dropdown-menu shadow">
                                <div class="mega-content px-4">
                                    <div class="container-fluid">
                                        <div class="row d-flex justify-content-center p-4">
                                            <div class="nav-sub-items col-12 mb-4 col-sm-4 col-md-2">
                                                <h6>TRENDING</h6>
                                                <div class="list-group">
                                                    <a class="list-group-item" href="#">New Arrivals</a>
                                                    <a class="list-group-item" href="#">Trending Styles</a>
                                                    <a class="list-group-item" href="#">Kitten Heels</a>
                                                    <a class="list-group-item" href="#">Holiday Edit</a>
                                                </div>
                                            </div>
                                            <div class="nav-sub-items col-12 mb-4 col-sm-4 col-md-2">
                                                <h6>SHOES</h6>
                                                <div class="list-group">
                                                    <a class="list-group-item" href="#">All Shoes</a>
                                                    <a class="list-group-item" href="#">Heels</a>
                                                    <a class="list-group-item" href="#">Flats</a>
                                                    <a class="list-group-item" href="#">Loafers</a>
                                                    <a class="list-group-item" href="#">Mary Jane Shoes</a>
                                                    <a class="list-group-item" href="#">Slippers</a>
                                                </div>
                                            </div>
                                            <div class="nav-sub-items col-12 mb-4 col-sm-4 col-md-2">
                                                <h6>SANDALS</h6>
                                                <div class="list-group">
                                                    <a class="list-group-item" href="#">All Sandals</a>
                                                    <a class="list-group-item" href="#">Flat Sandals</a>
                                                    <a class="list-group-item" href="#">Heeled Sandals</a>
                                                    <a class="list-group-item" href="#">Espadrilles</a>
                                                    <a class="list-group-item" href="#">Wedges</a>
                                                </div>
                                            </div>
                                            <div class="nav-sub-items col-12 mb-4 col-sm-4 col-md-2">
                                                <h6>SNEAKERS</h6>
                                                <div class="list-group">
                                                    <a class="list-group-item" href="#">All Sneakers</a>
                                                    <a class="list-group-item" href="#">Slip on Sneakers</a>
                                                    <a class="list-group-item" href="#">Lace-Up Sneakers</a>
                                                </div>
                                            </div>
                                            <div class="nav-sub-items col-12 mb-4 col-sm-4 col-md-2 nav-sub-last">
                                                <h6>BOOTS</h6>
                                                <div class="list-group">
                                                    <a class="list-group-item" href="#">All Boots</a>
                                                    <a class="list-group-item" href="#">Ankle Boots</a>
                                                    <a class="list-group-item" href="#">Knee Hign Boots</a>
                                                    <a class="list-group-item" href="#">Heeled Boots</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link nav-text" href="#">R&B STORIES</a>
                        </li>
                        <li class="nav-item nav-phone"></li>
                        <li class="nav-item nav-phone"></li>
                        <li class="nav-item nav-phone"></li>
                        <li class="nav-item nav-phone"></li>
                        <li class="nav-item nav-phone"></li>
                        <li class="nav-item nav-phone"></li>
                        <li class="nav-item nav-phone"></li>
                        <li class="nav-item nav-phone"><a href="#" class="nav-text">Sign In</a></li>
                        <li class="nav-item nav-phone"><a href="#" class="nav-text">Create an account</a></li>
                        <li class="nav-item nav-phone"><a href="#" class="nav-text">Contact us</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Phone Header -->
        <!-- END Mega Menu HTML -->
    </div>
</div>