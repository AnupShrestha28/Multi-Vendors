<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class ActiveUserController extends Controller
{
    public function AllUser(){
        $users = User::where('role','user')->latest()->get();

        return view('backend.user.user_all_data',compact('users'));
    } // end method

    public function AllVendor(){
        $vendors = User::where('role','vendor')->latest()->get();

        return view('backend.user.vendor_all_data',compact('vendors'));
    } // end method

    public function DeleteUser($id){
        $user = User::findOrFail($id);
        $img = $user->user_image;

        // unlink($img);

        User::findOrFail($id)->delete();

        $notification = array(
            'message' => 'User deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method

    public function DeleteVendor($id){
        $vendor = User::findOrFail($id);
        $img = $vendor->user_image;

        User::findOrFail($id)->delete();

        $notification = array(
            'message' => 'Vendor Deleted Successfully',
            'alert-type' => 'success'
        );
        return redirect()->back()->with($notification);
    } // end method
}
