<x-guest-layout>
    <style>
        ul.nav{
            list-style-type: none !important;
        }

    </style>
    
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>{{ __('messages.message') }}</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">{{ __('messages.message') }}</li>
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
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-order-tab" 
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
                            {{-- <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-card-tab"
                                    type="button" role="tab" style="font-size: 14px; text-align: center;" href="{{route ('user_cards')}}"><i
                                        data-feather="credit-card"></i>Payment Methods</a>
                            </li> --}}
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-profile-tab"
                                    type="button" role="tab" style="font-size: 14px; text-align: center;" href="{{route ('user_profile')}}"><i data-feather="user"></i>
                                    {{ __('messages.profile') }}</a>
                            </li>
                            @php
                                $buyer = DB::table('buyers')->where('user_id', $user->id)->first();
                                $noti = DB::table('user_notifications')->where('buyer_id', $buyer->id)->count();
                            @endphp
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="pills-profile-tab"
                                    type="button" role="tab" style="font-size: 14px; text-align: center; display: flex; align-items: center;" href="{{route ('user_message')}}"><i data-feather="mail"></i>
                                    {{ __('messages.message') }}
                                    <span id="notification-badge" class="badge rounded-pill badge-theme" style="color: #ff6b6b; font-size: 12px; margin-left: auto;">
                                        <b></b>
                                    </span>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                </div>
                <!-- User Dashboard Section End -->

                <!-- Show Profile Start -->
                <div class="col-xxl-9 col-lg-8">
                    <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">
                        {{ __('messages.my_menu') }}</button>
                    <div class="dashboard-right-sidebar">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel">
                                <div class="dashboard-profile">
                                    <div class="title title-flex">
                                        <div>
                                            <h2>{{ __('messages.message') }}</h2>
                                            <span class="title-leaf">
                                                <svg class="icon-width bg-gray">
                                                    <use xlink:href="{{ asset('frontend/assets/svg/leaf.svg#leaf') }}"></use>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>
                                    {{-- @include('components.messagebox') --}}
                                    <div class="row" style="margin-bottom: 5px;">
                                        @if ($userNotis->count() > 0)
                                        <div class="col-md-10">
                                            @include('components.messagebox')
                                        </div>
                                        <div class="col-md-2 text-right" style="display: flex; align-items: center; justify-content: flex-end; margin-left: auto;">
                                            <button id="clearAllNotifications" class="btn btn-danger" style="background-color: var(--bs-body-bg);display: flex; align-items: center; padding: 10px 20px; font-size: 16px; border-radius: 5px;">
                                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#removeNotiAll" style="color: var(--theme-color); text-decoration: none; display: flex; align-items: center;">
                                                    <i class="ri-delete-bin-line" style="margin-right: 5px;"></i> {{ __('messages.clear_all') }}
                                                </a>
                                            </button>
                                            <!-- Remove Noti Modal Start -->
                                            <div class="modal fade theme-modal remove-profile" id="removeNotiAll" tabindex="-1" aria-hidden="true">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header d-block text-center">
                                                            <h5 class="modal-title w-100" id="exampleModalLabel22">{{ __('messages.are_you_sure_to_delete') }}</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                <i class="fa-solid fa-xmark"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="remove-box">
                                                                <p>{{ __('messages.delete_all_messages') }}</p>
                                                            </div>
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form action="{{ route('remove_message_all', ['id' => $buyer->id]) }}" method="POST">
                                                                @csrf
                                                                <button type="submit" class="btn theme-bg-color btn-md fw-bold text-light">{{ __('messages.btn_yes') }}</button>
                                                            </form>
                                                            <button type="button" class="btn btn-md fw-bold" data-bs-dismiss="modal"
                                                            style="background-color: #ff6b6b;border-color: #ff6b6b;">{{ __('messages.btn_no') }}</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Remove Noti Modal End -->
                                        </div>
                                        @else
                                        <div class="col-md-12 text-center">
                                            <h3>{{ __('messages.no_message_in_message_box') }}</h3>
                                        </div>
                                        @endif
                                    </div>

                                    @foreach($userNotis as $key => $userNoti)
                                    <div class="row">
                                        <div class="profile-detail dashboard-bg-box" style="margin-bottom: 5px;">
                                            <div class="profile-name-detail">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            @if ($userNoti->title == 'Cash Cancel')
                                                                <p><strong>{{ __('messages.order_cancelled') }}</strong></p>
                                                            @else
                                                                <p><strong>{{ __('messages.order_status', [
                                                                    'status' => $userNoti->title == 'Cancel' ? __('messages.cancelled_message') : 
                                                                               ($userNoti->title == 'Delivered' ? __('messages.delivered_message') : 
                                                                               ($userNoti->title == 'Confirmed' ? __('messages.confirmed_message') : $userNoti->title))
                                                                ]) }}</strong></p>
                                                            @endif
                                                        </div>
                                                        <div class="col-md-2 text-right" style="display: flex; align-items: center; justify-content: flex-end; margin-left: auto;">
                                                            {{ date('Y/m/d H:i', strtotime($userNoti->created_at)) }}
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-10">
                                                            <div class="row">
                                                                <div class="col-md-1">
                                                                    <img src="{{ asset('images/'.$userNoti->orderDetail->product->product_thambnail) }}"
                                                                    class="img-fluid blur-up lazyload" alt="" style="width: 40px;height: 40px;">
                                                                </div>
                                                                <div class="col-md-11">
                                                                    <div class="row">
                                                                        <h4>{{ $userNoti->orderDetail->product->product_name }}</h4>
                                                                    </div>
                                                                    <div class="row">
                                                                        <p>{{ $userNoti->orderDetail->qty }} {{ $userNoti->orderDetail->qty == 1 ? __('messages.item') : __('messages.items') }}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                @if($userNoti->title == 'Confirmed')
                                                                    <span>
                                                                        {{ __('messages.order_confirmed', [
                                                                            'shop_name' => $userNoti->orderDetail->seller->shop_name,
                                                                            'expected_from' => date('Y/m/d', strtotime($userNoti->orderDetail->expected_from)),
                                                                            'expected_to' => date('Y/m/d', strtotime($userNoti->orderDetail->expected_to))
                                                                        ]) }}
                                                                    </span>
                                                                @elseif($userNoti->title == 'Delivered')
                                                                    <span>
                                                                        {{ __('messages.order_delivered', [
                                                                            'shop_name' => $userNoti->orderDetail->seller->shop_name,
                                                                            'delivered_date' => date('Y/m/d H:i', strtotime($userNoti->orderDetail->delivered_date))
                                                                        ]) }}
                                                                        {{ __('messages.contact_us_if_not_received') }}
                                                                    </span>
                                                                @elseif($userNoti->title == 'Cancel')
                                                                    <span>
                                                                        {{ __('messages.order_cancelled_by_seller', [
                                                                            'shop_name' => $userNoti->orderDetail->seller->shop_name,
                                                                            'cancelled_reason' => $userNoti->orderDetail->cancelled_reason
                                                                        ]) }}
                                                                    </span>
                                                                @elseif($userNoti->title == 'Cash Cancel')
                                                                    <span>
                                                                        {{ __('messages.order_cancelled_no_payment', [
                                                                            'cancelled_reason' => $userNoti->orderDetail->cancelled_reason
                                                                        ]) }}
                                                                    </span>
                                                                @endif
                                                            </div>
                                                        </div>
                                                        <div class="col-md-2 text-right" style="display: flex; align-items: center; justify-content: space-between; margin-left: auto;">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal" 
                                                            data-bs-target="#removeNoti{{ $userNoti->id }}">
                                                                {{-- <i class="ri-delete-bin-line"></i> --}}
                                                                <i data-feather="trash-2" style="width: 16px; height: 16px;"></i>
                                                            </a>
                                                        </div>
                                                        <!-- Remove Noti Modal Start -->
                                                        <div class="modal fade theme-modal remove-profile" id="removeNoti{{ $userNoti->id }}" tabindex="-1" aria-hidden="true">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header d-block text-center">
                                                                        <h5 class="modal-title w-100" id="exampleModalLabel22">{{ __('messages.are_you_sure_to_remove') }}</h5>
                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                                            <i class="fa-solid fa-xmark"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <div class="remove-box">
                                                                            <p>{{ __('messages.remove_message_from_message_box') }}</p>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <form action="{{ route('remove_message', ['id' => $userNoti->id]) }}" method="POST">
                                                                            @csrf
                                                                            <button type="submit" class="btn theme-bg-color btn-md fw-bold text-light">{{ __('messages.btn_yes') }}</button>
                                                                        </form>
                                                                        <button type="button" class="btn btn-md fw-bold" data-bs-dismiss="modal"
                                                                        style="background-color: #ff6b6b;border-color: #ff6b6b;">{{ __('messages.btn_no') }}</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <!-- Remove Noti Modal End -->
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>                            
                                    @endforeach
                                </div>      
                            </div>
                        </div>
                        @include('components.pagination')
                    </div>  
                </div>
                <!-- User Profile View End -->
            </div>
        </div>
    </section>
    <!-- User Dashboard Section End -->
</x-guest-layout>