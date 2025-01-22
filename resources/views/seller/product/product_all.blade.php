<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@extends('seller.seller_dashboard')
@section('seller')
<style>
    .table thead th,
    .table tbody td {
        white-space: nowrap;
    }

    .table thead th.sticky,
    .table tbody td.sticky {
        position: sticky;
        background: white;
        z-index: 1;
    }

    .table thead th.sticky-1,
    .table tbody td.sticky-1 {
        left: 0;
        z-index: 2;
    }

    .table thead th.sticky-2,
    .table tbody td.sticky-2 {
        left: 150px;
        z-index: 2;
    }

    .table thead th.sticky-3,
    .table tbody td.sticky-3 {
        left: 300px;
        z-index: 2;
    }

    .table-product {
        overflow-x: auto;
    }

    /* Add alternating row colors */
    .table tbody tr:nth-child(odd) {
        background-color: #f9f9f9;
    }

    .table tbody tr:nth-child(even) {
        background-color: #ffffff;
    }

    .table tbody tr:hover {
        background-color: #f1f1f1;
    }

    .table tbody tr:nth-child(odd) .sticky {
        background-color: #f9f9f9;
    }

    .table tbody tr:nth-child(even) .sticky {
        background-color: #ffffff;
    }

    .table tbody tr:hover .sticky {
        background-color: #f1f1f1;
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
                        <div class="title-header option-title d-sm-flex d-block">
                            <h5>Products List</h5>
                            <div class="right-options">
                                <ul>
                                    <li>
                                        <a class="btn btn-solid" href="{{ route('add.product') }}">Add Product</a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                        <div>
                            <div class="table-responsive">
                                <table class="user-table ticket-table review-table theme-table table" id="table_id">
                                    <thead>
                                        <tr>
                                            <th class="sticky sticky-1" style="min-width: 50px">No</th>
                                            <th>Date</th>
                                            <th class="sticky sticky-2" style="min-width: 200px">Product Image</th>
                                            <th class="sticky sticky-3" style="min-width: 300px">Product Name</th>
                                            <th>Current Qty</th>
                                            <th>Price</th>
                                            <th>Discount</th>
                                            <th>Commission</th>
                                            <th>Status</th>
                                            <th>Option</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if ($products->isEmpty())
                                        <tr>
                                            <td colspan="9">No data available</td>
                                        </tr>
                                        @else
                                        @foreach ($products as $key => $item)
                                        <tr>
                                            <td class="sticky sticky-1">
                                                {{ $ttl + 1 - ($products->firstItem() + $key) }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y/m/d') }}<br>
                                                {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}
                                            </td>
                                            <td class="sticky sticky-2">
                                                <div class="table-image">
                                                    <img width="50" height="50" src="{{ asset('images/' . $item->product_thambnail) }}">
                                                </div>
                                            </td>

                                            <td class="sticky sticky-3">
                                                {{ mb_strlen($item->product_name) > 20 ? mb_substr($item->product_name, 0, 20) . '...' : $item->product_name }}
                                            </td>

                                            <td>{{ $item->product_qty }}</td>

                                            <td class="td-price">¥{{ number_format($item->selling_price) }}</td>

                                            <td class="td-price">
                                                @if ($item->discount_percent == null || $item->discount_percent == '0')
                                                <p>No Discount</p>
                                                @else
                                                <p>{{ $item->discount_percent }}%</p>
                                                @endif
                                            </td>

                                            <td>{{ $item->commission }}%</td>

                                            <td>
                                                <label class="switch">
                                                    <input data-width="80" data-id="{{ $item->id }}" class="toggle-class" type="checkbox" data-offstyle="outline-secondary" data-toggle="toggle" data-on="Active" data-off="InActive" {{ $item->status ? 'checked' : '' }}>
                                                </label>
                                            </td>

                                            <td>
                                                <ul>
                                                    <li>
                                                        <a href="{{ route('detail.product', $item->id) }}">
                                                            <i class="ri-eye-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="{{ route('edit.product', $item->id) }}">
                                                            <i class="ri-pencil-line"></i>
                                                        </a>
                                                    </li>

                                                    <li>
                                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModalToggle{{ $item->id }}">
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

<!-- Delete Modal Box Start -->
@foreach ($products as $key => $item)
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
                <form method="POST" action="{{ route('delete.product') }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $item->id }}">
                    <button type="submit" class="btn btn-animation">Yes</button>
                </form>
                <button type="button" class="btn btn-animation btn-secondary" data-bs-dismiss="modal" style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
            </div>
        </div>
    </div>
</div>
@endforeach
<!-- Delete Modal Box End -->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(function() {
        $('.toggle-class').change(function() {
            var status = $(this).prop('checked') ? 1 : 0;
            var product_id = $(this).data('id');

            $.ajax({
                type: "POST",
                dataType: "json",
                url: '/productstatus',
                data: {
                    'status': status,
                    'product_id': product_id,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    console.log(data.success);
                }
            });
        });
    });
</script>
@endsection