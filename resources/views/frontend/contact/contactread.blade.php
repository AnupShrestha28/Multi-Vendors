@extends('admin.admin_dashboard')
@section('admin')
<link rel="stylesheet" href="{{ asset('frontend/contactassets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/contactassets/css/components.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/contactassets/css/custom.css') }}">
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>


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


      <div class="main-content" style="padding-left:15px;padding-top:0;transform:translateY(-20px)">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="body">

                  </div>
                </div>
              </div>
              <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                  <div class="boxs mail_listing">
                    <div class="inbox-body no-pad">
                      <section class="mail-list">
                        <div class="mail-sender">
                          <div class="mail-heading">
                            <h4 class="vew-mail-header">
                             <a  class="fs-6 text-dark" href="{{ route('contact.inbox') }}"><i class="fa fa-arrow-left"></i><span class="ms-1"> Back to Inbox</span></a> <span class="ms-5 fs-5 text-capitalize">subject:<b class="ms-2" >{{ $contactread->subject }}</b></span>
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
                        <h6 id="replyLabel"></h6>
         
                            <form action="{{route('contact.replySend')}}" method="post">
                                @csrf
                                <input type="hidden" name="contactid" value="{{ $contactread->id }}">
                                <div class="replyBox m-t-20" >
                                    <p class="p-b-20">click here to
                                        <a id="reply" style="color:#6777ef;font-weight:500;cursor: pointer;">Reply</a> or
                                        <a id="quickreply" style="color:#6777ef;font-weight:500;cursor: pointer;">Quick Reply</a>
                                    </p>
                              </div>

                              <input type="hidden" name="replyText" id="replyText">
                        <div>   
                            <button  type="submit" id="replySend" class="btn btn-primary mt-2" style="display:none">Send</button>
                        </div>
                    </form>
                        

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

  <script>

     
            $('#reply').click(function(){
                $('.replyBox').html('');
                    $('#replyLabel').text('Replying to Message');
                $('.replyBox').attr('contenteditable','true'); 
                $('.replyBox').css('height','220px');
                $('#replySend').css('display','block');
            });

            $('.replyBox').keydown(function(){
               var textbox= $('.replyBox').text();
               $('#replyText').val(textbox);

            })
          
        


  </script>
@endsection
