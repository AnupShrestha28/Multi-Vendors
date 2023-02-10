@extends('dashboard')
@section('user')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

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
            <div class="col-lg-10 m-auto">
                <div class="row">
                    <div class="col-md-3">
                        <div class="dashboard-menu">
                            <ul class="nav flex-column" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="dashboard-tab" data-bs-toggle="tab" href="#dashboard" role="tab" aria-controls="dashboard" aria-selected="false"><i class="fi-rs-settings-sliders mr-10"></i>Dashboard</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="orders-tab" data-bs-toggle="tab" href="#orders" role="tab" aria-controls="orders" aria-selected="false"><i class="fi-rs-shopping-bag mr-10"></i>Orders</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="track-orders-tab" data-bs-toggle="tab" href="#track-orders" role="tab" aria-controls="track-orders" aria-selected="false"><i class="fi-rs-shopping-cart-check mr-10"></i>Track Your Order</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="address-tab" data-bs-toggle="tab" href="#address" role="tab" aria-controls="address" aria-selected="true"><i class="fi-rs-marker mr-10"></i>My Address</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="account-detail-tab" data-bs-toggle="tab" href="#account-detail" role="tab" aria-controls="account-detail" aria-selected="true"><i class="fi-rs-user mr-10"></i>Account details</a>
                                </li>
                                        @if(!$userData->social_id)
                                <li class="nav-item">
                                    <a class="nav-link" id="change-password-tab" data-bs-toggle="tab" href="#change-password" role="tab" aria-controls="change-password" aria-selected="true"><i class="fi-rs-user mr-10"></i>Change Password</a>
                                </li>
                                @endif

                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('user.logout' )}}"><i class="fi-rs-sign-out mr-10"></i>Logout</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="tab-content account dashboard-content pl-50">
                            <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="mb-0">Hello {{ Auth::user()->name }}</h3>
                                        <br>


                                        <img id="showImage" src=@if(!empty($userData->photo)) {{ asset('upload/user_images/'.$userData->photo) }} @elseif(!empty($userData->social_avatar)) "{{ $userData->social_avatar }}"  @else "{{ url('upload/no_image.jpg') }}" @endif alt="User" class="rounded-circle p-1 bg-primary" width="110">


                                    </div>
                                    <div class="card-body">
                                        <p>
                                            From your account dashboard. you can easily check &amp; view your <a href="#">recent orders</a>,<br />
                                            manage your <a href="#">shipping and billing addresses</a> and <a href="#">edit your password and account details.</a>
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="orders" role="tabpanel" aria-labelledby="orders-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="mb-0">Your Orders</h3>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                    <tr>
                                                        <th>Order</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Total</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>#1357</td>
                                                        <td>March 45, 2020</td>
                                                        <td>Processing</td>
                                                        <td>$125.00 for 2 item</td>
                                                        <td><a href="#" class="btn-small d-block">View</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>#2468</td>
                                                        <td>June 29, 2020</td>
                                                        <td>Completed</td>
                                                        <td>$364.00 for 5 item</td>
                                                        <td><a href="#" class="btn-small d-block">View</a></td>
                                                    </tr>
                                                    <tr>
                                                        <td>#2366</td>
                                                        <td>August 02, 2020</td>
                                                        <td>Completed</td>
                                                        <td>$280.00 for 3 item</td>
                                                        <td><a href="#" class="btn-small d-block">View</a></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="track-orders" role="tabpanel" aria-labelledby="track-orders-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h3 class="mb-0">Orders tracking</h3>
                                    </div>
                                    <div class="card-body contact-from-area">
                                        <p>To track your order please enter your OrderID in the box below and press "Track" button. This was given to you on your receipt and in the confirmation email you should have received.</p>
                                        <div class="row">
                                            <div class="col-lg-8">
                                                <form class="contact-form-style mt-30 mb-50" action="#" method="post" class="loader-form">
                                                    <div class="input-style mb-20">
                                                        <label>Order ID</label>
                                                        <input name="order-id" placeholder="Found in your order confirmation email" type="text" />
                                                    </div>
                                                    <div class="input-style mb-20">
                                                        <label>Billing email</label>
                                                        <input name="billing-email" placeholder="Email you used during checkout" type="email" />
                                                    </div>
                                                    <button class="submit submit-auto-width btn-loader" type="submit"><span class="btn-text">Track</span><span class="loading-ring"></span></button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="address" role="tabpanel" aria-labelledby="address-tab">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="card mb-3 mb-lg-0">
                                            <div class="card-header">
                                                <h3 class="mb-0">Billing Address</h3>
                                            </div>
                                            <div class="card-body">
                                                <address>
                                                    3522 Interstate<br />
                                                    75 Business Spur,<br />
                                                    Sault Ste. <br />Marie, MI 49783
                                                </address>
                                                <p>New York</p>
                                                <a href="#" class="btn-small">Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="card">
                                            <div class="card-header">
                                                <h5 class="mb-0">Shipping Address</h5>
                                            </div>
                                            <div class="card-body">
                                                <address>
                                                    4299 Express Lane<br />
                                                    Sarasota, <br />FL 34249 USA <br />Phone: 1.941.227.4444
                                                </address>
                                                <p>Sarasota</p>
                                                <a href="#" class="btn-small">Edit</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="account-detail" role="tabpanel" aria-labelledby="account-detail-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Account Details</h5>
                                    </div>
                                    <div class="card-body">

                                        <form method="post" action="{{ route('user.profile.store') }}" enctype="multipart/form-data" class="loader-form">
                                            @csrf

                                            <div class="row">
                                                <div class="form-group col-md-6">
                                                    <label>User Name <span class="required">*</span></label>
                                                    <input required="" class="form-control" name="username" type="text" value="{{ $userData->username }}" />
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label>Full Name <span class="required">*</span></label>
                                                    <input required="" class="form-control" name="name" value="{{ $userData->name }}" />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Email <span class="required">*</span></label>
                                                    <input required="" class="form-control" name="email" type="text" value="{{ $userData->email }}" />
                                                </div>
                                                <div class="form-group col-md-12">
                                                    <label>Phone <span class="required">*</span></label>
                                                    <input required="" class="form-control" name="phone" type="text" value="{{ $userData->phone }}" />

                                                                @if($userData->phone_verified )
                                                                <p class="text-success">Your Phone Number is Verified<svg class ="ms-1" style="height:15px; width: 15px;" id="Layer_1" data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 122.88 116.87"><defs><style>.cls-1{fill:#10a64a;fill-rule:evenodd;}.cls-2{fill:#fff;}</style></defs><title>verified-symbol</title><polygon class="cls-1" points="61.37 8.24 80.43 0 90.88 17.79 111.15 22.32 109.15 42.85 122.88 58.43 109.2 73.87 111.15 94.55 91 99 80.43 116.87 61.51 108.62 42.45 116.87 32 99.08 11.73 94.55 13.73 74.01 0 58.43 13.68 42.99 11.73 22.32 31.88 17.87 42.45 0 61.37 8.24 61.37 8.24"/><path class="cls-2" d="M37.92,65c-6.07-6.53,3.25-16.26,10-10.1,2.38,2.17,5.84,5.34,8.24,7.49L74.66,39.66C81.1,33,91.27,42.78,84.91,49.48L61.67,77.2a7.13,7.13,0,0,1-9.9.44C47.83,73.89,42.05,68.5,37.92,65Z"/></svg></p>
                                                                @elseif(!$userData->phone)

                                                                @else
                                                                <div class="d-flex mt-2 align-middle" style="gap: 10px" >
                                                                <p class="text-danger">Your Phone Number is Not Verified</p>

                                                               <a href="{{ route('otp.sendotp') }}" class="btn btn-success p-1">Click here to verify</a>
                                                            </div>
                                                                @endif
                                                </div>
                                                <div class="form-group">
                                                <div class="row">
                                                  
                                                <input type="hidden" name="" value="Nepal" id="country" >
                                                <div class="col-md-3">
                                                    <label>Zone <span class="required">*</span></label>
                                                    <select required name="zones" id="zones" class="form-control">
                                                        <option value="" disabled selected>Choose Zone</option>
                                                </select>                                         
                                               </div>
                                            <div class="col-md-3">
                                                <label>District <span class="required">*</span></label>

                                            <select required name="districts" id="districts" class="form-control">
                                                    <option value="" disabled selected>Choose District</option>
                                            </select>
                                        </div>
                                        <div class="col-md-6">
                                            <label>Address <span class="required">*</span></label>
                                            <input required="" class="form-control" name="address" type="text" value="{{ $userData->address }}" />

                                        </div>

                                        </div>

                                    </div>


                                                <div class="form-group col-md-12">
                                                    <label>User Photo <span class="required">*</span></label>
                                                    <input class="form-control" name="photo" type="file" id="image" />
                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label> <span class="required">*</span></label>
                                                    <img id="showImage" src="{{ (!empty($userData->photo)) ? url('upload/user_images/'.$userData->photo) : url('upload/no_image.jpg') }}" alt="User" class="rounded-circle p-1 bg-primary" width="110">
                                                </div>

                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-fill-out submit font-weight-bold btn-loader" name="submit" value="Submit"><span class="btn-text">Save Changes</span><span class=" loading-ring"></span></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                                    @if(!$userData->social_id)
                            <!--  change password -->

                            <div class="tab-pane fade" id="change-password" role="tabpanel" aria-labelledby="change-password-tab">
                                <div class="card">
                                    <div class="card-header">
                                        <h5>Change Password</h5>
                                    </div>
                                    <div class="card-body">

                                        <form method="post" action="{{ route('user.update.password') }}"  class="loader-form">
                                            @csrf

                                            @if(session('status'))

                                            <div class="alert alert-success" role="alert">
                                                {{session('status')}}
                                            </div>

                                        @elseif(session('error'))
                                            <div class="alert alert-danger" role="alert">
                                                {{session('error')}}
                                            </div>

                                        @endif

                                            <div class="row">


                                                <div class="form-group col-md-12">
                                                    <label>Old Password <span class="required">*</span></label>
                                                    <input class="form-control @error('old_password') is-invalid @enderror" name="old_password" type="password" id="current_password"placeholder="Old Password" />

                                                    @error('old_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label>New Password <span class="required">*</span></label>
                                                    <input class="form-control @error('new_password') is-invalid @enderror" name="new_password" type="password" id="new_password"placeholder="New Password" />

                                                    @error('new_password')
                                                    <span class="text-danger">{{ $message }}</span>
                                                @enderror

                                                </div>

                                                <div class="form-group col-md-12">
                                                    <label>Confirm New Password <span class="required">*</span></label>
                                                    <input class="form-control" name="new_password_confirmation" type="password" id="new_password_confirmation" placeholder="Confirm New Password" />

                                                </div>



                                                <div class="col-md-12">
                                                    <button type="submit" class="btn btn-fill-out submit font-weight-bold btn-loader" name="submit" value="Submit"><span class="btn-text"><span class="btn-text">Save Changes</span><span class="loading-ring"></span></span><span class="spinner loading-ring"></span></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endif



                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{ asset('frontend/assets/js/zonesanddistrtics.js') }}"></script>
<script>
    window.onload = function() {
        var zonesel = document.getElementById("zones");
        var districtsel = document.getElementById("districts");
       
        for (var x in stateObject) {
          zonesel.options[zonesel.options.length] = new Option(x, x);
        }

        zonesel.onchange = function() {    //empty Chapters- and Topics- dropdowns
       
            //subjectSel.length = 1;   
            districtsel.length = 1;
            //display correct values
            for (var y in stateObject[this.value]) {
              districtsel.appendChild(new Option(stateObject[this.value][y],y));
            }
          }
        
      }





    $(document).ready(function(){
        $('#image').change(function(e){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showImage').attr('src', e.target.result);
            }
            reader.readAsDataURL(e.target.files['0']);
        })
    });
  





</script>



@endsection
