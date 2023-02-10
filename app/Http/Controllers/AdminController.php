<?php

namespace App\Http\Controllers;

use App\Models\Company;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Image;

use function PHPUnit\Framework\fileExists;

class AdminController extends Controller
{
    public function AdminDashboard()
    {
        return view('admin.index');
    } // end method

    public function AdminLogin()
    {
        return view('admin.admin_login');
    } // end method

    public function AdminDestroy(Request $request)
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/admin/login');
    } // end method

    public function AdminProfile()
    {
        $id = Auth::user()->id;
        $adminData = User::find($id);

        return view('admin.admin_profile_view', compact('adminData'));
    } // end method

    public function AdminProfileStore(Request $request)
    {
        $id = Auth::user()->id;
        $data = User::find($id);
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phone = $request->phone;
        $data->address = $request->address;

        if ($request->file('photo')) {
            $file = $request->file('photo');
            @unlink(public_path('upload/admin_images/' . $data->photo));
            $filename = date('YmdHi') . $file->getClientOriginalName();
            $file->move(public_path('upload/admin_images'), $filename);
            $data['photo'] = $filename;
        }

        $data->save();

        $notification = array(
            'message' => 'Admin Profile Updated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->back()->with($notification);
    } // end method

    public function AdminChangePassword()
    {
        return view('admin.admin_change_password');
    } // end method

    public function AdminUpdatePassword(Request $request)
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

    public function InactiveVendor()
    {
        $inActiveVendor = User::where('status', 'inactive')->where('role', 'vendor')->latest()->get();

        return view('backend.vendor.inactive_vendor', compact('inActiveVendor'));
    } // end method

    public function ActiveVendor()
    {
        $ActiveVendor = User::where('status', 'active')->where('role', 'vendor')->latest()->get();

        return view('backend.vendor.active_vendor', compact('ActiveVendor'));
    } // end method

    public function InactiveVendorDetails($id)
    {
        $inactiveVendorDetails = User::findOrFail($id);
        return view('backend.vendor.inactive_vendor_details', compact('inactiveVendorDetails'));
    } // end method

    public function ActiveVendorApprove(Request $request)
    {
        $vendor_id = $request->id;
        $user = User::findOrFail($vendor_id)->update([
            'status' => 'active',
        ]);

        $notification = array(
            'message' => 'Vendor Activated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('active.vendor')->with($notification);
    } // end method

    public function ActiveVendorDetails($id)
    {
        $activeVendorDetails = User::findOrFail($id);
        return view('backend.vendor.active_vendor_details', compact('activeVendorDetails'));
    } // end method

    public function InActiveVendorApprove(Request $request)
    {
        $vendor_id = $request->id;
        $user = User::findOrFail($vendor_id)->update([
            'status' => 'inactive',
        ]);

        $notification = array(
            'message' => 'Vendor deactivated Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('inactive.vendor')->with($notification);
    }





    public function websitedetails()
    {
        $company = Company::first();
        return view('backend.websitedetails.websitedetails_add', ['company' => $company]);
    }
    public function addcdetails(Request $request)
    {
        if ($request->has('websitebrand_image')) {
            $image = $request->file('websitebrand_image');
            $generate = hexdec(uniqid()) . '.' . $image->getClientOriginalExtension();
            Image::make($image)->save('upload/companylogo/' . $generate);
            $save_url = 'upload/companylogo/' . $generate;
        } else {
            $save_url = null;
        }
        $company = Company::first();
        if (is_null($company)) {
            Company::create([
                'cname' => $request->website_name,
                'chelplineno' => $request->website_helplineno,
                'chelplineslogan' => $request->website_helplineslogan,
                'cnumber' => $request->website_cnumber,
                'caddress' => $request->website_caddress,
                'cemail' => $request->website_cemail,
                'cimage' => $save_url,
            ]);
            $notification = array(
                'message' => 'Company Details Saved Successfully',
                'alert-type' => 'success'
            );
        } else {
            if (!$request->has('websitebrand_image')) {
                $save_url = $company->cimage;
            } else {
                if (fileExists($company->cimage)) {
                    unlink($company->cimage);
                }
            }
            Company::findorFail($company->id)->update([
                'cname' => $request->website_name,
                'chelplineno' => $request->website_helplineno,
                'chelplineslogan' => $request->website_helplineslogan,
                'cnumber' => $request->website_cnumber,
                'caddress' => $request->website_caddress,
                'cemail' => $request->website_cemail,
                'cimage' => $save_url,
            ]);
            $notification = array(
                'message' => 'Company Details Updated Successfully',
                'alert-type' => 'success'
            );
        }

        return redirect()->route('add.webdetails')->with($notification);
    }
}
