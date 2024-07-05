<style>
    @font-face {
        font-family: ArterioNonCommercial;
        src: url('frontend/fonts/ArterioNonCommercial.otf');
    }
    @font-face {
        font-family: Poppins;
        src: url('frontend/fonts/Poppins-Regular.ttf');
    }
    @font-face {
        font-family: ABChanel Corpo Regular;
        src: url('frontend/fonts/ABChanel Corpo Regular.ttf');
    }
    table * {
        font-family: Poppins;
        font-size: 13px;
    }
    .kafsh {
        font-size: 34px !important;
        font-family: 'ArterioNonCommercial' !important;
        letter-spacing: 16px !important;
        text-align: center;
        margin:0px;
    }
    .thank-text {
        font-size: 19px;
        text-align: center;
        margin: 11px 0px;
    }
    .text-center {
        text-align:center;
    }
</style>
<table style="width:100%;border-collapse:initial;border-spacing:0;max-width:470px;text-align:left;border-radius:8px;margin:32px auto 0;padding:0 20px;border:1px solid #c9cccf" cellpadding="0" cellspacing="0">
<tbody><tr style="margin-top:0;margin-bottom:0;padding:0">
<td style="margin-top:0;margin-bottom:0;padding:0;border-width:0">
<table style="width:100%;border-collapse:initial!important;border-spacing:0;margin-top:0;margin-bottom:0;padding:20px 4px" cellpadding="0" cellspacing="0">
<tbody><tr style="margin-top:0;margin-bottom:0;padding:0">
<td style="margin-top:0;margin-bottom:0;padding:0;border-width:0">
<center>
<table style="width:100%;border-collapse:collapse;border-spacing:0;margin-top:0;margin-bottom:0;padding:0" cellpadding="0" cellspacing="0">
<tbody><tr style="margin-top:0;margin-bottom:0;padding:0">
<td style="margin-top:0;margin-bottom:0;padding:0;border-width:0">
<table style="width:100%;border-collapse:collapse;border-spacing:0;margin-top:0;margin-bottom:0;padding:0" cellpadding="0" cellspacing="0">
<tbody><tr style="margin-top:0;margin-bottom:0;padding:0">
<td style="margin-top:0;margin-bottom:0;padding:0;border-width:0">
    @if(isset($customer))
        <p class="m-0 kafsh">KAFSH</p>
        <p class="thank-text">Thank you for your purchase!</p>
    @else
        {{$request->name}} placed order #{{$request->order->order_no}} on {{date('M d',strtotime($request->order->created_at))}} at {{date('g:i A',strtotime($request->order->created_at))}}.
    @endif
    @if(isset($customer))
        <div class="text-center">
            <a href="{{url('account')}}" style="margin-right:5px;margin-top:0;margin-bottom:0;color:white;text-decoration:none;font-size:14px;font-weight:400;line-height:1.41;text-transform:initial;letter-spacing:initial;display:inline-block;background-color:#008060;border-radius:4px;padding:0;border-color:#008060;border-style:solid;border-width:8px 16px" target="_blank">View order</a>
        </div>
    @endif
</td>
</tr>
</tbody></table>
</td>
</tr>
</tbody></table>
</center>
</td>
</tr>
</tbody></table>
<table style="width:100%;border-collapse:initial!important;border-spacing:0;margin-top:0;margin-bottom:0;border-top-width:1px;border-top-color:#c9cccf;border-top-style:solid;padding:20px 4px" cellpadding="0" cellspacing="0">
<tbody><tr style="margin-top:0;margin-bottom:0;padding:0">
<td style="margin-top:0;margin-bottom:0;padding:0;border-width:0">
<center>
<table style="width:100%;border-collapse:collapse;border-spacing:0;margin-top:0;margin-bottom:0;padding:0" cellpadding="0" cellspacing="0">
<tbody><tr style="margin-top:0;margin-bottom:0;padding:0">
<td style="margin-top:0;margin-bottom:0;padding:0;border-width:0">
<strong style="color:#202223;font-weight:600;font-size:16px">Order summary</strong>
<br>
<br>
<table style="width:100%;border-collapse:collapse;border-spacing:0;margin-top:0;margin-bottom:0;padding:0" cellpadding="0" cellspacing="0">
<tbody><tr style="margin-top:0;margin-bottom:0;width:100%;padding:0">
<td style="margin-top:0;margin-bottom:0;padding:0;border-width:0">
<table style="width:100%;border-collapse:collapse;border-spacing:0;margin-top:0;margin-bottom:0;padding:0" cellpadding="0" cellspacing="0">
    <tbody>
        @php $total = 0; @endphp
        @foreach ($request->product_id as $key => $product_id)
            @php $product_data = get_product_data($product_id); $total += ($product_data->price * $request->product_quantity[$key]); @endphp
            <tr>
                <td style="margin-top:10px;margin-bottom:0;padding:0;border-width:0">
                    <img src="{{url($product_data->images[0])}}" align="left" width="60" height="60" style="height:50px;line-height:0;outline:none;text-decoration:none;vertical-align:top;width:50px;margin-right:16px;border-radius:4px;border:1px solid #c9cccf">
                </td>
                <td style="margin-top:0;margin-bottom:0;width:100%;padding:0;border-width:0">
                    <span style="font-size:13px;line-height:1.42;color:#202223">{{$product_data->title}}</span><br>
                    <span>Rs.{{number_format($product_data->price, 2)}} × {{$request->product_quantity[$key]}} </span><br>
                </td>
                <td style="margin-top:0;margin-bottom:0;white-space:nowrap;padding:0;border-width:0">
                    <p style="color:#202223;line-height:20px;font-weight:400;margin:0 0 0 16px;padding:0" align="right">
                    {{number_format($product_data->price * $request->product_quantity[$key], 2)}}
                    </p>
                </td>
            </tr>
            <tr>
                <td><br></td>
                <td><br></td>
                <td><br></td>
            </tr>
        @endforeach
    </tbody>
</table>
</td>
</tr>
</tbody></table>
<table style="width:100%;border-collapse:collapse;border-spacing:0;margin-top:0;margin-bottom:0;padding:0" cellpadding="0" cellspacing="0">
<tbody><tr style="margin-top:0;margin-bottom:0;padding:0">
<td style="margin-top:0;margin-bottom:0;padding:0;border-width:0">
<table style="width:100%;border-collapse:collapse;border-spacing:0;margin-top:0;margin-bottom:0;padding:0" cellpadding="0" cellspacing="0">
<tbody>
    {{-- <tr style="margin-top:0;margin-bottom:0;padding:0">
<td style="margin-top:0;margin-bottom:0;padding:2px 0;border-width:0">
<p style="color:#202223;line-height:1.42em;margin:0;padding:0">
<span>Subtotal</span>
</p>
</td>
<td style="margin-top:0;margin-bottom:0;padding:2px 0;border-width:0" align="right">
Rs.1,799.00
</td>
</tr>
<tr style="margin-top:0;margin-bottom:0;padding:0">
<td style="margin-top:0;margin-bottom:0;padding:2px 0;border-width:0">
<p style="color:#202223;line-height:1.42em;margin:0;padding:0">
<span>Shipping</span>
<span>
<span style="line-height:1.42em;color:#6d7175">(Shipping)</span>
</span>
</p>
</td>
<td style="margin-top:0;margin-bottom:0;padding:2px 0;border-width:0" align="right">
Rs.0.00
</td>
</tr> --}}
</tbody></table>
<table style="width:100%;border-collapse:collapse;border-spacing:0;margin-top:0;margin-bottom:0;padding:0" cellpadding="0" cellspacing="0">
<tbody><tr style="margin-top:0;margin-bottom:0;padding:0">
<td style="margin-top:0;margin-bottom:0;font-weight:bold;padding:20px 0 0;border-width:0">
<p style="color:#202223;line-height:1.42em;margin:0;padding:0">
<span>Total</span>
</p>
</td>
<td style="margin-top:0;margin-bottom:0;font-weight:bold;padding:20px 0 0;border-width:0" align="right">
Rs.{{number_format($total, 2)}} PKR
</td>
</tr>
</tbody></table>
</td>
</tr>
</tbody></table>
</td>
</tr>
</tbody></table>
</center>
</td>
</tr>
</tbody></table>
<table style="width:100%;border-collapse:initial!important;border-spacing:0;margin-top:0;margin-bottom:0;border-top-width:1px;border-top-color:#c9cccf;border-top-style:solid;padding:20px 4px" cellpadding="0" cellspacing="0">
<tbody><tr style="margin-top:0;margin-bottom:0;padding:0">
<td style="margin-top:0;margin-bottom:0;padding:0;border-width:0">
<center>
<table style="width:100%;border-collapse:collapse;border-spacing:0;margin-top:0;margin-bottom:0;padding:0" cellpadding="0" cellspacing="0">
<tbody><tr style="margin-top:0;margin-bottom:0;padding:0">
<td style="margin-top:0;margin-bottom:0;padding:0;border-width:0">
<table style="width:100%;border-collapse:collapse;border-spacing:0;margin-top:0;margin-bottom:0;padding:0" cellpadding="0" cellspacing="0">
<tbody><tr style="margin-top:0;margin-bottom:0;padding:0">
<td style="margin-top:0;margin-bottom:0;width:50%;padding:0;border-width:0">
<strong style="color:#202223">Payment processing method</strong>
<br>
<p style="color:#202223;line-height:20px;margin:0;padding:0">Cash on Delivery (COD)</p>
</td>
</tr>
</tbody></table>
<br>
<table style="width:100%;border-collapse:collapse;border-spacing:0;margin-top:0;margin-bottom:0;padding:0" cellpadding="0" cellspacing="0">
<tbody><tr style="margin-top:0;margin-bottom:0;padding:0">
<td style="margin-top:0;margin-bottom:0;width:50%;padding:0;border-width:0">
<strong style="color:#202223">Delivery method</strong>
<br>
<p style="color:#202223;line-height:20px;margin:0;padding:0">Shipping</p>
</td>
</tr>
</tbody></table>
<br>
<table style="width:100%;border-collapse:collapse;border-spacing:0;margin-top:0;margin-bottom:0;padding:0" cellpadding="0" cellspacing="0">
<tbody><tr style="margin-top:0;margin-bottom:0;padding:0">
<td style="margin-top:0;margin-bottom:0;width:50%;padding:0;border-width:0">
<strong style="color:#202223">Shipping address</strong>
<br>
<p style="color:#202223;line-height:20px;margin:0;padding:0">
{{$request->name}}<br>
{{$request->address}}<br>
{{$request->city}}<br>
{{$request->phone}}<br>
</p>
</td>
</tr>
</tbody></table>
</td>
</tr>
</tbody></table>
</center>
</td>
</tr>
</tbody></table>
</td>
</tr>
</tbody></table>
{{-- {{dd($request->all())}} --}}