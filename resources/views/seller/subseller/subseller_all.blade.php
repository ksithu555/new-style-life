<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@extends('seller.seller_dashboard')
@section('seller')
<!-- Section start -->
<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            @include('components.messagebox')
            <div class="col-sm-12">
                <div class="card card-table">
                    <!-- Table Start -->
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>Subseller List</h5>
                            <div class="right-options">
                                <ul>
                                    <li>
                                        <a class="btn btn-solid" href="{{ route('add.subseller') }}">Add Subseller</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="user-table ticket-table review-table theme-table table"
                                    id="table_id">

                                    <thead>
                                        <tr>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Phone</th>
                                                <th>Photo</th>
                                                <th>Option</th>
                                            </tr>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($subseller->isEmpty())
                                            <tr>
                                                <td colspan="9">No data available</td>
                                            </tr>
                                        @else
                                            @foreach ($subseller as $key => $item)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y/m/d') }}<br>
                                                        {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}</td>
                                                    <td>{{ $item->name }}</td>
                                                    <td>{{ $item->email }}</td>
                                                    <td>{{ $item->phone }}</td>
                                                    <td>
                                                        <div class="table-image">
                                                            <img src="{{ (!empty($item->user_photo)) ? url('images/'.$item->user_photo) : url('upload/profile/profile.jpg') }}" width="50" height="50" >
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <ul>
                                                            <li>
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModalToggle{{ $item->id }}">
                                                            <i class="ri-delete-bin-line"></i>
                                                            </li>
                                                        </ul>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- Table End -->
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
<!-- Section End -->


<!-- Delete Modal Box Start -->
@foreach( $subseller as $key => $item )
    <div class="modal fade theme-modal remove-coupon" id="deleteModalToggle{{ $item->id }}" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-block text-center">
                    <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="remove-box">
                        <p>The data will be deleted permanently.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('delete.subseller') }}">
                        @csrf
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            <button type="submit" class="btn btn-animation">Yes</button>
                    </form>
                    <button type="button" class="btn btn-animation btn-secondary" data-bs-dismiss="modal"
                    style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- Delete Modal Box End -->

@endsection