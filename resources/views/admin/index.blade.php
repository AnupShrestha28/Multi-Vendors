@extends('admin.admin_dashboard')
@section('admin')

@php

    $date = date('d-m-y');
    $today = App\Models\Order::where('order_date',$date)->sum('amount');

    $month = date('F');
    $month = App\Models\Order::where('order_month',$month)->sum('amount');

    $year = date('Y');
    $year = App\Models\Order::where('order_year',$year)->sum('amount');

    $pending = App\Models\Order::where('status','pending')->get();

    $vendor = App\Models\User::where('status','active')->where('role','vendor')->get();

    $customer = App\Models\User::where('status','active')->where('role','user')->get();

@endphp

<div class="page-content">

    <div class="row row-cols-1 row-cols-md-2 row-cols-xl-4">
        <div class="col">
            <div class="card radius-10 bg-gradient-deepblue">
             <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-white">Rs.{{ $today }}</h5>
                    
                </div>
             
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">Today's Sale</p>
                </div>
            </div>
          </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-orange">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-white">Rs.{{ $month }}</h5>
                   
                </div>
              
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">Monthly Sale</p>
                </div>
            </div>
          </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-ohhappiness">
            <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-white">Rs.{{ $year }}</h5>
                   
                </div>
              
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">Yearly Sale</p>
                </div>
            </div>
        </div>
        </div>
        <div class="col">
            <div class="card radius-10 bg-gradient-ibiza">
             <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-white">{{ count($pending) }}</h5>
                    
                </div>
              
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">Pending Orders</p>
                </div>
            </div>
         </div>
        </div>

        <div class="col">
            <div class="card radius-10 bg-gradient-ibiza">
             <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-white">{{ count($vendor) }}</h5>
                 
                </div>
              
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">Total Vendors</p>
                </div>
            </div>
         </div>
        </div>


        <div class="col">
            <div class="card radius-10 bg-gradient-ibiza">
             <div class="card-body">
                <div class="d-flex align-items-center">
                    <h5 class="mb-0 text-white">{{ count($customer) }}</h5>
                  
                </div>
               
                <div class="d-flex align-items-center text-white">
                    <p class="mb-0">Total Users</p>
                </div>
            </div>
         </div>
        </div>
    </div><!--end row-->


    @php

        $orders = App\Models\Order::where('status','pending')->orderBy('id','DESC')->limit(10)->get();

    @endphp

      <div class="card radius-10">
        <div class="card-body">
            <div class="d-flex align-items-center">
                <div>
                    <h5 class="mb-0">Orders Summary</h5>
                </div>
                <div class="font-22 ms-auto"><i class="bx bx-dots-horizontal-rounded"></i>
                </div>
            </div>
            <hr>
            <div class="table-responsive">
                <table class="table align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>S.No</th>
                            <th>Date</th>
                            <th>Invoice</th>
                            <th>Amount</th>
                            <th>Payment</th>
                            <th>Status</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($orders as $key => $order)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $order->order_date }}</td>
                            <td>{{ $order->invoice_no}}</td>
                            <td>{{ $order->amount }}</td>
                            <td>{{ $order->payment_method }}</td>
                            <td>
                                <div class="badge rounded-pill bg-light-info text-info w-100">{{ $order->status }}</div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
@endsection