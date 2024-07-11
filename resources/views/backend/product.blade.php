@extends('backend.app')


@section('header')
    <!--begin::Page title-->
    <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
        <!--begin::Title-->
        <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Product</h1>
        <!--end::Title-->
    </div>
    <!--end::Page title-->
    <!--begin::Actions-->
    <div class="d-flex align-items-center py-1">
        <!--begin::Wrapper-->
        {{-- <div class="me-4">
            <!--begin::Menu-->
            <a href="#" class="btn btn-sm btn-flex btn-light btn-active-primary fw-bolder" data-kt-menu-trigger="click" data-kt-menu-placement="bottom-end">
            <!--begin::Svg Icon | path: icons/duotune/general/gen031.svg-->
            <span class="svg-icon svg-icon-5 svg-icon-gray-500 me-1">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                    <path d="M19.0759 3H4.72777C3.95892 3 3.47768 3.83148 3.86067 4.49814L8.56967 12.6949C9.17923 13.7559 9.5 14.9582 9.5 16.1819V19.5072C9.5 20.2189 10.2223 20.7028 10.8805 20.432L13.8805 19.1977C14.2553 19.0435 14.5 18.6783 14.5 18.273V13.8372C14.5 12.8089 14.8171 11.8056 15.408 10.964L19.8943 4.57465C20.3596 3.912 19.8856 3 19.0759 3Z" fill="black" />
                </svg>
            </span>
            <!--end::Svg Icon-->Filter</a>
            <!--begin::Menu 1-->
            <div class="menu menu-sub menu-sub-dropdown w-250px w-md-300px" data-kt-menu="true" id="kt_menu_61484bf44d957">
                <!--begin::Header-->
                <div class="px-7 py-5">
                    <div class="fs-5 text-dark fw-bolder">Filter Options</div>
                </div>
                <!--end::Header-->
                <!--begin::Menu separator-->
                <div class="separator border-gray-200"></div>
                <!--end::Menu separator-->
                <!--begin::Form-->
                <div class="px-7 py-5">
                    <!--begin::Input group-->
                    <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label fw-bold">Status:</label>
                        <!--end::Label-->
                        <!--begin::Input-->
                        <div>
                            <select class="form-select form-select-solid" data-kt-select2="true" data-placeholder="Select option" data-dropdown-parent="#kt_menu_61484bf44d957" data-allow-clear="true">
                                <option></option>
                                <option value="1">Approved</option>
                                <option value="2">Pending</option>
                                <option value="2">In Process</option>
                                <option value="2">Rejected</option>
                            </select>
                        </div>
                        <!--end::Input-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label fw-bold">Member Type:</label>
                        <!--end::Label-->
                        <!--begin::Options-->
                        <div class="d-flex">
                            <!--begin::Options-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid me-5">
                                <input class="form-check-input" type="checkbox" value="1" />
                                <span class="form-check-label">Author</span>
                            </label>
                            <!--end::Options-->
                            <!--begin::Options-->
                            <label class="form-check form-check-sm form-check-custom form-check-solid">
                                <input class="form-check-input" type="checkbox" value="2" checked="checked" />
                                <span class="form-check-label">Customer</span>
                            </label>
                            <!--end::Options-->
                        </div>
                        <!--end::Options-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Input group-->
                    <div class="mb-10">
                        <!--begin::Label-->
                        <label class="form-label fw-bold">Notifications:</label>
                        <!--end::Label-->
                        <!--begin::Switch-->
                        <div class="form-check form-switch form-switch-sm form-check-custom form-check-solid">
                            <input class="form-check-input" type="checkbox" value="" name="notifications" checked="checked" />
                            <label class="form-check-label">Enabled</label>
                        </div>
                        <!--end::Switch-->
                    </div>
                    <!--end::Input group-->
                    <!--begin::Actions-->
                    <div class="d-flex justify-content-end">
                        <button type="reset" class="btn btn-sm btn-light btn-active-light-primary me-2" data-kt-menu-dismiss="true">Reset</button>
                        <button type="submit" class="btn btn-sm btn-primary" data-kt-menu-dismiss="true">Apply</button>
                    </div>
                    <!--end::Actions-->
                </div>
                <!--end::Form-->
            </div>
            <!--end::Menu 1-->
            <!--end::Menu-->
        </div> --}}
        <!--end::Wrapper-->
        <!--begin::Button-->
        <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#model_new_record">Add Product</a>
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
        
        .image-input-wrapper-secondary:hover{
            background-image: url('{{asset("frontend/img/cross.png")}}');
            background-size: 78px !important;
            background-position: center;
            cursor: pointer;
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
                        <th>Title</th>
                        <th>Status</th>
                        <th>Inventory</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr>
                        <td style="padding:5px 0px !important;">
                            <img src="{{asset($product->images[0])}}" class="rounded" height="40px">
                            {{$product->title}}
                        </td>
                        <td> @if($product->status == 1) <span class="badge badge-success">Active</span> @else <span class="badge badge-warning">Draft</span> @endif </td>
                        <td>{{$product->quantity}}</td>
                        <td class="">
                            <a href="{{url('backend/product')}}/{{$product->id}}/edit" class="btn btn-sm btn-primary px-3 py-2 m-1" title="Edit"><i class="fa fa-edit p-0"></i></a>
                            {{-- <form method="POST" action="{{url('backend/product')}}/{{$product->id}}">
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
                
                <form method="POST" action="{{route('product.store')}}" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12 mb-10">
                                <label class="required form-label">Title</label>
                                <input type="text" class="form-control form-control-solid" onkeyup="add_slug()" id="title" name="title" placeholder="Title" required>
                            </div>
                            <div class="col-3 mb-10">
                                <label class="required form-label">Price</label>
                                <input type="number" class="form-control form-control-solid" id="price" name="price" placeholder="Price" required>
                            </div>
                            <div class="col-3 mb-10">
                                <label class="form-label">Compare-at price</label>
                                <input type="number" class="form-control form-control-solid" name="compare_price" placeholder="Compare-at price">
                            </div>
                            <div class="col-3 mb-10">
                                <label class="form-label">Quantity</label>
                                <input type="integer" class="form-control form-control-solid" name="quantity" placeholder="Quantity">
                            </div>
                            <div class="col-3 mb-10">
                                <label class="required mt-10 form-label">Status</label>
                                <div class="form-check">
                                    <input class="form-check-input" name="status" type="checkbox" id="ActiveCheckChecked" checked>
                                    <label class="form-check-label" for="ActiveCheckChecked">
                                        Active
                                    </label>
                                </div>
                            </div>
                            <div class="col-6 mb-10">
                                <label class="form-label">Collections</label>
                                <select name="collections[]" class="form-control form-select form-control-solid" size="3" multiple aria-label="multiple select" >
                                    <option value="">-- Select Collection --</option>
                                    @foreach($collections as $collection)
                                    <option value="{{$collection->title}}">{{$collection->title}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6 mb-10">
                                <label class="form-label">Tags <span style="font-size:0.7vw;">(Seperated with commas)</span></label>
                                <input type="text" class="form-control form-control-solid" name="tags" placeholder="Tags">
                            </div>
                            <div class="col-3 d-flex justify-content-end w-100 mb-5">
                                <button type="button" class="btn btn-primary" onclick="add_variation()">+ Add Variation</button>
                            </div>
                            <div class="variation d-none col-12 row mb-10" id="variation-1">
                                <div class="col-12 row mb-5 mt-5 variation_1" id="variation_1-1">
                                    <div class="col-3">
                                        <label class="form-label">Option name</label>
                                        <select onchange="change_title(1)" name="variation_title[]" id="variation_title-1" class="form-control form-select form-control-solid">
                                            <option value="">-- Variation --</option>
                                            <option value="Color">Color</option>
                                            <option value="Size">Size</option>
                                            <option value="Material">Material</option>
                                            <option value="Style">Style</option>
                                        </select>
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label">Value</label>
                                        <input type="text" class="form-control form-control-solid" id="variation_value-1" name="variation_value[]" placeholder="Value">
                                    </div>
                                    <div class="col-2">
                                        <label class="form-label">Quantity</label>
                                        <input type="integer" class="form-control form-control-solid" id="variation_quantity-1" name="variation_quantity[]" placeholder="Quantity">
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label">Price</label>
                                        <input type="integer" class="form-control form-control-solid" id="variation_price-1" name="variation_price[]" placeholder="Price">
                                    </div>
                                    <div class="col-1 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger btn-sm" type="button" onclick="del_variation(1,null,1)">x</button>
                                    </div>
                                </div>
                                {{-- <div class="variation_1" id="variation_1_1"></div> --}}
                                <div class="col-12" id="add_variation_1">
                                    <button type="button" class="btn btn-primary btn-sm p-1 px-2 m-3 w-100" type="button" onclick="add_c_variation(1)">+</button>
                                </div>
                            </div>
                            
                            <div class="col-12 mb-10">
                                <label class="required form-label">Images</label>
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
                                                <input type="file" name="images[]" accept="image/*" required/>
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
                                    <button class="btn btn-primary btn-sm mb-3" type="button" onclick="add_image()">+</button>                       
                                </div>
                            </div>
                            <div class="col-12 mb-10">
                                <label class="required form-label">Description</label>
                                <textarea name="description" id="kt_docs_ckeditor_classic"></textarea>                        
                            </div>

                            <div class="col-12 border rounded border-dark p-5">
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
                                    <input type="text" class="form-control form-control-solid" name="slug" id="slug" placeholder="Slug">                        
                                </div>
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
    <div class="modal fade" tabindex="-1" id="image_model">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Image</h5>

                    <!--begin::Close-->
                    <div class="btn btn-icon btn-sm btn-active-light-primary ms-2" data-bs-dismiss="modal" aria-label="Close">
                        <span class="svg-icon svg-icon-2x"></span>
                    </div>
                    <!--end::Close-->
                </div>
                <div class="modal-body">
                    <img id="show_image" alt="image" width="300">
                </div>

                <div class="modal-footer">
                    <a class="btn btn-primary" id="download_button" download>Download</a>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                </div>

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
        function show_image(image){
        $("#show_image").attr("src",hostUrl+image);
        $("#download_button").attr("href",hostUrl+image);
    }

    ClassicEditor.create(document.querySelector('#kt_docs_ckeditor_classic')).then(editor => {
        console.log(editor);
    }).catch(error => {
        console.error(error);
    });

    function add_image(){
        count = 0; html = '';
        $('.images-wrapper').each(function(){
            count = $(this).attr('id').split('-')[2];
        });

        count = parseInt(count) + 1;
        html = 
        '<div class="image-input image-input-empty images-wrapper me-3" id="img-wrapper-'+count+'" data-kt-image-input="true">'+
            '<div onclick="remove_image(\'img-wrapper-'+count+'\')" class="image-input-wrapper image-input-wrapper-secondary w-125px h-125px"></div>'+

            '<label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Change photo">'+
                '<i class="bi bi-pencil fs-6">'+
                    '<span class="path1"></span>'+
                    '<span class="path2"></span>'+
                '</i>'+

                '<input type="file" name="images[]" accept="image/*" />'+
                '<input type="hidden" name="avatar_remove[]" />'+
            '</label>'+

            '<span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="cancel" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Cancel photo">'+
                '<i class="bi bi-x-lg fs-3"></i>'+
            '</span>'+

            '<span class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="remove" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Remove photo">'+
                '<i class="bi bi-x-lg fs-3"></i>'+
            '</span>'+
        '</div>';

        $('#images-wrapper').append(html);
        KTImageInput.createInstances();
    }
    function change_title(id){
        val = $('#variation_title-'+id).val();
        $('.variation_title-'+id).each(function(){
            count = $(this).val(val);
        });
    }
    function add_variation(){
        if($('#variation-1').hasClass('d-none')){
            price = $('#price').val();
            $('#variation_price-1').val(price);
            $('#variation-1').removeClass('d-none');
        }else{

            // count = 0; html = '';
    
            // $('.variation').each(function(){
            //     count_ = $(this).attr('id').split('-')[1];
            // });
            
            // count = parseInt(count_) + 1;
            
            // html = 
            // '<div class="variation col-12 row mb-10" id="variation-'+count+'">'+
            //     '<div class="col-12 row mb-5 mt-5 variation_'+count+'" id="variation_'+count+'-1">'+
            //         '<div class="col-3">'+
            //             '<label class="form-label">Option name</label>'+
            //             '<select onchange="change_title('+count+')" name="variation_title[]" id="variation_title-'+count+'" class="form-control form-select form-control-solid">'+
            //                 '<option value="">-- Variation --</option>'+
            //                 '<option value="Color">Color</option>'+
            //                 '<option value="Size">Size</option>'+
            //                 '<option value="Material">Material</option>'+
            //                 '<option value="Style">Style</option>'+
            //             '</select>'+
            //         '</div>'+
            //         '<div class="col-3">'+
            //             '<label class="form-label">Value</label>'+
            //             '<input type="text" class="form-control form-control-solid" name="variation_value[]" placeholder="Value">'+
            //         '</div>'+
            //         '<div class="col-2">'+
            //             '<label class="form-label">Quantity</label>'+
            //             '<input type="value" class="form-control form-control-solid" name="variation_quantity[]" placeholder="Quantity">'+
            //         '</div>'+
            //         '<div class="col-3">'+
            //             //'<label class="form-label">Price</label>'+
            //             '<input type="hidden" value="0" class="form-control form-control-solid" name="variation_price[]" placeholder="Price">'+
            //         '</div>'+
            //         '<div class="col-1 d-flex align-items-end">'+
            //             '<button type="button" class="btn btn-danger btn-sm" type="button" onclick="del_variation('+count+','+null+',0)">x</button>'+
            //         '</div>'+
            //         '<div class="col-12" id="add_variation_'+count+'">'+
            //             '<button type="button" class="btn btn-primary btn-sm p-1 px-2 m-3 w-100" type="button" onclick="add_c_variation('+count+')">+</button>'+
            //         '</div>'+
            //     '</div>'+
            // '</div>';
    
            // $('div').find('#variation-'+count_).after(html);
        }
    }
    function add_c_variation(id){
        count = 0; html = '';
        title = $('#variation_title-'+id).val();

        $('.variation_'+id).each(function(){
            count = $(this).attr('id').split('-')[1];
        });

        price = $('#price').val();
        if(id == 1){
            price_part = '<label class="form-label">Price</label>'+
                        '<input type="number" value="'+price+'" class="form-control form-control-solid" name="variation_price[]" placeholder="Price">';
        }else{
            price_part = '<input type="hidden" value="0" class="form-control form-control-solid" name="variation_price[]" placeholder="Price">';
        }

        count = parseInt(count) + 1;
        html = 
        '<div class="col-12 row mb-5 mt-5 variation_'+id+'" id="variation_'+id+'-'+count+'">'+
            '<div class="col-3">'+
                '<input type="hidden" name="variation_title[]" value="'+title+'" class="variation_title-'+id+'">'+
            '</div>'+
            '<div class="col-3">'+
                '<label class="form-label">Value</label>'+
                '<input type="text" class="form-control form-control-solid" name="variation_value[]" placeholder="Value">'+
            '</div>'+
            '<div class="col-2">'+
                '<label class="form-label">Quantity</label>'+
                '<input type="number" class="form-control form-control-solid" name="variation_quantity[]" placeholder="Quantity">'+
            '</div>'+
            '<div class="col-3">'+
                price_part+
            '</div>'+
            '<div class="col-1 d-flex align-items-end">'+
                '<button type="button" class="btn btn-danger btn-sm" type="button" onclick="del_variation('+id+','+count+',0)">x</button>'+
            '</div>'+
        '</div>';

        $('#variation-'+id).find('#add_variation_'+id).before(html);
    }
    function del_variation(id, id1, id2){
        if(id2 == 0){
            if(id1 != null){
                $('#variation_'+id+'-'+id1).remove();
            }else{
                $('#variation-'+id).remove();
            }
        }else{
            i = 0;
            $('.variation_'+id).each(function(){
                if(i !== 0)
                count = $(this).remove();
                
                i++;
            });
            
            $('#variation-'+id).addClass('d-none');
            $('#variation_value-1').val('');
            $('#variation_quantity-1').val('');
            $('#variation_price-1').val('');
        }
    }
    function remove_image(id){
        $('#'+id).remove();
    }
    function add_slug(){
        title = $('#title').val().split(' ').join("-").toLowerCase();
        $('#slug').val(title);
    }
    </script>
@endsection


