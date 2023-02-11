
<!DOCTYPE html>
<html class="no-js" lang="en">





<head>
    <meta charset="utf-8" />
    <title>Verify Email - Multi Vendors</title>
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
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/toastr.min.css') }}">

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
                    <div class="col-xl-6 col-lg-8 col-md-12 m-auto">
                        <div class="row">

                            <div class="col-lg-12 col-md-12">
                                <div class="login_wrap widget-taber-content background-white">
                                    <div class=" bg-white">
                                    <div class="card">
                                        <div class="card-header text-black">
                                            <h5>Email Verification</h5>
                                        </div>
                                        <div class="card-body">
                                            <h6 class="mb-4">Your verification email has been sent to Your Email..Please check your Email!!</h6>
                                            @if (session('status') == 'verification-link-sent')


                                            <div class="mb-4 font-medium text-sm text-green-600 alert alert-primary ">
                                                <p>A new verification link has been sent to your Email Address </p>
                                            </div>
                                        @endif

                                            <form method="POST" action="{{ route('verification.send') }}">
                                                @csrf


                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-heading btn-block hover-up" name="login">Resend Verification Email</button>
                                                </div>

                                            </form>


                                        <form method="POST" action="{{ route('logout') }}">
                                            @csrf


            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                Logout
            </button>

                                        </form>

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
<!-- Preloader Start -->
{{-- <div id="preloader-active">
    <div class="preloader d-flex align-items-center justify-content-center">
        <div class="preloader-inner position-relative">
            <div class="text-center">
                <img src="{{ asset('frontend/assets/imgs/theme/loading.gif') }}" alt="" />
            </div>
        </div>
    </div>
</div> --}}

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
<script src="{{ asset('frontend/assets/js/toastr.min.js')}}"></script>

</body>

</html>

