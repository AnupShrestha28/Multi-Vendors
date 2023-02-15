<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrderItem;

class UserDraftController extends Controller
{
    //
    public function counting()
    {
        $orderitem = new OrderItem;
        $ordercount = $orderitem->product_id->count()->groupby('product_id');
        dd($ordercount);
    }
}
