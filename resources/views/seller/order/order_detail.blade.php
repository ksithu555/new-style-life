@extends('seller.seller_dashboard')
@section('seller')
<style>
    .break-line {
    width: 200px;
    word-wrap: break-word;
    white-space: normal;
}
</style>
<!-- tracking section start -->
<div class="page-body">
    <!-- tracking table start -->
    @if($orderDetails->isNotEmpty())
        @php
            $orders = $orderDetails->first();
            $totalCommission = 0;
            $subTotalAmount = 0;
            $deliveryPrice =0;
            foreach ($orderDetails as $index => $order) {
                if ($order->used_delivery_price == 1) {
                    $deliveryPrice = $order->delivery_price;
                }
            }
        @endphp
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        <div class="title-header title-header-block package-card">
                            <div>
                                <h5>Order Code: {{ $orders->order_code }}</h5>
                            </div>
                        </div>
                        <div class="bg-inner cart-section order-details-table">
                            <div class="row g-4">
                                <div class="col-xl-8">
                                    <div class="table-responsive table-details">
                                        <table class="table cart-table table-borderless">
                                            <thead>
                                                <tr>
                                                    <th colspan="3">Items</th>
                                                    <th class="text-end" colspan="3"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr class="table-order">
                                                    <td></td>
                                                    <td><h5>Product Name</h5></td>
                                                    <td><h5>Quantity</h5></td>
                                                    <td><h5>Price(tax inc)</h5></td>
                                                    <td><h5>Commission</h5></td>
                                                </tr>
                                                @foreach($orderDetails as $index => $order)
                                                    <tr class="table-order">
                                                        <td>
                                                            <a href="javascript:void(0)">
                                                                <img width="80" src="{{ asset('images/'.$order-> product_thambnail) }}">
                                                            </a>
                                                        </td>

                                                        <td style="width: 100%;">
                                                            <div class="break-line">
                                                                <h6>
                                                                    {!! $order->product_name !!}
                                                                </h6>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <h6>{{ $order->qty }}</h6>
                                                        </td>

                                                        <td>
                                                            <h6>¥{{ number_format($order->amount) }}</h6>
                                                        </td>

                                                        <td>
                                                            <h6>{{ $order->commission }}%</h6>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $totalCommission += $order->commission_amount;
                                                        $subTotalAmount += $order->amount;
                                                    @endphp
                                                @endforeach
                                            </tbody>

                                            <tfoot>
                                                <tr class="table-order">
                                                    <td colspan="4">
                                                        <h5>Subtotal(tax inc) :</h5>
                                                    </td>
                                                    <td>
                                                        <h4>¥{{ number_format($subTotalAmount) }}</h4>
                                                    </td>
                                                </tr>

                                                <tr class="table-order">
                                                    <td colspan="4">
                                                        <h5>Shipping(tax inc) :</h5>
                                                    </td>
                                                    <td>
                                                        <h4>¥{{ number_format($deliveryPrice) }}</h4>
                                                    </td>
                                                </tr>

                                                <tr class="table-order">
                                                    <td colspan="4">
                                                        <h5>Commission(tax inc):</h5>
                                                    </td>
                                                    <td>
                                                        <h4>- ¥{{ number_format($totalCommission) }}</h4>
                                                    </td>
                                                </tr>

                                                <tr class="table-order">
                                                    <td colspan="4">
                                                        <h4 class="theme-color fw-bold">Total Price(tax inc) :</h4>
                                                    </td>
                                                    <td>
                                                        <h4 class="theme-color fw-bold">¥{{ number_format($subTotalAmount-$totalCommission) }}</h4>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>

                                <div class="col-xl-4">
                                    <div class="order-success">
                                        <div class="row g-4">
                                            <h4>Summery</h4>
                                            <ul class="order-details">
                                                <li>Order ID: {{ $orders->order_code }}</li>
                                                <li>Order Date: {{ \Carbon\Carbon::parse($orders->order_created_at)->format('Y/m/d H:i') }}</li>
                                                <li>Order Total: ¥{{ number_format($subTotalAmount-$totalCommission) }}</li>
                                            </ul>

                                            <h4>Shipping address</h4>
                                            <ul class="order-details">
                                                <li>Name: {{ $order->buyer->name }}</li>
                                                <li>Post Code: 〒{{ $order->post_code }}</li>
                                                <li>Address: {{ $order->prefecture->name }}, {{ $order->city }}</li>
                                                <li>{{ $order->chome }}, {{ $order->building }} {{ $order->room_no }}</li>
                                                <li>{{ $order->order_details_phone }}</li>
                                            </ul>

                                            <div class="delivery-sec">
                                                <h3>Expected date of delivery: </h3>
                                                <span>{{ \Carbon\Carbon::parse($order->expected_from)->format('Y/m/d') }}-{{ \Carbon\Carbon::parse($order->expected_to)->format('Y/m/d') }}</span>
                                                <a href="{{ route('order.tracking', $order->order_id)}}">Track order</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                        <!-- section end -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    <!-- tracking table end -->
</div>
<!-- tracking section End -->

@endsection