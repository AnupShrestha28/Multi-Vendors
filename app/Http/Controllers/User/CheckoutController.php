<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\ShipDivision;
use App\Models\Product;
use App\Models\ShipDistricts;
use App\Models\ShipState;
use App\Models\Coupon;
use Carbon\Carbon;
use Auth;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function DistrictGetAjax($division_id){
        $ship = ShipDistricts::where('division_id',$division_id)->orderBy('district_name','ASC')->get();
        return json_encode($ship);
    } // end method

    public function StateGetAjax($district_id){
        $ship = ShipState::where('district_id',$district_id)->orderBy('state_name','ASC')->get();
        return json_encode($ship);
    } // end method
}
