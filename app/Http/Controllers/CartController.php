<?php

namespace App\Http\Controllers;

use Cookie;
use App\Cart;
use App\Coupon;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CartController extends Controller
{
    function AddToCart(Request $request){
        $cookie = Cookie::get('cookie_id');
        if ($cookie) {
            $unique = $cookie;
        }else{
            $unique = Str::random(7).rand(1,1000);
            Cookie::queue('cookie_id', $unique, 43200);
        }
        $exists = Cart::where('cookie_id' , $unique)->where('product_id' , $request->product_id)->where('quantity' , $request->quantity)->where('color_id' , $request->color_id)->where('size_id' , $request->size_id);

        if ($exists->exists()) {
            $exists->increment('quantity' , $request->quantity);
        }else{
            $cart = new Cart;
            $cart->cookie_id    = $unique;
            $cart->product_id   = $request->product_id;
            $cart->quantity     = $request->quantity;
            $cart->color_id     = $request->color_id;
            $cart->size_id      = $request->size_id;
            $cart->save();
        }
        return redirect()->route('Cart');
    }
    function Cart(Request $request){
        $code               = $request->coupon_code;
        $coupon_discount    = 0;

        if($code == ''){
            $cookie = Cookie::get('cookie_id');
            return view('frontend.cart',[
            'carts' => Cart::where('cookie_id', $cookie)->get(),
            'coupon_discount' => $coupon_discount,
        ]);
        }else{
            $cookie = Cookie::get('cookie_id');
            if (Coupon::where('code', $code)->exists()) {
                $carts      = Cart::where('cookie_id', $cookie)->get();
                $valid_date = Coupon::where('code', $code)->first();

                if (Carbon::now()->format('y-m-d') <= $valid_date->validity) {
                    if ($valid_date->level == 'amount') {
                        $coupon_discount = $valid_date->discount;
                    }else {
                        $total = 0;
                        foreach ($carts as $cat) {
                            $total += $cat->product->price * $cat->quantity;
                        }
                        $coupon_discount = ($total / 100) * $valid_date->discount;
                    }
                }else{
                    return 'Invalid';
                }
            }else{
                return 'Code does not found';
            }

            return view('frontend.cart',[
                'carts' => Cart::where('cookie_id', $cookie)->get(),
                'coupon_discount' => $coupon_discount,
                'code' => $code,
            ]);
        }


    }
    function CartUpdate(Request $request){
        foreach($request->cart_id as $key => $data){
            $cart = Cart::findOrFail($data);
            $cart->quantity = $request->quantity[$key];
            $cart->save();
        }
        return back();
    }
    function SingleCartDelete($id){
        $cart = Cart::findOrFail($id);
        $cart->delete();
        return back();
    }

    // function CouponValue(){
    //     return 'OK';
    // }
}
