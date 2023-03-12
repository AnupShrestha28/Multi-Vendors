@extends('frontend.master_dashboard')
@section('main')




  <link rel="stylesheet" href="{{ asset('frontend/contactassets/bundles/datatables/datatables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/contactassets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/contactassets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/contactassets/css/components.css') }}">

  <link rel="stylesheet" href="{{asset('frontend/contactassets/css/custom.css')}}">


  <div>
    <div class="main-wrapper main-wrapper-1">



      <div class="px-4 py-6">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header justify-content-center">
                    <h3 style="font-size: 22px">Your Support Ticket</h3>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>

                          <tr>
                            <th>
                              TID
                            </th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Priority</th>
                            <th>Sent At</th>
                            <th>Show Details</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                            @if(!empty($contact))
                            @foreach($contact as $item)
                          <tr>
                            <td>
                              {{ $item->ticketid }}
                            </td>
                            <td>
                                {{Illuminate\Support\Str::limit($item->subject, $limit = 30, $end = '...') }}

                            </td>
                            <td class="align-middle">
                                {{Illuminate\Support\Str::limit($item->message, $limit = 30, $end = '...') }}
                            </td>
                            <td>
                                @switch($item->priority)
                                @case('High')
                                <div class="badge badge-primary badge-shadow">{{ $item->priority }}</div>
                                @break
                                @case('Medium')
                                <div class="badge badge-success badge-shadow">{{ $item->priority }}</div>
                                @break
                                @case('Low')
                                <div class="badge badge-info badge-shadow">{{ $item->priority }}</div>
                                @break
                                @default
                                <div class="badge badge-primary badge-shadow">{{ $item->priority }}</div>
                                @endswitch
                            </td>
                            <td>
                            {{ $item->created_at }}
                            </td>
                            <td><button subject="{{ $item->subject }}" message="{{ $item->message }}" class="btn btn-primary" data-toggle="modal" data-target=".bd-example-modal-lg" >Detail</button></td>
                            <td><span  class="badge badge-secondary">@if($item->readstatus==0) Delivered @elseif($item->readstatus==2) Replied @else Seen @endif</span></td>
                          </tr>
                          @endforeach
                       @endif
                        </tbody>
                      </table>
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

  <div id="modal-reply" class="modal fade  bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
  aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content" id="contact-support">
      <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabel" name="subject"></h5>
      </div>
      <div class="modal-body"  >
                  <div class="d-flex" style="flex-direction: column;gap:10px">

                    <span name="message">  </span>
                  </div>
      </div>

      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>

  <script src="{{ asset('frontend/contactassets/js/app.min.js') }}"></script>
  <!-- JS Libraies -->
  <script src="{{ asset('frontend/contactassets/bundles/datatables/datatables.min.js') }}"></script>
  <script src="{{ asset('frontend/contactassets/bundles/datatables/DataTables-1.10.16/js/dataTables.bootstrap4.min.js') }}"></script>
  <script src="{{ asset('frontend/contactassets/bundles/jquery-ui/jquery-ui.min.js') }}"></script>
  <!-- Page Specific JS File -->
  <script src="{{ asset('frontend/contactassets/js/page/datatables.js') }}"></script>
  <!-- Template JS File -->
  <script src="{{ asset('frontend/assets/js/script.js') }}"></script>
  <!-- Custom JS File -->
  <script src="{{ asset('frontend/contactassets/js/custom.js') }}"></script>

<script>
    $('#modal-reply').on('show.bs.modal', function (e) {

        var opener=e.relatedTarget;

         //we get details from attributes
        var subject=$(opener).attr('subject');
        var message=$(opener).attr('message');

      //set what we got to our form
        $('#contact-support').find('[name="subject"]').html(subject);
        $('#contact-support').find('[name="message"]').html(message);

      });
</script>
@endsection
