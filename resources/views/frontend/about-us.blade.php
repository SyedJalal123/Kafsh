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
        strong {
            font-weight: 600;
        }
    </style>
@endsection

@section('content')
    <section class="main page-top-section">
        <h1 class="heading">About Us</h1>
    </section>
    <section class="col-12 container">
        <p class="text-2 text-center">
            Welcome to Kafsh, where tradition meets innovation in handcrafted leather sandals. 
            We celebrate the traditional craft of shoe making, offering authentic, quality footwear that bridges tradition and modernity. 
            Our mission is to make this craft accessible globally while honoring cultural heritage and artisanal craftsmanship. 
            Step into a world of culture and elegance with Kafsh sandals.
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
