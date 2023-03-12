@extends('frontend.master_dashboard')
@section('main')




  <link rel="stylesheet" href="{{ asset('frontend/contactassets/css/app.min.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/contactassets/bundles/datatables/datatables.min.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/contactassets/bundles/datatables/DataTables-1.10.16/css/dataTables.bootstrap4.min.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/contactassets/css/style.css') }}">
  <link rel="stylesheet" href="{{ asset('frontend/contactassets/css/components.css') }}">

  <link rel="stylesheet" href="{{asset('frontend/contactassets/css/custom.css')}}">


  <div id="app">
    <div class="main-wrapper main-wrapper-1">



      <div class="main-content">
        <section class="section">
          <div class="section-body">
            <div class="row">
              <div class="col-12">
                <div class="card">
                  <div class="card-header">
                    <h4>Your All Support Ticket</h4>
                  </div>
                  <div class="card-body">
                    <div class="table-responsive">
                      <table class="table table-striped" id="table-1">
                        <thead>

                          <tr>
                            <th class="text-center">
                              TID
                            </th>
                            <th>Subject</th>
                            <th>Message</th>
                            <th>Priority</th>
                    <th>Sent At</th>
                    <th>Detail</th>
                            <th>Status</th>
                          </tr>
                        </thead>
                        <tbody>
                            @foreach($contact as $item)
                          <tr>
                            <td>
                              {{ $item->ticketid }}
                            </td>
                            <td>{{$item->subject}}</td>
                            <td class="align-middle">
                             {{$item->message}}
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
                            <td><span  class="badge badge-secondary">@if($item->readstatus==0) Seen @else Delivered @endif</span></td>
                          </tr>
                          @endforeach
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
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="myLargeModalLabel"></h5>

      </div>
      <div class="modal-body contact-support " >
                  <div class="d-flex" style="flex-direction: column;gap:10px">
                    <span name="subject">  </span>
                    <span name="message">  </span>
                  </div>
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
        var firstname=$(opener).attr('first-name');

      //set what we got to our form
        $('#profileForm').find('[name="firstname"]').val(firstname);

      });
</script>
@endsection
