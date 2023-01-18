@extends('dashboard')
@section('user')

<div class="container m-3">

    @if(session()->has('success'))
        <div class="alert alert-success" style="padding: 10px;width: 400px">
    <p class="text-black">{{ session()->get('success') }}</p>
</div>
    @endif


    <form action="{{ route('otp.otpverify') }}" method="POST"  >
        @csrf
        <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
        <div><h5 class="mt-3 mb-3">Enter OTP:</h5></div>
        <div class="d-flex">
      <input type="text" placeholder="Enter OTP" name="otp" value="{{ old('otp') }}" style="width: 300px"/>

     <button type="submit" class="btn btn-success ms-2">Submit</button>
    </div>
     {{--  @if(session()->has('error'))
     <p class="text-danger mt-3 mb-3">{{ session()->get('error') }}</p>
     @endif  --}}
     @error('otp')
           <p class="text-danger mt-3 mb-3">{{ $message }}</p>
     @enderror
    </form>
</div>

@endsection
