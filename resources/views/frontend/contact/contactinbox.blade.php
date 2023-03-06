@extends('admin.admin_dashboard')
@section('admin')
<link rel="stylesheet" href="{{ asset('frontend/contactassets/css/style.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/contactassets/css/components.css') }}">
<link rel="stylesheet" href="{{ asset('frontend/contactassets/css/custom.css') }}">

<style>
    .bg-white{
        color: unset ;
    }

    .disabled{
        color: lightgray !important;
        pointer-events: none;
    }
</style>

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Contact Inbox</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Contact Inbox </li>
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
                    <div class="inbox-center table-responsive">
                      <table class="table table-hover" id="inboxTable">
                        <thead>
                          <tr>
                            <th class="text-center">
                              <label class="form-check-label">
                                <input type="checkbox" id="checkAll">
                                <span class="form-check-sign ms-2"> Select All</span>
                              </label>
                            </th>
                            <th colspan="3">
                              <div class="inbox-header">
                                <div class="mail-option">
                                  <div class="email-btn-group m-l-15">


                                    <a id="deleteChecked"><i class="fa fa-trash fs-5"></i><span class="ms-2 fs-6">Delete</span> </a>

                                </div>

                            
                            </div>
                        </div>
                    </th>
                    <th>
{{--
                        <select  name="" id="prioritySelection" class="form-control  " style="width: 70%">
                                <option selected disabled>---Select a priority----</option>
                            <option value="High">High</option>
                            <option value="Medium" >Medium</option>
                            <option value="Low" >Low</option>
                        </select>  --}}


                    </th>
                        @php
                            $unreadcount= App\Models\Contact::where('readstatus',0)->count();
                        @endphp
                    @if($unreadcount)<th style="color:red"><span class="mr-1">({{ $unreadcount }})</span>Unread Messages</th>@endif
                            <th class="hidden-xs" colspan="2">
                              <div class="pull-right">
                                <div class="email-btn-group m-l-15">

                                  <a href="{{  $contact->previousPageUrl() }}"  class="@if($contact->onFirstPage()) disabled @endif col-dark-gray waves-effect m-r-20" title="Previous Page"
                                    data-toggle="tooltip">
                                    <i class="fa fa-arrow-left"></i>
                                  </a>


                                  <a href="{{ $contact->nextPageUrl() }}" class=" @if(!$contact->hasMorePages()) disabled @endif col-dark-gray waves-effect m-r-20" title="Next Page"
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
                                <th>Ticket ID</th>
                                <th class="hidden-xs">Name</th>

                                <th class="max-texts">

                                    <span style="text-overflow:ellipsis">Priority</span>
                                    <span style="margin-left:5rem">Subject</span>
                                </th>
                                    <td></td>
                                    <td></td>
                                    <th class="text-right d-flex" style="align-items: center;justify-content:end" > Date</th>
                              </tr>


                            @foreach($contact as $item)
                          <tr class="unread fs-6">
                            <td class="tbl-checkbox" id="checkbox">
                              <label class="form-check-label">
                                <input class="check" value="{{ $item->id }}" type="checkbox">
                                <span class="form-check-sign"></span>
                              </label>
                            </td>
                            <td>@if($item->readstatus!=0){{  $item->ticketid}} @else <strong >{{ $item->ticketid }}</strong> @endif</td>
                            <td class="hidden-xs ">@if($item->readstatus!=0){{  $item->user->name}} @else <strong >{{ $item->user->name }}</strong> @endif</td>
                            <td class="max-texts">
                              <a href="{{ route('contact.read',$item->id) }}">
                                    @switch($item->priority)
                                    @case('High')
                                    <span class="badge badge-primary">{{ $item->priority }}</span>
                                    @break
                                    @case('Medium')
                                    <span class="badge badge-success">{{ $item->priority }}</span>
                                    @break
                                    @case('Low')
                                    <span class="badge badge-info">{{ $item->priority }}</span>
                                    @break
                                    @default
                                    <span class="badge badge-primary">{{ $item->priority }}</span>
                                    @endswitch







                                    @if($item->readstatus==0)<strong class="ms-3">{{ $item->subject }}</strong>@else <span class="ms-3">{{ $item->subject }}</span> @endif</a>
                            </td>
                                <td></td>
                                <td></td>
                            <td class="text-right d-flex" style="align-items: center;justify-content:end" >@if($item->readstatus!=0) {{ $item->created_at }} @else  <strong> {{ $item->created_at }}</strong> @endif</td>
                          </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                    <div class="row">
                      <div class="col-sm-7 ">
                        @if ($contact->links()->paginator->hasPages())

                        <p  class="p-15 ms-3" >{{ $contact->links() }}</p>
                        <p class="p-15">Showing {{ $contact->firstItem() }} to {{ $contact->lastItem() }}
                            of  {{$contacts->count()}} entries
                        </p>
                        @endif



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

            //$("#prioritySelection").change (function () {
             //   var selectedCountry = $(this).children("option:selected").val();
           // });


        $('#checkAll').click(function() {
            if ($(this).is(":checked")) {
                $('.check').prop("checked", true);
            }
            else{
                $('.check').prop("checked", false);

            }
        });
        $('#deleteChecked').on('click', function() {
          var selected = [];
          if($('.check').is(':checked'))
          {

              $('#inboxTable .check:checked').each(function() {
                  selected.push($(this).val());
                $(this).closest('.unread').addClass('checkbox-checked');
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
                url:'/contact/delete',
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
                    window.location='{{ route('contact.inbox') }}'
                  });
                }
              });
            }
          });
        }
        else{
            toastr.info("Please select at least one item to delete");
        }
        });
    });
  </script>

  @endsection

