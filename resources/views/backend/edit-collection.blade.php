@extends('backend.app')


@section('header')
    <!--begin::Page title-->
    <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
        <!--begin::Title-->
        <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Edit Collection</h1>
        <!--end::Title-->
    </div>
    <!--end::Page title-->
    <!--begin::Actions-->
    <div class="d-flex align-items-center py-1">
        <!--begin::Button-->
        <a href="{{asset('backend/collection')}}" class="btn btn-sm btn-primary">Collections</a>
        <!--end::Button-->
    </div>
    <!--end::Actions-->
@endsection

@section('styles')
    <link href="assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css">
    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css">

    @if($collection->image == null)
        @php $image_placeholder = url("backend/assets/media/avatars/blank.png"); @endphp
    @else
        @php $image_placeholder = url($collection->image); @endphp
    @endif
    <!--begin::Image input placeholder-->
    <style>
        .image-input {
            background-image: url('{{$image_placeholder}}');
        }

        [data-bs-theme="dark"] .image-input {
            background-image: url('{{asset("backend/assets/media/avatars/blank.png")}}');
        }
        
    </style>
    <!--end::Image input placeholder-->
@endsection

@section('content')
    <!--begin::Card-->
    <div class="card">
        <form method="POST" action="{{url('backend/collection')}}/{{$collection->id}}" enctype="multipart/form-data">
            @csrf
            @method("PATCH")
            <div class="modal-body">
                <div class="row">
                    <div class="col-9 mb-10">
                        <label class="required form-label">Title</label>
                        <input type="text" class="form-control form-control-solid" value="{{$collection->title}}" id="title" onkeyup="add_slug()" name="title" placeholder="Title" required>

                        <label class="required mt-10 form-label">Status</label>
                        <div class="form-check ">
                            <input class="form-check-input" name="status" type="checkbox" id="ActiveCheckChecked" @if($collection->status == 1) checked @endif>
                            <label class="form-check-label" for="ActiveCheckChecked">
                                Active
                            </label>
                        </div>
                    </div>
                    <div class="col-3 mb-10">
                        <label class="form-label">Image</label>
                        <br>
                        <div class="d-flex flex-row align-items-end">
                            <div id="images-wrapper">
                                <!--begin::Image input-->
                                <div class="image-input image-input-empty images-wrapper me-3" id="img-wrapper-0" data-kt-image-input="true">
                                    <!--begin::Image preview wrapper-->
                                    <div class="image-input-wrapper w-125px h-125px"></div>
                                    <!--end::Image preview wrapper-->

                                    <!--begin::Edit button-->
                                    <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Change photo">
                                        <i class="bi bi-pencil fs-6">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>

                                        <!--begin::Inputs-->
                                        <input type="file" name="image" accept=".png, .jpg, .jpeg"/>
                                        <input type="hidden" name="old_image" value="{{$collection->image}}"/>
                                        <input type="hidden" name="avatar_remove[]" />
                                        <!--end::Inputs-->
                                    </label>
                                    <!--end::Edit button-->

                                    <!--begin::Cancel button-->
                                    <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Cancel photo">
                                        <i class="bi bi-x-lg fs-3"></i>
                                    </span>
                                    <!--end::Cancel button-->

                                    <!--begin::Remove button-->
                                    <span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Remove photo">
                                        <i class="bi bi-x-lg fs-3"></i>
                                    </span>
                                    <!--end::Remove button-->
                                </div>
                                <!--end::Image input-->
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row border rounded border-dark p-5">
                    <h2>Search engine listing</h2>
                    <div class="col-12 mb-10 mt-4">
                        <label class="form-label">SEO Title</label>
                        <input type="text" class="form-control form-control-solid" value="{{$collection->seo_title}}" name="seo_title" placeholder="SEO Title">
                    </div>
                    <div class="col-12 mb-10">
                        <label class="form-label">SEO Description</label>
                        <textarea class="form-control form-control-solid" name="seo_description" placeholder="SEO Description">{{$collection->seo_description}}</textarea>                        
                    </div>
                    <div class="col-12 mb-10">
                        <label class="form-label">Slug</label>
                        <input type="text" class="form-control form-control-solid" value="{{$collection->slug}}" id="slug" name="slug" placeholder="Slug" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <a href="{{url('backend/collection')}}" type="button" class="btn btn-light">Close</a>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </form>
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
            ordering:false,
        });
        // #myInput is a <input type="text"> element
        $('#search_input').on( 'keyup', function () {
            table.search( this.value ).draw();
        } );
        ClassicEditor.create(document.querySelector('#kt_docs_ckeditor_classic')).then(editor => {
            console.log(editor);
        }).catch(error => {
            console.error(error);
        });


        function show_image(image){
            $("#show_image").attr("src",hostUrl+image);
            $("#download_button").attr("href",hostUrl+image);
        }
        function remove_image(id){
            $('#'+id).remove();
        }
        function change_type(){
            var type = $('#package_type').val();
            if(type == "Domestic"){
                $('.type_box').removeClass('d-none');
            }else{
                $('.type_box').removeClass('d-none');
                $('.type_box').addClass('d-none');
            }
        }
        function add_slug(){
            title = $('#title').val().split(' ').join("-").toLowerCase();
            $('#slug').val(title);
        }
    </script>
@endsection


