@extends('dashboard')
@section('user')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> Order 
        </div>
    </div>
</div>

<div class="page-content pt-50 pb-50">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 m-auto">
                <div class="row">

                     <!-- start col md 3 menu -->
                     @include('frontend.body.dashboard_sidebar_menu')
                    <!-- end col md 3 menu -->


                    <!-- Start col md 9 -->
                    <div class="col-md-9">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Shipping Details</h4>
                                    </div>
                                    <hr>
                                    <div class="card-body">
                                        <table class="table">
                                            <tr>
                                                <th>Shipping Name:</th>
                                                <th>Shipping Name:</th>
                                            </tr>

                                            <tr>
                                                <th>Shipping Name:</th>
                                                <th>Shipping Name:</th>
                                            </tr>

                                            <tr>
                                                <th>Shipping Name:</th>
                                                <th>Shipping Name:</th>
                                            </tr>

                                            <tr>
                                                <th>Shipping Name:</th>
                                                <th>Shipping Name:</th>
                                            </tr>

                                            <tr>
                                                <th>Shipping Name:</th>
                                                <th>Shipping Name:</th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Shipping Details</h4>
                                    </div>
                                    <hr>
                                    <div class="card-body">
                                        <table class="table">
                                            <tr>
                                                <th>Shipping Name:</th>
                                                <th>Shipping Name:</th>
                                            </tr>

                                            <tr>
                                                <th>Shipping Name:</th>
                                                <th>Shipping Name:</th>
                                            </tr>

                                            <tr>
                                                <th>Shipping Name:</th>
                                                <th>Shipping Name:</th>
                                            </tr>

                                            <tr>
                                                <th>Shipping Name:</th>
                                                <th>Shipping Name:</th>
                                            </tr>

                                            <tr>
                                                <th>Shipping Name:</th>
                                                <th>Shipping Name:</th>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <!-- End col-md-6 -->
                        </div> <!-- End row -->
                    </div>

                    <!-- End col md 9 -->




















                </div>
            </div>
        </div>
    </div>
</div>

@endsection
