<footer class="main">
    @php
    $company = App\Models\Company::first();
    @endphp
    <section class="newsletter mb-15 wow animate__animated animate__fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="position-relative newsletter-inner d-flex justify-start">
                        <div class="newsletter-content">
                            <h1  class="mb-20 fs-1 d-flex justify-start">
                                Please Subscribe Now<br />
                            </h1>
                            <p class="mb-45" style="max-width: 530px">To get a free and amazing offers and other cool things stay with us and please subscribe us<span class="text-brand"></span></p>
                            <form id="subscriber_form" class="form-subcriber d-flex justify-center" class="loader-form-subscribe" style="max-width: 750px !important" >

                                <input type="text" id="subscriber_email" name="subscriber_email" placeholder="Enter your email address" />
                                <button  class="btn btn-primary btn-loader" type="submit"><span class="btn-text-subscribe">Subscribe</span><span class="loading-ring-subscribe"></span></button>
                            </form>
                        </div>
                        <div>

                            <img src="{{ asset('frontend/assets/imgs/theme/e_mail.png') }}" class="me-3" alt="newsletter" />
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section-padding footer-mid">
        <div class="container pt-15 pb-20">
            <div class="row">
                <div class="col">
                    <div class="widget-about font-md mb-md-3 mb-lg-3 mb-xl-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                        <div class="logo mb-30">

                            <a href="index.html" class="mb-15"><img src=@if(empty($company->cimage))"{{ asset('frontend/assets/imgs/theme/brandlogo.png') }}"@else {{asset($company->cimage)}} @endif style="height:4rem;width:auto" alt="logo" /></a>
                            <p class="font-lg text-heading">Awesome grocery store website template</p>
                        </div>
                        <ul class="contact-infor">
                            <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-location.svg') }}" alt="" /><strong>Address: </strong> <span>@if(!empty($company->caddress)){{ $company->caddress }}@else Kathmandu,Nepal @endif</span></li>
                            <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-contact.svg') }}" alt="" /><strong>Call Us:</strong><span>@if(!empty($company->cnumber)){{ $company->cnumber }}@else (+91) - 540-025-124553 @endif</span></li>
                            <li><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-email-2.svg') }}" alt="" /><strong>Email:</strong><span>@if(!empty($company->cemail)){{ $company->cemail }}@else nest@nest.com @endif</span></li>
                        </ul>
                    </div>
                </div>
                <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                    <h4 class=" widget-title">Company</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        <li><a href="#">About Us</a></li>
                        <li><a href="#">Delivery Information</a></li>
                        <li><a href="#">Privacy Policy</a></li>
                        <li><a href="#">Terms &amp; Conditions</a></li>
                        <li><a href="#">Contact Us</a></li>
                        <li><a href="#">Support Center</a></li>
                        <li><a href="#">Careers</a></li>
                    </ul>
                </div>
                <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                    <h4 class="widget-title">Account</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        <li><a href="#">Sign In</a></li>
                        <li><a href="#">View Cart</a></li>
                        <li><a href="#">My Wishlist</a></li>
                        <li><a href="#">Track My Order</a></li>
                        <li><a href="#">Help Ticket</a></li>
                        <li><a href="#">Shipping Details</a></li>
                        <li><a href="#">Compare products</a></li>
                    </ul>
                </div>
                <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                    <h4 class="widget-title">Corporate</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        <li><a href="{{ route('become.vendor') }}">Become a Vendor</a></li>
                        <li><a href="#">Affiliate Program</a></li>
                        <li><a href="#">Farm Business</a></li>
                        <li><a href="#">Farm Careers</a></li>
                        <li><a href="#">Our Suppliers</a></li>
                        <li><a href="#">Accessibility</a></li>
                        <li><a href="#">Promotions</a></li>
                    </ul>
                </div>
                <div class="footer-link-widget col wow animate__animated animate__fadeInUp" data-wow-delay=".4s">
                    <h4 class="widget-title">Popular</h4>
                    <ul class="footer-list mb-sm-5 mb-md-0">
                        <li><a href="#">Milk & Flavoured Milk</a></li>
                        <li><a href="#">Butter and Margarine</a></li>
                        <li><a href="#">Eggs Substitutes</a></li>
                        <li><a href="#">Marmalades</a></li>
                        <li><a href="#">Sour Cream and Dips</a></li>
                        <li><a href="#">Tea & Kombucha</a></li>
                        <li><a href="#">Cheese</a></li>
                    </ul>
                </div>

            </div>
    </section>
    <div class="container pb-30 wow animate__animated animate__fadeInUp" data-wow-delay="0">
        <div class="row align-items-center">
            <div class="col-12 mb-30">
                <div class="footer-bottom"></div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6">
                <p class="font-sm mb-0">&copy; 2023 - Multi Vendors <br />All rights reserved</p>
            </div>
            <div class="col-xl-4 col-lg-6 text-center d-none d-xl-block">

                <div class="hotline d-lg-inline-flex">
                    <img src="{{ asset('frontend/assets/imgs/theme/icons/phone-call.svg') }}" alt="hotline" />
                    <p>@if(!empty($company->chelplineno)){{ $company->chelplineno }}@else 1900-800 @endif<span>@if(!empty($company->chelplineslogan)){{ $company->chelplineslogan }}@else 24/7 Support Center @endif</span></p>
                </div>
            </div>
            <div class="col-xl-4 col-lg-6 col-md-6 text-end d-none d-md-block">
                <div class="mobile-social-icon">
                    <h6>Follow Us</h6>
                    <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-facebook-white.svg') }}" alt="" /></a>
                    <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-twitter-white.svg') }}" alt="" /></a>
                    <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-instagram-white.svg') }}" alt="" /></a>
                </div>
                <p class="font-sm">Up to 15% discount on your first subscribe</p>
            </div>
        </div>
    </div>
    <script src="{{ asset('frontend/assets/js/vendor/jquery-3.6.0.min.js') }}"></script>

    <script>
        //loading animation jquery


        function loaderremove()
        {
            $('.loading-ring-subscribe').css('visibility', 'hidden');
            $('.btn-text-subscribe').css('color', 'white');
            $('#subscriber_email').val("");

        }

    $('#subscriber_form').submit(function(e){
            $('.btn-text-subscribe').css('color', 'transparent');
            $('.loading-ring-subscribe').css('visibility', 'visible');
        e.preventDefault();
     var subscriber_email= $('#subscriber_email').val();
     var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    if(validRegex.test(subscriber_email)==false)
    {
        loaderremove();
        toastr.error("Please Enter valid email address");
        return false;
    }
        $.ajax({
                type:'post',
                url:'/add-subscriber-email',
                data: {
                    subscriber_email:subscriber_email,_token: '{{csrf_token()}}'
                },
                success:function(response){
                    if(response=="exists"){
                        toastr.warning("This Email has Already Subscribed",{timeOut:5000});
                        loaderremove();
                   }else if(response=="saved"){
                            toastr.success("Thanks for Subscribing &#128578;",{timeOut:8000});
                            loaderremove();
                    }
                },
                error:function()
                {
                    toastr.error('error');
                    loaderremove();
                }
        });
    });
    </script>

</footer>

