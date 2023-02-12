<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StripeController extends Controller
{
    public function StripeOrder(Request $request){
        \Stripe\Stripe::setApiKey('sk_test_51MafZCE8hOMOO1b5aFtT7mtDZYx3J21DNalcjmUlzMyoGYER0gI39zzGbT8iaSCdhMcw3VJFEoGiWxc2FjEkEnhz00SGk8k3H2');
    $token = $_POST['stripeToken'];

    $charge = \Stripe\Charge::create([
    'amount' => 999*100,
    'currency' => 'usd',
    'description' => 'Multi Vendors Shop',
    'source' => $token,
    'metadata' => ['order_id' => '6735'],
    ]);
    dd($charge);
    } // end method
}
