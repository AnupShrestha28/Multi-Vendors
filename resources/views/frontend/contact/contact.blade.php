@extends('frontend.master_dashboard')


@section('main')
  <link rel="stylesheet" href="{{ asset('frontend/contactassets/js/app.min.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/contactassets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/contactassets/css/components.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/contactassets/css/custom.css') }}">

  <div id="app">
    <section class="section">
      <div class="container mt-5">
        <div class="row">
          <div class="col-12 col-md-10 offset-md-1 col-lg-10 offset-lg-1">
            <div class="login-brand">
            </div>
            <div class="card card-primary">
              <div class="row m-0">

                <div class="card-header text-center">
                  <h4>Contact Us</h4>
                </div>
                <div class="card-body">

                  <form action="{{ route('contact.messagesend') }}" id="contactForm" method="POST" class="loader-form">
                    @csrf
                    <div class="col-lg-12">
                      <div class="row">
                        <div class="col-lg-6 ">

                          <div class="form-group floating-addon">
                            <label>Subject</label>
                            <div class="input-group">

                              <input id="subject" type="text" name="subject" class="form-control" style="padding-left:10px !important" autofocus
                                placeholder="Enter Subject">
                            </div>
                          </div>
                        </div>

                        <div class="col-lg-6 p-0">

                          <div class="form-group floating-addon">
                            <label>Priority</label>
                            <div class="input-group">


                              <select name="priority" id="priority" style="border: 1px solid #ececec">
                                <option value="" selected disabled>Choose</option>
                                <option value="High">High</option>
                                <option value="Medium">Medium</option>
                                <option value="Low">Low</option>

                              </select>
                            </div>
                          </div>

                        </div>

                      </div>
                      <div class="row m-0">

                        <div class="col-lg-12 p-0">
                          <div class="form-group">
                            <label>Message</label>
                            <textarea style="height:200px !important" name="message" id="message" class="form-control"
                              placeholder="Enter your message"></textarea>
                          </div>


                        </div>
                      </div>
                      <div class="form-group text-left">
                            <button class="btn btn-loader btn-round btn-lg btn-primary" type="submit"><span class="btn-text">Send Message</span><span class="loading-ring"></span></button>

                        </button>
                      </div>
                    </div>
                  </form>
                </div>


              </div>
            </div>

          </div>
        </div>
      </div>
    </section>
  </div>

  <script src="{{ asset('frontend/contactassets/js/app.min.js') }}"></script>
  <script src="{{ asset('frontend/contactassets/js/scripts.js') }}"></script>
  <script src="{{ asset('frontend/contactassets/js/custom.js') }}"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
@if(auth()->check())
  <script type="text/javascript">
    $(document).ready(function(){
        //loading animation jquery
$('.loader-form-subscribe').on('submit', (e) => {

    $('.btn-text').css('color', 'transparent');
    $('.loading-ring').css('visibility', 'visible');
});

        function loaderremove()
            {
                $('.loading-ring').css('visibility', 'hidden');
                $('.btn-text').css('color', 'white');
            }
        $('#contactForm').validate({
            rules:{
                priority:{
                    required : true,
                },
                subject:{
                    required:true,
                },
                message:{
                    required:true,
                }
            },
            messages:{
                priority:{
                    required: 'Please select Priority',
                },
                subject:{
                    required: 'Please enter subject'
                },
                messsage:{
                    required: 'Please enter some message'
                },

            },
            errorElement : 'span',
            errorPlacement: function(error, element){
                error.addClass('invalid-feedback');
                element.closest('.form-group').append(error);
                loaderremove();
            },
            highlight : function(element, errorClass, validClass){
                $(element).addClass('is-invalid');
                loaderremove();

            },
            unhighlight : function(element, errorClass, validClass){
                $(element).removeClass('is-invalid');

            },
        });
    });
</script>
@endif


  @endsection


