@extends('frontend.app')

@section('styles')
@endsection


@section('content')
    <section class="main page-top-section">
        <h1 class="heading">Collections</h1>
    </section>
    <section class="col-12 container">
        <div class="row collections m-0 py-5">
            @foreach ($collections as $collection)    
                @include('frontend.includes.collection')
            @endforeach
        </div>
    </section>
@endsection

@section('models')

@endsection

@section('scripts')
    <script src="{{asset('frontend/js/home.js')}}"></script>
@endsection