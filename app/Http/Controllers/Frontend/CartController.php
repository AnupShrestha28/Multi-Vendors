<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use Illuminate\Http\Request;
use App\Models\Product;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\Session;
use Carbon\Carbon;

class CartController extends Controller
{
    public function AddToCart(Request $request, $id){
        $product = Product::findOrFail($id);
        if($product->discount_price == NULL){
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],
            ]);
            return response()->json(['success' => 'Successfully added on your cart']);
        }else{
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],
            ]);
            return response()->json(['success' => 'Successfully added on your cart']);
        }
    } // end method

    public function AddMiniCart(){

        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal
        ));
    } // end method

    public function RemoveMiniCart($rowId){
        Cart::remove($rowId);
        return response()->json(['success' => 'Product removed from cart']);
    } // end method

    public function AddToCartDetails(Request $request, $id){
        $product = Product::findOrFail($id);
        if($product->discount_price == NULL){
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->selling_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],
            ]);
            return response()->json(['success' => 'Successfully added on your cart']);
        }else{
            Cart::add([
                'id' => $id,
                'name' => $request->product_name,
                'qty' => $request->quantity,
                'price' => $product->discount_price,
                'weight' => 1,
                'options' => [
                    'image' => $product->product_thambnail,
                    'color' => $request->color,
                    'size' => $request->size,
                ],
            ]);
            return response()->json(['success' => 'Successfully added on your cart']);
        }
    } // end method

    public function MyCart(){
        return view('frontend.mycart.view_mycart');
    } // end method

    public function GetCartProduct(){
        $carts = Cart::content();
        $cartQty = Cart::count();
        $cartTotal = Cart::total();

        return response()->json(array(
            'carts' => $carts,
            'cartQty' => $cartQty,
            'cartTotal' => $cartTotal
        ));
    } // end method

    public function CartRemove($rowId){
        Cart::remove($rowId);

        return response()->json(['success' => 'Successfully removed from cart']);
    } // end method

    public function CartDecrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty - 1);

        if(Session::has('coupon')){
            $coupon_name = Session::get('coupon')['coupon_name'];

            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100),
            ]);

        }

        return response()->json('Decrement');
    } // end method

    public function CartIncrement($rowId){
        $row = Cart::get($rowId);
        Cart::update($rowId, $row->qty + 1);

        if(Session::has('coupon')){
            $coupon_name = Session::get('coupon')['coupon_name'];

            $coupon = Coupon::where('coupon_name',$coupon_name)->first();

            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100),
            ]);

        }

        return response()->json('Increment');
    } // end method

    public function CouponApply(Request $request){
        $coupon = Coupon::where('coupon_name',$request->coupon_name)->where('coupon_validity','>=',Carbon::now()->format('Y-m-d'))->first();

        if($coupon){
            Session::put('coupon',[
                'coupon_name' => $coupon->coupon_name,
                'coupon_discount' => $coupon->coupon_discount,
                'discount_amount' => round(Cart::total() * $coupon->coupon_discount/100),
                'total_amount' => round(Cart::total() - Cart::total() * $coupon->coupon_discount/100),
            ]);

            return response()->json(array(
                'validity' => true,
                'success' => 'Coupon Applied Successfully'
            ));

        }else{
            return response()->json(['error' => 'Invalid Coupon Try Again.']);
        }

    } // end method


    public function CouponCalculation(){
        if(Session::has('coupon')){
            return response()->json(array(
                'subtotal' => Cart::total(),
                'coupon_name' => session()->get('coupon')['coupon_name'],  
                'coupon_discount' => session()->get('coupon')['coupon_discount'],  
                'discount_amount' => session()->get('coupon')['discount_amount'],  
                'total_amount' => session()->get('coupon')['total_amount'],  
            ));
        }else{
            return response()->json(array(
                'total' => Cart::total(),
            ));
        }
    } // end method

    public function CouponRemove(){
        Session::forget('coupon');
        return response()->json(['success' => 'Coupon Remove Successfully']);
    } // end method
}
