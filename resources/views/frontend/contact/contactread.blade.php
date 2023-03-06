@extends('admin.admin_dashboard')
@section('admin')
<link rel="stylesheet" href="asset('frontend/contactassets/css/app.min.css')">
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
                        @php
                            $allreplies= App\Models\ContactReply::where('contact_id',$contactread->id)->get();
                        @endphp

                        @if($allreplies->isEmpty())
                            <h5 class="text-center">No Replies Yet</h5>
                        @else
                        <div>
                            <h5 class="text-center">All Replies</h5>

                            @foreach($allreplies as $reply)
                            <div class="mt-4 mb-4s">
                                <span>Replied At: {{ $reply->created_at }}</span>
                                <div class="mt-2" style="font-size: 1rem">{{$reply->reply_text}}</div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        <h6 id="replyLabel" class="mt-4"></h6>

                            <form action="{{route('contact.replySend')}}" method="post">
                                @csrf
                                <input type="hidden" name="contactid"  value="{{ $contactread->id }}">
                                <div class="replyBox m-t-20" >
                                    <p class="p-b-20">click here to
                                        <a id="reply" style="color:#6777ef;font-weight:500;cursor: pointer;">Reply</a> or

                                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg">
                                            Quick Reply</button>                                    </p>
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
<input type="hidden" id="contact_id" value="{{ $contactread->id }}">

  <div id="modal-reply" class="modal fade  bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="myLargeModalLabel">All Quick Reply</h5>

        </div>
        <div class="modal-body " >
            @php
                $allquickreplies= App\Models\QuickReply::get();

            @endphp
                    @if($allquickreplies->isEmpty())
                    <h6>No Quick Replies..Click to add some quick replies <a href="{{ route('manage.quickreply') }}">Add</a></h6>
                    @else
                    <div class="d-flex" style="flex-direction: column;gap:10px">

                        @foreach ($allquickreplies as $quickreply )
                        <button onclick="replySend(this)" class="btn btn-primary" style="display:block;overflow:hidden;text-overflow: ellipsis" value="{{ $quickreply->quickreplytext }}">
                            {{ $quickreply->quickreplytext }}
                        </button>
                        @endforeach
                    </div>

                    <div class="modal-footer">
                        Click <a href="{{ route('manage.quickreply') }}">here</a> to add more quick replies
                    </div>

            @endif
        </div>

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


function replySend(a){
    var quickreplytext=a.getAttribute('value');

    var contactid= $('#contact_id').val();

        $.ajax({
           url:'/contact/reply/send',
           type:'POST',
           data: {
            contactid:contactid,quickreplytext:quickreplytext,_token: '{{csrf_token()}}'
        },
           success:function(response){

            if(response=='sent')

            toastr.success('Quick Reply sent successfully')
            const myTimeout = setTimeout(location.reload(), 4000);

           },
           error:function(){
              toastr.error('error');
           }
        });

}

  </script>
@endsection
