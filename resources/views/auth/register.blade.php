
<!DOCTYPE html>
<html class="no-js" lang="en">


<head>
    <meta charset="utf-8" />
    <title>Register - Multi Vendors</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/imgs/theme/favicon.svg') }}" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css?v=5.3') }}" />
</head>

<body>

    @include('frontend.body.header')

    <main class="main pages">
        <div class="page-header breadcrumb-wrap">
            <div class="container">
                <div class="breadcrumb">
                    <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
                    <span></span> My Account
                </div>
            </div>
        </div>
        <div class="page-content pt-150 pb-150">
            <div class="container">
                <div class="row">
                    <div class="col-xl-8 col-lg-10 col-md-12 m-auto">
                        <div class="row">
                            <div class="col-lg-6 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h1 class="mb-5">Create an Account</h1>
                                            <p class="mb-30">Already have an account? <a href="{{ route('login') }}">Login</a></p>
                                        </div>
                                        <form method="POST" action="{{ route('register') }}" id="myForm" class="loader-form">
                                            @csrf

                                            <div class="form-group">
                                                <input type="text" id="name"  name="name" placeholder="Enter full name" class="text-inputbox" value="{{ old('name') }}" />
                                                @if ($errors->has('name'))
                                                <span class="text-danger ">{{ $errors->first('name') }}</span>
                                            @endif
                                            </div>
                                            <div class="form-group">
                                                <input type="email" id="email"  name="email" placeholder="Enter email" class="text-inputbox" value="{{ old('email') }}" />
                                                @if ($errors->has('email'))
                                                <span class="text-danger ">{{ $errors->first('email') }}</span>
                                            @endif
                                            </div>
                                            <div class="form-group">
                                                <input type="text" id="phone"  name="phone" placeholder="Enter your Phone Number" class="text-inputbox" value="{{ old('phone') }}" />
                                                @if ($errors->has('phone'))
                                                <span class="text-danger ">{{ $errors->first('phone') }}</span>
                                            @endif
                                            </div>
                                            <div class="form-group">
                                                <input  id="password" type="password" name="password" placeholder="Enter password" class="text-inputbox"/>
                                                @if ($errors->has('password'))
                                                <span class="text-danger ">{{ $errors->first('password') }}</span>
                                            @endif
                                            </div>
                                            <div class="form-group">
                                                <input  id="password_confirmation" type="password" name="password_confirmation" placeholder="Confirm password" />

                                            </div>

                                            <div class="form-group mb-50">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="terms" id="exampleCheckbox12"  />
                                                        <label class="form-check-label" for="exampleCheckbox12"><label>I agree to terms &amp; Policy.</label></label>
                                                        @if ($errors->has('terms'))
                                                        <br><span class="text-danger ">{{ $errors->first('terms') }}</span>
                                                    @endif
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group mb-30">
                                                <button type="submit" class="btn btn-fill-out btn-block hover-up btn-loader font-weight-bold" name="login"><span class="btn-text">Submit &amp; Register</span> <span class="loading-ring"></span></button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 pr-30 d-none d-lg-block">
                                <div class="card-login mt-115">
                                    <a href="{{ route('login.facebook') }}" class="social-login facebook-login">
                                        <img src="{{ asset('frontend/assets/imgs/theme/icons/logo-facebook.svg') }}" alt="" />
                                        <span>Continue with Facebook</span>
                                    </a>
                                    <a href="{{ route('login.google') }}" class="social-login google-login">
                                        <img src="{{ asset('frontend/assets/imgs/theme/icons/logo-google.svg') }}" alt="" />
                                        <span>Continue with Google</span>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>

    @include('frontend.body.footer')


<!-- Vendor JS-->
<script src="{{ asset('frontend/assets/js/vendor/modernizr-3.6.0.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/vendor/jquery-migrate-3.3.0.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/vendor/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/slick.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/jquery.syotimer.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/waypoints.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/wow.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/perfect-scrollbar.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/magnific-popup.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/select2.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/counterup.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/jquery.countdown.min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/images-loaded.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/isotope.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/scrollup.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/jquery.vticker-min.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/jquery.theia.sticky.js') }}"></script>
<script src="{{ asset('frontend/assets/js/plugins/jquery.elevatezoom.js') }}"></script>
<script src="{{ asset('adminbackend/assets/js/validate.min.js')}}"></script>
<!-- Template  JS -->
<script src="{{ asset('frontend/assets/js/main.js?v=5.3') }}"></script>
<script src="{{ asset('frontend/assets/js/shop.js?v=5.3') }}"></script>

<script>
    $(document).ready(function(){
        $('#myForm').validate({
            ignore: [':not(checkbox:hidden)'],
            rules:{
                name:{
                    required : true,
                },
                email:{
                    required : true,
                },
                phone:{
                    required : true,
                    number: true,
                    minlength: 10,
                },
                terms:{
                    required : true,
                },
                password:{
                    required : true,
                    minlength: 8,
                },
                password_confirmation:{
                    required:true,
                    equalTo: "#password",

                }
            },
            messages:{
                name:{
                    required: 'Full Name field is required',
                },
                password:{
                    required: 'Password field is required',
                    minlength: 'Password must be at least 8 characters',
                },
                email:{
                    required: 'Email field is required',
                },
                phone:{
                    required: 'Phone field is required',
                    number : 'Please enter valid phone number',
                    minlength: 'Please enter 10 digits number'
                },
                terms:{
                    required: 'Please agree terms and conditions',
                },
                password_confirmation:{
                    required:'Password confirmation field is required',
                    equalTo: "Password confirmation doesn't match",
                }
            },
            errorElement : 'span',
            errorPlacement: function(error, element){
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
                loaderremove();
            },
            highlight : function(element, errorClass, validClass){

                loaderremove();
            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');
            },
        });
    });
</script>

</body>

</html>
