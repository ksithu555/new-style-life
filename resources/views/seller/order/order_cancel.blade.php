@extends('seller.seller_dashboard')
@section('seller')
<!-- tracking section start -->
<div class="page-body">
    <!-- tracking table start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-body">
                        @if($orderDetails->isNotEmpty())
                            @php
                                $orders = $orderDetails->first();
                                $totalCommission = 0;
                                $subTotalAmount = 0;
                                $deliveryPrice =0;
                                foreach ($orderDetails as $order) {
                                    if ($order->used_delivery_price == 1) {
                                        $deliveryPrice = $order->delivery_price;
                                    }
                                }
                            @endphp
                        @endif
                        <div class="title-header title-header-block package-card">
                            <div>
                                <h5>Order Code: {{ $orders->order_code }}</h5>
                            </div>
                        </div>
                        <div class="bg-inner cart-section order-details-table">
                            <div class="row g-4">
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
                                                <td><h5>Option</h5></td>
                                            </tr>
                                            @foreach($orderDetails as $index => $order)
                                                @if($order->status != 'Cancel')
                                                    <tr class="table-order">
                                                        <td>
                                                            <a href="javascript:void(0)">
                                                                <img width="80" src="{{ asset('images/'.$order->product-> product_thambnail) }}">
                                                            </a>
                                                        </td>

                                                        <td style="width: 100%;">
                                                            <h6>
                                                                {!! preg_replace('/(.{1,40})\s+?/', '$1<br>', $order->product_name) !!}
                                                            </h6>
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

                                                        <td>
                                                            <button type="button" class="btn btn-animation btn-submit" data-bs-toggle="modal" data-bs-target="#cancelOrder{{ $order->id }}">Cancel</button>
                                                        </td>
                                                    </tr>
                                                    @php
                                                        $totalCommission += $order->commission_amount;
                                                        $subTotalAmount += $order->amount;
                                                    @endphp
                                                @endif
                                            @endforeach
                                        </tbody>

                                        <tfoot>
                                            <tr class="table-order">
                                                <td colspan="5">
                                                    <h5>Subtotal(tax inc) :</h5>
                                                </td>
                                                <td>
                                                    <h4>¥{{ number_format($subTotalAmount) }}</h4>
                                                </td>
                                            </tr>

                                            <tr class="table-order">
                                                <td colspan="5">
                                                    <h5>Shipping(tax inc) :</h5>
                                                </td>
                                                <td>
                                                    <h4>¥{{ number_format($deliveryPrice) }}</h4>
                                                </td>
                                            </tr>

                                            <tr class="table-order">
                                                <td colspan="5">
                                                    <h5>Commission(tax inc):</h5>
                                                </td>
                                                <td>
                                                    <h4>- ¥{{ number_format($totalCommission) }}</h4>
                                                </td>
                                            </tr>

                                            <tr class="table-order">
                                                <td colspan="5">
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

<!-- Cancel Order Modal Start -->
@foreach($orderDetails as $index => $order)
    <div class="modal fade theme-modal remove-coupon" id="cancelOrder{{ $order->id }}" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <h4 class="modal-title w-100" id="exampleModalLabel22">Order Cancel</h4>
                </div>
                <form action="{{ route('order.cancel.reason')}}" method="POST" id="cancelOrderForm{{ $order->id }}">
                    @csrf
                    <input type="hidden" name="id" value="{{ $order->id }}">
                    <div class="modal-body">
                        <p style="color: red;">Canceling this product will result in its cancellation.</p>
                        <textarea class="form-control" name="cancelled_reason" rows="8"></textarea>
                        <p style="display:none" class="cancelled_reason text text-danger"></p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        <button type="button" class="btn btn-animation" onclick="validateAndSubmitForm('{{ $order->id }}')">Confirm</button>
                        <button type="button" class="btn btn-animation btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endforeach
<!-- Cancel Order Modal End -->

<script>
    function validateAndSubmitForm(orderId) {
        var form = document.getElementById('cancelOrderForm' + orderId);
        var reasonField = form.querySelector('textarea[name="cancelled_reason"]');
        var errorField = form.querySelector('.cancelled_reason.text');

        if (!reasonField.value.trim()) {
            errorField.textContent = 'Please provide a cancellation reason.';
            errorField.style.display = 'block';
        } else {
            errorField.textContent = '';
            errorField.style.display = 'none';
            form.submit();
        }
    }
</script>


@endsection