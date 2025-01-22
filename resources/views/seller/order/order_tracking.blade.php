@extends('seller.seller_dashboard')
@section('seller')
 <!-- Order Tracking Seation starts-->
 <div class="page-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="bg-inner cart-section order-details-table">
                                    @if($orderDetails->isNotEmpty())
                                        @php
                                            $orders = $orderDetails->first();
                                        @endphp
                                    @endif
                                    <div class="title-header option-title">
                                        <h5>Order Code: {{ $orders->order_code }}</h5>
                                    </div>
                                    <div class="row">
                                        <div class="table-responsive table-details">
                                            <table class="table cart-table table-borderless">
                                                <thead>
                                                    <tr>
                                                        <th colspan="3">Items</th>
                                                        <th class="text-end" colspan="3"></th>
                                                    </tr>
                                                </thead>

                                                <tbody>
                                                    @foreach($orderDetails as $index => $order)
                                                        <tr>
                                                            <td>
                                                                <a href="javascript:void(0)">
                                                                    <img src="{{ asset('images/'.$order->product-> product_thambnail) }}">
                                                                </a>
                                                            </td>

                                                            <td style="width: 100%;">
                                                                <h6>
                                                                    {!! preg_replace('/(.{1,30})\s+?/', '$1<br>', $order->product_name) !!}
                                                                </h6>
                                                            </td>

                                                            <td>
                                                                <p>Quantity</p>
                                                                <h5>{{ $order->qty }}</h5>
                                                            </td>
                                                            <td>
                                                                <p>Price</p>
                                                                <h5>¥{{ number_format($order->selling_price) }}</h5>
                                                            </td>
                                                            <td>
                                                                <p>Order Placed</p>
                                                                <h5>{{ \Carbon\Carbon::parse($order->created_at)->format('Y/m/d') }}</h5>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                        <ol class="progtrckr">
                                            <li class="{{ !empty($order->confirmed_date) ? 'progtrckr-done' : 'progtrckr-todo' }}">
                                                <h5>Order Confirmed</h5>
                                            </li>
                                            <li class="{{ !empty($order->processing_date) ? 'progtrckr-done' : 'progtrckr-todo' }}">
                                                <h5>Processing</h5>
                                            </li>
                                            <li class="{{ !empty($order->picked_date) ? 'progtrckr-done' : 'progtrckr-todo' }}">
                                                <h5>Pick-up</h5>
                                            </li>
                                            <li class="{{ !empty($order->shipped_date) ? 'progtrckr-done' : 'progtrckr-todo' }}">
                                                <h5>Shipped</h5>
                                            </li>
                                            <li class="{{ !empty($order->delivered_date) ? 'progtrckr-done' : 'progtrckr-todo' }}">
                                                <h5>Delivered</h5>
                                            </li>
                                        </ol>

                                        <div class="col-12 overflow-visible">
                                            <div class="tracker-table">
                                                <div class="table-responsive">
                                                    <table class="table">
                                                        <thead>
                                                            <tr class="table-head">
                                                                <th scope="col">No</th>
                                                                <th scope="col">Date</th>
                                                                <th scope="col">Status</th>
                                                                <th scope="col">Name</th>
                                                            </tr>
                                                        </thead>

                                                        <tbody>
                                                            @if ($process->isEmpty())
                                                                <tr>
                                                                    <td colspan="4" style="text-align: center">No data available</td>
                                                                </tr>
                                                            @else
                                                            @foreach ($process as $key => $item)
                                                                <tr>
                                                                    <td>{{ $key + 1 }}</td>
                                                                    <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y/m/d H:i') }}</td>
                                                                    @if (!empty($item->confirmed_date))
                                                                        <td><p class="fw-bold">Confirmed</p></td>
                                                                        <td><p class="fw-bold">{{ $item->updated_by }}</p></td>
                                                                    @elseif (!empty($item->processing_date))
                                                                        <td><p class="fw-bold">Processing</p></td>
                                                                        <td><p class="fw-bold">{{ $item->updated_by }}</p></td>
                                                                    @elseif (!empty($item->picked_date))
                                                                        <td><p class="fw-bold">Picked</p></td>
                                                                        <td><p class="fw-bold">{{ $item->updated_by }}</p></td>
                                                                    @elseif (!empty($item->shipped_date))
                                                                        <td><p class="fw-bold">Shipped</p></td>
                                                                        <td><p class="fw-bold">{{ $item->updated_by }}</p></td>
                                                                    @elseif (!empty($item->delivered_date))
                                                                        <td><p class="fw-bold">Delivered</p></td>
                                                                        <td><p class="fw-bold">{{ $item->updated_by }}</p></td>
                                                                    @else
                                                                        <td><p class="fw-bold">Cancelled</p></td>
                                                                        <td><p class="fw-bold">{{ $item->updated_by }}</p></td>
                                                                    @endif
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
                            <div class="card-footer text-end border-0 pb-0 d-flex justify-content-end">
                                <a href="{{ route('invoice',$order->id) }}">
                                    <button class="btn btn-primary me-3">Invoice</button>
                                </a>
                                <a href="{{ route('all.order') }}">
                                    <button class="btn btn-outline">Back</button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Container-fluid Ends-->
</div>
<!-- Order Tracking Seation End-->
@endsection