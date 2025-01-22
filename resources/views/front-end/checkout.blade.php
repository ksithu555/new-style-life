<x-guest-layout>
    <!-- Breadcrumb Section Start -->

    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Checkout</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Checkout</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Checkout section Start -->
    <section class="checkout-section-2 section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-lg-8">
                    <div class="left-sidebar-checkout">
                        <div class="checkout-detail-box">
                            <ul>
                                <li>
                                    <div class="checkout-icon">
                                        <lord-icon target=".nav-item" src="https://cdn.lordicon.com/ggihhudh.json"
                                            trigger="loop-on-hover"
                                            colors="primary:#121331,secondary:#646e78,tertiary:#0baf9a"
                                            class="lord-icon">
                                        </lord-icon>
                                    </div>
                                    <div class="checkout-box">
                                        <div class="checkout-title">
                                            <h4>Delivery Address</h4>
                                        </div>
                                        @if($buyerAddress->count() > 0)
                                        <div class="checkout-detail">
                                            <div class="row g-4">
                                                @foreach($buyerAddress as $index => $buyeraddress)
                                                <div class="col-xxl-6 col-lg-12 col-md-6">
                                                    <div class="delivery-address-box">
                                                        <div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="jack"
                                                                    id="flexRadioDefault2" {{ $buyeraddress->default == 1 ? 'checked' : '' }}>
                                                            </div>
                                                            <input type="hidden" id="buyeraddress_id" name="buyeraddress_id" value="{{ $buyeraddress->id }}">
                                                            <input type="hidden" name="buyer_id" value="{{ $buyeraddress->userid }}">

                                                            <div class="label">
                                                                <label>{{ $buyeraddress->place }}</label>
                                                            </div>

                                                            <ul class="delivery-address-detail">
                                                                <li>
                                                                    <h4 class="fw-500">{{ $buyeraddress->name }}</h4>
                                                                </li>

                                                                <li>
                                                                    <p class="text-content">{{ $buyeraddress->post_code }}</p>
                                                                    <p class="text-content">{{ $buyeraddress->prefecture->name }}</p>
                                                                    <p class="text-content">{{ $buyeraddress->city }} {{ $buyeraddress->chome }}</p>
                                                                    <p class="text-content">{{ $buyeraddress->building }} {{ $buyeraddress->room_no }}</p>

                                                                </li>

                                                                <li>
                                                                    <h6 class="text-content mb-0"><span
                                                                            class="text-title">Phone
                                                                            :</span>{{ $buyeraddress->phone }}</h6>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </li>

                                <li>
                                    <div class="checkout-icon">
                                        <lord-icon target=".nav-item" src="https://cdn.lordicon.com/qmcsqnle.json"
                                            trigger="loop-on-hover" colors="primary:#0baf9a,secondary:#0baf9a"
                                            class="lord-icon">
                                        </lord-icon>
                                    </div>
                                    <div class="checkout-box">
                                        <div class="checkout-title">
                                            <h4>Payment Option</h4>
                                        </div>

                                        <div class="row" style="margin-bottom: 50px;" id="paypaldiv">
                                            <div class="col-lg-8 mx-auto">
                                                <div class="product-section-box">
                                                    <ul class="nav nav-tabs custom-nav" id="pills-tab" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link active" id="pills-home-tab"
                                                                data-bs-toggle="pill" data-bs-target="#pills-home"
                                                                type="button" role="tab">Cash</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link" id="pills-profile-tab"
                                                                data-bs-toggle="pill" data-bs-target="#pills-profile"
                                                                type="button" role="tab">PayPal/Credit</button>
                                                        </li>
                                                    </ul>
                                                    <div class="tab-content" id="pills-tabContent" style="margin-top: 10px;">
                                                        <div class="tab-pane fade show active" id="pills-home" role="tabpanel">
                                                            <div class="review-title-2">
                                                                <div class="slider-1 product-wrapper no-arrow" style="margin-bottom: 10px;">
                                                                    @if ($bankAccounts->count() > 0)
                                                                        @foreach($bankAccounts as $key => $bankAccount)
                                                                            <div class="address-box">
                                                                                <div class="row" style="background-color: rgb(215, 215, 215); height: 50px; display: flex; align-items: center;">
                                                                                    <div class="col-md-1 d-flex align-items-center justify-content-center">
                                                                                        <div class="form-check">
                                                                                            <input class="form-check-input" type="radio" name="selected_bank_account" 
                                                                                                   value="{{ $bankAccount->id }}" id="bank_account_{{ $bankAccount->id }}" 
                                                                                                   {{ $key === 0 ? 'checked' : '' }}>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-md-11 d-flex align-items-center">
                                                                                        <label>
                                                                                            <h4 class="fw-bold">
                                                                                                Choose the payment for {{ $bankAccount->bank_name }} bank!
                                                                                            </h4>
                                                                                        </label>
                                                                                    </div>
                                                                                    <span class="error" style="color:red" id="error-selected_bank_account"></span>
                                                                                </div>                                                                                
                                                                                <div class="table-responsive address-table">
                                                                                    <table class="table">
                                                                                        <tbody style="background-color: rgb(245, 245, 245);">
                                                                                            <tr>
                                                                                                <td>Bank Name:</td>
                                                                                                <td>
                                                                                                    <p>{{ $bankAccount->bank_name }}</p>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Branch Name:</td>
                                                                                                <td>
                                                                                                    <p>{{ $bankAccount->branch_name }}</p>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Account Type:</td>
                                                                                                <td>
                                                                                                    <p>{{ $bankAccount->account_type }}</p>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Account Number:</td>
                                                                                                <td>
                                                                                                    <p>{{ $bankAccount->account_number }}</p>
                                                                                                </td>
                                                                                            </tr>
                                                                                            <tr>
                                                                                                <td>Account Name:</td>
                                                                                                <td>
                                                                                                    <p>{{ $bankAccount->account_name }}</p>
                                                                                                </td>
                                                                                            </tr>
                                                                                        </tbody>
                                                                                    </table>
                                                                                </div>
                                                                            </div>
                                                                        @endforeach
                                                                    @endif
                                                                    </div>

                                                                <h4 class="fw-bold" style="margin-bottom: 10px;">Enter Your Bank Account Name</h4>
                                                                <p style="color:red; font-size:12px;">* Please be careful to enter the correct transfer person name. 
                                                                    This name will be used to verify payment transfers to confirm whether the payment has been made.</p>
                                                                <div class="form-floating theme-form-floating">
                                                                    <input type="text" class="form-control" name="transfer-person-name" id="transfer-person-name" placeholder="Transfer Person Name">
                                                                    <label for="transfer-person-name">Transfer Person Name</label>
                                                                    <span class="error" style="color:red" id="error-transfer-person-name"></span>
                                                                </div>
                                                                <p style="color:red; font-size:12px;">* Choose the date within 7 days.</p>
                                                                <div class="form-floating theme-form-floating" style="margin-top: 10px;">
                                                                    <input type="date" class="form-control" name="transfer-date" id="transfer-date" placeholder="Transfer Date">
                                                                    <label for="transfer-date">Transfer Date</label>
                                                                    <span class="error" style="color:red" id="error-transfer-date"></span>
                                                                </div>
                                                                <button class="btn" type="button" id="btnPayWithCash"
                                                                    style="layout: vertical;background-color:#009cde;color:#fff;shape:rect;label:paywithcash;height:50; font-size: 20px;font-family: Arial, sans-serif;"
                                                                    {{ $bankAccounts->count() < 1 ? 'disabled' : '' }}>
                                                                    Pay With Cash
                                                                </button>
                                                            </div>
                                                        </div>

                                                        <div class="tab-pane fade" id="pills-profile" role="tabpanel">
                                                            <div id="paypal-button-container"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                @php
                    $amount = 0;
                    $amount1 = 0;
                    $total = 0;
                    $subTotal = 0;
                    $totalqty = 0;
                    $productIds = [];
                    $sellerIds = [];
                    $productColors = [];
                    $productSizes = [];
                    $productQuantities = [];
                    $buyerId = $buyerAddress[0]->buyer_id;
                    $buyerAddressIdFirst = $buyerAddress[0]->id;
                @endphp
                <div class="col-lg-4">
                    <div class="right-side-summery-box">
                        <div class="summery-box-2">
                            <div class="summery-header">
                                <h3>Order Summery</h3>
                            </div>
                            @foreach($cartLists as $cartlist)

                            <ul class="summery-contain">
                                @php
                                    $productIds[] = $cartlist->product_id;
                                    $sellerIds[] = $cartlist->seller_id;
                                    $productColors[] = $cartlist->product_color;
                                    $productSizes[] = $cartlist->product_size;
                                    $productQuantities[] = $cartlist->quantity;
                                    $productAmounts[] = $cartlist->selling_price * $cartlist->quantity;
                                @endphp

                                <li>
                                <img src="{{ asset('images/'.$cartlist-> product_thambnail) }}"
                                                            class="img-fluid blur-up lazyload" alt="" style="width: 50px; height: 50px;">
                                    <h4>
                                        @if(mb_strlen($cartlist->product_name) > 15)
                                            {!! mb_substr($cartlist->product_name, 0, 15) . '<br>' . mb_substr($cartlist->product_name, 15, 15) . '...' !!}
                                        @else
                                            {!! nl2br(e($cartlist->product_name)) !!}
                                        @endif
                                        <span>
                                            X {{ $cartlist->quantity }}
                                        </span>
                                    </h4>
                                            @php
                                                $sellingPrice = $cartlist->selling_price;
                                                $quantity = $cartlist->quantity;
                                                $amount1 = $sellingPrice * $quantity;
                                                $subTotal += $amount1;
                                                $totalqty += $quantity
                                            @endphp
                                            <h4 class="price" style="color: black;">¥{{ number_format($amount1 , 0, '.', ',') }}</h4>
                                </li>
                            </ul>
                            <input type="hidden" name="totalqty" value="{{ $totalqty }}">

                            @endforeach
                            <ul class="summery-total">
                                <li>

                                    <h4>Subtotal</h4>
                                    <h4 class="price">¥ {{ number_format($subTotal , 0, '.', ',') }}</h4>

                                </li>

                                <li>
                                    <h4>Shipping</h4>
                                    <h4 class="price">¥ {{ number_format($shippingFee , 0, '.', ',') }}</h4>
                                </li>

                                <li>
                                    <h4>Coupon Discount</h4>
                                    <h4 class="price">(-)¥ {{ number_format($couponDiscount , 0, '.', ',') }}</h4>
                                </li>

                                <li class="list-total">
                                    <h4>Total (JPY)</h4>
                                    <h4 class="price">¥ {{ number_format($total1 , 0, '.', ',') }}</h4>
                                </li>
                            </ul>
                        
                            
                        </div>


                        <!-- Place Order button (initially hidden) -->
                        <button class="btn theme-bg-color text-white btn-md w-100 mt-4 fw-bold" id="placeOrderButton" style="display: none;">Place Order</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Checkout section End -->

    <script src="https://www.paypal.com/sdk/js?client-id=Afa37Sd8KhndPxu857AGrWKc44766o1oiHViAxUlSl9ZFiryUEY7mwcsslzuv-OARUnMSJBSS15ZVoGg&currency=JPY"> // Replace YOUR_CLIENT_ID with your sandbox client ID
    </script>
    <script>
        var Newbuyeraddressid = <?php echo json_encode($buyerAddressIdFirst ); ?>; 
        document.querySelectorAll('input[name="jack"]').forEach(function(radio) {
            radio.addEventListener('change', function() {
                if (this.checked) {
                    // Get the value of buyeraddress_id using id attribute
                    Newbuyeraddressid = this.closest('.checkout-detail').querySelector('input[name="buyeraddress_id"]').value;
                }
            });
        });
        paypal.Buttons({

            style: {
                layout: 'vertical',
                color: 'blue',
                shape: 'rect',
                label: 'paypal',
                height: 50
            },
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: '{{ $total1 }}'
                            
                        }
                    }]
                });
            },
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    if (details.status == 'COMPLETED') {

                        purchasepaymentdone('{{ $total1 }}', function(result) {
                            if(result==1){ 
                            $('#paymentsuccessModal').modal('show');
                            }
                            else{
                            $('#paymentfailModal').modal('show');
                            }
                        });

                } else {
                        $('#paymentfailModal').modal('show');
                    }
                });
            }
        }).render('#paypal-button-container');

        function purchasepaymentdone(total1, callback) {
            var Newproductid = <?php echo json_encode($productIds ); ?>; 
            var Newbuyerid = <?php echo json_encode($buyerId ); ?>; 
            var Newsellerid = <?php echo json_encode($sellerIds ); ?>; 
            var Newcolor = <?php echo json_encode($productColors ); ?>; 
            var Newsize = <?php echo json_encode($productSizes ); ?>; 
            var Newquantity = <?php echo json_encode($productQuantities ); ?>;
            var Newproductamount = <?php echo json_encode($productAmounts ); ?>;
            var Newtotalqty = <?php echo json_encode($totalqty ); ?>;
            var Newamount = <?php echo json_encode($amount ); ?>;
            var Newamount1 = <?php echo json_encode($amount1 ); ?>;
            var Newtotalamount = <?php echo json_encode($total1 ); ?>;
            var Newsubtotalamount = <?php echo json_encode($subTotal ); ?>;
            var Newshippingfee = <?php echo json_encode($shippingFee ); ?>;
            var Newcoupondiscount = <?php echo json_encode($couponDiscount ); ?>;
            var NewshopIds = <?php echo json_encode($shop ); ?>;
            var NewMaxDelis = <?php echo json_encode($maxDeli ); ?>;
            var NewCouponUsedSellerId = <?php echo json_encode($couponUsedSellerId ); ?>;
            var NewCouponUsedProductId = <?php echo json_encode($couponUsedProductId ); ?>;
            var NewCouponId = <?php echo json_encode($couponId ); ?>;

            $.ajax({
                url: '{{ route("payment_completed") }}',
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    productid: Newproductid,
                    buyerid: Newbuyerid,
                    sellerid: Newsellerid,
                    color: Newcolor,
                    size: Newsize,
                    quantity: Newquantity,
                    productamount: Newproductamount,
                    totalqty: Newtotalqty,
                    amount: Newamount,
                    amount1: Newamount1,
                    totalamount: Newtotalamount,
                    subtotalamount: Newsubtotalamount,
                    shippingfee: Newshippingfee,
                    coupondiscountamount: Newcoupondiscount,
                    buyeraddressid : Newbuyeraddressid,
                    shopIds : NewshopIds,
                    maxDelis : NewMaxDelis,
                    couponUsedSellerId : NewCouponUsedSellerId,
                    couponUsedProductId : NewCouponUsedProductId,
                    couponId : NewCouponId,
                    payment: "PayPal"
                },
                async : false,
                success: function(response) {
                    window.location.href = "{{ route('order_success', '') }}" + "/" + response.orderId;
                },
                error: function(xhr, status, error) {
                    var errorMessage = xhr.status + ': ' + xhr.statusText;
                    alert('Error - ' + errorMessage);
                    // You can log the error to console for debugging purposes
                    console.error('Error: ' + errorMessage + 'error:' + response);
                }
            });
        }
    </script>
    
    <script>
        document.getElementById('btnPayWithCash').addEventListener('click', function() {
            let isValid = true;

            const selectedBankAccount = document.querySelector('input[name="selected_bank_account"]:checked').value;
            const transferPersonName = document.getElementById('transfer-person-name').value.trim();
            const transferDateInput = document.getElementById('transfer-date');
            const transferDate = new Date(transferDateInput.value);
            const today = new Date();
            today.setHours(0, 0, 0, 0);
            const next7Days = new Date(today);
            next7Days.setDate(today.getDate() + 7);

            document.querySelectorAll('.error').forEach(el => el.textContent = '');

            if (!selectedBankAccount) {
                isValid = false;
                document.getElementById('error-selected_bank_account').textContent = 'Please select the bank account you want to transfer.';
            }

            if (!transferPersonName) {
                isValid = false;
                document.getElementById('error-transfer-person-name').textContent = 'Please provide your account holder.';
            } else if (transferPersonName.length > 255) {
                isValid = false;
                document.getElementById('error-transfer-person-name').textContent = 'Your account holder must not exceed 255 characters.';
            }

            if (!transferDate || isNaN(transferDate.getTime())) {
                isValid = false;
                document.getElementById('error-transfer-date').textContent = 'Please provide the date of transfer for payment.';
            } else if (transferDate < today) {
                isValid = false;
                document.getElementById('error-transfer-date').textContent = 'The transfer date cannot be in the past.';
            } else if (transferDate > next7Days) {
                isValid = false;
                document.getElementById('error-transfer-date').textContent = 'The transfer date cannot exceed the next 7 days.';
            }

            if (isValid) {
                var Newproductid = <?php echo json_encode($productIds); ?>; 
                var Newbuyerid = <?php echo json_encode($buyerId); ?>; 
                var Newsellerid = <?php echo json_encode($sellerIds); ?>; 
                var Newcolor = <?php echo json_encode($productColors); ?>; 
                var Newsize = <?php echo json_encode($productSizes); ?>; 
                var Newquantity = <?php echo json_encode($productQuantities); ?>;
                var Newproductamount = <?php echo json_encode($productAmounts); ?>;
                var Newtotalqty = <?php echo json_encode($totalqty); ?>;
                var Newamount = <?php echo json_encode($amount); ?>;
                var Newamount1 = <?php echo json_encode($amount1); ?>;
                var Newtotalamount = <?php echo json_encode($total1); ?>;
                var Newsubtotalamount = <?php echo json_encode($subTotal); ?>;
                var Newshippingfee = <?php echo json_encode($shippingFee); ?>;
                var Newcoupondiscount = <?php echo json_encode($couponDiscount); ?>;
                var NewshopIds = <?php echo json_encode($shop); ?>;
                var NewMaxDelis = <?php echo json_encode($maxDeli); ?>;
                var NewCouponUsedSellerId = <?php echo json_encode($couponUsedSellerId); ?>;
                var NewCouponUsedProductId = <?php echo json_encode($couponUsedProductId); ?>;
                var NewCouponId = <?php echo json_encode($couponId); ?>;

                $.ajax({
                    url: '{{ route("cash_payment") }}',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        productid: Newproductid,
                        buyerid: Newbuyerid,
                        sellerid: Newsellerid,
                        color: Newcolor,
                        size: Newsize,
                        quantity: Newquantity,
                        productamount: Newproductamount,
                        totalqty: Newtotalqty,
                        amount: Newamount,
                        amount1: Newamount1,
                        totalamount: Newtotalamount,
                        subtotalamount: Newsubtotalamount,
                        shippingfee: Newshippingfee,
                        coupondiscountamount: Newcoupondiscount,
                        buyeraddressid : Newbuyeraddressid,
                        shopIds : NewshopIds,
                        maxDelis : NewMaxDelis,
                        couponUsedSellerId : NewCouponUsedSellerId,
                        couponUsedProductId : NewCouponUsedProductId,
                        couponId : NewCouponId,
                        payment: "Cash",
                        bankAccount: selectedBankAccount,
                        transferPersonName: transferPersonName,
                        transferDate: transferDateInput.value.trim()
                    },
                    async: false,
                    success: function(response) {
                        window.location.href = "{{ route('order_success', '') }}" + "/" + response.orderId;
                    },
                    error: function(xhr, status, error) {
                        var errorMessage = xhr.status + ': ' + xhr.statusText;
                        alert('Error - ' + errorMessage);
                        console.error('Error: ' + errorMessage + ' error: ' + response);
                    }
                });
            }
        });
    </script>
</x-guest-layout>