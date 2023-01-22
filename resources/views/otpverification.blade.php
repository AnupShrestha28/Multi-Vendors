

@extends('dashboard')
@section('user')

<div class="container m-4 ">

    <h4>Mobile Number:</h4>
<form action="{{ route('otp.generate') }}" method="POST" class="mt-3 mb-3 loader-form" >
        @csrf
        <input type="text" value="{{ $mobile }}" name="phone" style="width: 200px;pointer-events:none"/>
        <button type="submit" class="ms-2 btn-loader"><span class="btn-text">Send OTP</span><span class="spinner loading-ring"></span></button>
    </form>

</div>
@endsection



