
<style>
    .images {
        margin: 8px;


        position: relative;


    }

    .images img {
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

    .images:hover .image-overlay {
        opacity: 1;

    }


    .images:hover .image-info {
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
        </div>


    </div>
    <div class="topline draft-line">

    </div>
    <div class="content-box-lg drafting">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div id="photos" class="owl-carousel owl-theme">
                        <div class="images">
                            <img src="images/1.png" alt="buddha" class="img-responsive">
                            <div class="image-overlay">
                                <div class="image-info text-center">
                                    <h3> Name</h3>
                                </div>
                            </div>
                        </div>


                        <div class="images">
                            <img src="images/benches.jpg" alt="buddha" class="img-responsive">
                            <div class="image-overlay">
                                <div class="image-info text-center">
                                    <h3>Name</h3>
                                </div>
                            </div>
                        </div>


                        <div class="images">
                            <img src="images/bridge.jpg" alt="buddha" class="img-responsive">
                            <div class="image-overlay">
                                <div class="image-info text-center">
                                    <h3>Name</h3>
                                </div>
                            </div>
                        </div>


                        <div class="images">
                            <img src="images/1.png" alt="buddha" class="img-responsive">
                            <div class="image-overlay">
                                <div class="image-info text-center">
                                    <h3>Name</h3>
                                </div>
                            </div>
                        </div>


                        <div class="images">
                            <img src="images/1.png" alt="" class="img-responsive">
                            <div class="image-overlay">
                                <div class="image-info text-center">
                                    <h3>Name</h3>

                                </div>
                            </div>
                        </div>


                        <div class="images">
                            <img src="images/1.png" alt="" class="img-responsive">
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
<script src="jquery.js"></script>
<script src="owl.carousel.min.js"></script>
<script>
$(function () {
    $("#photos").owlCarousel({
        items: 6,
        autoplay: false,
        smartSpeed: 600,
        loop: true,
        autoplayHoverPause: true,
        nav: true,
        dots: false,
        navText: ['<i class="fa fa-angle-left left"></i>',
            '<i class="fa fa-angle-right right"></i>'
        ],
        responsive: {

            0: {
                items: 1
            },

            480: {
                items: 6
            },
        }
    });
});
</script>
