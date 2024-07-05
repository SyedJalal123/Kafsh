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
    </style>
@endsection

@section('content')
    <section class="main page-top-section">
        <h1 class="heading">Contact Us</h1>
    </section>
    <section class="col-12 container">
        <p class="text-2 poppins-all">
            <strong class="fw-600">Email</strong>: kafshwearings@gmail.com
            <br><br>
            <strong class="fw-600">Number</strong>: 03140890365
        </p>
    </section>
@endsection

@section('models')

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {});
    </script>
@endsection
