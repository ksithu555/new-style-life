@extends('seller.seller_dashboard')
@section('seller')
<div class="page-body">
<!-- New Subseller Add Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-8 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Subseller Information</h5>
                                </div>

                                <form method="POST" action="{{ route('update.subseller') }}" class="theme-form theme-form-2 mega-form" >
                                    @csrf
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Name</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="name" value="{{ $subseller->name }}">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Email</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="email" name="email" value="{{ $subseller->email }}">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="password" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Confirm
                                            Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="confirmed" class="form-control">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Phone
                                            Number</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="phone" value="{{ $subseller->phone }}" pattern="\d*">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-animation" data-bs-toggle="modal" data-bs-target="#confrimModalToggle">Update</button>

                                    <!-- Modal -->
                                    <div class="modal fade theme-modal remove-coupon" id="confrimModalToggle" aria-hidden="true" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header d-block text-center">
                                                    <h5 class="modal-title w-100" id="exampleModalLabel22">Do you want to update it?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="remove-box">
                                                        <p>Please check information before saving.</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-animation">Yes</button>
                                                    <button type="button" class="btn btn-animation btn-secondary" data-bs-dismiss="modal">No</button>
                                                </div>
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
    </div>
    <!-- New Subseller Add End -->
</div>
@endsection