<!DOCTYPE html>
<html class="no-js" lang="en">

<head>
    <meta charset="utf-8" />
    <title>Login - Multi Vendors</title>
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta name="description" content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:title" content="" />
    <meta property="og:type" content="" />
    <meta property="og:url" content="" />
    <meta property="og:image" content="" />
    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('frontend/assets/imgs/theme/favicon.svg') }}" />
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/sweetalert.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css?v=5.3') }}" />

    <!-- Toaster -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.css" >


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
                            <div class="col-lg-6 pr-30 d-none d-lg-block">
                                <img class="border-radius-15" src="{{ asset('frontend/assets/imgs/page/loginimage1.png') }}" alt="" />
                            </div>
                            <div class="col-lg-6 col-md-8">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class="padding_eight_all bg-white">
                                        <div class="heading_s1">
                                            <h1 class="mb-5">Login</h1>
                                            <p class="mb-30">Dont have an account? <a href="{{ route('register') }}">Create here</a></p>
                                        </div>
                                            @if(!session()->has('message'))
                                        @error('loginfailed')
                                        <div class="alert alert-danger alert-dismissible" role="alert"  style="padding: .5rem .5rem ">
                                            <span id="message" >{{ $message }}</span>

                                             <button type="button" style="font-size: 10px;padding: 1rem 1rem" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                        </div>
                                        @enderror
                                        @endif
                                        <form method="POST" action="{{ route('login') }}" class="loader-form" id="myForm">
                                            @csrf
                                            <div class="form-group">
                                                <input type="text" id="logins"  name="logins" placeholder="Enter your email or phone number" value="{{Cookie::get('useremail')}}" />
                                                @if ($errors->has('logins'))
                                                <span class="text-danger ">{{ $errors->first('logins') }}</span>
                                            @endif
                                                         </div>
                                            <div class="form-group">
                                                <input  id="password" type="password" name="password" placeholder="Enter your passsword" />
                                                @if ($errors->has('password'))
                                                <span class="text-danger">{{ $errors->first('password') }}</span>
                                            @endif

                                            </div>

                                            <div class="login_footer form-group mb-50">
                                                <div class="chek-form">
                                                    <div class="custome-checkbox">
                                                        <input class="form-check-input" type="checkbox" name="remember" id="remember_me" @if(Cookie::has('useremail')) checked @endif />
                                                        <label class="form-check-label" for="remember_me"><span>Remember me</span></label>
                                                    </div>
                                                </div>
                                                <a class="text-muted" href="{{ route('password.request') }}">Forgot password?</a>
                                            </div>
                                            <div class="form-group">
                                                <button type="submit" class="btn btn-heading btn-block hover-up btn-loader " name="login"><span class="btn-text">Login</span><span class=" loading-ring"></span></button>
                                            </div>
                                        </form>
                                        <div class="mt-2 mb-2">
                                            <hr><p class="text-center mt-0 mb-0">OR</p><hr>
                                        </div>
                                        <div class="col-lg-12 col-sm-12 col-md-12  d-lg-block">
                                            <div class="card-login d-flex gap-2 p-0 ms-0" style="border:none">
                                                <a style="font-size: 14px; white-space:nowrap" href="{{ route('login.facebook') }}" class="social-login facebook-login">
                                                    <img src="{{ asset('frontend/assets/imgs/theme/icons/logo-facebook.svg') }}" alt="" />
                                                    <span>Continue with Facebook</span>
                                                </a>
                                                <a style="font-size: 14px; white-space:nowrap "href="{{ route('login.google') }}" class="social-login google-login">
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

    <!-- Template  JS -->
    <script src="{{ asset('frontend/assets/js/main.js?v=5.3') }}"></script>
    <script src="{{ asset('frontend/assets/js/shop.js?v=5.3') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.js"></script>

    <script src="{{ asset('frontend/assets/js/sweetalert.min.js') }}"></script>

    <script src="{{ asset('adminbackend/assets/js/validate.min.js')}}"></script>
    <script>
    @if(session()->has('status'))
    Swal.fire({
            icon: 'success',
            title: '{{ session()->get("status") }}'

        })

        @endif
    </script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

	<script>
        function loaderremove()
        {
            $('.loading-ring').css('visibility', 'hidden');
            $('.btn-text').css('color', 'white');

        }
	 @if(Session::has('message'))
	 var type = "{{ Session::get('alert-type','info') }}"
	 switch(type){
		case 'info':
		toastr.info(" {{ Session::get('message') }} ");
		break;

		case 'success':
		toastr.success(" {{ Session::get('message') }} ");
		break;

		case 'warning':
		toastr.warning(" {{ Session::get('message') }} ");
		break;

		case 'error':
		toastr.error(" {{ Session::get('message') }} ");
		break;
	 }
	 @endif

     $(document).ready(function(){
        $.validator.addMethod("email_or_mobile", function(value, element) {
            return /^\d{10,10}$/.test(value) ||
                /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(value) //email
    }, "Please enter valid email or phone number");
        $('#myForm').validate({
            rules:{
                logins:{
                   email_or_mobile: true,
                   required: true,

                },
                password:{
                    required : true,
                },
            },
            messages:{
                logins:{
                    required: 'Email or phone field is required',
                },
                password:{
                    required: 'Password field is required',
                }
            },
            errorElement : 'span',
            errorPlacement: function(error, element){
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
                loaderremove();
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
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
