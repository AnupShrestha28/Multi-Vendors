<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\MOdels\User;
use App\MOdels\UserOtp;

class OtpController extends Controller
{
    public function sendotp()
    {
        return view('otpverification');
    }

    public function generate(Request $request)
    {
        $request->validate([
            'phone' => 'required|exists:users,phone'
        ]);

        $userOtp = $this->generateOtp($request->phone);
        $userOtp->sendSMS($request->phone); //send OTP
        return redirect()->route('otp.verification', ['user_id', $userOtp->user_id])->with('success', 'OTP has been sent on your mobile number');
    }

    public function generateOtp($phone)
    {
        $user = User::where('phone', $phone)->first();
        $userOtp = UserOtp::where('user_id', $user->id)->latest()->first();
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
}
