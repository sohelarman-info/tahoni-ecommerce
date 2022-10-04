<?php

namespace App\Http\Controllers;

use App\attribute;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderShipped;

use App\Order;
use App\Shipping;
use App\Cart;
use Auth;
use Cookie;
use Stripe;

//PayPal
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;

class PaymentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');

        /** PayPal api context **/
        // $paypal_conf = \Config::get('paypal');
        // $this->_api_context = new ApiContext(new OAuthTokenCredential(
        //     $paypal_conf['client_id'],
        //     $paypal_conf['secret'])
        // );
        // $this->_api_context->setConfig($paypal_conf['settings']);
    }
    function payment(Request $request){
        $order = Order::findOrFail(1);
        if ($request->payment == 'card') {

        Mail::to(Auth::user()->email)->send(new OrderShipped($order));
            $shipping               = new Shipping;
            $shipping->user_id      = Auth::id();
            $shipping->first_name   = $request->first_name;
            $shipping->last_name    = $request->last_name;
            $shipping->email        = $request->email;
            $shipping->phone        = $request->phone;
            $shipping->city_id      = $request->city_id;
            $shipping->company      = $request->company;
            $shipping->address      = $request->address;
            $shipping->coupon_code  = $request->coupon_code;
            $shipping->save();

            $cookie = Cookie::get('cookie_id');
            $carts  = Cart::where('cookie_id', $cookie)->get();

            foreach ($carts as $cart) {
                $order                      = new Order;
                $order->shipping_id         = $shipping->id;
                $order->product_id          = $cart->product_id;
                $order->product_unit_price  = $cart->product->price;
                $order->quantity            = $cart->quantity;
                $order->save();

                $attr = attribute::where('product_id', $cart->product_id)->where('color_id', $cart->color_id)->where('size_id', $cart->size_id);
                if ($attr->exists()) {
                    $attr->decrement('quantity', $cart->quantity);
                }
                $cart->delete();
            }

            Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
            Stripe\Charge::create ([
                "amount" => 100 * 100,
                "currency" => "usd",
                "source" => $request->stripeToken,
                "description" => "Test payment from ES WEBDEV 2001."
        ]);
                $Payment_Update = Shipping::findOrFail($shipping->id);
                $Payment_Update->payment_status = 1;
                $Payment_Update->save();
            return 'Card Payment Successfully';
        }
        elseif ($request->payment == 'paypal') {
            return 'Paypal';
        //     $payer = new Payer();
        //     $payer->setPaymentMethod('paypal');

    	//     $item_1 = new Item();

        //     $item_1->setName('Product 1')
        //     ->setCurrency('USD')
        //     ->setQuantity(1)
        //     ->setPrice(500);

        //     $item_list = new ItemList();
        //     $item_list->setItems(array($item_1));

        //     $amount = new Amount();
        //     $amount->setCurrency('USD')
        //     ->setTotal(400);

        //     $transaction = new Transaction();
        //     $transaction->setAmount($amount)
        //     ->setItemList($item_list)
        //     ->setDescription('Enter Your transaction description');

        //     $redirect_urls = new RedirectUrls();
        //     $redirect_urls->setReturnUrl(url('/status'))
        //     ->setCancelUrl(url('/status'));

        //     $payment = new Payment();
        //     $payment->setIntent('Sale')
        //     ->setPayer($payer)
        //     ->setRedirectUrls($redirect_urls)
        //     ->setTransactions(array($transaction));
        //     try {
        //     $payment->create($this->_api_context);
        //     } catch (\PayPal\Exception\PPConnectionException $ex) {
        //     if (\Config::get('app.debug')) {
        //         \Session::put('error','Connection timeout');
        //         return Redirect::route('paywithpaypal');
        //     } else {
        //         \Session::put('error','Some error occur, sorry for inconvenient');
        //         return redirect('paywithpaypal');
        //     }
        // }

        //     foreach($payment->getLinks() as $link) {
        //         if($link->getRel() == 'approval_url') {
        //             $redirect_url = $link->getHref();
        //             break;
        //         }
        //     }

        // Session::put('paypal_payment_id', $payment->getId());

        // if(isset($redirect_url)) {
        //     return Redirect::away($redirect_url);
        // }

        // \Session::put('error','Unknown error occurred');
    	// return redirect('paywithpaypal');
         }
        elseif ($request->payment == 'bank') {
            return 'Bank';
        }
        elseif ($request->payment == 'cash') {
            return 'Cash';
        }
        else {
            return 'You Have not selected payment method';
        }
    }
    public function getPaymentStatus(Request $request)
    {
        $payment_id = Session::get('paypal_payment_id');

        Session::forget('paypal_payment_id');
        if (empty($request->input('PayerID')) || empty($request->input('token'))) {
            \Session::put('error','Payment failed');
            return Redirect::route('paywithpaypal');
        }
        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId($request->input('PayerID'));
        $result = $payment->execute($execution, $this->_api_context);

        if ($result->getState() == 'approved') {
            \Session::put('success','Payment success !!');
            return Redirect::route('paywithpaypal');
        }

        \Session::put('error','Payment failed !!');
		return Redirect::route('paywithpaypal');
    }

    function OrderList(){
    return view('layouts.mail.order');
    }
}
