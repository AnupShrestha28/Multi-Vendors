@extends('dashboard')
@section('user')

<div class="container m-3">

    @if(session()->has('success'))
        <div class="alert alert-success alert-dismissible" role="alert" style="width: 400px;padding: .7rem">

            <p class="text-black">{{ session()->get('success') }}</p>
     <button type="button" style="padding: 1rem 1rem" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
    @endif




    <form action="{{ route('otp.otpverify') }}" method="POST"  class="loader-form" >
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <div><h5 class="mt-3 mb-3">Enter OTP:</h5></div>
        <div class="d-flex">
      <input type="text" placeholder="Enter OTP" name="otp" value="{{ old('otp') }}" style="width: 300px"/>

     <button type="submit" class="btn btn-success ms-2 btn-loader"  ><span class="btn-text">Submit</span><span class="loading-ring"></span></button>
    </div>
     {{--  @if(session()->has('error'))
     <p class="text-danger mt-3 mb-3">{{ session()->get('error') }}</p>
     @endif  --}}
     @error('otp')
           <p class="text-danger mt-3 mb-3">{{ $message }}</p>
     @enderror
    </form>
    {{--  <p class="mt-2">Didnt Receive OTP? <form action="{{ route('otp.resend') }}" method="POST">@csrf<input type="hidden" name="phone" value="{{ auth()->user()->phone }}" style="pointer-events:none"> <button type="submit">Resend</button></form></p>  --}}
      <div class="mt-2 d-flex gap-1 align-items-center" style="font-size: 1rem">
        <span> Didnt Receive OTP?</span>
          <form action="{{ route('otp.resend') }}" method="POST" id="resendform">
        @csrf
         <input type="hidden" name="phone" value="{{ auth()->user()->phone }}" style="pointer-events:none">
          <a href="#" onclick="document.getElementById('resendform').submit()" >Resend</a>
    </form>
</div>



</div>

@endsection
