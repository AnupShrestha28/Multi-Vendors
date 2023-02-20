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
      <div class="main-content" style="padding-left:15px;padding-top:0">
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
                    <div class="inbox-center table-responsive">
                      <table class="table table-hover" id="inboxTable">
                        <thead>
                          <tr>
                            <th class="text-center">
                              <label class="form-check-label">
                                <input type="checkbox">
                                <span class="form-check-sign"></span>
                              </label>
                            </th>
                            <th colspan="3">
                              <div class="inbox-header">
                                <div class="mail-option">
                                  <div class="email-btn-group m-l-15">
                                    <a href="#" class="col-dark-gray waves-effect m-r-20" title="back"
                                      data-toggle="tooltip">
                                      <i class="fa fa-arrow-left"></i>Back
                                    </a>

                                    <a id="deleteChecked" class="col-dark-gray waves-effect m-r-20" title="Delete"
                                      data-toggle="tooltip">
                                      <i class="fa fa-trash"></i>Delete
                                    </a>

                                  </div>
                                </div>
                              </div>
                            </th>
                            <th class="hidden-xs" colspan="2">
                              <div class="pull-right">
                                <div class="email-btn-group m-l-15">
                                  <a href="#" class="col-dark-gray waves-effect m-r-20" title="previous"
                                    data-toggle="tooltip">
                                    <i class="fa fa-arrow-left"></i>
                                  </a>
                                  <a href="#" class="col-dark-gray waves-effect m-r-20" title="next"
                                    data-toggle="tooltip">
                                    <i class="fa fa-arrow-right"></i>
                                  </a>
                                </div>
                              </div>
                            </th>
                          </tr>
                        </thead>
                        <tbody>
                            <tr class="unread " style="height: 30px !important">
                                <th class="tbl-checkbox">
                                  <label class="form-check-label">
                                        Select
                                  </label>
                                </th>
                                <th class="hidden-xs">Name</th>
                                <th class="max-texts">

                                    <span style="text-overflow:ellipsis">Priority</span>
                                    <span style="margin-left:5rem">Subject</span>
                                </th>
                                    <td></td>
                                <th class="text-right d-flex" style="align-items: center;justify-content:end" > Date</th>
                              </tr>
                            @foreach($contact as $item)
                          <tr class="unread">
                            <td class="tbl-checkbox" id="checkbox">
                              <label class="form-check-label">
                                <input class="check" value="{{ $item->id }}" type="checkbox">
                                <span class="form-check-sign"></span>
                              </label>
                            </td>
                            <td class="hidden-xs">{{  $item->user->name}}</td>
                            <td class="max-texts">
                              <a href="{{ route('contact.read',$item->id) }}">
                                <span style="text-overflow:ellipsis"class="badge badge-primary">{{ $item->priority }}</span>
                                <strong class="ms-3">{{ $item->subject }}</strong></a>
                            </td>
                                <td></td>
                            <td class="text-right d-flex" style="align-items: center;justify-content:end" > {{ $item->created_at }} </td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div class="row">
                      <div class="col-sm-7 ">
                        <p class="p-15">Showing  1- 15 of {{ $contact->count() }} </p>
                      </div>
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
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="{{ asset('frontend/contactassets/js/app.min.js') }}"></script>
  <script src="{{ asset('frontend/contactassets/js/scripts.js') }}"></script>
  <script src="{{ asset('frontend/contactassets/js/custom.js') }}"></script>
  <script>
    $(document).ready(function() {
        $('#deleteChecked').on('click', function() {
           console.log("hello");
          var selected = [];
          $('#inboxTable .check:checked').each(function() {
            selected.push($(this).val());
          });

          Swal.fire({
            icon: 'warning',
              title: 'Are you sure you want to delete selected record(s)?',
              showDenyButton: false,
              showCancelButton: true,
              confirmButtonText: 'Yes'
          }).then((result) => {
            if (result.isConfirmed) {
              $.ajax({
                type: 'post',
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url:{{ route('contact.delete') }},
                data: {
                  'selected': selected
                },
                success: function (response, textStatus, xhr) {
                  Swal.fire({
                    icon: 'success',
                      title: response,
                      showDenyButton: false,
                      showCancelButton: false,
                      confirmButtonText: 'Yes'
                  }).then((result) => {
                    window.location={{ route('contact.inbox') }}
                  });
                }
              });
            }
          });
        });
    });
  </script>

  @endsection


