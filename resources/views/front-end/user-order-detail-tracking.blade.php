<x-guest-layout>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <div class="page-body">
        <!-- Breadcrumb Section Start -->
        <section class="breadcrumb-section pt-0">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="breadcrumb-contain">
                            <h2>Orders</h2>
                            <nav>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item">
                                        <a href="/">
                                            <i class="fa-solid fa-house"></i>
                                        </a>
                                    </li>
                                    <li class="breadcrumb-item active">Orders</li>
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
                                    <img src="{{ asset('frontend/assets/images/inner-page/cover-img.jpg') }}" class="img-fluid blur-up lazyload" alt="">
                                </div>

                                <div class="profile-contain">
                                    <div class="profile-image">
                                        <div class="position-relative">
                                            @if ($user->user_photo)
                                            <img src="{{ asset('upload/profile/' . $user->user_photo) }}" class="blur-up lazyload update_img" alt="" id="uploaded_image">
                                            @else
                                            <img src="{{ asset('frontend/assets/images/profile.png') }}" class="blur-up lazyload update_img" alt="" id="uploaded_image">
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
                                    <a class="nav-link" id="pills-dashboard-tab" data-bs-toggle="pill" data-bs-target="#pills-dashboard" type="button" style="font-size: 14px; text-align: center;"><i data-feather="home"></i>
                                        DashBoard</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="pills-order-tab" style="font-size: 14px; text-align: center;" href="{{ route('user_order') }}"><i data-feather="shopping-bag"></i>Orders</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="delivery-detail" type="button" style="font-size: 14px; text-align: center;" href="{{ route('user_deivery_status') }}"><i data-feather="box"></i>
                                        Delivery Status</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-address-tab" type="button" role="tab" style="font-size: 14px; text-align: center;" href="{{ route('user_addresses') }}"><i data-feather="map-pin"></i>Addresses</a>
                                </li>
                                {{-- <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-card-tab"
                                        type="button" role="tab" style="font-size: 14px; text-align: center;" href="{{route ('user_cards')}}"><i data-feather="credit-card"></i>Payment Methods</a>
                                </li> --}}
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-profile-tab" type="button" role="tab" style="font-size: 14px; text-align: center;" href="{{ route('user_profile') }}"><i data-feather="user"></i>
                                        Profile</a>
                                </li>
                                @php
                                $buyer = DB::table('buyers')
                                ->where('user_id', $user->id)
                                ->first();
                                $noti = DB::table('user_notifications')
                                ->where('buyer_id', $buyer->id)
                                ->where('seen', 0)
                                ->count();
                                @endphp
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-profile-tab" type="button" role="tab" style="font-size: 14px; text-align: center; display: flex; align-items: center;" href="{{ route('user_message') }}"><i data-feather="mail"></i>
                                        Message
                                        <span id="notification-badge" class="badge rounded-pill badge-theme" style="color: #ff6b6b; font-size: 12px; margin-left: auto;">
                                            <b>{{ $noti > 0 ? 'new' : '' }}</b>
                                        </span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- User Dashboard Section End -->
                    <div class="col-xxl-9 col-xl-8 col-lg-6 order-detail">
                        <div class="row g-sm-4 g-3">
                            <div class="col-xl-4 col-sm-6">
                                <div class="order-details-contain">
                                    <div class="order-tracking-icon">
                                        <i data-feather="package" class="text-content"></i>
                                    </div>

                                    <div class="order-details-name">
                                        <h5 class="text-content">Product Info</h5>
                                        <h3>
                                            @if (mb_strlen($orderDetail->product_name) > 30)
                                            {!! mb_substr($orderDetail->product_name, 0, 30) .
                                            '<br>' .
                                            mb_substr($orderDetail->product_name, 30, 30) .
                                            '...' !!}
                                            @else
                                            {!! nl2br(e($orderDetail->product_name)) !!}
                                            @endif
                                        </h3>
                                        <h5>¥ {{ number_format($orderDetail->selling_price, 0, '.', ',') }}</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-sm-6">
                                <div class="order-details-contain">
                                    <div class="order-tracking-icon">
                                        <i data-feather="truck" class="text-content"></i>
                                    </div>

                                    <div class="order-details-name">
                                        <h5 class="text-content">Shipping Fee</h5>
                                        <h4>¥ {{ number_format($orderDetail->delivery_price, 0, '.', ',') }}</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-sm-6">
                                <div class="order-details-contain">
                                    <div class="order-tracking-icon">
                                        <i class="text-content" data-feather="info"></i>
                                    </div>

                                    <div class="order-details-name">
                                        <h5 class="text-content">Shop Info</h5>
                                        <h3>{{ $orderDetail->seller->shop_name }}</h3>
                                        <h5>{{ $orderDetail->seller->phone }}</h5>
                                    </div>
                                </div>
                            </div>
                            @php
                            function formatZipCode($zipCode)
                            {
                            if (preg_match('/^\d{3}-\d{4}$/', $zipCode)) {
                            return $zipCode;
                            }
                            if (preg_match('/^\d{7}$/', $zipCode)) {
                            return substr($zipCode, 0, 3) . '-' . substr($zipCode, 3, 4);
                            }
                            return $zipCode; // return as-is if not a standard 7 digit zip code
                            }
                            @endphp

                            <div class="col-xl-4 col-sm-6">
                                <div class="order-details-contain">
                                    <div class="order-tracking-icon">
                                        <i class="text-content" data-feather="crosshair"></i>
                                    </div>

                                    <div class="order-details-name">
                                        <h5 class="text-content">From</h5>
                                        <h4>〒{{ $orderDetail->seller->zip_code }} </h4>
                                        <h4>{{ $orderDetail->seller->country->name }}
                                            {{ $orderDetail->seller->prefecture }}
                                        </h4>
                                        <h4>{{ $orderDetail->seller->city }} {{ $orderDetail->seller->chome }} </h4>
                                        <h4>{{ $orderDetail->seller->building }} {{ $orderDetail->seller->room }}</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-sm-6">
                                <div class="order-details-contain">
                                    <div class="order-tracking-icon">
                                        <i class="text-content" data-feather="map-pin"></i>
                                    </div>

                                    <div class="order-details-name">
                                        <h5 class="text-content">Destination</h5>
                                        <h4>〒{{ formatZipCode($orderDetail->cus_post_code) }} </h4>
                                        <h4>{{ $orderDetail->prefecture->name }} </h4>
                                        <h4>{{ $orderDetail->cus_city }} {{ $orderDetail->cus_chome }} </h4>
                                        <h4>{{ $orderDetail->cus_building }} {{ $orderDetail->cus_room }}</h4>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-4 col-sm-6">
                                <div class="order-details-contain">
                                    <div class="order-tracking-icon">
                                        <i class="text-content" data-feather="calendar"></i>
                                    </div>

                                    <div class="order-details-name">
                                        <h5 class="text-content">Estimated Date</h5>
                                        @if ($orderDetail->expected_from || $orderDetail->expected_to)
                                        <h4>From : {{ date('Y/m/d', strtotime($orderDetail->expected_from)) }}
                                        </h4>
                                        <h4>To : {{ date('Y/m/d', strtotime($orderDetail->expected_to)) }}</h4>
                                        @else
                                        <h4>{{ date('Y/m/d', strtotime($orderDetail->order_detail_created_at . ' + ' . $orderDetail->estimate_date . ' days')) }}
                                        </h4>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 overflow-hidden">
                                @php
                                $status = 0;
                                $pendingDone = 'progtrckr-done';
                                $pendingDate = $orderDetail->order_detail_created_at;
                                $confirmedDate = 'Pending';
                                $processingDate = 'Pending';
                                $pickedDate = 'Pending';
                                $shippedDate = 'Pending';
                                $deliveredDate = 'Pending';
                                if ($orderDetail->confirmed_date) {
                                $status = 1;
                                $confirmedDate = $orderDetail->confirmed_date;
                                }
                                if ($orderDetail->processing_date) {
                                $status = 2;
                                $processingDate = $orderDetail->processing_date;
                                }
                                if ($orderDetail->picked_date) {
                                $status = 3;
                                $pickedDate = $orderDetail->picked_date;
                                }
                                if ($orderDetail->shipped_date) {
                                $status = 4;
                                $shippedDate = $orderDetail->shipped_date;
                                }
                                if ($orderDetail->delivered_date) {
                                $status = 5;
                                $deliveredDate = $orderDetail->delivered_date;
                                }

                                $confirmedDone = $status >= 1 ? 'progtrckr-done' : 'progtrckr-todo';
                                $processingDone = $status >= 2 ? 'progtrckr-done' : 'progtrckr-todo';
                                $pickedDone = $status >= 3 ? 'progtrckr-done' : 'progtrckr-todo';
                                $shippedDone = $status >= 4 ? 'progtrckr-done' : 'progtrckr-todo';
                                $deliveredDone = $status >= 5 ? 'progtrckr-done' : 'progtrckr-todo';
                                @endphp
                                <ol class="progtrckr">
                                    <li class="{{ $pendingDone }}">
                                        <h5>Pending</h5>
                                        <h6>{{ date('Y/m/d H:i', strtotime($pendingDate)) }}</h6>
                                    </li>
                                    <li class="{{ $confirmedDone }}">
                                        <h5>Confirmed</h5>
                                        @if ($confirmedDate != 'Pending')
                                        <h6>{{ date('Y/m/d H:i', strtotime($confirmedDate)) }}</h6>
                                        @else
                                        <h6>{{ $confirmedDate }}</h6>
                                        @endif
                                    </li>
                                    <li class="{{ $processingDone }}">
                                        <h5>Processing</h5>
                                        @if ($processingDate != 'Pending')
                                        <h6>{{ date('Y/m/d H:i', strtotime($processingDate)) }}</h6>
                                        @else
                                        <h6>{{ $processingDate }}</h6>
                                        @endif
                                    </li>
                                    <li class="{{ $pickedDone }}">
                                        <h5>Picked</h5>
                                        @if ($pickedDate != 'Pending')
                                        <h6>{{ date('Y/m/d H:i', strtotime($pickedDate)) }}</h6>
                                        @else
                                        <h6>{{ $pickedDate }}</h6>
                                        @endif
                                    </li>
                                    <li class="{{ $shippedDone }}">
                                        <h5>Shipped</h5>
                                        @if ($shippedDate != 'Pending')
                                        <h6>{{ date('Y/m/d H:i', strtotime($shippedDate)) }}</h6>
                                        @else
                                        <h6>{{ $shippedDate }}</h6>
                                        @endif
                                    </li>
                                    <li class="{{ $deliveredDone }}">
                                        <h5>Delivered</h5>
                                        @if ($deliveredDate != 'Pending')
                                        <h6>{{ date('Y/m/d H:i', strtotime($deliveredDate)) }}</h6>
                                        @else
                                        <h6>{{ $deliveredDate }}</h6>
                                        @endif
                                    </li>
                                </ol>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <div class="table-responsive">
                                    <table class="table order-tab-table">
                                        <thead>
                                            <tr>
                                                <th>Description</th>
                                                <th>Date</th>
                                                <th>Time</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>Order Placed</td>
                                                <td>{{ date('Y/m/d', strtotime($pendingDate)) }}</td>
                                                <td>{{ date('h:i A', strtotime($pendingDate)) }}</td>
                                            </tr>
                                            @if ($confirmedDate != 'Pending')
                                            <tr>
                                                <td>Confirmed the Order</td>
                                                <td>{{ date('Y/m/d', strtotime($confirmedDate)) }}</td>
                                                <td>{{ date('h:i A', strtotime($confirmedDate)) }}</td>
                                            </tr>
                                            @endif
                                            @if ($processingDate != 'Pending')
                                            <tr>
                                                <td>Processing to Ship</td>
                                                <td>{{ date('Y/m/d', strtotime($processingDate)) }}</td>
                                                <td>{{ date('h:i A', strtotime($processingDate)) }}</td>
                                            </tr>
                                            @endif
                                            @if ($pickedDate != 'Pending')
                                            <tr>
                                                <td>Picked for Shipping</td>
                                                <td>{{ date('Y/m/d', strtotime($pickedDate)) }}</td>
                                                <td>{{ date('h:i A', strtotime($pickedDate)) }}</td>
                                            </tr>
                                            @endif
                                            @if ($shippedDate != 'Pending')
                                            <tr>
                                                <td>Shipping the Product</td>
                                                <td>{{ date('Y/m/d', strtotime($shippedDate)) }}</td>
                                                <td>{{ date('h:i A', strtotime($shippedDate)) }}</td>
                                            </tr>
                                            @endif
                                            @if ($deliveredDate != 'Pending')
                                            <tr>
                                                <td>Delivered</td>
                                                <td>{{ date('Y/m/d', strtotime($deliveredDate)) }}</td>
                                                <td>{{ date('h:i A', strtotime($deliveredDate)) }}</td>
                                            </tr>
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>
    </section>
    <!-- User Dashboard Section End -->

</x-guest-layout>