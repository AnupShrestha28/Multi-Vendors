@extends('dashboard')
@section('user')

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

<div class="page-header breadcrumb-wrap">
    <div class="container">
        <div class="breadcrumb">
            <a href="index.html" rel="nofollow"><i class="fi-rs-home mr-5"></i>Home</a>
            <span></span> User Account
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


                    <div class="col-md-9">
                        <div class="tab-content account dashboard-content pl-50">
                            <div class="tab-pane fade active show" id="dashboard" role="tabpanel" aria-labelledby="dashboard-tab">
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
                                                    <select required name="zones" id="zones" style="height:64px"class="form-control">
                                                        <option value="" disabled selected>Choose Zone</option>
                                                        <option value=@if($userData->zone) "{{ $userData->zone }}" disabled selected @endif>@if($userData->zone) {{ $userData->zone }}  @endif</option>
                                                </select>
                                               </div>
                                            <div class="col-md-3">
                                                <label>District <span class="required">*</span></label>

                                            <select style="height:64px" required name="districts" id="districts" class="form-control">
                                                    <option value="" disabled selected>Choose District</option>
                                                    <option value=@if($userData->district) "{{ $userData->district }}" disabled selected @endif>@if($userData->district) {{ $userData->district  }} @endif</option>
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

           zonesel.onchange = function() {
    districtsel.length = 1;

    if(this.selectedIndex<1)return;
    var z = stateObject[this.value];
    for (var i = 0; i < z.length; i++) {
      districtsel.options[districtsel.options.length] = new Option(z[i], z[i]);
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
