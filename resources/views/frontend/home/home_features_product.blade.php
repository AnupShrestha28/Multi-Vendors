@php

$featured = App\Models\Product::where('featured',1)->orderBy('id','DESC')->limit(10)->get();

@endphp



<section class="section-padding pb-5">
    <div class="container">
        <div class="section-title wow animate__animated animate__fadeIn">
            <h3 class="" > Featured Products </h3>
             
        </div>
        <div class="row">
           
            <div class="col-lg-9 col-md-12 wow animate__animated animate__fadeIn" data-wow-delay=".4s">
                <div class="tab-content" id="myTabContent-1">
                    <div class="tab-pane fade show active" id="tab-one-1" role="tabpanel" aria-labelledby="tab-one-1">
                        <div class="carausel-4-columns-cover arrow-center position-relative">
                            <div class="slider-arrow slider-arrow-2 carausel-4-columns-arrow" id="carausel-4-columns-arrows"></div>
                            <div class="carausel-4-columns carausel-arrow-center" id="carausel-4-columns">


                                @foreach($featured as $product)

                                <div class="product-cart-wrap">
                                    <div class="product-img-action-wrap">
                                        <div class="product-img product-img-zoom">
                                            <a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">
                                                <img class="default-img" src="{{ asset($product->product_thambnail) }}" alt="" />
                                            </a>
                                        </div>
                                        <div class="product-action-1">
                                            <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishlist(this.id)"><i class="fi-rs-heart"></i></a>

                                    <a aria-label="Compare" class="action-btn" id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>

                                    <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                        </div>

                                        @php

                                        $amount = $product->selling_price - $product->discount_price;

                                        $discount = ($amount/$product->selling_price) * 100;

                                        @endphp

                                        <div class="product-badges product-badges-position product-badges-mrg">
                                            @if($product->discount_price == NULL)

                                            <span class="new">No Discount</span>

                                            @else
                                            <span class="hot">{{ round($discount) }}% Off</span>

                                            @endif
                                        </div>
                                    </div>
                                    <div class="product-content-wrap">
                                        <div class="product-category">
                                            <a href="shop-grid-right.html">{{ $product['category']['category_name'] }}</a>
                                        </div>
                                        <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}">{{ $product->product_name }}</a></h2>

                                        @php

                                        $reviewcount = App\Models\Review::where('product_id',$product->id)->where('status',1)->latest()->get();
                                        
                                                                            $average = App\Models\Review::where('product_id',$product->id)->where('status',1)->avg('rating');
                                        
                                                                            @endphp

                                        <div class="product-rate d-inline-block">
                                            @if($average == 0)


                                        @elseif($average == 1 || $average < 2)
                                        <div class="product-rating" style="width: 20%"></div>

                                        @elseif($average == 2 || $average < 3)
                                        <div class="product-rating" style="width: 40%"></div>

                                        @elseif($average == 3 || $average < 4)
                                        <div class="product-rating" style="width: 60%"></div>

                                        @elseif($average == 4 || $average < 5)
                                        <div class="product-rating" style="width: 80%"></div>

                                        @elseif($average == 5 || $average < 5)
                                        <div class="product-rating" style="width: 100%"></div>
                                        @endif
                                        </div>

                                        @if($product->discount_price == NULL)
                                        <div class="product-price mt-10">
                                            <span>Rs.{{ $product->selling_price }} </span>
                                            
                                        </div>

                                        @else
                                        <div class="product-price mt-10">
                                            <span>Rs.{{ $product->discount_price }}</span>
                                            <span class="old-price">Rs.{{ $product->selling_price }}</span>
                                        </div>

                                        @endif
                                        
                                       
                                        <a onclick="productView(this.id)"  id="{{ $product->id }}" data-bs-toggle="modal" data-bs-target="#quickViewModal" class="btn w-100 hover-up"><i class="fi-rs-shopping-cart mr-5"></i>Add</a>

                                    </div>
                                </div>
                                <!--End product Wrap-->

                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!--End tab-pane-->

                   
                </div>
                <!--End tab-content-->
            </div>
            <!--End Col-lg-9-->
        </div>
    </div>
</section>