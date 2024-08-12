@extends('backend.app')


@section('header')
    <!--begin::Page title-->
    <div data-kt-swapper="true" data-kt-swapper-mode="prepend" data-kt-swapper-parent="{default: '#kt_content_container', 'lg': '#kt_toolbar_container'}" class="page-title d-flex align-items-center flex-wrap me-3 mb-5 mb-lg-0">
        <!--begin::Title-->
        <h1 class="d-flex align-items-center text-dark fw-bolder fs-3 my-1">Orders</h1>
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
        {{-- <a href="#" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-toggle="modal" data-bs-target="#model_new_record">Add Product</a> --}}
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
            <div class="col-12 d-flex justify-content-between m-2 mb-0 align-items-center">
                <input type="text" class="form-control p-2" style="max-width: 200px;" placeholder="Search" id="search_input">
                <div class="d-none d-flex flex-row" id="fulfillment-buttons">
                    <button class="tag-button-1 me-2" id="fulfilled-button" onclick="fullfillment_item('Fulfilled')">Mark as fulfilled</button>
                    <button class="tag-button-1 me-2" style="background:#ffd8d8;" id="unfulfilled-button" onclick="fullfillment_item('Unfulfilled')">Mark as Unfulfilled</button>
                    <button class="tag-button-1 me-2" style="background:#ff8787;"id="cancel-button" onclick="fullfillment_item('Cancelled')">Mark as cancelled</button>
                    {{-- <div class="dropdown">
                        <button onclick="dropdown_fun('dropdown_1')" class="dropdow-btn tag-button-1">...</button>
                        <div id="dropdown_1" class="dropdown-content" style="right: 0;">
                            <a href="#home">Home</a>
                            <a href="#about">About</a>
                            <a href="#contact">Contact</a>
                        </div>
                    </div> --}}
                </div>
            </div>
            {{-- <div class="col-3 d-flex justify-content-end">
            </div> --}}
        </div>
        <div class="card-body p-5 pt-0">
            <table id="kt_datatable_example_5" class="table table-row-bordered gy-5 data_table">
                <thead>
                    <tr class="fw-bold fs-6 text-muted">
                        <th>Title</th>
                        <th>Date</th>
                        <th>Customer</th>
                        <th>Status</th>
                        <th>Total</th>
                        {{-- <th>Tags</th> --}}
                    </tr>
                </thead>
                <tbody>
                    @foreach($orders as $key => $order)
                    <tr>
                        <td @if($order->status == 'Cancelled') class="text-decoration-line-through" @endif>#{{$order->order_no}}</td>
                        <td @if($order->status == 'Cancelled') class="text-decoration-line-through" @endif>{{date('d M - H:i a', strtotime($order->created_at))}}</td>
                        <td @if($order->status == 'Cancelled') class="text-decoration-line-through" @endif>{{$order->name}}</td>
                        <td> 
                            @if($order->status == 'Fulfilled') <span class="badge badge-success">Fulfilled</span> 
                            @elseif($order->status == 'Unfulfilled') <span class="badge badge-warning">Unfulfilled</span> 
                            @elseif($order->status == 'Delivered') <span class="badge badge-success">Delivered</span> 
                            @elseif($order->status == 'Cancelled') <span class="badge badge-danger">Cancelled</span> 
                            @endif
                        </td>
                        <td>
                            <div class="d-flex flex-row">
                                <span>{{number_format($order->total, 2)}} &nbsp;&nbsp;</span>
                                <div class="dropdown">
                                    <i onmouseover="dropdown_fun('dropdown_2-{{$key}}')" onmouseout="dropdown_fun_close()" class="dropdow-btn cursor-pointer m-2 bi bi-caret-down-fill"></i>
                                    <div id="dropdown_2-{{$key}}" class="dropdown-content p-3" style="bottom:0;right:0;">
                                        @foreach($order->product as $key => $products)
                                            @foreach($products as $product)
                                                @php $product_data = get_product_data($product['id']); @endphp
                                                <p class="m-0 my-1 dropdown-product-name">{{$product_data->title}} x {{$product['quantity']}}</p>
                                            @endforeach
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </td>
                        {{-- <td class="">
                            {{$order->tags}}
                        </td> --}}
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
            ordering:false,
            select: {
                style: 'multi'
            }
        });
        
        $('#kt_datatable_example_5 tbody').on('click', 'tr', function () {
            setTimeout( function(){ 
                var rows = table.rows( { selected: true } ).data();
                // console.log(rows);
                if(rows.length > 0){
                   $('#fulfillment-buttons').removeClass('d-none');
                }else{
                   $('#fulfillment-buttons').addClass('d-none'); 
                }
            }, 1);
        });

        // #myInput is a <input type="text"> element
        $('#search_input').on( 'keyup', function () {
            table.search( this.value ).draw();
        });

        ClassicEditor.create(document.querySelector('#kt_docs_ckeditor_classic')).then(editor => {
            console.log(editor);
        }).catch(error => {
            console.error(error);
        });

        function dropdown_fun(dropdown_id) {
            document.getElementById(dropdown_id).classList.toggle("show");
        }
        function dropdown_fun_close(){
            var dropdowns = document.getElementsByClassName('dropdown-content');
            var i;
            for (i = 0; i < dropdowns.length; i++) {
                var openDropdown = dropdowns[i];
                if (openDropdown.classList.contains('show')) {
                    openDropdown.classList.remove('show');
                }
            }
        }
        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
            if (!event.target.matches('.dropdow-btn')) {
                var dropdowns = document.getElementsByClassName('dropdown-content');
                var i;
                for (i = 0; i < dropdowns.length; i++) {
                    var openDropdown = dropdowns[i];
                    if (openDropdown.classList.contains('show')) {
                        openDropdown.classList.remove('show');
                    }
                }
            }
        }
        function fullfillment_item(value){
            var rows = table.rows({ selected: true }).data();
            var order_no = [];

            for(i = 0; i < rows.length; i++){
                order_no.push(rows[i][0].replace('#',''));
            }
            // Get Data
            $.ajax({
                url: PR_URL+"/backend/fullfill_orders",
                type: "POST",
                data:{ 
                    order_no: order_no,
                    value: value
                },
                success: function(response){
                    location.reload();
                }
            });
        }
        function show_image(image){
            $("#show_image").attr("src",hostUrl+image);
            $("#download_button").attr("href",hostUrl+image);
        }
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


