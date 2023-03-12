<header class="header-area header-style-1 header-height-2">
    @php
            $company = App\Models\Company::first();
            @endphp
    <div class="header-top header-top-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info">
                        <ul>
                            <li><a href="shop-order.html">Order Tracking</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4">
                    <div class="text-center">
                        <div id="news-flash" class="d-inline-block">
                            <ul>

                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info header-info-right">
                        <ul>
{{--
                            <li>
                                <a class="language-dropdown-active" href="#">English <i class="fi-rs-angle-small-down"></i></a>
                                <ul class="language-dropdown">
                                    <li>
                                        <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/flag-fr.png') }}" alt="" />Français</a>
                                    </li>
                                    <li>
                                        <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/flag-dt.png') }}" alt="" />Deutsch</a>
                                    </li>
                                    <li>
                                        <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/flag-ru.png') }}" alt="" />Pусский</a>
                                    </li>
                                </ul>
                            </li>  --}}

                             <li>Need help? Call Us: <strong class="text-brand"> @if(!empty($company->cnumber)){{ $company->cnumber }}@else +1800-900 @endif</strong></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">


            <div class="header-wrap">
                <div class="logo logo-width-1">

                    <a href=""><img src=@if(empty($company->cimage))"{{ asset('frontend/assets/imgs/theme/brandlogo.png') }}"@else {{asset($company->cimage)}} @endif style="height:4rem;width:auto;object-fit:contain" alt="logo" /></a>
                </div>
                <div class="header-right">
                    <div class="search-style-2">
                        <form action="{{ route('product.search') }}" method="post">
                            @csrf


                            <input onfocus="search_result_show()" onblur="search_result_hide()" name="search" id="search" placeholder="Search for items..." />

                            <div id="searchProducts"></div>

                        </form>
                    </div>

                    <div class="header-action-right">
                        <div class="header-action-2">
                            <div class="search-location">
                                <form action="#">
                                    <select class="select-active">
                                        <option>Your Location</option>
                                        <option>Alabama</option>
                                        <option>Alaska</option>
                                        <option>Arizona</option>
                                        <option>Delaware</option>
                                        <option>Florida</option>
                                        <option>Georgia</option>
                                        <option>Hawaii</option>
                                        <option>Indiana</option>
                                        <option>Maryland</option>
                                        <option>Nevada</option>
                                        <option>New Jersey</option>
                                        <option>New Mexico</option>
                                        <option>New York</option>
                                    </select>
                                </form>
                            </div>



                            <div class="header-action-icon-2">
                                <a href="{{ route('compare') }}">
                                    <img class="svgInject" src="{{ asset('frontend/assets/imgs/theme/icons/icon-compare.svg')}}" alt="Nest">
                                </a>
                                <a href="{{ route('compare') }}"><span class="lable ml-0">Compare</span></a>
                            </div>



                            <div class="header-action-icon-2">
                                <a href="{{ route('wishlist') }}">
                                    <img class="svgInject" alt="Nest" src="{{ asset('frontend/assets/imgs/theme/icons/icon-heart.svg') }}" />
                                    <span class="pro-count blue" id="wishQty">0</span>
                                </a>
                                <a href="{{ route('wishlist') }}"><span class="lable">Wishlist</span></a>
                            </div>





                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="{{ route('mycart') }}">
                                    <img alt="Nest" src="{{ asset('frontend/assets/imgs/theme/icons/icon-cart.svg') }}" />
                                    <span class="pro-count blue" id="cartQty">0</span>
                                </a>
                                <a href="{{ route('mycart') }}"><span class="lable">Cart</span></a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">


                                    <!-- mini cart start with ajax -->

                                    <div id="miniCart">

                                    </div>


                                    <!-- end mini cart start with ajax -->


                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span id="cartSubTotal">Rs.</span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="{{ route('mycart') }}" class="outline">View cart</a>
                                            <a href="{{ route('checkout') }}">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="header-action-icon-2" >
                                <a href="{{ route('login') }}">
                                      {{--  <img class="svgInject"  alt="Nest"  src="{{ asset('frontend/assets/imgs/theme/icons/user_circle_icon_172814.svg') }}" />  --}}
                                      <svg id="Flat" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256">
                                        <path d="M230,128A102,102,0,1,0,59.22656,203.25977a5.962,5.962,0,0,0,1.177,1.05468,101.78869,101.78869,0,0,0,135.19629-.00341,5.95057,5.95057,0,0,0,1.16822-1.04639A101.75316,101.75316,0,0,0,230,128ZM38,128a90,90,0,1,1,155.51367,61.64014,77.58239,77.58239,0,0,0-40.00293-31.38477,46,46,0,1,0-51.02148,0,77.57954,77.57954,0,0,0-40.00318,31.38477A89.67113,89.67113,0,0,1,38,128Zm56-8a34,34,0,1,1,34,34A34.03864,34.03864,0,0,1,94,120ZM71.44336,197.95312a66.02837,66.02837,0,0,1,113.113.00049,89.80329,89.80329,0,0,1-113.113-.00049Z"/>
                                      </svg>
                                                                </a>


                                @auth


                                <a href="#"><span class="lable ml-0">Account</span></a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                    <ul>
                                        <li>
                                            <a href="{{ route('dashboard') }}"><i class="fi fi-rs-user mr-10"></i>My Account</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('user/order/page') }}"><i class="fi fi-rs-location-alt mr-10"></i>My Orders</a>
                                        </li>

                                        <li>
                                            <a href="{{ route('contact.supportticket') }}"><i class="fa fa-ticket mr-10"></i>Your Support Ticket</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('dashboard') }}"><i class="fi fi-rs-label mr-10"></i>My Voucher</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('dashboard') }}"><i class="fi fi-rs-heart mr-10"></i>My Wishlist</a>
                                        </li>
                                        <li>
                                            <a href="{{ url('user/account/page') }}"><i class="fi fi-rs-settings-sliders mr-10"></i>Account Details</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('user.logout') }}"><i class="fi fi-rs-sign-out mr-10"></i>Sign out</a>
                                        </li>
                                    </ul>
                                </div>

                                @else

                                <a href="{{ route('login') }}"><span class="lable ml-0">Login</span></a>


                                <span class="lable" style="margin-left: 2px; margin-right:2px;"  > | </span>

                                <a href="{{ route('register') }}"><span class="lable ml-0">Register</span></a>


                                @endauth




                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>




    @php

    $categories = App\Models\Category::orderBy('category_name','ASC')->get();

    @endphp





    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">

                    <a href="{{ url('/') }}"><img src=@if(empty($company->cimage))"{{ asset('frontend/assets/imgs/theme/brandlogo.png') }}"@else {{asset($company->cimage)}} @endif style="height:4rem;width:auto;object-fit:contain" alt="logo" /></a>
                </div>
                <div class="header-nav d-none d-lg-flex">
                    <div class="main-categori-wrap d-none d-lg-block">
                        <a class="categories-button-active" href="#">
                            <span class="fi-rs-apps"></span>   All Categories
                            <i class="fi-rs-angle-down"></i>
                        </a>
                        <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                            <div class="d-flex categori-dropdown-inner">
                                <ul>
                                    @foreach($categories as $item)
                                        @if($loop->index < 5)
                                    <li>
                                        <a href="{{ url('product/category/'.$item->id.'/'.$item->category_slug) }}"> <img src="{{ asset( $item->category_image) }}" alt="" />{{$item->category_name}}</a>
                                    </li>
                                    @endif
                                   @endforeach
                                </ul>
                                <ul class="end">
                                    @foreach($categories as $item)
                                    @if($loop->index > 4)
                                    <li>
                                        <a href="{{ url('product/category/'.$item->id.'/'.$item->category_slug) }}"> <img src="{{ asset( $item->category_image) }}" alt="" />{{$item->category_name}}</a>
                                    </li>
                                    @endif
                                   @endforeach

                                </ul>
                            </div>
                            <div class="more_slide_open" style="display: none">
                                <div class="d-flex categori-dropdown-inner">
                                    <ul>
                                        <li>
                                            <a href="shop-grid-right.html"> <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-1.svg') }}" alt="" />Milks and Dairies</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-2.svg') }}" alt="" />Clothing & beauty</a>
                                        </li>
                                    </ul>
                                    <ul class="end">
                                        <li>
                                            <a href="shop-grid-right.html"> <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-3.svg') }}" alt="" />Wines & Drinks</a>
                                        </li>
                                        <li>
                                            <a href="shop-grid-right.html"> <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-4.svg') }}" alt="" />Fresh Seafood</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="more_categories"><span class="icon"></span> <span class="heading-sm-1">Show more...</span></div>
                        </div>
                    </div>
                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                        <nav>
                            <ul>

                                <li>
                                    <a class="active" href="{{ url('/') }}">Home  </a>

                                </li>


    @php

    $categories = App\Models\Category::orderBy('category_name','ASC')->limit(7)->get();

    @endphp

                                @foreach($categories as $category)
                                <li>
                                    <a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug) }}">{{$category->category_name}} <i class="fi-rs-angle-down"></i></a>

    @php

    $subcategories = App\Models\SubCategory::where('category_id', $category->id)->orderBy('subcategory_name','ASC')->get();

    @endphp
                                    <ul class="sub-menu">
                                        @foreach($subcategories as $subcategory)
                                        <li><a href="{{ url('product/subcategory/'.$subcategory->id.'/'.$subcategory->subcategory_slug) }}">{{ $subcategory->subcategory_name}}</a></li>
                                       @endforeach
                                    </ul>
                                </li>
                                @endforeach
                                <li>

                                    <a href="{{route('customer.contact')}}">Contact</a>                                </li>

                                    <a href="{{ route('home.blog') }}">Blog</a>
                                </li>

                            </ul>
                        </nav>
                    </div>
                </div>

                @php
                $company = App\Models\Company::first();
                @endphp
                <div class="hotline d-none d-lg-flex">
                    <img src="{{ asset('frontend/assets/imgs/theme/icons/phone-call.svg') }}" alt="hotline" />
                    <p>@if(!empty($company->chelplineno)){{ $company->chelplineno }}@else 1900-800 @endif<span>@if(!empty($company->chelplineslogan)){{ $company->chelplineslogan }}@else 24/7 Support Center @endif</span></p>
                </div>
                <div class="header-action-icon-2 d-block d-lg-none">
                    <div class="burger-icon burger-icon-white">
                        <span class="burger-icon-top"></span>
                        <span class="burger-icon-mid"></span>
                        <span class="burger-icon-bottom"></span>
                    </div>
                </div>
                <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">
                        <div class="header-action-icon-2">
                            <a href="{{ route('wishlist') }}">
                                <img class="svgInject" alt="Nest" src="{{ asset('frontend/assets/imgs/theme/icons/icon-heart.svg') }}" />
                                <span class="pro-count blue" id="wishQty">0</span>
                            </a>
                            <a href="{{ route('wishlist') }}"><span class="lable">Wishlist</span></a>
                        </div>
                        <div class="header-action-icon-2">
                            <a class="mini-cart-icon" href="{{ route('mycart') }}">
                                <img alt="Nest" src="{{ asset('frontend/assets/imgs/theme/icons/icon-cart.svg') }}" />
                                <span class="pro-count blue" id="cartQty">0</span>
                            </a>
                            <a href="{{ route('mycart') }}"><span class="lable">Cart</span></a>
                            <div class="cart-dropdown-wrap cart-dropdown-hm2">


                                <!-- mini cart start with ajax -->

                                <div id="miniCart">

                                </div>


                                <!-- end mini cart start with ajax -->


                                <div class="shopping-cart-footer">
                                    <div class="shopping-cart-total">
                                        <h4>Total <span id="cartSubTotal">Rs.</span></h4>
                                    </div>
                                    <div class="shopping-cart-button">
                                        <a href="{{ route('mycart') }}" class="outline">View cart</a>
                                        <a href="{{ route('checkout') }}">Checkout</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- End Header  -->

<style>
    #searchProducts{
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: #ffffff;
        z-index: 999;
        border-radius: 8px;
        margin-top: 5px;

    }
</style>

<script>
    function search_result_show(){
        $("#searchProducts").slideDown();
    }

    function search_result_hide(){
        $("#searchProducts").slideUp();
    }
</script>




<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="{{ url('/') }}"><img src=@if(empty($company->cimage))"{{ asset('frontend/assets/imgs/theme/brandlogo.png') }}"@else {{asset($company->cimage)}} @endif style="height:4rem;width:auto;object-fit:contain" alt="logo" /></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="{{ route('product.search') }}" method="post">
                    @csrf


                    <input onfocus="search_result_show()" onblur="search_result_hide()" name="search" id="search" placeholder="Search for items..." />

                    <div id="searchProducts"></div>

                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu font-heading">
                        <li class="menu-item-has-children">
                            <a href="{{ url('/') }}">Home</a>

                        </li>
                        @php

                        $categories = App\Models\Category::orderBy('category_name','ASC')->limit(7)->get();

                        @endphp

                                                    @foreach($categories as $category)
                                                    <li>
                                                        <li class="menu-item-has-children">
                                                        <a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug) }}">{{$category->category_name}} </a>
                                                        <ul class="dropdown">

                        @php

                        $subcategories = App\Models\SubCategory::where('category_id', $category->id)->orderBy('subcategory_name','ASC')->get();

                        @endphp
                                                        <ul class="sub-menu">
                                                            @foreach($subcategories as $subcategory)
                                                            <li><a href="{{ url('product/subcategory/'.$subcategory->id.'/'.$subcategory->subcategory_slug) }}">{{ $subcategory->subcategory_name}}</a></li>
                                                           @endforeach
                                                        </ul>
                                                    </ul>
                                                    </li>
                                                </li>
                                                    @endforeach
                                                    <li>

                                                        <a href="{{route('customer.contact')}}">Contact</a>                                </li>

                                                        <a href="{{ route('home.blog') }}">Blog</a>
                                                    </li>
                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap">

                <div class="single-mobile-header-info">
                    @auth


                                <span href="">Click <a href="{{ route('dashboard') }}" style="background-color: rgba(70, 129, 244, 0.9); width:40px; text-align:center; color:#fff; border-radius:8px;">here</a> to redirect into your dashboard</span>

                                @else

                                <a href="{{ route('login') }}">Login</a>

                                <a href="{{ route('register') }}">Register</a>

                                @endauth

                </div>
                <div class="single-mobile-header-info">
                    <li>Need help? Call Us: <strong class="text-brand"> @if(!empty($company->cnumber)){{ $company->cnumber }}@else +1800-900 @endif</strong></li>
                </div>
            </div>
            <div class="mobile-social-icon mb-50">
                <h6 class="mb-15">Follow Us</h6>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-facebook-white.svg') }}" alt="" /></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-twitter-white.svg') }}" alt="" /></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-instagram-white.svg') }}" alt="" /></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-pinterest-white.svg') }}" alt="" /></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-youtube-white.svg') }}" alt="" /></a>
            </div>
            <p class="font-sm mb-0">&copy; 2023 - Multi Vendors <br />All rights reserved</p>
        </div>
    </div>
</div>

