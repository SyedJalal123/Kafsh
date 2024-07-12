@extends('frontend.app')

@section('styles')
    <!-- Font Icon -->
    <link rel="stylesheet" href="{{asset('frontend/fonts/material-icon/css/material-design-iconic-font.min.css')}}">
    <!-- Main css -->
    <link rel="stylesheet" href="{{asset('frontend/css/style_signup.css')}}">
@endsection

@section('content')
    <div class="main">
        @include('frontend.includes.login_sessions')

        <!-- Sing in  Form -->
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><img src="{{asset('frontend/img/signin-image.jpg')}}" alt="sing up image"></figure>
                        {{-- <a href="{{url('sign-up')}}" class="signup-image-link">Create an account</a> --}}
                    </div>

                    <div class="signin-form">
                        <h2 class="form-title">Sign in</h2>
                        <form method="POST" action="{{url('sign-in')}}" class="register-form" id="login-form">
                            @csrf
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="email" class="@error('email') is-invalid @enderror" name="email" id="email" placeholder="Your Email" value="{{ old('email') }}" required autocomplete="email" autofocus/>
                            </div>
                            <div class="form-group d-flex align-items-center">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password" id="pass" class="@error('password') is-invalid @enderror" required placeholder="Password" autocomplete="current-password"/>
                                <i onclick="pass_show()" id="pass_show" style="cursor: pointer;font-size: 17px;" class="zmdi zmdi-eye"></i>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Remember me</label>
                            </div>
                            <div class="form-group form-button login-button-box mt-5">
                                <input type="submit" name="signin" id="signin" class="form-submit" value="Log in"/>
                                <span class="m-2">Or</span><a href="{{url('sign-up')}}" class="signup-image-link">Create an account</a>
                            </div>
                        </form>
                        <div class="social-login">
                            {{-- <span class="social-label">Or login with</span>
                            <ul class="socials">
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                                <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                            </ul> --}}
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </div>
   
@endsection

@section('scripts')
    <script src="{{asset('frontend/vendor/jquery/jquery.min.js')}}"></script>
    <script src="{{asset('frontend/js/main_signup.js')}}"></script>

    <script>
        function check_pass(){
            password = $('#pass').val();
            re_pass = $('#re_pass').val();

            if(password == re_pass){
                $('#pass').attr('style','border-bottom: 1px solid green;');
                $('#re_pass').attr('style','border-bottom: 1px solid green;');
            }else{
                $('#pass').attr('style','border-bottom: 1px solid red;');
                $('#re_pass').attr('style','border-bottom: 1px solid red;');
            }
        }
        function pass_show() {
            var x = document.getElementById("pass");
            if (x.type === "password") {
                x.type = "text";
                $('#pass_show').removeClass('zmdi-eye');
                $('#pass_show').addClass('zmdi-eye-off');
            } else {
                x.type = "password";
                $('#pass_show').removeClass('zmdi-eye-off');
                $('#pass_show').addClass('zmdi-eye');
            }
        }
    </script>
@endsection
