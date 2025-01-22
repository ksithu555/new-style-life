<x-guest-layout>
    <style>
    ul.nav {
        list-style-type: none !important;
    }
    </style>

    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Delivery Status</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Delivery Status</li>
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
                                <img src="{{ asset('frontend/assets/images/inner-page/cover-img.jpg') }}"
                                    class="img-fluid blur-up lazyload" alt="">
                            </div>

                            <div class="profile-contain">
                                <div class="profile-image">
                                    <div class="position-relative">
                                        @if ($user->user_photo)
                                        <img src="{{ asset('upload/profile/' . $user->user_photo) }}"
                                            class="blur-up lazyload update_img" alt="" id="uploaded_image">
                                        @else
                                        <img src="{{ asset('frontend/assets/images/profile.png') }}"
                                            class="blur-up lazyload update_img" alt="" id="uploaded_image">
                                        @endif
                                        <div class="cover-icon">
                                            <label for="user_profile_upload_input">
                                                <i class="fa-solid fa-pen">
                                                    <input type="file" id="user_profile_upload_input"
                                                        name="user_profile" class="form-control"
                                                        onchange="uploadUserProfile()">
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
                                <a class="nav-link" id="pills-dashboard-tab" type="button"
                                    style="font-size: 14px; text-align: center;" href="{{ route('user_dashboard') }}"><i
                                        data-feather="home"></i>
                                    DashBoard</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-order-tab" style="font-size: 14px; text-align: center;"
                                    href="{{ route('user_order') }}"><i data-feather="shopping-bag"></i>Orders</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="delivery-detail" type="button"
                                    style="font-size: 14px; text-align: center;"
                                    href="{{ route('user_deivery_status') }}"><i data-feather="box"></i>
                                    Delivery Status</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-address-tab" type="button" role="tab"
                                    style="font-size: 14px; text-align: center;" href="{{ route('user_addresses') }}"><i
                                        data-feather="map-pin"></i>Addresses</a>
                            </li>
                            {{-- <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-card-tab"
                                    type="button" role="tab" style="font-size: 14px; text-align: center;" href="{{route ('user_cards')}}"><i
                                data-feather="credit-card"></i>Payment Methods</a>
                            </li> --}}
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-profile-tab" type="button" role="tab"
                                    style="font-size: 14px; text-align: center;" href="{{ route('user_profile') }}"><i
                                        data-feather="user"></i>
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
                                <a class="nav-link" id="pills-profile-tab" type="button" role="tab"
                                    style="font-size: 14px; text-align: center; display: flex; align-items: center;"
                                    href="{{ route('user_message') }}"><i data-feather="mail"></i>
                                    Message
                                    <span id="notification-badge" class="badge rounded-pill badge-theme"
                                        style="color: #ff6b6b; font-size: 12px; margin-left: auto;">
                                        <b>{{ $noti > 0 ? 'new' : '' }}</b>
                                    </span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <!-- User Dashboard Section End -->
                <div class="col-xxl-9 col-lg-8">
                    <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">
                        My Menu</button>
                    <div class="dashboard-right-sidebar">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel">
                                <div class="dashboard-home">
                                    <div class="title">
                                        <h2>Delivery Status</h2>
                                        <span class="title-leaf">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="{{ asset('frontend/assets/svg/leaf.svg#leaf') }}">
                                                </use>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="table-responsive dashboard-bg-box">
                                        <table class="table product-table">
                                            <thead>

                                                <tr>
                                                    <th scope="col">No</th>
                                                    <th scope="col">Order Code</th>
                                                    <th scope="col" colspan="2">Product</th>
                                                    <th scope="col">Quantity</th>
                                                    <th scope="col">Total(tax inc)</th>
                                                    <th scope="col">Status</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if ($orders->count() == 0)
                                                <tr>
                                                    <td colspan="4" style="text-align: center">No data
                                                        available</td>
                                                </tr>
                                                @else
                                                @foreach ($orders as $key => $order)
                                                <tr>
                                                    <td>{{ $ttl + 1 - ($orders->firstItem() + $key) }}</td>
                                                    <td>
                                                        <h6>{{ $order->order_code }}</h6>
                                                    </td>
                                                    <td>
                                                        <img src="{{ asset('images/' . $order->product_thambnail) }}"
                                                            class="img-fluid blur-up lazyload" alt=""
                                                            style="width: 60px; height: 60px;">
                                                    </td>
                                                    <td>
                                                        <h6 style="text-align: left">
                                                            @if (mb_strlen($order->product_name) > 10)
                                                            {!! mb_substr($order->product_name, 0, 10) . '<br>' .
                                                            mb_substr($order->product_name, 10, 10) . '...' !!}
                                                            @else
                                                            {!! nl2br(e($order->product_name)) !!}
                                                            @endif
                                                        </h6>
                                                    </td>
                                                    <td>
                                                        <h6>{{ $order->qty }}</h6>
                                                    </td>
                                                    <td>
                                                        <h6>¥ {{ number_format($order->amount, 0, '.', ',') }}
                                                        </h6>
                                                    </td>
                                                    @php
                                                    $status = 'Pending';
                                                    if ($order->cancel_date) {
                                                    $status = 'Cancelled';
                                                    } elseif ($order->delivered_date) {
                                                    $status = 'Delivered';
                                                    } elseif ($order->shipped_date) {
                                                    $status = 'Shipping';
                                                    } elseif ($order->picked_date) {
                                                    $status = 'Picked';
                                                    } elseif ($order->confirmed_date) {
                                                    $status = 'Confirmed';
                                                    } elseif ($order->processing_date) {
                                                    $status = 'Processing';
                                                    }
                                                    @endphp
                                                    <td>
                                                        <h6>{{ $status }}</h6>
                                                    </td>
                                                </tr>
                                                @endforeach
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                    <div>
                                        @include('components.pagination')
                                    </div>
                                </div>
                                <!-- Delivery Status View End -->
                            </div>
                        </div>
                    </div>
                </div>
    </section>
    <!-- User Dashboard Section End -->
</x-guest-layout>