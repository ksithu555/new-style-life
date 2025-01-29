<x-guest-layout>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <div class="page-body">
        <!-- Breadcrumb Section Start -->
        <section class="breadcrumb-section pt-0">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-contain">
                            <h2>{{ __('messages.orders') }}</h2>
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="/">
                                            <i class="fa-solid fa-house"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">{{ __('messages.orders') }}</li>
                                </ol>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- Breadcrumb Section End -->
    
        <!-- User Dashboard Section Start -->
        <section class="user-dashboard-section section-b-space">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-xxl-3 col-lg-4">
                        <div class="dashboard-left-sidebar">
                            <div class="close-button d-flex d-lg-none">
                                <button class="close-sidebar">
                                    <i class="fa-solid fa-xmark"></i>
                                </button>
                            </div>
                            <div class="profile-box">
                                <div class="cover-image">
                                    <img src="{{ asset('frontend/assets/images/inner-page/cover-img.jpg') }}" class="img-fluid blur-up lazyload"
                                        alt="">
                                </div>
    
                                <div class="profile-contain">
                                    <div class="profile-image">
                                        <div class="position-relative">
                                            @if ($user->user_photo)
                                            <img src="{{ asset('upload/profile/' . $user->user_photo) }}"
                                                class="blur-up lazyload update_img" alt=""  id="uploaded_image">
                                            @else
                                            <img src="{{ asset('frontend/assets/images/profile.png') }}"
                                                class="blur-up lazyload update_img" alt=""  id="uploaded_image">
                                            @endif
                                                <div class="cover-icon">
                                                    <label for="user_profile_upload_input">
                                                        <i class="fa-solid fa-pen">
                                                        <input type="file" id="user_profile_upload_input" name="user_profile" class="form-control" onchange="uploadUserProfile()">
                                                        </i>
                                                    </label>
                                                </div>
                                        </div>
                                    </div>
    
                                    <div class="profile-name">
                                        <h3>{{ $user->name }}</h3>
                                        <h6 class="text-content">{{ $user->email }}</h6>
                                    </div>
                                </div>
                            </div>
    
                            <ul class="nav nav-pills user-nav-pills" id="pills-tab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-dashboard-tab"
                                            type="button" style="font-size: 14px; text-align: center;" href="{{route ('user_dashboard')}}"><i data-feather="home"></i>
                                            {{ __('messages.dashboard') }}</a>
                                </li>
                                <li class="nav-item active" role="presentation">
                                    <a class="nav-link active" id="pills-order-tab"
                                        style="font-size: 14px; text-align: center;" href="{{route ('user_order')}}"><i
                                            data-feather="shopping-bag"></i>{{ __('messages.orders') }}</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="delivery-detail"
                                        type="button" style="font-size: 14px; text-align: center;" href="{{route ('user_deivery_status')}}"><i data-feather="box"></i>
                                        {{ __('messages.delivery_status') }}</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-address-tab"
                                        type="button" role="tab" style="font-size: 14px; text-align: center;" href="{{route ('user_addresses')}}"><i
                                            data-feather="map-pin"></i>{{ __('messages.address') }}</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-profile-tab"
                                        type="button" role="tab" style="font-size: 14px; text-align: center;" href="{{route ('user_profile')}}"><i data-feather="user"></i>
                                        {{ __('messages.profile') }}</a>
                                </li>
                                @php
                                    $buyer = DB::table('buyers')->where('user_id', $user->id)->first();
                                    $noti = DB::table('user_notifications')->where('buyer_id', $buyer->id)->where('seen', 0)->count();
                                @endphp
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-profile-tab"
                                        type="button" role="tab" style="font-size: 14px; text-align: center; display: flex; align-items: center;" href="{{route ('user_message')}}"><i data-feather="mail"></i>
                                        {{ __('messages.message') }}
                                        <span id="notification-badge" class="badge rounded-pill badge-theme" style="color: #ff6b6b; font-size: 12px; margin-left: auto;">
                                            <b>{{ $noti > 0 ? 'new' : '' }}</b>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
    
                    <!-- User Dashboard Section End -->
    
                    <div class="col-xxl-9 col-lg-8" class="tab-pane fade" id="pills-order" role="tabpanel">
                        <!-- Orders Details Start -->
                            <div class="page-body">
                    <!-- tracking table start -->
    
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-sm-12">
                            @php
                                $price = 0;
                                $shippingFee = 0;
                                $couponDiscountAmount = 0;
                                $subTotalAmount  = 0;
                                $totalAmount = 0;
                                $orders = 0;
                            @endphp
                                <div class="card">
                                    <div class="card-body">
                                        <div class="title-header title-header-block package-card">
                                        @if($orderDetails->isNotEmpty())
                                            @php
                                                $orders = $orderDetails->first();
                                                $subTotalAmount = $orders->sub_total_amount;
                                                $totalAmount = $orders->total_amount;
                                                $couponDiscountAmount = $orders->coupon_discount_amount;
                                                $shippingFee = $orders->shipping_fee;
                                            @endphp
                                        @endif
                                            <div>
                                                <h5>{{ __('messages.order_code') }} <span style="color: var(--theme-color);">{{ $orders->order_code }}</span></h5>
                                            </div>
                                            <div class="card-order-section">
                                                <h5 style="color: var(--theme-color);">{{ date('Y/m/d', strtotime($orders->order_created_at)) }}</h5>
                                                <h5>{{ __('messages.items') }}: <span style="color: var(--theme-color);">{{ $orders->total_qty }}</span></h5>
                                                <h5>{{ __('messages.total') }}: <span style="color: var(--theme-color);">¥ {{ number_format($orders->total_amount , 0, '.', ',') }}</span></h5>
                                            </div>
                                        </div>
                                        <br>
                                        @if ($orderDetails->first()->payment_approved == 0)
                                            <p style="color:red; font-size:12px;">* {{ __('messages.please_make_transfer') }}</p>
                                        @elseif ($orderDetails->first()->payment_approved == 2)
                                            <p style="color:red; font-size:12px;">* {{ __('messages.order_cancelled_no_transfer') }}</p>
                                        @endif
                                        <div class="bg-inner cart-section order-details-table">
                                            <div class="row g-4">
                                                <div class="col-xl-9">
                                                    <div class="table-responsive table-details">
                                                        <table class="table cart-table table-borderless">
                                                            <thead>
                                                                <tr>
                                                                    <th>#</th>
                                                                    <th>{{ __('messages.product') }}</th>
                                                                    <th>{{ __('messages.shop') }}</th>
                                                                    <th>{{ __('messages.quantity') }}</th>
                                                                    <th>{{ __('messages.price_tax_included') }}</th>
                                                                    <th>{{ __('messages.size') }}</th>
                                                                    <th>{{ __('messages.color') }}</th>
                                                                    <th></th>
                                                                </tr>
                                                            </thead>
    
                                                            @foreach($orderDetails as $index => $order)
                                                            <tbody>
                                                                <tr class="table-order">
                                                                    <td>
                                                                        {{ $index + 1 }}
                                                                    </td>
                                                                    <td>
                                                                        <a href="{{ route('show-product-left-thumbnail', ['id' => $order->product_id]) }}">
                                                                            <h5 style="width: 100px;">{{ mb_substr($order->product_name, 0, 20) . '...' }}</h5>
                                                                        </a>
                                                                    </td>
                                                                    @php
                                                                        $shop = DB::table('sellers')->where('user_id', $order->seller_id)->first();
                                                                    @endphp
                                                                    <td>
                                                                        <h5>{{ $shop->shop_name }}</h5>
                                                                    </td>
                                                                    <td>
                                                                        <h5>{{ $order->qty }}</h5>
                                                                    </td>
                                                                    <td>
                                                                        <h5>¥ {{ number_format($order->selling_price * $order->qty , 0, '.', ',') }}</h5>
                                                                    </td>
                                                                    <td>
                                                                        <h5>{{ $order->size }}</h5>
                                                                    </td>
                                                                    <td>
                                                                        <h5>{{ $order->color }}</h5>
                                                                    </td>
                                                                    <td>
                                                                        @if ($order->payment_approved == 1)
                                                                            @if ($order->status != "Cancel" && $order->status != "Cash Cancel")
                                                                            <a type="button" class="btn btn-sm" style="background-color: var(--theme-color); border:0.5px solid var(--theme-color); margin-left:0.5em; color:white;"
                                                                                href="{{route ('order_detail_tracking',['id' => $order->order_detail_id]) }}">{{ __('messages.tracking') }}</a>
                                                                            @else
                                                                            <button type="button" class="btn btn-sm" style="background-color: #ff6b6b; border:0.5px solid var(--theme-color); margin-left:0.5em; color:white;"
                                                                                onclick="cancelReason({{ $order->order_detail_id }})">{{ __('messages.cancelled') }}</button>
                                                                            @endif
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                            <!-- Confirmation Modal for Edit -->
                                                            @if ($order->status == "Cancel" || $order->status == "Cash Cancel")
                                                            <div class="modal fade theme-modal remove-profile" id="showCancelReason{{ $order->order_detail_id }}" tabindex="-1" aria-hidden="true">
                                                                <div class="modal-dialog modal-dialog-centered">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header d-block text-center">
                                                                            <h5 class="modal-title w-100" id="exampleModalLabel{{ $order->order_detail_id }}">{{ __('messages.cancelled_reason') }}</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                                <i class="fa-solid fa-xmark"></i>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="remove-box">
                                                                                <p>{{ $order->cancelled_reason}}</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            @endif
                                                            @endforeach
                                                            <tfoot>
                                                                <tr class="table-order">
                                                                    <td colspan="4">
                                                                        <h5>{{ __('messages.sub_total') }} :</h5>
                                                                    </td>
                                                                    <td>
                                                                        <h4>¥ {{ number_format($subTotalAmount , 0, '.', ',') }}</h4>
                                                                    </td>
                                                                </tr>
    
                                                                <tr class="table-order">
                                                                    <td colspan="4">
                                                                        <h5>{{ __('messages.shipping') }} :</h5>
                                                                    </td>
                                                                    <td>
                                                                        <h4>¥ {{ number_format($shippingFee , 0, '.', ',') }}</h4>
                                                                    </td>
                                                                </tr>
    
                                                                <tr class="table-order">
                                                                    <td colspan="4">
                                                                        <h5>{{ __('messages.coupon_discounted') }} :</h5>
                                                                    </td>
                                                                    <td>
                                                                        <h4>¥ {{ number_format($couponDiscountAmount , 0, '.', ',') }}</h4>
                                                                    </td>
                                                                </tr>
    
                                                                <tr class="table-order">
                                                                    <td colspan="4">
                                                                        <h4 class="theme-color fw-bold">{{ __('messages.total_price') }} :</h4>
                                                                    </td>
                                                                    <td>
                                                                        <h4 class="theme-color fw-bold">¥ {{ number_format($totalAmount , 0, '.', ',') }}</h4>
                                                                    </td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
    
                                                <div class="col-xl-3">
                                                    <div class="order-success">
                                                        <div class="row g-4">
                                                            <h3>{{ __('messages.summary') }}</h3>
                                                            <ul class="order-details">
                                                                <li>{{ __('messages.order_code') }}: {{ $order->order_code }}</li>
                                                                <li>{{ __('messages.order_date') }}: {{ date('Y/m/d H:i', strtotime($order->created_at)) }}</li>
                                                                <li>{{ __('messages.order_total') }}: ¥ {{ number_format($totalAmount , 0, '.', ',') }}</li>
                                                            </ul>
    
                                                            @php
                                                                function formatZipCode($zipCode) {
                                                                    if (preg_match('/^\d{3}-\d{4}$/', $zipCode)) {
                                                                        return $zipCode;
                                                                    }
                                                                    if (preg_match('/^\d{7}$/', $zipCode)) {
                                                                        return substr($zipCode, 0, 3) . '-' . substr($zipCode, 3, 4);
                                                                    }
                                                                    return $zipCode; // return as-is if not a standard 7 digit zip code
                                                                }
                                                            @endphp
                                                            <div class="payment-mode">
                                                                <h4>{{ __('messages.shipping_address') }}</h4>
                                                                <ul class="order-details">
                                                                    <li><h5>{{ $order->order_details_name }}</h5></li><br>
                                                                    <li>〒{{ formatZipCode($order->post_code) }}</li><br>
                                                                    <li>{{ $order->prefecture->name }}</li><br>
                                                                    <li>{{ $order->city }}</li><br>
                                                                    <li>{{ $order->chome }}</li><br>
                                                                    <li>{{ $order->building }} {{ $order->room_no }}</li><br>
                                                                    <li>{{ $order->order_details_phone }}</li>
                                                                </ul>
                                                            </div>
    
                                                            <div class="payment-mode">
                                                                <h4>{{ __('messages.payment_method') }}</h4>
                                                                <p>{{ $order->payment_type }}</p>
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
                <!-- tracking section End -->
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- User Dashboard Section End -->
    <script>
        function uploadUserProfile() {
            // Get the selected file
            const fileInput = document.getElementById('user_profile_upload_input');
            const file = fileInput.files[0];
            
            // Create a FormData object and append the file to it
            const formData = new FormData();
            formData.append('user_profile', file);
            
            // Send an AJAX request to the user_profile_upload route
            $.ajax({
                url: '/user-profile-upload',
                type: 'POST',
                data: formData,
                processData: false,
                contentType: false,
                success: function(data) {
                    // Handle the response data
                    if (data.success) {
                        // If upload successful, update the src attribute of the image tag
                        console.log(data.file_url);
                        $('#uploaded_image').attr('src', data.file_url);
                    } else {
                        // If upload failed, display an error message
                        console.error('Upload failed:', data.error);
                    }
                },
                error: function(xhr, status, error) {
                    // Handle errors
                    console.error('Error:', error);
                }
            });
        }
    </script>
    
    <script>
        ClassicEditor
            .create(document.querySelector('#ckeditor'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        function mainThamUrl(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#mainThmb').attr('src', e.target.result).width(70).height(70);
                };
                reader.readAsDataURL(input.files[0]); // Corrected method name
            }
        }
    </script>
    <script>
        document.getElementById('multiImg').addEventListener('change', function(event) {
            const preview = document.getElementById('preview_img');
            preview.innerHTML = '';
    
            Array.from(event.target.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '100px';
                    img.style.maxHeight = '100px';
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>
    <script>
        function cancelReason(id) {
            const confirmModal = new bootstrap.Modal(document.getElementById('showCancelReason' + id));
                confirmModal.show();
        }
    </script>
    
    </x-guest-layout>