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
        strong {
            font-weight: 600;
        }
    </style>
@endsection

@section('content')
    <section class="main page-top-section">
        <h1 class="heading">Refund Policy</h1>
    </section>
    <section class="col-12 container pt-4 px-3">
        <div class="text-2 poppins-all">
            <p>We have a 7-day return policy, which means you have 7 days after receiving your item to request a return.
                <br><br>
                To be eligible for a return, your item must be in the same condition that you received it, unworn or unused, with tags, and in its original packaging. 
                You’ll also need the receipt or proof of purchase.
                <br><br>
            </p>
            <p>To initiate a return, you can email us at
                <span>&nbsp;</span>
                <a href="mailto:info@buykaro.pk" target="_new" data-mce-href="mailto:info@buykaro.pk">info@Kafsh.pk</a>
                <span>&nbsp;</span>or call us at 03140890365.
            </p>
            <p>
                <br>
                If your return is accepted, we’ll send you a return shipping label, as well as instructions on how and where to send your package. 
                Items sent back to us without first requesting a return will not be accepted.
                <br><br>
                You can always contact us for any return questions at
                <span>&nbsp;</span>
                <a href="mailto:info@buykaro.pk" data-mce-href="mailto:info@buykaro.pk">info@</a>Kafsh
                <a href="mailto:info@buykaro.pk" data-mce-href="mailto:info@buykaro.pk">.pk</a>.
            </p>
            <br>
            <p>
                <strong>Damages and issues</strong><br>
                Please inspect your order upon reception and contact us immediately if the item is defective, or damaged or if you receive the wrong item so that we can evaluate the issue and make it right.
            </p>
            <br>
            <p>
                <strong>Exceptions / non-returnable items</strong><br>
                Certain types of items cannot be returned, like perishable goods (such as food, flowers, or plants), custom products (such as special orders or personalized items), and personal care goods (such as beauty products). We also do not accept returns for hazardous materials, flammable liquids, or gases. 
                Please get in touch if you have questions or concerns about your specific item.
                <br><br>
                Unfortunately, we cannot accept returns on sale items or gift cards.
            </p>
            <br>
            <p>
                <strong>Exchanges</strong><br>
                The fastest way to ensure you get what you want is to return the item you have, and once the return is accepted, make a separate purchase for the new item.
            </p>
            <br>
            <p>
                <strong>Refunds</strong><br>
                We will notify you once we’ve received and inspected your return, and let you know if the refund was approved or not. 
                If approved, you’ll be automatically refunded on your original payment method within 7 business days. 
                Please remember it can take some time for your bank or credit card company to process and post the refund too.
                <br>
                If more than 7 business days have passed since we approved your return, please contact us at info@Kafsh.pk
            </p>
          </div>
    </section>
@endsection

@section('models')

@endsection

@section('scripts')
    <script>
        $(document).ready(function() {});
    </script>
@endsection
