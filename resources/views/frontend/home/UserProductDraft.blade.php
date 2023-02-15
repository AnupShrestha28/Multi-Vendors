



<style>
    .images-user-draft {
        margin: 8px;
        position: relative;
    }

    .images-user-draft img {
        height: 150px;
        width: 250px !important;
        object-fit: cover;
    }

    .image-overlay {
        background-color: rgba(33, 34, 38, .9);
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

    .image-info h3 {
        color: #ffffff;
        font-size: 20px;
        margin: 0;
        font-weight: bold;
        color: #f4c613;


    }

    .image-info p {
        color: #fff;
    }

    .images-user-draft:hover .image-overlay {
        opacity: 1;

    }


    .images-user-draft:hover .image-info {
        transition: transform 0.5s ease;
        -webkit-transform: translateY(-30px);
        transform: translateY(-30px);
    }

    .owl-theme .owl-nav [class*=owl-] {
        color: black !important;
        font-size: 2rem;
        background: none !important;
    }




    .gallery-heading h4 {
        color: black;
        margin-right: 120px;

    }

    .gallery-heading h4:hover {
        color: #f4c613;
    }


    .gallery-heading h1 {
        font-family: 'Raleway', 'Century Gothic', sans-serif;
        font-weight: bold;
    }

    .owl-prev,
    .owl-next {
        position: absolute;
        top: 50%;
        transform: translateY(-50%);
    }

    .owl-prev {
        left: -6rem;
    }

    .owl-next {
        right: -6rem;
    }

    .draft-line {
        background-color: rgba(65, 105, 225, 0.8);
        width: 100%;
        height: 15px;
        margin: 1.5rem;
    }

    .topline {
        margin-top: 3rem;
    }

</style>
<section id="galleries">

    <div id="gallery">
        <div class="gallery-heading">
            <h1 style="text-align: center"><br><br>Product Drafting</h1>

            @php

            foreach($lists as $list)
            {
                    $products=App\Models\Product::where('id',$list['product_id'])->get();
                    foreach($products as $product)
                    {

                        dump($product->product_thambnail);
                    }
            }

            @endphp


        </div>


    </div>
    <div class="topline draft-line">

    </div>
    <div class="content-box-lg drafting">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="photoss" class="owl-carousel owl-theme">

                        <div class="images-user-draft">
                            <img src="{{ asset('frontend/assets/imgs/theme/brandlogo.png')}}" alt="" class="img-responsive">
                            <div class="image-overlay">
                                <div class="image-info text-center">
                                    <h3>Name</h3>
                                </div>
                            </div>
                        </div>




                    </div>
                </div>
            </div>

        </div>
    </div>

    <div class="bottomline draft-line"></div>


</section>

