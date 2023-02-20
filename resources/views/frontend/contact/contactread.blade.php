@extends('admin.admin_dashboard')
@section('admin')
<link rel="stylesheet" href="{{ asset('frontend/contactassets/js/app.min.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/contactassets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/contactassets/css/components.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/contactassets/css/custom.css') }}">

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Contact Inbox</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Contact Inbox</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

            </div>
        </div>
    </div>
  <div id="app">
    <div class="main-wrapper main-wrapper-1">


      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3">
                <div class="card">
                  <div class="body">

                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9">
                <div class="card">
                  <div class="boxs mail_listing">
                    <div class="inbox-body no-pad">
                      <section class="mail-list">
                        <div class="mail-sender">
                          <div class="mail-heading">
                            <h4 class="vew-mail-header">
                              <b>{{ $contactread->subject }}</b>
                            </h4>
                          </div>
                          <hr>
                          <div class="media">

                              <img alt="image" src=@if(!empty($contactread->user->photo)) {{ asset('upload/user_images/'.$contactread->user->photo) }} @elseif(!empty($contactread->user->social_avatar)) "{{ $contactread->user->social_avatar }}"  @else "{{ url('upload/no_image.jpg') }}" @endif class="rounded-circle" width="35"
                               title="User Image">

                            <div class="media-body">
                              <span class="date pull-right">{{ $contactread->created_at }}</span>
                              <h5 class="text-primary">{{ $contactread->user->name }}</h5>
                              <small class="text-muted">From:{{ $contactread->user->email }}</small>
                            </div>
                          </div>
                        </div>
                        <div class="view-mail p-t-20">
                          <p>{{ $contactread->message }}</p>

                        </div>

                        <div class="replyBox m-t-20">
                          <p class="p-b-20">click here to
                            <a href="#">Reply</a> or
                            <a href="#">Forward</a>
                          </p>
                        </div>
                      </section>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section>

      </div>

    </div>
  </div>
  <script src="{{ asset('frontend/contactassets/js/app.min.js') }}"></script>
  <script src="{{ asset('frontend/contactassets/js/scripts.js') }}"></script>

  <script src="{{ asset('frontend/contactassets/js/custom.js') }}"></script>
@endsection
