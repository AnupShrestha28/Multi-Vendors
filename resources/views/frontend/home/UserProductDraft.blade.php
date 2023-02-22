

<style>
    #product-drafting{
        margin-bottom: 1rem;
    }
    .images-user-draft {
        margin: 8px;
        position: relative;
        border:2px solid #ececec;
        border-radius: 10px;
    }
    .images-user-draft img {
        height: 150px;
        width: 250px !important;
        object-fit: cover;
    }
    .image-overlay {
        background-color:rgba(245,245,245,0.7);
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        overflow: hidden;
        opacity: 0;
        -webkit-transition: all 300ms linear;
        transition: all 300ms linear;
    }
    .image-info {
        width: 100%;
        height: 100%;
        padding: 55% 0;
    }
    .image-info h2 {
        color: #000;
        font-size: 20px;
        margin: 0;
        font-weight: bold;
    }
    .image-info p {
        color: #000;
    }
    .images-user-draft:hover .image-overlay {
        opacity: 1;
    }
    .images-user-draft:hover .product-img-action-wrap .product-action-1{
        opacity: 1;
        visibility: visible;
    }
    .images-user-draft:hover .product-img-action-wrap .product-img a img.hover-img{
        opacity: 1;
        visibility: visible;
    }
    .images-user-draft:hover .image-info {
        transition: transform 0.5s ease;
        -webkit-transform: translateY(-70px);
        transform: translateY(-70px);
    }
    .owl-theme .owl-nav [class*=owl-] {
        color: black !important;
        font-size: 2rem;
        background: none !important;
    }
    .product-cart-wrap{
        color:#000 !important;
    }
    .user-draft-product-heading h4 {
        color: black;
        margin-right: 120px;
    }
    .user-draft-product-heading h4:hover {
        color: #f4c613;
    }
    .user-draft-product-heading h1 {
        font-weight: bold;
        font-size: 2rem;
    }
    .owl-prev,
    .owl-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
    }
    .owl-prev {
        left: -3rem;
    }
    .owl-next {
        right: -3rem;
    }
    .draft-line {
        background-color: rgba(65, 105, 225, 0.8);
        width: 100%;
        height: 8px;
        margin: 0.5rem;
    }
    .topline {
        margin-top: 1rem;
    }
    .product-action-100{
        display:flex;
        justify-content: space-evenly;
        align-items:center;
        gap:10px;
        color:#000;
    }
</style>
@php
$lists=App\Models\UserDraft::get();
  @endphp
@if(!empty($lists))
@foreach($lists as $list)
                            @if($list->isdeleted==0)
                            @php
                                $products=App\Models\Product::where('id',$list['product_id'])->get();
                                @endphp

<section id="Product-Drafting">

    <div id="user-draft-product" style="transform: translateY()">
        <div class="user-draft-product-heading">
            <h1 style="text-align: center"><br><br>Recommended Product</h1>
        </div>


    </div>

    </div>
    <div class="content-box-lg drafting">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="photoss" class="owl-carousel owl-theme">




                        @foreach($products as $product)
                        <div class="images-user-draft">
                                <img src="{{ $product->product_thambnail }}" alt="" class="img-responsive">

                                <div class="image-overlay">
                                    <div class="image-info text-center">

                                        <div class="product-content-wrap">
                                            <div class="product-category">

                                                  <p>

                                                      <a href="shop-grid-right.html">{{ $product['category']['category_name']}}</a>
                                                    </p>

                                            </div>

                                            <h2><a href="{{ url('product/details/'.$product->id.'/'.$product->product_slug) }}"> {{ $product->product_name }}</a></h2>
                                        </div>
                                        <div class="product-cart-wrap product-cart-wraped wow animate__animated " data-wow-delay=".1s">
                                        <div class="row product-grid">

                                                <div class="product-img-action-wrap">

                                                    <div class="product-action-1 product-action-100" >


                                                        <a aria-label="Add To Wishlist" class="action-btn" id="{{ $product->id }}" onclick="addToWishlist(this.id)"><i class="fi-rs-heart"></i></a>

                                                        <a aria-label="Compare" class="action-btn" id="{{ $product->id }}" onclick="addToCompare(this.id)"><i class="fi-rs-shuffle"></i></a>

                                                        <a aria-label="Quick view" class="action-btn" data-bs-toggle="modal" data-bs-target="#quickViewModal" id="{{ $product->id }}" onclick="productView(this.id)"><i class="fi-rs-eye"></i></a>
                                                        @php
                                                            $draft= App\Models\UserDraft::where('product_id',$product->id)->first();
                                                        @endphp

                                                        <a href="{{ route('remove.draft',$draft->product_id) }}" ><i class="fi-rs-trash"></i></a>
                                                    </div>
                                                </div>

                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </div>


                            @endforeach



                    </div>
                </div>
            </div>

        </div>
    </div>



</section>
@endif
@endforeach
@endif
