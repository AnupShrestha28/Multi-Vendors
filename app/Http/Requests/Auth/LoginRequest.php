<?php

namespace App\Http\Requests\Auth;

use App\Models\User;
use Illuminate\Auth\Events\Lockout;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;
use Illuminate\Validation\ValidationException;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */

    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(Request $request)
    {
        // return [
        //     'logins' => ['required', 'string', 'email:ordigits:10'],
        //     'password' => ['required', 'string']

        // ];
        if (is_numeric($request->logins)) {

            return [
                'logins' => ['required', 'numeric', 'digits:10'],
                'password' => ['required', 'string'],
            ];
        } elseif (!is_numeric($request->logins)) {
            return [
                'logins' => ['required', 'email', 'string'],
                'password' => ['required', 'string']
            ];
        } else {
            return [
                'logins' => ['required'],
                'password' => ['required', 'string']

            ];
        }
    }
    public function messages()
    {
        return [
            'logins.digits' => 'Phone number must be 10 digits',
            'logins.email' => 'Email address must be valid',
            'logins.required' => 'Email or Phone field is required'
        ];
    }



    /**
     * Attempt to authenticate the request's credentials.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function authenticate()
    {
        $this->ensureIsNotRateLimited();
        $getadminuser = User::where('email', $this->logins)->where('role', 'admin')->first();
        $getvendoruser = User::where('email', $this->logins)->where('role', 'vendor')->first();
        $getuser = User::where('email', $this->logins)->where('role', 'user')->first();
        $remember_me = $this->boolean('remember') ? true : false;

        if ($getadminuser && $remember_me) {
            Cookie::queue('adminemail', $this->logins, 2400);
        } elseif ($getadminuser && !$remember_me) {
            Cookie::queue('adminemail', '', -1);
        }
        if ($getvendoruser && $remember_me) {
            Cookie::queue('vendoremail', $this->logins, 2400);
        } elseif ($getvendoruser && !$remember_me) {
            Cookie::queue('vendoremail', '', -1);
        }

        if ($remember_me && $getuser) {
            Cookie::queue('useremail', $this->logins, 2400);
        } elseif ($getuser && !$remember_me) {
            Cookie::queue('useremail', '', -1);
        }



        $user1 = User::where('phone', $this->logins)->whereNull('phone_verified')->first();
        if ($user1) {
            // dd('failed');
            Session::flash('alert_type', 'warning');
            Session::flash('message', 'Phone is not verified to login with phone');
            $user = '';
        }
        $user4 = User::where('phone', $this->logins)->whereNotNull('phone_verified')->first();
        $user2 = User::where('email', $this->logins)->first();
        $user6 = User::where('email', $this->logins)->orwhere('phone', $this->logins)->first();
        if ($user4) {
            $user = User::where('phone', $this->logins)->first();
        } else if ($user2) {
            $user = User::where('email', $this->logins)->first();
        } else if (!$user6) {
            $user = User::where('email', $this->logins)->orwhere('phone', $this->logins)->first();
        }


        if (!$user  || !Hash::check($this->password, $user->password)) {
            RateLimiter::hit($this->throttleKey());
            throw ValidationException::withMessages([
                'loginfailed' => __('auth.failed'),
            ]);
        }
        // if (!Auth::attempt($this->only('email', 'password'), $this->boolean('remember'))) {
        //     RateLimiter::hit($this->throttleKey());

        //     throw ValidationException::withMessages([
        //         'emailfailed' => trans('auth.failed'),
        //     ]);
        // }
        Auth::login($user, $this->boolean('remember'));
        RateLimiter::clear($this->throttleKey());

        // $login_type = filter_var($this->input('logins'), FILTER_VALIDATE_EMAIL)
        //     ? 'email'
        //     : 'phone';

        // $this->merge([
        //     $login_type => $this->input('logins')
        // ]);

        // if (!Auth::attempt($this->only($login_type, 'password'), $this->boolean('remember'))) {
        //     RateLimiter::hit($this->throttleKey());

        //     throw ValidationException::withMessages([
        //         'loginfailed' => __('auth.failed'),
        //     ]);
        // }
    }

    /**
     * Ensure the login request is not rate limited.
     *
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function ensureIsNotRateLimited()
    {
        if (!RateLimiter::tooManyAttempts($this->throttleKey(), 5)) {
            return;
        }

        event(new Lockout($this));

        $seconds = RateLimiter::availableIn($this->throttleKey());

        throw ValidationException::withMessages([
            'email' => trans('auth.throttle', [
                'seconds' => $seconds,
                'minutes' => ceil($seconds / 60),
            ]),
        ]);
    }

    /**
     * Get the rate limiting throttle key for the request.
     *
     * @return string
     */
    public function throttleKey()
    {
        return Str::transliterate(Str::lower($this->input('email')) . '|' . $this->ip());
    }
}
