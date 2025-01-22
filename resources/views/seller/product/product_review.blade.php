<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@extends('seller.seller_dashboard')
@section('seller')
<style>
    .break-line {
    width: 200px;
    word-wrap: break-word;
    white-space: normal;
    }
</style>
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
                            <h5>Product Reviews</h5>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="user-table ticket-table review-table theme-table table"
                                    id="table_id">

                                    <thead>
                                        <tr>
                                            <th>No</th>
                                            <th>Date</th>
                                            <th>Customer Name</th>
                                            <th>Product Name</th>
                                            <th>Rating</th>
                                            <th>Comment</th>
                                            <th>Status</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($review->isEmpty())
                                            <tr>
                                                <td colspan="9">No data available</td>
                                            </tr>
                                        @else
                                        @foreach ($review as $key => $item)
                                        <tr>
                                            <td>{{ ($ttl+1) - ($review->firstItem() + $key) }}</td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y/m/d') }}<br>
                                                {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}  </td>
                                            <td>{{ $item->user->name }}</td>

                                            <td>
                                                <div class="break-line">
                                                    <h6>
                                                        {!! $item->product->product_name !!}
                                                    </h6>
                                                </div>
                                            </td>

                                            @if ($item->stars_rated == NULL)
                                                <td>
                                                    <ul class="rating">
                                                        <li>
                                                            No Rating
                                                        </li>
                                                    </ul>
                                                </td>
                                            @elseif($item->stars_rated == 1)
                                                <td>
                                                    <ul class="rating">
                                                        <li>
                                                            <i class="fas fa-star theme-color"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                        </li>
                                                    </ul>
                                                </td>
                                            @elseif($item->stars_rated == 2)
                                                <td>
                                                    <ul class="rating">
                                                        <li>
                                                            <i class="fas fa-star theme-color"></i>
                                                            <i class="fas fa-star theme-color"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                        </li>
                                                    </ul>
                                                </td>
                                            @elseif($item->stars_rated == 3)
                                                <td>
                                                    <ul class="rating">
                                                        <li>
                                                            <i class="fas fa-star theme-color"></i>
                                                            <i class="fas fa-star theme-color"></i>
                                                            <i class="fas fa-star theme-color"></i>
                                                            <i class="fas fa-star"></i>
                                                            <i class="fas fa-star"></i>
                                                        </li>
                                                    </ul>
                                                </td>
                                            @elseif($item->stars_rated == 4)
                                                <td>
                                                    <ul class="rating">
                                                        <li>
                                                            <i class="fas fa-star theme-color"></i>
                                                            <i class="fas fa-star theme-color"></i>
                                                            <i class="fas fa-star theme-color"></i>
                                                            <i class="fas fa-star theme-color"></i>
                                                            <i class="fas fa-star"></i>
                                                        </li>
                                                    </ul>
                                                </td>
                                            @else
                                                <td>
                                                    <ul class="rating">
                                                        <li>
                                                            <i class="fas fa-star theme-color"></i>
                                                            <i class="fas fa-star theme-color"></i>
                                                            <i class="fas fa-star theme-color"></i>
                                                            <i class="fas fa-star theme-color"></i>
                                                            <i class="fas fa-star theme-color"></i>
                                                        </li>
                                                    </ul>
                                                </td>
                                            @endif

                                            <td>
                                                <div class="break-line">
                                                    <h6>
                                                        {!! $item->comment !!}
                                                    </h6>
                                                </div>
                                            </td>
                                            <td>
                                                <label class="switch">
                                                    <input data-width="80" data-id="{{$item->id}}" class="toggle-review" type="checkbox" data-offstyle="outline-secondary" data-toggle="toggle" data-on="Active" data-off="InActive"  {{ $item->status ? 'checked' : '' }}>
                                                </label>
                                            </td>

                                            <td>
                                                <ul>
                                                    <li>
                                                        <a class="sidebar-link sidebar-title link-nav" data-bs-toggle="modal" data-bs-target="#editReview{{ $item->id }}"
                                                            href="javascript:void(0)">
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#deleteModalToggle{{ $item->id }}">
                                                            <i class="ri-delete-bin-line"></i>
                                                        </a>
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
        <!--pagination -->
        @include('components.pagination')
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
<!-- Section End -->

<!-- Modal Start -->
@foreach($review as $key => $item)
    <div class="modal fade theme-modal remove-coupon" id="editReview{{ $item->id }}" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <h4 class="modal-title w-100" id="exampleModalLabel22">Edit Review</h4>
                </div>
                @if(isset($item->id))
                    <div class="modal-body">
                        <form action="{{ route('review.update')}}" method="POST">
                            @csrf
                            <input type="hidden" name="review_id" value="{{ $item->id }}">
                            <textarea class="form-control" name="comment" rows="6" cols="6">{{ $item->comment }}</textarea>
                            <div class="modal-footer">
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                <button type="submit" class="btn btn-animation">Update</button>
                                <button type="button" class="btn btn-animation btn-secondary" data-bs-dismiss="modal">Cancel</button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </div>
@endforeach
<!-- Modal End -->

<!-- Delete Modal Box Start -->
@foreach( $review as $key => $item )
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
                    <form method="POST" action="{{ route('review.delete') }}">
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

<script>
$(function() {
    $('.toggle-review').change(function() {
        var status = $(this).prop('checked') ? 1 : 0;
        var review_id = $(this).data('id');

        $.ajax({
            type: "POST",
            url: '/reviewstatus',
            data: {
                'status': status,
                'review_id': review_id,
                '_token': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(data) {
                location.reload();
            }
        });
    });
});
</script>
@endsection
