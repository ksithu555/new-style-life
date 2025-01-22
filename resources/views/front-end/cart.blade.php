<x-guest-layout>
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Cart</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <!-- Cart Section Start -->
    <section class="cart-section section-b-space">
        @if(session()->has('refreshCart'))
            <div class="alert alert-warning alert-block">
                <strong>{{ session('refreshCart') }}</strong>
            </div>
        @endif

        <div class="container-fluid" style="margin-left: 10px;">
            <div class="row g-sm-5 g-3">
                <div class="col-xxl-9">
                    @php
                        $totalAmount = 0;
                        $totalAmount1 = 0;
                        $subTotal = 0;
                        $total = 0;
                        $applyDisabled = 1;
                    @endphp
                    @if($cartLists->count() < 1)
                    @php
                        $applyDisabled = 1;
                    @endphp
                        <h2 class="text-center">No Products Added To Your Cart</h2>
                    @else
                    <div class="cart-table">
                        <div class="table-responsive-xl">
                            <table class="table cart-table table-borderless">
                                <thead>
                                    <tr>
                                        <td style="text-align: center;"><h5>Product</h5></td>
                                        <td style="padding-left: 15px;"><h5>Price(tax inc)</h5></td>
                                        <td style="padding-left: 15px;"><h5>Quantity</h5></td>
                                        <td style="padding-left: 15px;"><h5>Total</h5></td>
                                        <td style="padding-left: 15px;"><h5>Coupon</h5></td>
                                        <td></td>
                                    </tr>
                                    <tr><td></td></tr>
                                </thead>
                                <tbody>
                                @foreach($cartLists as $cartlist)
                                    <tr class="product-box-contain">
                                        <td class="product-detail">
                                            <div class="product border-0">
                                                <a href="{{ route('show-product-left-thumbnail', ['id' => $cartlist->product_id]) }}">
                                                    <img src="{{ asset('images/'.$cartlist-> product_thambnail) }}"
                                                            class="img-fluid blur-up lazyload" alt="" style="width: 60px; height: 60px;">
                                                </a>
                                                <div class="product-detail" style="width: 100px;">
                                                    <ul>
                                                        <li class="text-content">
                                                            <a href=" {{ url('/product-left-thumbnail/' . $cartlist->product_id) }} ">{{ $cartlist->product_name }}</a>
                                                        </li>
                                                        <li class="text-content"><span class="text-title">In
                                                                Stock:</span>{{ $cartlist->in_stock }}
                                                        </li>
                                                        <li class="text-content"><span class="text-title">Sold
                                                                By:</span>{{ $cartlist->shop_name }}
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </td>
                                        
                                        
                                        <td class="price">
                                        @if($cartlist->discount_percent)
                                            <h5>¥{{ number_format($cartlist->selling_price, 0, '.', ',') }}</h5><del class="text-content">¥{{ number_format($cartlist->original_price, 0, '.', ',') }}</del>
                                        @else
                                            <h5>¥{{ number_format($cartlist->selling_price, 0, '.', ',') }}</h5>
                                        @endif
                                            <div class="product-detail" style="width: 100px;">
                                                <ul>
                                                    <li class="text-content"><span class="text-title">
                                                            Size :</span>{{ $cartlist->size }}
                                                    </li>
                                                    <li class="text-content"><span class="text-title">
                                                            Color :</span>{{ $cartlist->color }}
                                                    </li>
                                                </ul>
                                            </div>
                                        </td>
                      
                                        <td class="quantity">
                                            <div class="quantity-price">
                                                <div class="cart_qty">
                                                    <div class="input-group qty-box">
                                                        <button type="button" class="btn qty-left-minus" data-type="minus" data-field="">
                                                            <i class="fa fa-minus ms-0"></i>
                                                        </button>
                                                        @if(session()->has('instockCheck'))
                                                            @php
                                                                $instockCheck = session()->get('instockCheck', []);
                                                            @endphp
                                                            @if (in_array($cartlist->id, $instockCheck))
                                                                <input class="form-control input-number qty-input" style="color: red;"
                                                                type="text" name="quantity" value="{{ $cartlist->quantity }}" 
                                                                data-cart-id="{{ $cartlist->cart_id }}" 
                                                                data-in-stock="{{ $cartlist->in_stock }}">
                                                            @else
                                                                <input class="form-control input-number qty-input" 
                                                                type="text" name="quantity" value="{{ $cartlist->quantity }}" 
                                                                data-cart-id="{{ $cartlist->cart_id }}" 
                                                                data-in-stock="{{ $cartlist->in_stock }}">
                                                            @endif
                                                        @else
                                                            <input class="form-control input-number qty-input" 
                                                            type="text" name="quantity" value="{{ $cartlist->quantity }}" 
                                                            data-cart-id="{{ $cartlist->cart_id }}" 
                                                            data-in-stock="{{ $cartlist->in_stock }}">
                                                        @endif

                                                        <button type="button" class="btn qty-right-plus" data-type="" data-field="">
                                                            <i class="fa fa-plus ms-0"></i>
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="subtotal" style="min-width: 110px;">
                                            @php
                                                $totalAmount1 = $cartlist->selling_price * $cartlist->quantity;
                                                $subTotal += $totalAmount1;
                                            @endphp
                                            <h5>¥{{ number_format($totalAmount1 , 0, '.', ',') }} </h5>
                                        </td>
                                        
                                        <td class="coupon" style="min-width: 100px;">
                                            @if($cartlist->coupon_code)
                                            @php
                                                $applyDisabled = 0;
                                            @endphp
                                            <button class="theme-bg-color btn-sm btn-animation proceed-btn fw-bold"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#viewCoupon{{ $cartlist->coupon_id }}"
                                                onclick="">{{ $cartlist->coupon_code }}
                                            </button>
                                            @else
                                            <h5>-</h5>
                                            @endif
                                        </td>
                                           
                                        <td class="save-remove">
                                            <button
                                            data-bs-toggle="modal" data-bs-target="#removeProfile{{ $cartlist->cart_id }}"
                                            onclick="showDeleteModal('{{ $cartlist->cart_id }}')"
                                            class="btn-sm btn-animation proceed-btn fw-bold">
                                            Remove</button>
                                        </td> 
                                    </tr>
                                    <!-- Confirm Modal Box Start -->
                                    <div class="modal fade theme-modal remove-profile" id="removeProfile{{ $cartlist->cart_id }}" tabindex="-1" aria-hidden="true">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header d-block text-center">
                                                    <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                        <i class="fa-solid fa-xmark"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="remove-box">
                                                        <p>This item will be removed from your cart.</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <form method="POST" action="{{ route('remove_cart', ['id' => $cartlist->cart_id]) }}">
                                                        @csrf
                                                        <button onclick="location.href = '{{ route('remove_cart', ['id' => $cartlist->cart_id]) }}';" type="submit"
                                                        class="btn theme-bg-color btn-md fw-bold text-light">Yes</button>
                                                    </form>
                                                    <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal"
                                                    style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    @endif
                </div>
                
                <div class="col-xxl-3">
                        <div class="summery-box p-sticky">
                            <div class="summery-header">
                                <h3>Cart Total</h3>
                            </div>
                            {{-- @if ($couponapplycheck == 1)
                            <div class="alert alert-warning alert-block" id="alert-warning">
                                <strong>Invalid Coupon Code</strong>
                            </div>
                            @elseif ($couponapplycheck != null)
                            <div class="alert alert-warning alert-block" id="alert-warning">
                                <strong>To use this coupon, minimum order is ¥{{ number_format($couponapplycheck, 0, '', ',') }}</strong>
                            </div>
                            @endif --}}
                            <div class="summery-contain" id="ts-form">
                                    <div class="coupon-cart">
                                        {{-- <input type="hidden" name="buyer_id" value="{{ $cartlist->buyer_id }}"> --}}
                                        <h6 class="text-content mb-2">Coupon Apply</h6>
                                        <div class="mb-3 coupon-box input-group">
                                            <input type="text" class="form-control" name="coupon" id="exampleFormControlInput1"
                                                placeholder="Enter Coupon Code Here..." @if ($applyDisabled == 1) disabled @endif>
                                            <button id="applyButton" class="btn-apply" @if ($applyDisabled == 1) disabled @endif>Apply</button>
                                        </div>
                                    </div>
                                <ul>
                                    <li>
                                        <h4>Subtotal</h4> 
                                        <h4 class="price">¥ {{ number_format($subTotal , 0, '.', ',') }}</h4>
                                    </li>
                                    
                                    
                                    <li>
                                        <h4>Coupon Discount</h4>   
                                        {{-- @if ($couponapplycheck != 1)   --}}
                                        @if (session()->has('discount'))
                                        @php
                                            $discount = session('discount');
                                        @endphp
                                        <h4 class="price"> (-) ¥ {{ number_format($discount , 0, '.', ',') }}</h4>
                                        @else
                                        <h4 class="price"> (-) ¥ 0</h4>
                                        @endif
                                    </li>
                                   
                                    
                                    <li class="align-items-start">
                                        <h4>Shipping</h4>
                                        <h4 class="price text-end">¥ {{ number_format($shippingFee , 0, '.', ',') }}</h4>
                                    </li>
                                   
                                </ul>
                            </div>

                            <form action="{{ route('checkout') }}" method="POST">
                                @csrf
                                <ul class="summery-total">
                                    <li class="list-total border-top-0">
                                        <h4>Total (tax inc)</h4>
                                        @if($discount)
                                            @php 
                                                $Total  = $subTotal + $shippingFee - $discount
                                            @endphp
                                        @else
                                            @php
                                                $Total  = $subTotal + $shippingFee
                                            @endphp
                                        @endif
                                        <h4 class="price theme-color">¥ {{ number_format($Total , 0, '.', ',') }}</h4>
                                    </li>
                                </ul>
                                @foreach ($cartLists as $cartlist)
                                    <input type="hidden" name="product[]" value="{{ $cartlist->product_id }}">
                                    <input type="hidden" name="inStock[]" value="{{ $cartlist->in_stock }}">
                                    <input type="hidden" name="quantity[]" value="{{ $cartlist->quantity }}">
                                @endforeach
                                @foreach ($maxDeliveryPrices as $key => $maxDeli)
                                    <input type="hidden" name="shop[]" value="{{ $key }}">
                                    <input type="hidden" name="maxDeli[]" value="{{ $maxDeli }}">
                                @endforeach
                                @if (session()->has('couponUsedSeller'))
                                @php
                                    $couponUsedSellerId = session('couponUsedSeller');
                                @endphp
                                    <input type="hidden" name="coupon_used_seller_id" value="{{ $couponUsedSellerId }}">
                                @endif
                                @if (session()->has('couponUsedProduct'))
                                @php
                                    $couponUsedProductId = session('couponUsedProduct');
                                @endphp
                                    <input type="hidden" name="coupon_used_product_id" value="{{ $couponUsedProductId }}">
                                @endif
                                @if (session()->has('couponId'))
                                @php
                                    $couponId = session('couponId');
                                @endphp
                                    <input type="hidden" name="coupon_id" value="{{ $couponId }}">
                                @endif
                                    <input type="hidden" name="subTotal" value="{{ $subTotal }}">
                                    <input type="hidden" name="shipping" value="{{ $shippingFee }}">
                                    <input type="hidden" name="coupon_discount" value="{{ $discount }}">
                                    <input type="hidden" name="total" value="{{ $Total }}">
                                    
                                <div class="button-group cart-button">
                                    <ul>
                                        <li>
                                            <button type="submit"
                                                class="btn btn-animation proceed-btn fw-bold"
                                                @if ($cartLists->count() < 1) disabled @endif>
                                                Process To Checkout</button>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Cart Section End -->

    @foreach($cartLists as $cartlist)
    @if($cartlist->coupon_id)
    <div class="modal fade theme-modal remove-profile" id="viewCoupon{{ $cartlist->coupon_id }}" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-block text-center">
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="remove-box">
                        @php
                            $coupon = DB::table('coupons')->where('id', $cartlist->coupon_id)->first();
                            $couponSeller = DB::table('sellers')->where('coupon_id', $coupon->id)->where('coupon_status', 1)->first();
                            $couponProduct = DB::table('products')->where('coupon_id', $coupon->id)->where('coupon_status', 1)->first();
                        @endphp
                        <div class="banner-contain">
                            <img src="{{ asset('frontend/assets/images/homepage/coupon1.jpg') }}" class="bg-img blur-up lazyload" alt="">
                            <div class="banner-details p-center p-4 text-white text-center">
                                <div>
                                    <h3 class="lh-base fw-bold offer-text">{{ $coupon->name }}</h3>
                                    <h4 class="lh-base fw-bold offer-text">
                                        Get ¥{{ number_format($coupon->discount_amount, 0, '', ',') }} Cashback! Min Order of
                                            ¥{{ number_format($coupon->mini_amount, 0, '', ',') }}
                                    </h4>
                                    <h5 class="lh-base fw-bold offer-text">Expired Date :
                                        {{ date('Y/m/d', strtotime($coupon->startdate)) }} ~
                                        {{ date('Y/m/d', strtotime($coupon->enddate)) }}
                                    </h5>
                                    @if ($couponSeller)
                                        <h4 class="lh-base fw-bold offer-text">Publisher : {{ $couponSeller->shop_name }}</h4>
                                    @elseif ($couponProduct)
                                        <h4 class="lh-base fw-bold offer-text">Publisher : New Style Life</h4>
                                    @endif
                                    <h6 class="coupon-code">Use Code : {{ $coupon->coupon_code}}</h6>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
    @endforeach
    <script>
        document.getElementById('applyButton').addEventListener('click', function() {
            var couponCode = document.getElementById('exampleFormControlInput1').value;
            if (couponCode)
            {
                window.location.href = "{{ route('apply_coupon_code') }}?coupon=" + encodeURIComponent(couponCode);
            }
        });
    </script>
    <script>
    $('.qty-box .qty-right-plus').on('click', function () {
        var $qty = $(this).parents(".qty-box").find(".qty-input");
        var currentVal = parseInt($qty.val(), 10);
        var inStock = parseInt($qty.data('in-stock'), 10);

        if (!isNaN(currentVal) && !isNaN(inStock)) {
            if (currentVal < inStock) {
                $qty.val(currentVal + 1);
                var NewCartId = $qty.data('cart-id'); // Retrieve the cart ID
                updateQuantity(NewCartId, $qty.val());
                if ($qty.val() == inStock) {
                    $(this).attr('disabled', 'disabled'); // Disable the plus button
                }
            }
        }
    });

    $('.qty-box .qty-left-minus').on('click', function () {
        var $qty = $(this).parents(".qty-box").find(".qty-input");
        var currentVal = parseInt($qty.val(), 10);
        var inStock = parseInt($qty.data('in-stock'), 10);
        var $plusButton = $(this).parents(".qty-box").find(".qty-right-plus");

        if (!isNaN(currentVal) && currentVal > 1) {
            $qty.val(currentVal - 1);
            var NewCartId = $qty.data('cart-id'); // Retrieve the cart ID
            updateQuantity(NewCartId, $qty.val());

            if (currentVal - 1 < inStock) {
                $plusButton.removeAttr('disabled'); // Enable the plus button if below in stock
            }
        }
    });

    function updateQuantity(cardId, quantity) {
        // Send AJAX request to update quantity
        $.ajax({
            type: "POST",
            url: "/cart/" + cardId,
            data: {
                '_token': '{{ csrf_token() }}',
                'quantity': quantity
            },
            success: function (response) {
                // Handle success response if needed
                // alert(response.message);
                console.log('Quantity updated successfully.');
                if (response.redirect_url) {
                // Redirect to the provided URL
                window.location.href = response.redirect_url;
            }
            },
            error: function (xhr, status, error) {
                // Handle error response if needed
                console.error('Error updating quantity:', error);
            }
        });
    }

    </script>
</x-guest-layout>