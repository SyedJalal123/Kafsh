@extends('backend.app')


@section('header')
    <!--begin::Page title-->
    <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
        <!--begin::Title-->
        <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Collection</h1>
        <!--end::Title-->
    </div>
    <!--end::Page title-->
    <!--begin::Actions-->
    <div class="d-flex align-items-center py-1">
        <!--begin::Button-->
        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#model_new_record">Create Collection</a>
        <!--end::Button-->
    </div>
    <!--end::Actions-->
@endsection

@section('styles')
    <link href="assets/plugins/custom/prismjs/prismjs.bundle.css" rel="stylesheet" type="text/css">
    <link href="assets/plugins/custom/datatables/datatables.bundle.css" rel="stylesheet" type="text/css">
    <!--begin::Image input placeholder-->
    <style>
        .image-input {
            background-image: url('{{asset("backend/assets/media/avatars/blank.png")}}');
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
        <!--begin::Card body-->
        <div class="row">
            <div class="col-9"></div>
            <div class="col-3">
                <input type="text" class="form-control p-2 m-2" style="max-width: 200px;" placeholder="Search" id="search_input">
            </div>
        </div>
        <div class="card-body p-5">
            <table id="kt_datatable_example_5" class="table table-row-bordered gy-5 data_table">
                <thead>
                    <tr class="fw-bold fs-6 text-muted">
                        <th></th>
                        <th>Title</th>
                        <th>Status</th>
                        <th>Products</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($collections as $collection)
                    <tr>
                        <th></th>
                        <td><strong>{{$collection->title}}</strong></td>
                        <td> @if($collection->status == 1) <span class="badge badge-success">Active</span> @else <span class="badge badge-warning">Draft</span> @endif </td>
                        <td>0</td>
                        <td class="">
                            <a href="{{url('backend/collection')}}/{{$collection->id}}/edit" class="btn btn-sm btn-primary px-3 py-2 m-1" title="Edit"><i class="fa fa-edit p-0"></i></a>
                            {{-- <form method="POST" action="{{url('backend/collection')}}/{{$collection->id}}">
                                @csrf
                                @method("DELETE")
                                <button type="submit" class="btn btn-sm btn-danger px-3 py-2 m-1" title="Delete" onclick="return confirm('Are you sure to delete this ?')" ><i class="fa fa-trash p-0"></i></a>
                            </form> --}}
                        </td>
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
    <div class="modal fade" tabindex="-1" id="model_new_record">
        <div class="modal-dialog modal-lg">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title">Add Record</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"><img width="20" src="{{asset('frontend/img/cross.png')}}"></span>
                    </div>
                    <!--end::Close-->
                </div>
                
                <form method="POST" action="{{route('collection.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-9 mb-10">
                                <label class="required form-label">Title</label>
                                <input type="text" class="form-control form-control-solid" onkeyup="add_slug()" name="title" id="title" placeholder="Title" required>

                                <label class="required mt-10 form-label">Status</label>
                                <div class="form-check ">
                                    <input class="form-check-input" name="status" type="checkbox" id="ActiveCheckChecked" checked>
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
                                <input type="text" class="form-control form-control-solid" name="seo_title" placeholder="SEO Title">
                            </div>
                            <div class="col-12 mb-10">
                                <label class="form-label">SEO Description</label>
                                <textarea class="form-control form-control-solid" name="seo_description" placeholder="SEO Description"></textarea>                        
                            </div>
                            <div class="col-12 mb-10">
                                <label class="form-label">Slug</label>
                                <input type="text" class="form-control form-control-solid" id="slug" name="slug" placeholder="Slug" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
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


