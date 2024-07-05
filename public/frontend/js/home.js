
// document.addEventListener( 'DOMContentLoaded', function () {
//     var splide = new Splide( '#thumbnail-slider', {
//             gap         : 10,
//             rewind      : true,
//             focus       : 'center',
//             pagination  : false,
//     });
//     var thumbnails = document.getElementsByClassName( 'thumbnail' );
//     var current;

//     for ( var i = 0; i < thumbnails.length; i++ ) {
//         initThumbnail( thumbnails[ i ], i );
//     }

//     function initThumbnail( thumbnail, index ) {
//         thumbnail.addEventListener( 'click', function () {
//             splide.go( index );
//         } );
//     }

//     splide.on( 'mounted move', function () {
//         var thumbnail = thumbnails[ splide.index ];

//         if ( thumbnail ) {
//             if ( current ) {
//                 current.classList.remove( 'is-active' );
//             }

//             thumbnail.classList.add( 'is-active' );
//             current = thumbnail;
//         }
//     } );

//     splide.mount();
// });

function splide_fun(){
    var splide = new Splide( '#thumbnail-slider', {
        gap         : 10,
        rewind      : true,
        focus       : 'center',
        pagination  : false,
    });
    var thumbnails = document.getElementsByClassName( 'thumbnail' );
    var current;

    for ( var i = 0; i < thumbnails.length; i++ ) {
        initThumbnail( thumbnails[ i ], i );
    }

    function initThumbnail( thumbnail, index ) {
        thumbnail.addEventListener( 'click', function () {
            splide.go( index );
        } );
    }

    splide.on( 'mounted move', function () {
        var thumbnail = thumbnails[ splide.index ];

        if ( thumbnail ) {
            if ( current ) {
                current.classList.remove( 'is-active' );
            }

            thumbnail.classList.add( 'is-active' );
            current = thumbnail;
        }
    });

    splide.mount();
}
function background_color(){
    val = $('#navbar-background-input').val();
    if(val == 0){
        $('#navbar-background-input').val('1');
        $('.navbar > div').attr("style","background: white");
        $('.hamburger span').attr("style","background-color: black !important;");
        $('.logo-box-phone').attr("style","transition-duration: 200ms; color: black !important;");
        // $('.rlogo-brand').attr("style","transition-duration: 200ms; filter: brightness(0.1);");
        $('.phone-menu-top svg').attr("style","color: black;");
    }else{
        $('#navbar-background-input').val('0');
        $('.navbar > div').attr("style","background: linear-gradient(to bottom, rgba(0, 0, 0, 0.7) 0%, rgb(0 0 0 / 35%) 53%, rgba(0, 0, 0, 0) 100%);");
        $('.hamburger span').attr("style","background-color: white !important;");
        $('.logo-box-phone').attr("style","transition-duration: 200ms; color: white !important;");
        // $('.rlogo-brand').attr("style","transition-duration: 200ms; filter: brightness(1);");
        $('.phone-menu-top svg').attr("style","color: white;");
    }
}
function addtocart(){
    variation = null;
    variation_title = null;
    id = $('#modal_productId').val();
    title = $('#product-model-title').text();
    quantity = $('#quantity_input').val();
    price = $('#modal_price_input').val();
    image = $('#modal_productImage').val();

    $(".variation-item").each(function () {
        if($(this).hasClass("selected")){
            variation = $(this).text();
            return false;
        }
    });

    variation_title = $('#variation-title-'+variation).val();
    
    // Get Data
    $.ajax({
        url: PR_URL+"/addToCart",
        type: "POST",
        data:{ 
            id: id,
            title: title,
            quantity: quantity,
            price: price,
            variation: [variation_title, variation],
            image: image
        },
        success: function(response){
            Swal.fire({
                icon: "success",
                title: "Item Added to Cart",
                showConfirmButton: false,
                timer: 3000,
                showCloseButton: true,
                footer: '<a href="'+PR_URL+'/cart" class="btn-3">GO TO CART</a>'
            });
        }
    });
}
function addtocart_view(){
    // alert();
    variation = null;
    variation_title = null;
    id = $('#view_modal_productId').val();
    title = $('#view_product-model-title').text();
    quantity = $('#view_quantity_input').val();
    price = $('#view_modal_price_input').val();
    image = $('#view_modal_productImage').val();

    $(".view_variation-item").each(function () {
        if($(this).hasClass("selected")){
            variation = $(this).text();
            return false;
        }
    });

    variation_title = $('#view_variation-title-'+variation).val();
    
    // Get Data
    $.ajax({
        url: PR_URL+"/addToCart",
        type: "POST",
        data:{ 
            id: id,
            title: title,
            quantity: quantity,
            price: price,
            variation: [variation_title, variation],
            image: image
        },
        success: function(response){
            Swal.fire({
                icon: "success",
                title: "Item Added to Cart",
                showConfirmButton: false,
                timer: 3000,
                showCloseButton: true,
                footer: '<a href="'+PR_URL+'/cart" class="btn-3">GO TO CART</a>'
            });
        }
    });
}
function quick_shop(product){
    // console.log(product);
    $('#modal_productId').val(product['id']);
    $('#modal_productImage').val(product['images'][0]);
    $('#product-model-title').text(product['title']);
    $('#modal_sub_price').text(addCommas(product['compare_price'])+'.00');
    $('#modal_price').text(addCommas(product['price'])+'.00');
    $('#modal_price_input').val(product['price']);
    $('#save_price').text(addCommas(parseInt(product['compare_price']) - parseInt(product['price']))+'.00');

    
    $('.variation-box').remove();
    html = '';
    for (i = 0; i < product['variations'].length; ++i) {
        if(i == 0){
            html += '<input type="hidden" id="variation-title-'+product['variations'][i]['value']+'" class="variation-item-title" value="'+product['variations'][i]['title']+'">'+
            '<div class="variation-item selected">'+product['variations'][i]['value']+'</div>';         
        }else{
            html += '<input type="hidden" id="variation-title-'+product['variations'][i]['value']+'" class="variation-item-title" value="'+product['variations'][i]['title']+'">'+
            '<div class="variation-item">'+product['variations'][i]['value']+'</div>';         
        }
    }
    html = '<div class="variation-box mb-3">'+
                '<div class="variation-list">'+
                    html+
                '</div>'+
            '</div>';

    $('#quickshop_model .product-box .price-box').after(html);


}
function quick_view(product){
    // console.log(product);
    $('#view_modal_productId').val(product['id']);
    $('#view_modal_productImage').val(product['images'][0]);
    $('#view_product-model-title').text(product['title']);
    $('#view_modal_sub_price').text(addCommas(product['compare_price'])+'.00');
    $('#view_modal_price').text(addCommas(product['price'])+'.00');
    $('#view_modal_price_input').val(product['price']);
    $('#view_save_price').text(addCommas(parseInt(product['compare_price']) - parseInt(product['price']))+'.00');


    $('.splide__slide').remove();
    html = '';
    for(i = 0; i < product['images'].length; ++i){    
        html += '<li class="splide__slide">'+
                    '<img src="'+PR_URL+'/'+product['images'][i]+'">'+
                '</li>';
    }
    $('#splide__list_id').append(html);
    splide_fun();

    $('.view_variation-box').remove();
    html = '';
    for (i = 0; i < product['variations'].length; ++i) {
        if(i == 0){
            html += '<input type="hidden" id="view_variation-title-'+product['variations'][i]['value']+'" class="variation-item-title" value="'+product['variations'][i]['title']+'">'+
            '<div class="view_variation-item variation-item-style selected">'+product['variations'][i]['value']+'</div>';         
        }else{
            html += '<input type="hidden" id="view_variation-title-'+product['variations'][i]['value']+'" class="variation-item-title" value="'+product['variations'][i]['title']+'">'+
            '<div class="view_variation-item variation-item-style">'+product['variations'][i]['value']+'</div>';         
        }
    }

    html = '<div class="view_variation-box variation-box-style mb-3">'+
                '<div class="variation-list">'+
                    html+
                '</div>'+
            '</div>';

    $('#quickview_model .product-box .price-box').after(html);


}
function buynow() {
    $(".modal-backdrop").last().css("z-index",1060);

    variation = null;
    variation_title = null;

    $(".view_variation-item").each(function () {
        if($(this).hasClass("selected")){
            variation = $(this).text();
            return false;
        }
    });

    variation_title = $('#view_variation-title-'+variation).val();


    product_id = $('#view_modal_productId').val();
    quantity = $('#view_quantity_input').val();
    title = $('#view_product-model-title').text();
    price = $('#view_modal_price_input').val();
    image = $('#view_modal_productImage').val();
    total = quantity * price;

    $('#buynow_modal #product').val(product_id+'-'+variation_title+'-'+variation+'-'+quantity+'-'+price+'-'+total);
    $('#buynow_modal #product_id').val(product_id);
    $('#buynow_modal #product_price').val(price);
    $('#buynow_modal #product_image').attr('src',image);
    $('#buynow_modal .product-name').text(title);
    $('#buynow_modal #product_variation_title').val(variation_title);
    $('#buynow_modal #product_variation_value').val(variation);
    $('#buynow_modal #product_quantity').val(quantity);
    $('#buynow_modal #product_sub_total').val(total);
    $('#buynow_modal #total').val(total);
    $('#buynow_modal #total_show').text('Rs'+addCommas(total)+'.00');
    $('#buynow_modal #submit-button-buynow').text('BUY IT NOW - '+'Rs.'+addCommas(total)+'.00');
    $('#buynow_modal #price_and_quantity').text('Rs.'+addCommas(price)+'.00 x '+quantity);
    html = '';
    html = variation_title+": <strong>"+variation+"</strong>";
    $('#buynow_modal #product-variation').html(html);

    // del_url = "{{url('remove_from_cart')}}"+'/'+product_id+'/'+variation+'/open';
    // $('cart-box-delete').attr('href',del_url);

    
}
function quick_buynow() {
    $(".modal-backdrop").last().css("z-index",1060);

    variation = null;
    variation_title = null;

    $(".variation-item").each(function () {
        if($(this).hasClass("selected")){
            variation = $(this).text();
            return false;
        }
    });

    variation_title = $('#variation-title-'+variation).val();


    product_id = $('#modal_productId').val();
    quantity = $('#quantity_input').val();
    title = $('#product-model-title').text();
    price = $('#modal_price_input').val();
    image = $('#modal_productImage').val();
    total = quantity * price;

    $('#quick_buynow_modal #product').val(product_id+'-'+variation_title+'-'+variation+'-'+quantity+'-'+price+'-'+total);
    $('#quick_buynow_modal #product_id').val(product_id);
    $('#quick_buynow_modal #product_price').val(price);
    $('#quick_buynow_modal #product_image').attr('src',image);
    $('#quick_buynow_modal .product-name').text(title);
    $('#quick_buynow_modal #product_variation_title').val(variation_title);
    $('#quick_buynow_modal #product_variation_value').val(variation);
    $('#quick_buynow_modal #product_quantity').val(quantity);
    $('#quick_buynow_modal #product_sub_total').val(total);
    $('#quick_buynow_modal #total').val(total);
    $('#quick_buynow_modal #total_show').text('Rs'+addCommas(total)+'.00');
    $('#quick_buynow_modal #submit-button-quick-buynow').text('BUY IT NOW - '+'Rs.'+addCommas(total)+'.00');
    $('#quick_buynow_modal #price_and_quantity').text('Rs.'+addCommas(price)+'.00 x '+quantity);
    html = '';
    html = variation_title+": <strong>"+variation+"</strong>";
    $('#quick_buynow_modal #product-variation').html(html);

    // del_url = "{{url('remove_from_cart')}}"+'/'+product_id+'/'+variation+'/open';
    // $('cart-box-delete').attr('href',del_url);

    
}
$(document).ready(function() {

    $(document).on('click', '.view_variation-item', function(){
        if($('.view_variation-item').hasClass('selected')){
            $(".view_variation-item").removeClass("selected");
        }
        $(this).addClass("selected");   
    });

    $(document).on('click', '.is-minus', function(){
        val = parseInt($('#view_quantity_input').val()) - 1;
        if(val > 0){
            $('#view_quantity_input').val(parseInt(val));
        }
    });

    $(document).on('click', '.is-plus', function(){
        val = parseInt($('#view_quantity_input').val()) + 1;
        $('#view_quantity_input').val(parseInt(val));
    });

    $('#city-select').select2({
        dropdownParent: $('#buynow_modal .modal-body')
    });

    $('#city-select-2').select2({
        dropdownParent: $('#quick_buynow_modal .modal-body')
    });

    $(document).on('click', '.variation-item', function(){
        if($('.variation-item').hasClass('selected')){
            $(".variation-item").removeClass("selected");
        }
        $(this).addClass("selected");   
    });

});