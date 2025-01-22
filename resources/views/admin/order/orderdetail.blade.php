<x-auth-layout>
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
        @endif
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
    
                            @if ($orderDetails->first()->payment_approved == 0)
                                <p style="color:red; font-size:12px;">* Payment for this order didn't received yet!</p>
                            @endif
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
                                                        @if($orderDetails->first()->payment_approved == 1)
                                                        <td><h5>Tracking</h5></td>
                                                        @endif
                                                    </tr>
                                                    @foreach($orderDetails as $index => $order)
                                                        <tr class="table-order">
                                                            <td>
                                                                <a href="javascript:void(0)">
                                                                    <img width="80" src="{{ asset('images/'.$order->product-> product_thambnail) }}">
                                                                </a>
                                                            </td>
    
                                                            <td style="width: 100%;">
                                                                <h6>
                                                                    {!! preg_replace('/(.{1,30})\s+?/', '$1<br>', $order->product_name) !!}
                                                                </h6>
                                                            </td>
    
                                                            <td>
                                                                <h6>{{ $order->qty }}</h6>
                                                            </td>
    
                                                            <td>
                                                                <h6>¥{{ number_format($order->amount) }}</h6>
                                                            </td>
    
                                                            <td>
                                                                <h6>{{ $order->commission != 0 ? $order->commission : 0 }}%</h6>
                                                            </td>
                                                            @if($order->payment_approved == 1)
                                                                <td>
                                                                    <a class="btn btn-sm btn-solid text-white"
                                                                        href="{{ route('ordertracking', $order->order_detail_id)}}"
                                                                        @if($order->status === 'Cancel')
                                                                        onclick="return false;"
                                                                        @endif>
                                                                        Tracking
                                                                    </a>
                                                                </td>
                                                            @endif
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
        <!-- tracking table end -->
    </div>
    <!-- tracking section End -->
    </x-auth-layout>