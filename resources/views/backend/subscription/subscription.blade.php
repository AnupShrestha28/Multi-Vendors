@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
				<!--breadcrumb-->
				<div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
					<div class="breadcrumb-title pe-3">All Subscribers</div>
					<div class="ps-3">
						<nav aria-label="breadcrumb">
							<ol class="breadcrumb mb-0 p-0">
								<li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
								</li>
								<li class="breadcrumb-item active" aria-current="page">All Subscribers</li>
							</ol>
						</nav>
					</div>
                    <div class="ms-auto">
						<div class="btn-group">

						<a href="{{ route('send.email-subscribers')}}" class="btn btn-primary">Send Email to Subscriber</a>
						</div>
					</div>
				</div>
				<!--end breadcrumb-->
				<hr/>
				<div class="card">
					<div class="card-body">
						<div class="table-responsive">
							<table id="example" class="table table-striped table-bordered" style="width:100%">
								<thead>
									<tr>
										<th>S.No</th>
										<th>Subscriber Email</th>
										<th>Status</th>
										<th>Subscribed At</th>
										<th>Action</th>

									</tr>
								</thead>
								<tbody>
                                    @foreach($allsubscribers as $key => $item)
									<tr>
										<td>{{$key+1 }}</td>
										<td>{{$item->email}}</td>
                                        <td> @if($item->status == 1)

											<span class="badge rounded-pill bg-success">Active</span>

											@else

											<span class="badge rounded-pill bg-danger">InActive</span>

										@endif
										</td>
										<td>{{ $item->created_at }}</td>
										<td>
                                            <a href="{{ route('delete.subscribers',$item->id)}}" class="btn btn-danger">Delete</a>
                                            @if($item->status == 1)

											<a href="{{ route('subscriber.inactive',$item->id)}}" class="btn btn-primary" title="Inactive">Inactive</a>

											@else

											<a href="{{ route('subscriber.active',$item->id)}}" class="btn btn-success" title="Active">Active</a>

											@endif
                                        </td>

									</tr>
									@endforeach
								<tfoot>
                                    <tr>
										<th>S.No</th>
										<th>Subscriber Email</th>
										<th>Status</th>
										<th>Subscribed At</th>
										<th>Action</th>

									</tr>
								</tfoot>


							</table>


						</div>
					</div>
				</div>

			</div>

@endsection
