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
        .main {
            padding-right: 10px;
            padding-left: 10px;
        }
        body * {
            font-family: Poppins !important;
        }
        .success-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
        }
    </style>
    
@endsection

@section('content')
    {{-- {{dd(Session::get('cart'));}} --}}
    <section class="main col-12 mt-4">
        <div class="px-3 success-box">
            <img src="{{asset('frontend/img/tick.png')}}" width="100" class="mb-3" alt="">
            <h2 class="main-heading mb-3">Order Confirmed !</h2>
            <p class="mb-3 text-center">Your order (Order #{{$order->order_no}}) has been placed successfully.</p>
            <a class="mb-5 color-brown" href="{{url('account')}}">Track My Order</a>
            <a href="{{url('collections/all')}}"><button class="btn-4">Continue Shopping</button></a>
        </div>
    </section>
@endsection

@section('scripts')
    
@endsection
