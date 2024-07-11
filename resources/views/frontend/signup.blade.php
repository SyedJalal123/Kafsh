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
        <!-- Sign up form -->
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">Sign up</h2>
                        <form method="POST" action="{{url('sign-up')}}" class="register-form" id="register-form">
                            @csrf
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" class="@error('name') is-invalid @enderror" name="name" id="name" required placeholder="Your Name"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" class="@error('email') is-invalid @enderror" name="email" id="email" required placeholder="Your Email"/>
                            </div>
                            <div class="form-group d-flex align-items-center">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" class="@error('password') is-invalid @enderror" name="password" id="pass" required placeholder="Password" autocomplete="new-password"/>
                                <i onclick="pass_show()" id="pass_show" style="cursor: pointer;font-size: 17px;" class="zmdi zmdi-eye"></i>
                                
                            </div>
                            <div class="form-group d-flex align-items-center">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" onkeyup="check_pass()" class="" name="password_confirmation" id="re_pass" required placeholder="Repeat your password" autocomplete="new-password"/>
                                <i onclick="re_pass_show()" id="re_pass_show" style="cursor: pointer;font-size: 17px;" class="zmdi zmdi-eye"></i>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="agree-term" required class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" id="signup" class="form-submit" value="Register"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><img src="{{asset('frontend/img/signup-image.jpg')}}" alt="sing up image"></figure>
                        <a href="{{url('sign-in')}}" class="signup-image-link">I am already member</a>
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
        function re_pass_show() {
            var x = document.getElementById("re_pass");
            if (x.type === "password") {
                x.type = "text";
                $('#re_pass_show').removeClass('zmdi-eye');
                $('#re_pass_show').addClass('zmdi-eye-off');
            } else {
                x.type = "password";
                $('#re_pass_show').removeClass('zmdi-eye-off');
                $('#re_pass_show').addClass('zmdi-eye');
            }
        }
    </script>
@endsection
