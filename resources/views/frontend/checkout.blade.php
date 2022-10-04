@extends('frontend.master')
@section('title')
    Check Out
@endsection
@section('checkout')
    active
@endsection
@section('content')

<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Checkout</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><span>Checkout</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<style>
    .StripeElement {
        box-sizing: border-box;
        height: 40px;
        width: 100%;
        padding: 10px 12px;
        border: 1px solid transparent;
        border-radius: 4px;
        background-color: white;
        box-shadow: 0 1px 3px 0 #e6ebf1;
        -webkit-transition: box-shadow 150ms ease;
        transition: box-shadow 150ms ease;
      }
      .StripeElement--focus {
        box-shadow: 0 1px 3px 0 #cfd7df;
      }
      .StripeElement--invalid {
        border-color: #fa755a;
      }
      .StripeElement--webkit-autofill {
        background-color: #fefde5 !important;
      }
</style>
<!-- checkout-area start -->
<div class="checkout-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-lg-8">
                <div class="checkout-form form-style">
                    <h3>Billing Details</h3>
                <form action="{{ route('payment') }}" method="post" id="payment-form">
                        @csrf
                        <div class="row">
                            <div class="col-sm-6 col-12">
                                <p>First Name *</p>
                                <input name="first_name" type="text">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Last Name *</p>
                                <input name="last_name" type="text">
                            </div>
                            <div class="col-12">
                                <p>Company Name</p>
                                <input name="company" type="text">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Email Address *</p>
                                <input name="email" type="email">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Phone No. *</p>
                                <input name="phone" type="text">
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Country *</p>
                                <select name="country_id" id="country_id">
                                    <option value>Select One</option>
                                    @foreach ($countries as $country)

                                    <option value="{{ $country->id }}">{{ $country->name }}</option>

                                    @endforeach

                                </select>
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>States *</p>
                                <select name="state_id" id="state_id">
                                    <option value>Select One</option>
                                </select>
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Town/City *</p>
                                <select name="city_id" id="city_id">
                                    <option value>Select One</option>
                                </select>
                            </div>
                            <div class="col-sm-6 col-12">
                                <p>Postcode/ZIP</p>
                                <input name="zipcode" type="text">
                            </div>
                            <div class="col-12">
                                <p>Your Address *</p>
                                <input name="address" type="text">
                            </div>
                            <div class="col-12">
                                <p>Order Notes </p>
                                <textarea name="note" placeholder="Notes about Your Order, e.g.Special Note for Delivery"></textarea>
                            </div>
                        </div>

                </div>
            </div>
            <div class="col-lg-4">
                <div class="order-area">
                    <h3>Your Order</h3>
                    <ul class="total-cost">
                        @php
                            $grand_total = 0;
                        @endphp
                        @foreach ($carts as $cart)
                        @php
                            $grand_total += $cart->product->price * $cart->quantity;
                        @endphp
                        <li>{{ $cart->product->title }}<span class="pull-right">৳ {{ $cart->product->price }}</span></li>
                        @endforeach

                        <li>Subtotal <span class="pull-right"><strong>$380.00</strong></span></li>
                        <li>Shipping <span class="pull-right">Free</span></li>
                        <li>Total<span class="pull-right">৳ {{ $grand_total }}</span></li>
                    </ul>
                    <ul class="payment-method">
                        <li>
                            <input id="bank" name="payment" value="bank" type="radio">
                            <label for="bank">Direct Bank Transfer</label>
                        </li>
                        <li>
                            <input id="paypal" name="payment" value="paypal" type="radio">
                            <label for="paypal">Paypal</label>
                        </li>
                        <li>
                            <input id="card" name="payment" value="card" type="radio">
                            <label for="card">Credit Card</label>
                        </li>
                        <div class="form-row">
                            <label for="card-element">
                              Credit or debit card
                            </label>
                            <div id="card-element">
                              <!-- A Stripe Element will be inserted here. -->
                            </div>

                            <!-- Used to display form errors. -->
                            <div id="card-errors" role="alert"></div>
                        </div>
                        <li>
                            <input id="delivery" name="payment" value="cash" type="radio">
                            <label for="delivery">Cash on Delivery</label>
                        </li>
                    </ul>
                    <button type="submit">Place Order</button>
                </div>
            </form>
            </div>
        </div>
    </div>
</div>
<!-- checkout-area end -->
@endsection
<script src="//js.stripe.com/v3/"></script>
@section('footer_js')
<script type="text/javascript">
    $('#country_id').change(function(){
    var countryID = $(this).val();
    if(countryID){
        $.ajax({
           type:"GET",
           url:"{{url('api/get-state-list')}}/"+countryID,
           success:function(res){
            if(res){
                $("#state_id").empty();
                $("#state_id").append('<option>Select State</option>');
                $.each(res,function(key,value){
                    $("#state_id").append('<option value="'+value.id+'">'+value.name+'</option>');
                });

            }else{
               $("#state_id").empty();
            }
           }
        });
    }else{
        $("#state_id").empty();
        $("#city_id").empty();
    }
   });
    $('#state_id').on('change',function(){
    var stateID = $(this).val();
    if(stateID){
        $.ajax({
           type:"GET",
           url:"{{url('api/get-city-list')}}/"+stateID,
           success:function(res){
            if(res){
                $("#city_id").empty();
                $("#city_id").append('<option>Select City</option>');
                $.each(res,function(key,value){
                    $("#city_id").append('<option value="'+value.id+'">'+value.name+'</option>');
                });

            }else{
               $("#city_id").empty();
            }
           }
        });
    }else{
        $("#city_id").empty();
    }

   });

    // Create a Stripe js Code for client.
    var stripe = Stripe('pk_test_51I4KXaCZQ7a10wV0Q6Z00N0eLmxNbS5pdDPq2Tf4Q4r0rPrdyOpaprbwHzX1bScCGJMidWx3j9ngU5ubf67DC6xS00RKk8uKOv');

    // Create an instance of Elements.
    var elements = stripe.elements();

    // Custom styling can be passed to options when creating an Element.
    // (Note that this demo uses a wider set of styles than the guide below.)
    var style = {
    base: {
        color: '#32325d',
        fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
        fontSmoothing: 'antialiased',
        fontSize: '16px',
        '::placeholder': {
        color: '#aab7c4'
        }
    },
    invalid: {
        color: '#fa755a',
        iconColor: '#fa755a'
    }
    };

    // Create an instance of the card Element.
    var card = elements.create('card', {style: style});

    // Add an instance of the card Element into the `card-element` <div>.
    card.mount('#card-element');

    // Handle real-time validation errors from the card Element.
    card.on('change', function(event) {
    var displayError = document.getElementById('card-errors');
    if (event.error) {
        displayError.textContent = event.error.message;
    } else {
        displayError.textContent = '';
    }
    });

    // Handle form submission.
    var form = document.getElementById('payment-form');
    form.addEventListener('submit', function(event) {
    event.preventDefault();

    stripe.createToken(card).then(function(result) {
        if (result.error) {
        // Inform the user if there was an error.
        var errorElement = document.getElementById('card-errors');
        errorElement.textContent = result.error.message;
        } else {
        // Send the token to your server.
        stripeTokenHandler(result.token);
        }
    });
    });

    // Submit the form with the token ID.
    function stripeTokenHandler(token) {
    // Insert the token ID into the form so it gets submitted to the server
    var form = document.getElementById('payment-form');
    var hiddenInput = document.createElement('input');
    hiddenInput.setAttribute('type', 'hidden');
    hiddenInput.setAttribute('name', 'stripeToken');
    hiddenInput.setAttribute('value', token.id);
    form.appendChild(hiddenInput);

    // Submit the form
    form.submit();
    }
</script>
@endsection
