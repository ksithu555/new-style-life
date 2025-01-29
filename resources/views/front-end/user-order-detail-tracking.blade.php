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
                                        {{ __('messages.dashboard') }}</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="pills-order-tab" style="font-size: 14px; text-align: center;" href="{{ route('user_order') }}"><i data-feather="shopping-bag"></i>
                                        {{ __('messages.orders') }}</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="delivery-detail" type="button" style="font-size: 14px; text-align: center;" href="{{ route('user_deivery_status') }}"><i data-feather="box"></i>
                                        {{ __('messages.delivery_status') }}</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-address-tab" type="button" role="tab" style="font-size: 14px; text-align: center;" href="{{ route('user_addresses') }}"><i data-feather="map-pin"></i>
                                        {{ __('messages.address') }}</a>
                                </li>
                                {{-- <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-card-tab"
                                        type="button" role="tab" style="font-size: 14px; text-align: center;" href="{{route ('user_cards')}}"><i data-feather="credit-card"></i>Payment Methods</a>
                                </li> --}}
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="pills-profile-tab" type="button" role="tab" style="font-size: 14px; text-align: center;" href="{{ route('user_profile') }}"><i data-feather="user"></i>
                                        {{ __('messages.profile') }}</a>
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
                    <div class="col-xxl-9 col-xl-8 col-lg-6 order-detail">
                        <div class="row g-sm-4 g-3">
                            <div class="col-xl-4 col-sm-6">
                                <div class="order-details-contain">
                                    <div class="order-tracking-icon">
                                        <i data-feather="package" class="text-content"></i>
                                    </div>

                                    <div class="order-details-name">
                                        <h5 class="text-content">{{ __('messages.product_information') }}</h5>
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
                                        <h5 class="text-content">{{ __('messages.shipping_fee') }}</h5>
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
                                        <h5 class="text-content">{{ __('messages.shop_information') }}</h5>
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
                                        <h5 class="text-content">{{ __('messages.from') }}</h5>
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
                                        <h5 class="text-content">{{ __('messages.destination') }}</h5>
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
                                        <h5 class="text-content">{{ __('messages.estimated_date') }}</h5>
                                        @if ($orderDetail->expected_from || $orderDetail->expected_to)
                                        <h4>{{ __('messages.from') }} : {{ date('Y/m/d', strtotime($orderDetail->expected_from)) }}</h4>
                                        <h4>{{ __('messages.to') }} : {{ date('Y/m/d', strtotime($orderDetail->expected_to)) }}</h4>
                                        @else
                                        <h4>{{ date('Y/m/d', strtotime($orderDetail->order_detail_created_at . ' + ' . $orderDetail->estimate_date . ' days')) }}</h4>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <div class="col-12 overflow-hidden">
                                @php
                                $status = 0;
                                $pendingDone = 'progtrckr-done';
                                $pendingDate = $orderDetail->order_detail_created_at;
                                $confirmedDate = __('messages.pending');
                                $processingDate = __('messages.pending');
                                $pickedDate = __('messages.pending');
                                $shippedDate = __('messages.pending');
                                $deliveredDate = __('messages.pending');
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
                                        <h5>{{ __('messages.pending') }}</h5>
                                        <h6>{{ date('Y/m/d H:i', strtotime($pendingDate)) }}</h6>
                                    </li>
                                    <li class="{{ $confirmedDone }}">
                                        <h5>{{ __('messages.confirmed') }}</h5>
                                        @if ($confirmedDate != __('messages.pending'))
                                        <h6>{{ date('Y/m/d H:i', strtotime($confirmedDate)) }}</h6>
                                        @else
                                        <h6>{{ $confirmedDate }}</h6>
                                        @endif
                                    </li>
                                    <li class="{{ $processingDone }}">
                                        <h5>{{ __('messages.processing') }}</h5>
                                        @if ($processingDate != __('messages.pending'))
                                        <h6>{{ date('Y/m/d H:i', strtotime($processingDate)) }}</h6>
                                        @else
                                        <h6>{{ $processingDate }}</h6>
                                        @endif
                                    </li>
                                    <li class="{{ $pickedDone }}">
                                        <h5>{{ __('messages.picked') }}</h5>
                                        @if ($pickedDate != __('messages.pending'))
                                        <h6>{{ date('Y/m/d H:i', strtotime($pickedDate)) }}</h6>
                                        @else
                                        <h6>{{ $pickedDate }}</h6>
                                        @endif
                                    </li>
                                    <li class="{{ $shippedDone }}">
                                        <h5>{{ __('messages.shipped') }}</h5>
                                        @if ($shippedDate != __('messages.pending'))
                                        <h6>{{ date('Y/m/d H:i', strtotime($shippedDate)) }}</h6>
                                        @else
                                        <h6>{{ $shippedDate }}</h6>
                                        @endif
                                    </li>
                                    <li class="{{ $deliveredDone }}">
                                        <h5>{{ __('messages.delivered') }}</h5>
                                        @if ($deliveredDate != __('messages.pending'))
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
                                                <th>{{ __('messages.description') }}</th>
                                                <th>{{ __('messages.date') }}</th>
                                                <th>{{ __('messages.time') }}</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>{{ __('messages.order_placed') }}</td>
                                                <td>{{ date('Y/m/d', strtotime($pendingDate)) }}</td>
                                                <td>{{ date('h:i A', strtotime($pendingDate)) }}</td>
                                            </tr>
                                            @if ($confirmedDate != __('messages.pending'))
                                            <tr>
                                                <td>{{ __('messages.order_confirmed') }}</td>
                                                <td>{{ date('Y/m/d', strtotime($confirmedDate)) }}</td>
                                                <td>{{ date('h:i A', strtotime($confirmedDate)) }}</td>
                                            </tr>
                                            @endif
                                            @if ($processingDate != __('messages.pending'))
                                            <tr>
                                                <td>{{ __('messages.processing_to_ship') }}</td>
                                                <td>{{ date('Y/m/d', strtotime($processingDate)) }}</td>
                                                <td>{{ date('h:i A', strtotime($processingDate)) }}</td>
                                            </tr>
                                            @endif
                                            @if ($pickedDate != __('messages.pending'))
                                            <tr>
                                                <td>{{ __('messages.picked_for_shipping') }}</td>
                                                <td>{{ date('Y/m/d', strtotime($pickedDate)) }}</td>
                                                <td>{{ date('h:i A', strtotime($pickedDate)) }}</td>
                                            </tr>
                                            @endif
                                            @if ($shippedDate != __('messages.pending'))
                                            <tr>
                                                <td>{{ __('messages.shipping_the_product') }}</td>
                                                <td>{{ date('Y/m/d', strtotime($shippedDate)) }}</td>
                                                <td>{{ date('h:i A', strtotime($shippedDate)) }}</td>
                                            </tr>
                                            @endif
                                            @if ($deliveredDate != __('messages.pending'))
                                            <tr>
                                                <td>{{ __('messages.delivered') }}</td>
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
</x-guest-layout>