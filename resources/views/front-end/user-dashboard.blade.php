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
                        <h2>Dashboard</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Dashboard</li>
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
                            <a class="nav-link active" id="pills-dashboard-tab" data-bs-toggle="pill"
                                    data-bs-target="#pills-dashboard" type="button" style="font-size: 14px; text-align: center;" ><i data-feather="home"></i>
                                    DashBoard</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-order-tab"
                                    style="font-size: 14px; text-align: center;" href="{{route ('user_order')}}"><i
                                        data-feather="shopping-bag"></i>Orders</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="delivery-detail"
                                    type="button" style="font-size: 14px; text-align: center;" href="{{route ('user_deivery_status')}}"><i data-feather="box"></i>
                                    Delivery Status</a>
                            </li>
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-address-tab"
                                    type="button" role="tab" style="font-size: 14px; text-align: center;" href="{{route ('user_addresses')}}"><i
                                        data-feather="map-pin"></i>Addresses</a>
                            </li>
                            {{-- <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-card-tab"
                                    type="button" role="tab" style="font-size: 14px; text-align: center;" href="{{route ('user_cards')}}"><i
                                        data-feather="credit-card"></i>Payment Methods</a>
                            </li> --}}
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-profile-tab"
                                    type="button" role="tab" style="font-size: 14px; text-align: center;" href="{{route ('user_profile')}}"><i data-feather="user"></i>
                                    Profile</a>
                            </li>
                            @php
                                $buyer = DB::table('buyers')->where('user_id', $user->id)->first();
                                $noti = DB::table('user_notifications')->where('buyer_id', $buyer->id)->where('seen', 0)->count();
                            @endphp
                            <li class="nav-item" role="presentation">
                                <a class="nav-link" id="pills-profile-tab"
                                    type="button" role="tab" style="font-size: 14px; text-align: center; display: flex; align-items: center;" href="{{route ('user_message')}}"><i data-feather="mail"></i>
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

                <!-- Dashboard view Start -->
                <div class="col-xxl-9 col-lg-8">
                    <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">
                        My Menu</button>
                    <div class="dashboard-right-sidebar">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel">
                                <div class="dashboard-home">
                                    <div class="title">
                                        <h2>DashBoard</h2>
                                        <span class="title-leaf">
                                            <svg class="icon-width bg-gray">
                                                <use xlink:href="{{ asset('frontend/assets/svg/leaf.svg#leaf') }}"></use>
                                            </svg>
                                        </span>
                                    </div>

                                    <div class="dashboard-user-name">
                                        <h6 class="text-content">Hello, <b class="text-title">{{ $user->name }}</b></h6>
                                        <p class="text-content">From your My Account Dashboard you have the ability to
                                            view a snapshot of your recent account activity and update your account
                                            information. Select a link below to view or edit information.</p>
                                    </div>

                                    <div class="total-box">
                                        <div class="row g-sm-4 g-3">
                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="total-contain">
                                                    <img src="{{ asset('/frontend/assets/images/svg/order.svg') }}"
                                                        class="img-1 blur-up lazyload" alt="">
                                                    <img src="{{ asset('/frontend/assets/images/svg/order.svg') }}" class="blur-up lazyload"
                                                        alt="">
                                                    <div class="total-detail">
                                                        <h5>Total Order</h5>
                                                        <h3>{{ $orderCount }}</h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="total-contain">
                                                    <img src="{{ asset('/frontend/assets/images/svg/pending.svg') }}"
                                                        class="img-1 blur-up lazyload" alt="">
                                                    <img src="{{ asset('/frontend/assets/images/svg/pending.svg') }}" class="blur-up lazyload"
                                                        alt="">
                                                    <div class="total-detail">
                                                        <h5>Total Pending Order</h5>
                                                        <h3>{{ $pendingCount }}</h3>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xxl-4 col-lg-6 col-md-4 col-sm-6">
                                                <div class="total-contain">
                                                    <img src="{{ asset('/frontend/assets/images/svg/wishlist.svg') }}"
                                                        class="img-1 blur-up lazyload" alt="">
                                                    <img src="{{ asset('/frontend/assets/images/svg/wishlist.svg') }}"
                                                        class="blur-up lazyload" alt="">
                                                    <div class="total-detail">
                                                        <h5>Total Wishlist</h5>
                                                        <h3>{{ $wishlistCount }}</h3>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-12">
                                        <div class="dashboard-content-title">
                                                <h4>Account Information</h4>
                                            </div>

                                        <div class="row g-4">
                                            <div class="col-xxl-6">
                                                <div class="dashboard-detail">

                                                <div class="dashboard-detail">

                                                    <h6 class="text-content">{{ $user->name }}</h6>
                                                    <h6 class="text-content">{{ $user->email }}</h6>
                                                    <h6 class="text-content">{{ $user->phone }}</h6>
                                                </div>
                                            </div>

                                    </div>
                                        <div class="col-12">
                                            <div class="dashboard-content-title">
                                                <h4>Default Address</h4>
                                            </div>

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
                                            <div class="row g-4">
                                                <div class="col-xxl-6">
                                                    <div class="dashboard-detail">
                                                        <h6 class="text-content">〒{{ formatZipCode($address->post_code) }}</h6>
                                                        <h6 class="text-content">{{ $address->prefecture->name }}</h6>
                                                        <h6 class="text-content">{{ $address->city }} {{ $address->chome }}</h6>
                                                        <h6 class="text-content">{{ $address->building }} {{ $address->room_no }}</h6>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Dashboard View End -->
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

<!-- Edit Password Script -->
<script>
    $(document).ready(function() {
    $('.edit-btn').on('click', function() {
        var passData = JSON.parse($(this).data('password'));
        $('#id').val(passData.id);
        $('#email').val(passData.email);
        $('#password').val(passData.password);

    });

    $('#changePassword').on('click', function() {
        var passId = $('#id').val();
        var newEmail = $('#email').val();
        var newPassword = $('#password').val();


        // Perform AJAX request to update data in the controller
        $.ajax({
            url: '{{ route("edit_password") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: addressId,
                email: newEmail,
                password: newPassword,

            },
            success: function(response) {
            alert("123");
                // Handle success response
                console.log(response);
                // Close the modal
                $('#changePassword').modal('hide');
            },
            error: function(xhr) {
                // Handle error response
                console.error(xhr.responseText);
            }
        });
    });
});
</script>