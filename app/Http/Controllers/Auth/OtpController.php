<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MOdels\User;
use App\MOdels\UserOtp;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class OtpController extends Controller
{
    public function sendotp()
    {
        $mobilenumber = Auth::user()->phone;
        return view('otpverification', ['mobile' => $mobilenumber]);
    }

    public function generate(Request $request)
    {
        $request->validate([
            'phone' => 'required'
        ]);
        $userOtp = $this->generateOtp($request->phone);
        $userOtp->sendSMS($request->phone);
        return redirect()->route('otp.verification', ['user_id', $userOtp->user_id])->with('success', 'OTP has been sent on your mobile number');
    }

    public function generateOtp($phone)
    {
        $user = User::where('phone', $phone)->first();
        $userOtp = UserOtp::where('user_id', $user->id)->latest()->first();
        $users = User::where('user_id', $user->id);
        $now = now();
        if ($userOtp && $now->isBefore($userOtp->expire_at)) {
            return $userOtp;
        }
        return UserOtp::create([
            'user_id' => $user->id,
            'otp' => rand(123456, 999999),
            'expire_at' => $now->addMinutes(10)
        ]);
    }
    public function verification($user_id)
    {
        $mobilenumber = Auth::user()->phone;

        return view('otpcode', ['mobile' => $mobilenumber]);
    }

    public function otpverify(Request $request)
    {
        $request->validate([
            'otp' => 'required',
            'user_id' => 'required|exists:users,id',
        ]);

        $userOtp = UserOtp::where('user_id', $request->user_id)->where('otp', $request->otp)->first();
        $now = now();
        if (!$userOtp) {
            return redirect()->back()->with('error', 'Your OTP is not correct');
        } else if ($userOtp && $now->isAfter($userOtp->expire_at)) {
            return back()->with('error', 'This OTP has been expired');
        }
        $user = User::whereId($request->user_id)->first();
        if ($user) {
            $userOtp->update([
                'expire_at' => now()
            ]);
            $user->update([
                'phone_verified' => now()
            ]);


            return redirect()->route('dashboard')->with('message', 'Your phone number has been verified');
        }
        return redirect()->route('otp.otpverify')->with('error', 'Your otp is not correct');
    }
    public function resendotp(Request $request)
    {
        //otp controller
        $userotps = UserOtp::where('user_id', auth()->user()->id)->latest()->first();
        if ($userotps) {
            $userotps->update([
                'expire_at' => now()
            ]);
        }

        $this->generate($request);
        return back()->with('success', 'OTP has been resent to your mobile number');
    }

}
