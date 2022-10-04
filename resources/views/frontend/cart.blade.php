@extends('frontend.master')
@section('title')
    Add Cart
@endsection

@section('content')
<!-- .breadcumb-area start -->
<div class="breadcumb-area bg-img-4 ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="breadcumb-wrap text-center">
                    <h2>Shopping Cart</h2>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><span>Shopping Cart</span></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- .breadcumb-area end -->
<!-- cart-area start -->
<div class="cart-area ptb-100">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <form action="{{ route('CartUpdate') }}" method="POST">
                    @csrf
                    <table class="table-responsive cart-wrap">
                        <thead>
                            <tr>
                                <th class="images">Image</th>
                                <th class="product">Product</th>
                                <th class="ptice">Color</th>
                                <th class="ptice">Size</th>
                                <th class="ptice">Price</th>
                                <th class="quantity">Quantity</th>
                                <th class="total">Total</th>
                                <th class="remove">Remove</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                                $grand_total = 0;
                            @endphp
                            @foreach ($carts as $cart)
                            <tr>
                                <td class="images"><img src="images/{{  $cart->product->thumbnail }}" alt="{{ $cart->product->title }}"></td>
                                <td class="product"><a href="{{ route('SingleProduct', $cart->product->slug) }}">{{ $cart->product->title }}</a></td>
                                <td class="ptice" style="color:{{ $cart->color->color_name }}">{{ $cart->color->color_name }}</td>
                                <td class="ptice">{{ $cart->size->size_name }}</td>
                                <td class="ptice unit_price{{ $cart->id }}" data-unit{{ $cart->id }}="{{ number_format($cart->product->price, 2) }}">৳ {{ number_format($cart->product->price, 2) }}</td>
                                <input type="hidden" name="cart_id[]" value="{{ $cart->id }}">
                                <td class="quantity tuira cart-plus-minus">
                                    <input class="qty_quantity{{ $cart->id }}" type="text" name="quantity[]" value="{{ $cart->quantity }}" />
                                    <div class="dec qtybutton qtyminus{{ $cart->id }}">-</div>
                                    <div class="inc qtybutton qtyplus{{ $cart->id }}">+</div>
                                </td>
                                <td class="total total_unit{{ $cart->id }}">৳ {{ number_format($cart->product->price*$cart->quantity, 2) }}</td>
                                <td class="remove">
                                    <a href="{{ route('SingleCartDelete',$cart->product->id) }}"><i class="fa fa-times"></i></a>
                                </td>
                            </tr>
                            @php
                                $grand_total += $cart->product->price*$cart->quantity;
                            @endphp
                            @endforeach
                        </tbody>
                    </table>
                    <div class="row mt-60">
                        <div class="col-xl-4 col-lg-5 col-md-6 ">
                            <div class="cartcupon-wrap">
                                <ul class="d-flex">
                                    <li>
                                        <button>Update Cart</button>
                                    </li>
                                    <li><a href="{{ route('home') }}">Continue Shopping</a></li>
                                </ul>
                </form>
                            <form action="{{ route('Cart') }}" method="GET">
                                <h3>Cupon</h3>
                                <p>Enter Your Coupon Code if You Have One</p>
                                <div class="cupon-wrap">
                                    <input type="text" value="{{ $code ?? '' }}" name="coupon_code" placeholder="Cupon Code">
                                    <button>Apply Cupon</button>
                                </div>
                            </form>
                            </div>
                        </div>
                        <div class="col-xl-3 offset-xl-5 col-lg-4 offset-lg-3 col-md-6">
                            <div class="cart-total text-right">
                                <h3>Cart Totals</h3>
                                <ul>
                                    <li><span class="pull-left">Sub Total: </span>৳ {{ number_format($grand_total, 2) }}</li>
                                    <li><span class="pull-left">Coupon Discount: </span>৳ {{ $coupon_discount ?? 0 }}</li>
                                    <li><span class="pull-left grand_total">Total </span> ৳ {{ number_format($grand_total - $coupon_discount, 2) }}</li>
                                </ul>
                                <a href="{{ route('Checkout') }}">Proceed to Checkout</a>
                            </div>
                        </div>
                    </div>

            </div>
        </div>
    </div>
</div>
<!-- cart-area end -->
@endsection
@section('footer_js')
<script>

    $(document).ready(function(){
        @foreach ($carts as $car)
        $('.qtyminus{{ $car->id }}').click(function(){
            let qty_quantity    = $('.qty_quantity{{ $car->id }}').val();
            let unit_price      = $('.unit_price{{ $car->id }}').attr('data-unit{{ $car->id }}');
            $('.total_unit{{ $car->id }}').html(qty_quantity * unit_price);
            $minus_sub_total    = (qty_quantity * unit_price);
            let c = document.querySelectorAll(.=".tuira")
            let arr = Array.from(c)
            let sum=0;
            arr.map(item{
                sum += parseInt(item.innerHTML)
                $('hasan').html(sum);
                console.log(typeof parseInt(item.innerHTML))
            })
        })
        $('.qtyplus{{ $car->id }}').click(function(){
            let qty_quantity    = $('.qty_quantity{{ $car->id }}').val();
            let unit_price      = $('.unit_price{{ $car->id }}').attr('data-unit{{ $car->id }}');
            $plus_sub_total     = $('.total_unit{{ $car->id }}').html('৳' + 'qty_quantity * unit_price');
        })
        let grand_total         =
        @endforeach

    })

</script>
@endsection
