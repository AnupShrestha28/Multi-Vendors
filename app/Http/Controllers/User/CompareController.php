<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Compare;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class CompareController extends Controller
{
    public function AddToCompare(Request $request, $product_id){
        if(Auth::check()){
            $exists = Compare::where('user_id',Auth::id())->where('product_id',$product_id)->first();

            if(!$exists){
                Compare::insert([
                    'user_id' => Auth::id(),
                    'product_id' => $product_id,
                    'created_at' => Carbon::now(),
                ]);
                return response()->json(['success' => 'Successfully added on your compare list']);
            }else{
                return response()->json(['error' => 'This product has already been on your compare list']);
            }
        }else{
            return response()->json(['error' => 'At first login your account']);
        }
    } // end method

    public function AllCompare(){
        return view('frontend.compare.view_compare');
    } // end method

    public function GetCompareProduct(){
        $compare = Compare::with('product')->where('user_id',Auth::id())->latest()->get();

        return response()->json($compare);

    } // end method

    public function CompareRemove($id){
        Compare::where('user_id',Auth::id())->where('id',$id)->delete();

        return response()->json(['success' => 'Your compare product removed successfully']);
    } // end method
}
