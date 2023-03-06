<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\ShipState;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\OrderMail;
use App\Models\User;
use App\Notifications\OrderComplete;
use Illuminate\Support\Facades\Notification;


class StripeController extends Controller
{
    public function StripeOrder(Request $request){

        $user = User::where('role','admin')->get();

        if(Session::has('coupon')){
            $total_amount = Session::get('coupon')['total_amount'];
        }else{
            $total_amount = round(Cart::total());
        }

        \Stripe\Stripe::setApiKey('sk_test_51MafZCE8hOMOO1b5aFtT7mtDZYx3J21DNalcjmUlzMyoGYER0gI39zzGbT8iaSCdhMcw3VJFEoGiWxc2FjEkEnhz00SGk8k3H2');
    $token = $_POST['stripeToken'];

    $charge = \Stripe\Charge::create([
    'amount' => $total_amount*100,
    'currency' => 'usd',
    'description' => 'Multi Vendors Shop',
    'source' => $token,
    'metadata' => ['order_id' => uniqid()],
    ]);

    $order_id = Order::insertGetId([
        'user_id' => Auth::id(),
        'division_id' => $request->division_id,
        'district_id' => $request->district_id,
        'state_id' => $request->state_id,
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'post_code' => $request->post_code,
        'notes' => $request->notes,

        'payment_type' => $charge->payment_method,
        'payment_method' => 'Stripe',
        'transaction_id' => $charge->balance_transaction,
        'currency' => $charge->currency,
        'amount' => $total_amount,
        'order_number' => $charge->metadata->order_id,

        'invoice_no' => ''.mt_rand(10000000,99999999),
        'order_date' => Carbon::now()->format('d F Y'),
        'order_month' => Carbon::now()->format('F'),
        'order_year' => Carbon::now()->format('Y'),

        'status' => 'pending',
        'created_at' => Carbon::now()
    ]);

    // Start send email

    $invoice = Order::findOrFail($order_id);

    $data = [
        'invoice_no' => $invoice->invoice_no,
        'amount' => $total_amount,
        'name' => $invoice->name,
        'email' => $invoice->email,
    ];
    Mail::to($request->email)->send(new OrderMail($data, $order_id));

    // end send email


    $carts = Cart::content();
    foreach($carts as $cart){
        OrderItem::insert([
            'user_id' => Auth::id(),
            'order_id' => $order_id,
            'product_id' => $cart->id,
            'vendor_id' => $cart->options->vendor,
            'color' => $cart->options->color,
            'size' => $cart->options->size,
            'qty' => $cart->qty,
            'price' => $cart->price,
            'created_at' => Carbon::now()
        ]);
    } // end foreach method
        if(Session::has('coupon')){
            Session::forget('coupon');
        }
        Cart::destroy();

        $notification = array(
            'message' => 'Your order placed successfully',
            'alert-type' => 'success'
        );

        Notification::send($user, new OrderComplete($request->name));

        return redirect()->route('dashboard')->with($notification);
    } // end method

    public function CashOrder(Request $request){

        $user = User::where('role','admin')->get();

        if(Session::has('coupon')){
            $total_amount = Session::get('coupon')['total_amount'];
        }else{
            $total_amount = round(Cart::total());
        }

    $order_id = Order::insertGetId([
        'user_id' => Auth::id(),
        'division_id' => $request->division_id,
        'district_id' => $request->district_id,
        'state_id' => $request->state_id,
        'name' => $request->name,
        'email' => $request->email,
        'phone' => $request->phone,
        'address' => $request->address,
        'post_code' => $request->post_code,
        'notes' => $request->notes,

        'payment_type' => 'Cash On Delivery',
        'payment_method' => 'Cash On Delivery',

        'currency' => 'Usd',
        'amount' => $total_amount,

        'invoice_no' => ''.mt_rand(10000000,99999999),
        'order_date' => Carbon::now()->format('d F Y'),
        'order_month' => Carbon::now()->format('F'),
        'order_year' => Carbon::now()->format('Y'),
        'status' => 'pending',
        'created_at' => Carbon::now()
    ]);


    // Start send email

    $invoice = Order::findOrFail($order_id);

    $data = [
        'invoice_no' => $invoice->invoice_no,
        'amount' => $total_amount,
        'name' => $invoice->name,
        'email' => $invoice->email,
    ];
    Mail::to($request->email)->send(new OrderMail($data, $order_id));

    // end send email

    $carts = Cart::content();
    foreach($carts as $cart){
        OrderItem::insert([
            'user_id' => Auth::id(),
            'order_id' => $order_id,
            'product_id' => $cart->id,
            'vendor_id' => $cart->options->vendor,
            'color' => $cart->options->color,
            'size' => $cart->options->size,
            'qty' => $cart->qty,
            'price' => $cart->price,
            'created_at' => Carbon::now()
        ]);
    } // end foreach method
        if(Session::has('coupon')){
            Session::forget('coupon');
        }
        Cart::destroy();

        $notification = array(
            'message' => 'Your order placed successfully',
            'alert-type' => 'success'
        );

        Notification::send($user, new OrderComplete($request->name));

        return redirect()->route('dashboard')->with($notification);
    } // end method
}
