<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Notifications\OrderComplete;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Auth\Events\Registered;
use App\Providers\RouteServiceProvider;
use Illuminate\Support\Testing\Fakes\NotificationFake;
use App\Notifications\VendorRegNotification;
use Illuminate\Support\Facades\Notification;

class VendorController extends Controller
{
    public function VendorDashboard()
    {
        return view('vendor.index');
    } // end method

    public function VendorLogin()
    {
        return view('vendor.vendor_login');
    } // end method

    public function VendorDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/vendor/login');
    } // end method

    public function VendorProfile()
    {
        $id = Auth::user()->id;
        $vendorData = User::find($id);

        return view('vendor.vendor_profile_view', compact('vendorData'));
    } // end method

    public function VendorProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;
        $data->vendor_join = $request->vendor_join;
        $data->vendor_short_info = $request->vendor_short_info;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/vendor_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/vendor_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Vendor Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method

    public function VendorChangePassword()
    {
        return view('vendor.vendor_change_password');
    } // end method

    public function VendorUpdatePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|confirmed',
        ]);

        // Match the old password
        if (!Hash::check($request->old_password, auth::user()->password)) {
            return back()->with("error", "Old Password doesnot match");
        }

        // Update the new password
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->new_password)
        ]);

        return back()->with("status", "Password Changed Successfully");
    } // end method

    public function BecomeVendor(){
        return view('auth.become_vendor');
    } // end method

    public function VendorRegister(Request $request)
    {
        $vuser = User::where('role','admin')->get();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'min:8', 'confirmed', Rules\Password::defaults()],
            'phone' => ['required', 'numeric', 'digits:10'],
            'terms' => ['required']
        ], [
            'terms.required' => 'Please agree terms and conditions'
        ]);



        $user = User::insert([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'phone' => $request->phone,
            'vendor_join' => $request->vendor_join,
            'password' => Hash::make($request->password),
            'role' => 'vendor',
            'status' => 'inactive',
        ]);

        $notification = array(
            'message' => 'Vendor Registered Successfully',
            'alert-type' => 'success'
        );
        Notification::send($vuser, new VendorRegNotification($request));

        return redirect()->route('vendor.login')->with($notification);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    } // end method
}

