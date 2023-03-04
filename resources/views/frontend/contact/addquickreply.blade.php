@extends('admin.admin_dashboard')
@section('admin')

<div class="page-content">
    <!--breadcrumb-->
    <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
        <div class="breadcrumb-title pe-3">Add Quick Reply</div>
        <div class="ps-3">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0 p-0">
                    <li class="breadcrumb-item"><a href="javascript:;"><i class="bx bx-home-alt"></i></a>
                    </li>
                    <li class="breadcrumb-item active" aria-current="page">Add Quick Reply</li>
                </ol>
            </nav>
        </div>
        <div class="ms-auto">

            </div>
        </div>
    </div>
    <!--end breadcrumb-->
    <div class="container">
        <div class="main-body">
            <div class="row">

                <div class="col-lg-10">
                    <div class="card">
                        <div class="card-body">

                            <form id="myForm" method="post" action="{{ route('add.quickreply') }}" >
                                @csrf


                            <div class="row mb-3">
                                <div class="col-sm-3">
                                    <h6 class="mb-0">Quick Reply Text</h6>
                                </div>
                                <div class="form-group col-sm-9 text-secondary">
                                    <input type="text" name="quickreplytext" class="form-control" />
                                </div>
                            </div>



                            <div class="row">
                                <div class="col-sm-3"></div>
                                <div class="col-sm-9 text-secondary">
                                    <input type="submit" class="btn btn-primary px-4" value="Add Quick Reply" />
                                </div>
                            </div>
                        </div>

                    </form>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

@endsection