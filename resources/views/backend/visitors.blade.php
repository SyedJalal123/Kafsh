@extends('backend.app')


@section('header')
    <!--begin::Page title-->
    <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
        <!--begin::Title-->
        <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Customer</h1>
        <!--end::Title-->
    </div>
    <!--end::Page title-->
@endsection

@section('styles')
    <link href="assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css">
    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css">
@endsection

@section('content')
    <!--begin::Card-->
    <div class="card">
        <!--begin::Card body-->
        <div class="row">
            <div class="col-9"></div>
            <div class="col-3">
                <input type="text" class="form-control p-2 m-2" style="max-width: 200px;" placeholder="Search" id="search_input">
            </div>
        </div>
        <div class="card-body p-5">
            <form action="{{url('backend/visitors')}}" method="POST" id="visitors_filter">
                @csrf
                <button class="tag-button-1" type="button">
                    <input onchange="submit_filter()" type="text" id="kt_datepicker_7" class="b-none outline-none w-100" placeholder="Today" max="{{date('Y-m-d')}}">
                </button>
            </form>
            <table id="kt_datatable_example_5" class="table table-row-bordered gy-5 data_table">
                <thead>
                    <tr class="fw-bold fs-6 text-muted">
                        <th>Location</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($views as $view)
                    <tr>
                        <td>{{Location::get($view->collection)->cityName}}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <!--end::Card body-->
    </div>
    <!--end::Card-->
@endsection

@section('models')

@endsection

@section('scripts')
    <script src="{{asset('backend/assets/plugins/custom/datatables/datatables.bundle.js')}}"></script>

    <!--CKEditor Build Bundles:: Only include the relevant bundles accordingly-->
    <script src="{{asset('backend/assets/plugins/custom/ckeditor/ckeditor-classic.bundle.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/custom/ckeditor/ckeditor-inline.bundle.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/custom/ckeditor/ckeditor-balloon.bundle.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/custom/ckeditor/ckeditor-balloon-block.bundle.js')}}"></script>
    <script src="{{asset('backend/assets/plugins/custom/ckeditor/ckeditor-document.bundle.js')}}"></script>

    <script>
        table = $("#kt_datatable_example_5").DataTable({
            ordering:true,
        });
        
        $("#kt_datepicker_7").flatpickr({
            altInput: false,
            altFormat: "F j, Y",
            dateFormat: "d-m-Y",
            mode: "range",
            maxDate: "today"
        });
        // #myInput is a <input type="text"> element
        $('#search_input').on( 'keyup', function () {
            table.search( this.value ).draw();
        } );
        function submit_filter(){
            if(!$('.flatpickr-calendar').hasClass('open')){
               $('#visitors_filter').submit(); 
            }
        }
    </script>
@endsection


