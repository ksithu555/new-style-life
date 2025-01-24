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
                                <a class="nav-link" id="pills-dashboard-tab" type="button" style="font-size: 14px; text-align: center;" href="{{route ('user_dashboard')}}"><i data-feather="home"></i>
                                    {{ __('messages.dashboard') }}</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="pills-order-tab" style="font-size: 14px; text-align: center;" href="{{route ('user_order')}}"><i data-feather="shopping-bag"></i>
                                    {{ __('messages.orders') }}</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="delivery-detail" type="button" style="font-size: 14px; text-align: center;" href="{{route ('user_deivery_status')}}"><i data-feather="box"></i>
                                    {{ __('messages.delivery_status') }}</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-address-tab" type="button" role="tab" style="font-size: 14px; text-align: center;" href="{{route ('user_addresses')}}"><i data-feather="map-pin"></i>
                                    {{ __('messages.address') }}</a>
                            </li>
                            {{-- <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-card-tab" type="button" role="tab" style="font-size: 14px; text-align: center;" href="{{route ('user_cards')}}"><i data-feather="credit-card"></i>Payment Methods</a>
                            </li> --}}
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-profile-tab" type="button" role="tab" style="font-size: 14px; text-align: center;" href="{{route ('user_profile')}}"><i data-feather="user"></i>
                                    {{ __('messages.profile') }}</a>
                            </li>
                            @php
                                $buyer = DB::table('buyers')->where('user_id', $user->id)->first();
                                $noti = DB::table('user_notifications')->where('buyer_id', $buyer->id)->where('seen', 0)->count();
                            @endphp
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-profile-tab" type="button" role="tab" style="font-size: 14px; text-align: center; display: flex; align-items: center;" href="{{route ('user_message')}}"><i data-feather="mail"></i>
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

                
                <div class="col-xxl-9 col-lg-8">
                    <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">
                        {{ __('messages.my_menu') }}
                    </button>
                    <div class="dashboard-right-sidebar">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel">
                                <div class="dashboard-order">
                                    <div class="title">
                                        <h2>{{ __('messages.orders') }}</h2>
                                        <span class="title-leaf">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="{{ asset('frontend/assets/svg/leaf.svg#leaf') }}"></use>
                                            </svg>
                                        </span>
                                    </div>

                        
                        <div class="table-responsive dashboard-bg-box">
                            <table class="table product-table">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">{{ __('messages.date') }}</th>
                                        <th scope="col">{{ __('messages.order_code') }}</th>
                                        <th scope="col">{{ __('messages.quantity') }}</th>
                                        <th scope="col">{{ __('messages.amount_tax_inc') }}</th>
                                        <th scope="col">{{ __('messages.payment_method') }}</th>
                                        <th scope="col">{{ __('messages.option') }}</th>
                                    </tr>
                                 </thead>
                                 <tbody>
                                 @php $counter = 1; @endphp
                                 @foreach($orders as $key => $item)
                                 @csrf
                                        <tr>
                                            
                                            <td>{{ ($ttl+1) - ($orders->firstItem() + $key) }}</td>
                                            
                                            <td>
                                                <h6>{{ date('Y/m/d', strtotime($item->order_created_at)) }}</h6>
                                            </td>

                                            <td>
                                                <h6>{{ $item->order_code  }}</h6>
                                            </td>

                                            <td>
                                                <h6>{{ $item->total_qty  }}</h6>
                                            </td>
                                            <td>
                                                <h6 class="theme-color fw-bold">¥ {{ number_format($item->total_amount , 0, '.', ',') }}</h6>
                                            </td>
                                            <td>
                                                <h6>{{ $item->payment_type }}</h6>
                                                @if ($item->payment_approved == 0)
                                                <p style="color:red; font-size:12px;">{{ __('messages.transfer_not_yet') }}</p>
                                                @elseif ($item->payment_approved == 2)
                                                <p style="color:red; font-size:12px;">{{ __('messages.cancelled_no_transfer_payment') }}</p>
                                                @endif
                                            </td>

                                            <td>
                                                <a href="{{route ('user_order_details',['id' => $item->order_id]) }}">
                                                    <i data-feather="eye" style="width: 16px; height: 16px;"></i>
                                                </a>
                                            </td>
                                        </tr> 
                                    @endforeach 
                                </tbody>
                                </table>
                                    </div>
                                    <div>
                                        @include('components.pagination')
                                    </div>
                                </div>
                            </div>  
                        </div>
                        
                    </div>
                    <!-- Order View End -->
                </div>
            </div>
        </div>
    </section>
    <!-- User Dashboard Section End -->
</x-guest-layout>

    <!-- Bg overlay Start -->
    <div class="bg-overlay"></div>
    <!-- Bg overlay End -->

    <!-- Add address modal box start -->
    <div class="modal fade theme-modal" id="add-address" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a new address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="text" class="form-control" id="fname" placeholder="{{ __('messages.enter_first_name') }}">
                            <label for="fname">{{ __('messages.first_name') }}</label>
                        </div>
                    </form>
                
                    <form>
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="text" class="form-control" id="lname" placeholder="{{ __('messages.enter_last_name') }}">
                            <label for="lname">{{ __('messages.last_name') }}</label>
                        </div>
                    </form>
                
                    <form>
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="email" class="form-control" id="email" placeholder="{{ __('messages.enter_email') }}">
                            <label for="email">{{ __('messages.email') }}</label>
                        </div>
                    </form>
                
                    <form>
                        <div class="form-floating mb-4 theme-form-floating">
                            <textarea class="form-control" placeholder="{{ __('messages.leave_comment_here') }}" id="address" style="height: 100px"></textarea>
                            <label for="address">{{ __('messages.enter_address') }}</label>
                        </div>
                    </form>
                
                    <form>
                        <div class="form-floating mb-4 theme-form-floating">
                            <input type="text" class="form-control" id="pin" placeholder="{{ __('messages.enter_pin_code') }}">
                            <label for="pin">{{ __('messages.pin_code') }}</label>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn theme-bg-color btn-md text-white" data-bs-dismiss="modal">{{ __('messages.btn_save') }}</button>
                    <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">{{ __('messages.btn_close') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Add address modal box end -->