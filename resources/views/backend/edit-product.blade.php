@extends('backend.app')


@section('header')
    <!--begin::Page title-->
    <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
        <!--begin::Title-->
        <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Edit Product</h1>
        <!--end::Title-->
    </div>
    <!--end::Page title-->
    <!--begin::Actions-->
    <div class="d-flex align-items-center py-1">
        <!--begin::Button-->
        <a href="{{asset('backend/product')}}" class="btn btn-sm btn-primary">Products</a>
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
        <form method="POST" action="{{url('backend/product')}}/{{$product->id}}" enctype="multipart/form-data">
            @csrf
            @method("PATCH")
            <div class="modal-body">
                <div class="row">
                    <div class="col-12 mb-10">
                        <label class="required form-label">Title</label>
                        <input type="text" class="form-control form-control-solid" id="title" onkeyup="add_slug()" value="{{$product->title}}" name="title" placeholder="Title" required>
                    </div>
                    <div class="col-3 mb-10">
                        <label class="required form-label">Price</label>
                        <input type="number" class="form-control form-control-solid" id="price" value="{{$product->price}}" name="price" placeholder="Price" required>
                    </div>
                    <div class="col-3 mb-10">
                        <label class="form-label">Compare-at price</label>
                        <input type="number" class="form-control form-control-solid" value="{{$product->compare_price}}" name="compare_price" placeholder="Compare-at price">
                    </div>
                    <div class="col-3 mb-10">
                        <label class="form-label">Quantity</label>
                        <input type="integer" class="form-control form-control-solid" value="{{$product->quantity}}" name="quantity" placeholder="Quantity">
                    </div>
                    <div class="col-3 mb-10">
                        <label class="required mt-10 form-label">Status</label>
                        <div class="form-check">
                            <input class="form-check-input" name="status" type="checkbox" id="ActiveCheckChecked" @if($product->status == 1) checked @endif>
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
                                <option @foreach($product->collections as $co) @if($co == $collection->title) selected @endif @endforeach
                                 value="{{$collection->title}}">{{$collection->title}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-6 mb-10">
                        <label class="form-label">Tags <span style="font-size:0.7vw;">(Seperated with commas)</span></label>
                        <input type="text" value="{{$product->tags}}" class="form-control form-control-solid" name="tags" placeholder="Tags">
                    </div>
                    <div class="col-3 d-flex justify-content-end w-100 mb-5">
                        <button type="button" class="btn btn-primary" onclick="add_variation()">+ Add Variation</button>
                    </div>
                    <div class="variation @if(count($product->variations) == 0) d-none @endif col-12 row mb-10" id="variation-1">
                        <div class="col-12 row mb-5 mt-5 variation_1" id="variation_1-1">
                            <div class="col-3">
                                <label class="form-label">Option name</label>
                                <select onchange="change_title(1)" name="variation_title[]" id="variation_title-1" class="form-control form-select form-control-solid">
                                    <option value="">-- Variation --</option>
                                    <option @if(count($product->variations) !== 0) @if($product->variations[0]->title == "Color") selected @endif @endif value="Color">Color</option>
                                    <option @if(count($product->variations) !== 0) @if($product->variations[0]->title == "Size") selected @endif @endif value="Size">Size</option>
                                    <option @if(count($product->variations) !== 0) @if($product->variations[0]->title == "Material") selected @endif @endif value="Material">Material</option>
                                    <option @if(count($product->variations) !== 0) @if($product->variations[0]->title == "Style") selected @endif @endif value="Style">Style</option>
                                </select>
                            </div>
                            <div class="col-3">
                                <label class="form-label">Value</label>
                                <input type="text" @if(count($product->variations) !== 0) value="{{$product->variations[0]->value}}" @endif class="form-control form-control-solid" id="variation_value-1" name="variation_value[]" placeholder="Value">
                            </div>
                            <div class="col-2">
                                <label class="form-label">Quantity</label>
                                <input type="integer" @if(count($product->variations) !== 0) value="{{$product->variations[0]->quantity}}" @endif class="form-control form-control-solid" id="variation_quantity-1" name="variation_quantity[]" placeholder="Quantity">
                            </div>
                            <div class="col-3">
                                <label class="form-label">Price</label>
                                <input type="integer" @if(count($product->variations) !== 0) value="{{$product->variations[0]->price}}" @endif class="form-control form-control-solid" id="variation_price-1" name="variation_price[]" placeholder="Price">
                            </div>
                            <div class="col-1 d-flex align-items-end">
                                <button type="button" class="btn btn-danger btn-sm" type="button" onclick="del_variation(1,null,1)">x</button>
                            </div>
                        </div>
                        @foreach($product->variations as $key => $variation)
                            @if($key != 0)
                                <div class="col-12 row mb-5 mt-5 variation_1" id="variation_1-{{$key + 1}}">
                                    <div class="col-3">
                                        <label class="d-none form-label">Option name</label>
                                        <input type="hidden" name="variation_title[]" value="{{$variation->title}}" class="variation_title-1">
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label">Value</label>
                                        <input type="text" value="{{$variation->value}}" class="form-control form-control-solid" name="variation_value[]" placeholder="Value">
                                    </div>
                                    <div class="col-2">
                                        <label class="form-label">Quantity</label>
                                        <input type="integer" value="{{$variation->quantity}}" class="form-control form-control-solid" name="variation_quantity[]" placeholder="Quantity">
                                    </div>
                                    <div class="col-3">
                                        <label class="form-label">Price</label>
                                        <input type="integer" value="{{$variation->price}}" class="form-control form-control-solid" name="variation_price[]" placeholder="Price">
                                    </div>
                                    <div class="col-1 d-flex align-items-end">
                                        <button type="button" class="btn btn-danger btn-sm" type="button" onclick="del_variation(1,{{$key + 1}},0)">x</button>
                                    </div>
                                </div>
                            @endif
                        @endforeach
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
                                @foreach($product->images as $key => $image)
                                <!--begin::Image input-->
                                <div class="image-input image-input-empty images-wrapper me-3" style="background-image: url('{{asset($image)}}')" id="img-wrapper-{{$key}}" data-kt-image-input="true">
                                    <!--begin::Image preview wrapper-->
                                    <div onclick="remove_image('img-wrapper-{{$key}}')" class="image-input-wrapper image-input-wrapper-secondary w-125px h-125px"></div>
                                    <!--end::Image preview wrapper-->

                                    <!--begin::Edit button-->
                                    <label class="btn btn-icon btn-circle btn-color-muted btn-active-color-primary w-25px h-25px bg-body shadow" data-kt-image-input-action="change" data-bs-toggle="tooltip" data-bs-dismiss="click" title="Change photo">
                                        <i class="bi bi-pencil fs-6">
                                            <span class="path1"></span>
                                            <span class="path2"></span>
                                        </i>

                                        <!--begin::Inputs-->
                                        <input type="file" name="images[]" value="{{$image}}" accept="image/*"/>
                                        <input type="hidden" name="old_images[]" value="{{$image}}" accept=".png, .jpg, .jpeg"/>
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
                                @endforeach
                            </div>
                            <button class="btn btn-primary btn-sm mb-3" type="button" onclick="add_image()">+</button>                       
                        </div>
                    </div>
                    <div class="col-12 mb-10">
                        <label class="required form-label">Description</label>
                        <textarea name="description" id="kt_docs_ckeditor_classic">{{$product->description}}</textarea>                        
                    </div>

                    <div class="col-12 border rounded border-dark p-5">
                        <h2>Search engine listing</h2>
                        <div class="col-12 mb-10 mt-4">
                            <label class="form-label">SEO Title</label>
                            <input type="text" class="form-control form-control-solid" value="{{$product->seo_title}}" name="seo_title" placeholder="SEO Title">
                        </div>
                        <div class="col-12 mb-10">
                            <label class="form-label">SEO Description</label>
                            <textarea class="form-control form-control-solid" name="seo_description" placeholder="SEO Description">{{$product->seo_description}}</textarea>                        
                        </div>
                        <div class="col-12 mb-10">
                            <label class="form-label">Slug</label>
                            <input type="text" class="form-control form-control-solid" value="{{$product->slug}}" name="slug" id="slug" placeholder="Slug">                        
                        </div>
                    </div>
                </div>
            </div>

            <div class="modal-footer">
                <a href="{{url('backend/product')}}" type="button" class="btn btn-light">Close</a>
                <button type="submit" class="btn btn-primary">Update</button>
            </div>
        </form>
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


