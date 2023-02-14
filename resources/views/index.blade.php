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
</script>



@endsection
