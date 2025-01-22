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
                            <h5>Order List</h5>
                        </div>

                        <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                            @php $activeTab = request()->query('tab', 'list'); @endphp
                            <li class="nav-item" role="presentation">
                                <a class="nav-link @if($activeTab == 'list') active @endif" id="pills-home-tab"
                                    href="{{ request()->fullUrlWithQuery(['tab' => 'list', 'page' => 1]) }}">
                                    List
                                </a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link @if($activeTab == 'cancelled') active @endif" id="pills-profile-tab"
                                    href="{{ request()->fullUrlWithQuery(['tab' => 'cancelled', 'page' => 1]) }}">
                                    Cancelled Order
                                </a>
                            </li>
                        </ul>

                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade @if($activeTab == 'list') show active @endif" id="pills-home" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table all-package order-table theme-table dataTable no-footer" id="table_id">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Order Code</th>
                                                <th>Delivery Status</th>
                                                <th>Amount</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($order->isEmpty())
                                                <tr>
                                                    <td colspan="9">No data available</td>
                                                </tr>
                                            @else
                                                @foreach($order as $key => $item)
                                                    <tr>
                                                        <td>{{ ($ttl + 1) - ($order->firstItem() + $key) }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y/m/d') }}<br>
                                                            {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}</td>
                                                        <td>{{ $item->order->order_code }}</td>
                                                        <td class="@if($item->status == 'Pending') status-danger @elseif(!empty($item->delivered_date)) order-success @else order-pending @endif">
                                                            <span>{{ $item->status }}</span>
                                                        </td>
                                                        <td>¥{{ number_format($item->amount) }}</td>
                                                        <td>
                                                            <ul>
                                                                <li>
                                                                    <a href="{{ route('detail.order', ['id' => $item->order_id]) }}">
                                                                        <i class="ri-eye-line"></i>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="#" data-bs-toggle="offcanvas" data-bs-target="#order-details{{ $item->id }}">
                                                                        <i class="ri-pencil-line"></i>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="{{ route('invoice', $item->id) }}" @if($item->status === 'Cancel') onclick="return false;" @endif>
                                                                        <i class="icon-cloud-down"></i>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a class="btn btn-sm btn-solid text-white" href="{{ route('order.tracking', $item->order_id) }}" @if($item->status === 'Cancel') onclick="return false;" @endif>
                                                                        Tracking
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

                            <div class="tab-pane fade @if($activeTab == 'cancelled') show active @endif" id="pills-profile" role="tabpanel">
                                <div class="table-responsive">
                                    <table class="table all-package order-table theme-table dataTable no-footer" id="table_id">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Order Code</th>
                                                <th>Product Code</th>
                                                <th>Product Name</th>
                                                <th>Quantity</th>
                                                <th>Amount</th>
                                                <th>Reason</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @if ($cancelledOrder->isEmpty())
                                                <tr>
                                                    <td colspan="9">No data available</td>
                                                </tr>
                                            @else
                                                @foreach($cancelledOrder as $key => $item)
                                                    <tr>
                                                        <td>{{ ($cancelttl + 1) - ($cancelledOrder->firstItem() + $key) }}</td>
                                                        <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y/m/d') }}<br>
                                                            {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}</td>
                                                        <td>{{ $item->order->order_code }}</td>
                                                        <td><a href="{{ route('detail.product', $item->product->id) }}">{{ $item->product->product_code }}</a></td>
                                                        <td>
                                                            <div class="break-line">
                                                                <h6>
                                                                    {!! $item->product_name !!}
                                                                </h6>
                                                            </div>
                                                        </td>
                                                        <td>{{ $item->qty }}</td>
                                                        <td>¥{{ number_format($item->amount) }}</td>
                                                        <td>{{ $item->cancelled_reason }}</td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                    <!-- Table End -->
                </div>
            </div>
            @include('components.pagination')
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
<!-- Section End -->

<!-- Offcanvas Box Start -->
@foreach( $order as $key => $item )
@if(isset($item->id))
    <div class="offcanvas offcanvas-end order-offcanvas" tabindex="-1" id="order-details{{ $item->id }}"
        aria-labelledby="offcanvasExampleLabel" aria-hidden="false">
        <div class="offcanvas-header">
            <h4 class="offcanvas-title" id="offcanvasExampleLabel">Order Code: {{ $item->order->order_code }}</h4>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close">
                <i class="fas fa-times"></i>
            </button>
        </div>
        <div class="offcanvas-body">
            <div class="order-date">
                <span>Ordered Date: {{ $item->created_at }}</span>
            </div>

            <div class="accordion accordion-flush custome-accordion" id="accordionFlushExample">
                <div class="accordion-item">
                    <h2 class="accordion-header" id="flush-headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
                            Status
                        </button>
                    </h2>
                    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne"
                        data-bs-parent="#accordionFlushExample">
                        <div class="accordion-body">
                            <form action="{{ route('order.status') }}" method="POST">
                                @csrf
                                <input type="hidden" name="id" value="{{ $item->id }}">
                                @if($item->status === 'Pending')
                                    <h6>Choose which date will be delivered this order</h6>
                                    <p>Between :</p>
                                    <input type="date" name="expected_from" class="form-control">
                                    @error('expected_from')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <p>and :</p>
                                    <input type="date" name="expected_to" class="form-control mb-3 ">
                                    @error('expected_to')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                    <button type="submit" class="btn btn-outline-primary w-100" name="status" value="Confirmed">Confirmed</button>
                                @elseif ($item->status === 'Confirmed')
                                    <button type="submit" class="btn btn-outline-primary w-100" name="status" value="Processing">Processing</button>
                                @elseif ($item->status === 'Processing')
                                    <button type="submit" class="btn btn-outline-primary w-100" name="status" value="Picked">Pick up</button>
                                @elseif ($item->status === 'Picked')
                                    <button type="submit" class="btn btn-outline-primary w-100" name="status" value="Shipped">Shipping</button>
                                @elseif ($item->status === 'Shipped')
                                    <button type="submit" class="btn btn-outline-primary w-100" name="status" value="Delivered">Delivered</button>
                                @endif
                            </form>

                            @if($item->status === 'Pending')
                                <form action="{{ route('order.cancel') }}" method="GET">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $item->id }}">
                                    <button type="submit" class="btn btn-outline-primary w-100 {{ $item->status === 'Cancel' || $item->status === 'Delivered' ? 'disabled-blue' : '' }}" name="status" value="Cancel" {{ $item->status === 'Cancel' || $item->status === 'Delivered' ? 'disabled' : '' }}>Order Cancel</button>
                                </form>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endif
@endforeach
<!-- Offcanvas Box End -->


<!-- Modal Start -->
@foreach( $order as $key => $item )
    <div class="modal fade" id="staticBackdrop{{ $item->id }}" data-bs-backdrop="static" data-bs-keyboard="true" tabindex="-1"
    aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                    <h5 class="modal-title" id="staticBackdropLabel">Order Cancellation</h5>
                    <p>Type the reason why cancellation this order:</p>
                    @if(isset($item->id))
                        <form action="{{ route('order.cancel')}}" method="POST">
                            <input type="hidden" name="id" value="{{ $item->id }}">
                            @csrf
                            <textarea class="form-control" name="comment" rows="6"></textarea>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            <div class="button-box">
                                <button type="button" class="btn btn--no" data-bs-dismiss="modal">Cancel</button>
                                <button type="submit" class="btn btn--yes btn-primary">OK</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div>
        </div>
    </div>
@endforeach
<!-- Modal End -->

<script>
    document.addEventListener('DOMContentLoaded', function () {
        var urlParams = new URLSearchParams(window.location.search);
        var activeTab = urlParams.get('tab');
        if (activeTab) {
            var tabLink = document.querySelector(`[href*="tab=${activeTab}"]`);
            if (tabLink) {
                var tabTrigger = new bootstrap.Tab(tabLink);
                tabTrigger.show();
            }
        }
    });
</script>


<script>
$(document).ready(function() {
    $('.status-link').click(function(event) {
        event.preventDefault();

        var orderId = $(this).data('id');
        var status = $(this).data('status');

        $.ajax({
            url: "{{ route('order.status') }}",
            type: "POST",
            dataType: "json",
            data: {
                _token: "{{ csrf_token() }}",
                id: orderId,
                confirmed: status
            },
            success: function(response) {
                console.log(response.success);
            },
            error: function(xhr) {
                console.log(xhr.responseText);
            }
        });
    });
});
</script>

<script>
    document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('a.disabled').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
        });
    });
});
</script>

@endsection