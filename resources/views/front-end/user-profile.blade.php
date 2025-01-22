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
                        <h2>Profile</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Profile</li>
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
                            <li class="nav-item" role="presentation">
                                <a class="nav-link active" id="pills-profile-tab"
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

                <!-- Show Profile Start -->
                <div class="col-xxl-9 col-lg-8">
                    <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">
                        My Menu</button>
                    <div class="dashboard-right-sidebar">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel">
                                <div class="dashboard-profile">
                                    <div class="title title-flex">
                                        <div>
                                            <h2>Profile</h2>
                                            <span class="title-leaf">
                                                <svg class="icon-width bg-gray">
                                                    <use xlink:href="{{ asset('frontend/assets/svg/leaf.svg#leaf') }}"></use>
                                                </svg>
                                            </span>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="profile-detail dashboard-bg-box">
                                            <div class="profile-name-detail">
                                                <div class="col-md-4">
                                                    <div class="d-sm-flex align-items-center d-block">
                                                        <h3>{{ $user->name}}</h3>
                                                    </div>
                                                </div>
                                                <div class="col-md-4"></div>
                                                <div class="col-md-2" style="display: flex; align-items: center; justify-content: space-between;">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#editProfile">Edit</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="row">
                                        <div class="profile-about dashboard-bg-box">
                                            <div class="row">
                                                <div class="dashboard-title mb-3">
                                                    <h3>Your Account</h3>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="d-sm-flex align-items-center d-block">
                                                        Email Address  :
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    {{ $user->email }}
                                                </div>
                                                <div class="col-md-4"></div>
                                            </div>
                                            <div class="row" style="margin-top: 15px;">
                                                <div class="col-md-4">
                                                    <div class="d-sm-flex align-items-center d-block">
                                                        Phone Number  :
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    {{ $user->buyer->phone }}
                                                </div>
                                                <div class="col-md-4"></div>
                                            </div>

                                            <div class="profile-detail">
                                                <div class="row" style="margin-top: 30px;">
                                                    <div class="dashboard-title mb-3">
                                                        <h3>Login Details</h3>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="d-sm-flex align-items-center d-block">
                                                            Email  :
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        {{ $user->email }}
                                                    </div>
                                                    <div class="col-md-2" style="display: flex; align-items: center; justify-content: space-between;">
                                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                                            data-bs-target="#editPassword">Edit</a>
                                                    </div>
                                                    
                                                </div>
                                            </div>

                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="d-sm-flex align-items-center d-block">
                                                        Password :
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    ************************
                                                </div>
                                                <div class="col-md-4"></div>
                                            </div>
                                        </div>
                                        <div id="messageBoxContainer" style="margin-top: 10px;">
                                            @include('components.messagebox')
                                        </div>
                                    </div>
                                </div>      
                            </div>
                        </div>  
                    </div>  
                </div>
                <!-- User Profile View End -->
            </div>
        </div>
    </section>
    <!-- User Dashboard Section End -->
    <!-- Edit Profile Modal Box Start -->
    <div class="modal fade theme-modal" id="editProfile" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit Profile</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
    
                <form method="post" action="{{ route('edit_profile') }}" class="row g-4" id="edit-profile-form">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <input type="hidden" name="buyer_id" value="{{ $buyer->id }}">
                    
                    <div class="modal-body">
                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <input type="text" class="form-control" id="name" name="name" value="{{ $user->name }}">
                            <label for="name">Name</label>
                            <span class="error" style="color:red" id="error-name"></span>
                        </div>
    
                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <input type="text" class="form-control" id="email" name="email" value="{{ $user->email }}">
                            <label for="email">Email Address</label>
                            <span class="error" style="color:red" id="error-email"></span>
                        </div>
    
                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <input type="text" class="form-control" id="post_code" name="post_code" placeholder="Post Code" value="{{ $buyerAddress->post_code }}">
                            <label for="post_code">Post Code</label>
                            <span class="error" style="color:red" id="error-post_code"></span>
                        </div>
    
                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <select class="form-control" id="prefectures" name="prefectures">
                                @foreach ($prefecture as $item1)
                                    <option value="{{ $item1->id }}" {{ $item1->id == $buyerAddress->prefecture_id ? 'selected' : '' }}>{{ $item1->name }}</option>
                                @endforeach
                            </select>
                            <span class="error" style="color:red" id="error-prefectures"></span>
                        </div>
                        
                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <input type="text" class="form-control" id="city" name="city" placeholder="City, Ward, Town" value="{{ $buyerAddress->city }}">
                            <label for="city">City</label>
                            <span class="error" style="color:red" id="error-city"></span>
                        </div>
    
                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <input type="text" class="form-control" id="chome" name="chome" placeholder="Chome, Banchi, Go" value="{{ $buyerAddress->chome }}">
                            <label for="chome">Chome</label>
                            <span class="error" style="color:red" id="error-chome"></span>
                        </div>
    
                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <input type="text" class="form-control" id="building" name="building" placeholder="Building, Apartment, Company Name" value="{{ $buyerAddress->building }}">
                            <label for="building">Building</label>
                            <span class="error" style="color:red" id="error-building"></span>
                        </div>
    
                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <input type="text" class="form-control" id="roomno" name="roomno" placeholder="Unit, Room No" value="{{ $buyerAddress->room_no }}">
                            <label for="roomno">Room No</label>
                            <span class="error" style="color:red" id="error-roomno"></span>
                        </div>
    
                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <input class="form-control" id="phone" name="phone" placeholder="Enter your phone number" value="{{ $user->phone }}">
                            <label for="phone">Phone Number</label>
                            <span class="error" style="color:red" id="error-phone"></span>
                        </div>
    
                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <select class="form-control" id="place" name="place">
                                <option value="Home" {{ $buyerAddress->place == 'Home' ? 'selected' : '' }}>Home</option>
                                <option value="Office" {{ $buyerAddress->place == 'Office' ? 'selected' : '' }}>Office</option>
                                <option value="Other" {{ $buyerAddress->place == 'Other' ? 'selected' : '' }}>Other</option>
                            </select>
                            <span class="error" style="color:red" id="error-place"></span>
                        </div>
                    </div>
                
                    <div class="modal-footer">
                        <button type="button" class="btn theme-bg-color btn-md text-white" onclick="validateProfileForm()">Save</button>
                        <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal" style="background-color: #ff6b6b;">Close</button>
                    </div>
                </form> 
            </div>
        </div>
    </div>
    <!-- Confirmation Modal for Profile Edit -->
    <div class="modal fade theme-modal remove-profile" id="confirmEditProfile" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
            <div class="modal-content" style="background-color: #f5f5f5;"> <!-- Light gray with a little smaller width -->
                <div class="modal-header d-block text-center">
                    <h5 class="modal-title w-100" id="exampleModalLabelEditProfile">Are You Sure?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="remove-box">
                        <p>This changes will be saved.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn theme-bg-color btn-md fw-bold text-light" id="confirmYes">Yes</button>
                    <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal"
                    style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Profile Modal Box End -->

    <!-- Change Password Start -->
    <div class="modal fade theme-modal" id="editPassword" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel8">Edit Password</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <form method="post" action="{{ route('edit_password') }}" class="row g-4" id="editPasswordForm">
                    @csrf
                    <input type="hidden" name="id" value="{{ $user->id }}">
                    <input type="hidden" name="buyer_id" value="{{ $buyer->id }}">
                    <div class="modal-body">
                        <div class="row g-4">
                            <div class="col-xxl-12">
                                <div class="form-floating theme-form-floating" style="margin-right: 5px; margin-left: 5px;">
                                    <input type="text" class="form-control" id="email" value="{{ $user->email }}" disabled>
                                    <label for="email">Email Address</label>
                                    <span class="error" style="color:red" id="error-email"></span>
                                </div>
                            </div>
    
                            <div class="col-xxl-12">
                                <div class="form-floating theme-form-floating" style="margin-right: 5px; margin-left: 5px;">
                                    <input type="password" class="form-control" id="oldpassword" name="oldpassword" placeholder="Old Password">
                                    <label for="oldpassword">Old Password</label>
                                    <span class="error" style="color:red" id="error-oldpassword"></span>
                                </div>
                            </div>
    
                            <div class="col-xxl-12">
                                <div class="form-floating theme-form-floating" style="margin-right: 5px; margin-left: 5px;">
                                    <input type="password" class="form-control" id="newpassword" name="newpassword" placeholder="New Password">
                                    <label for="newpassword">New Password</label>
                                    <span class="error" style="color:red" id="error-newpassword"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn theme-bg-color btn-md text-white" 
                            onclick="validatePasswordChangeForm()">Save</button>
                        <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal" 
                            style = "background-color: #ff6b6b;margin-right: 5px; margin-left: 5px;">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Confirm Add Address Modal Start -->
    <div class="modal fade theme-modal remove-profile" id="confirmToEditPassword" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
            <div class="modal-content" style="background-color: #f5f5f5;">
                <div class="modal-header d-block text-center">
                    <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="remove-box">
                        <p>Change your password.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn theme-bg-color btn-md fw-bold text-light" id="confirmYesForPassword">Yes</button>
                    <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal"
                    style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Change Password End -->
</x-guest-layout>

<script>
    function validateProfileForm() {
        let isValid = true;
    
        const name = document.getElementById('name').value.trim();
        const email = document.getElementById('email').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const post_code = document.getElementById('post_code').value.trim();
        const prefectures = document.getElementById('prefectures').value;
        const city = document.getElementById('city').value.trim();
        const chome = document.getElementById('chome').value.trim();
        const building = document.getElementById('building').value.trim();
        const roomno = document.getElementById('roomno').value.trim();
        const place = document.getElementById('place').value;
    
        // Clear previous error messages
        document.querySelectorAll('#edit-profile-form .error').forEach(el => el.textContent = '');
    
        if (!name) {
            isValid = false;
            document.getElementById('error-name').textContent = 'Please provide your name.';
        } else if (name.length > 255) {
            isValid = false;
            document.getElementById('error-name').textContent = 'Your name must not exceed 255 characters.';
        }
    
        if (!email) {
            isValid = false;
            document.getElementById('error-email').textContent = 'Please provide your email address.';
        } else if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
            isValid = false;
            document.getElementById('error-email').textContent = 'Please provide a valid email address.';
        }
    
        if (!phone) {
            isValid = false;
            document.getElementById('error-phone').textContent = 'Please provide your phone number.';
        } else if (phone.length > 255) {
            isValid = false;
            document.getElementById('error-phone').textContent = 'The phone number must not exceed 255 characters.';
        }
    
        if (!post_code) {
            isValid = false;
            document.getElementById('error-post_code').textContent = 'Please provide your post code.';
        } else if (post_code.length !== 7 || !/^\d{7}$/.test(post_code)) {
            isValid = false;
            document.getElementById('error-post_code').textContent = 'Please provide a valid 7-digit post code.';
        }
    
        if (!prefectures) {
            isValid = false;
            document.getElementById('error-prefectures').textContent = 'Please select a prefecture.';
        }
    
        if (!city) {
            isValid = false;
            document.getElementById('error-city').textContent = 'Please provide your city.';
        } else if (city.length > 255) {
            isValid = false;
            document.getElementById('error-city').textContent = 'The city must not exceed 255 characters.';
        }
    
        if (!chome) {
            isValid = false;
            document.getElementById('error-chome').textContent = 'Please provide your chome.';
        } else if (chome.length > 255) {
            isValid = false;
            document.getElementById('error-chome').textContent = 'The chome must not exceed 255 characters.';
        }
    
        if (!building) {
            isValid = false;
            document.getElementById('error-building').textContent = 'Please provide your building information.';
        } else if (building.length > 255) {
            isValid = false;
            document.getElementById('error-building').textContent = 'The building information must not exceed 255 characters.';
        }

        if (!roomno) {
            isValid = false;
            document.getElementById('error-roomno').textContent = 'Please provide your room number.';
        } else if (roomno.length > 255) {
            isValid = false;
            document.getElementById('error-roomno').textContent = 'The room number must not exceed 255 characters.';
        }

        if (!place || place === 'Choose Place') {
            isValid = false;
            document.getElementById('error-place').textContent = 'Please select a valid place.';
        }

        if (isValid) {
        // Show confirmation modal
            const confirmModal = new bootstrap.Modal(document.getElementById('confirmEditProfile'));
            confirmModal.show();

            // Handle form submission within the confirmation modal
            document.getElementById('confirmYes').addEventListener('click', function() {
                document.getElementById('edit-profile-form').submit();
            });
        }
    }
</script>
<script>
    function validatePasswordChangeForm() {
        let isValid = true;

        const oldPassword = document.getElementById('oldpassword').value.trim();
        const newPassword = document.getElementById('newpassword').value.trim();

        // Clear previous error messages
        document.querySelectorAll('#editPassword .error').forEach(el => el.textContent = '');

        if (!oldPassword) {
            isValid = false;
            document.getElementById('error-oldpassword').textContent = 'Please provide your old password.';
        }

        if (!newPassword) {
            isValid = false;
            document.getElementById('error-newpassword').textContent = 'Please provide your new password.';
        } else if (newPassword.length < 8) {
            isValid = false;
            document.getElementById('error-newpassword').textContent = 'The password must be at least 8 characters long.';
        }

        if (isValid) {
        // Show confirmation modal
            const confirmModal = new bootstrap.Modal(document.getElementById('confirmToEditPassword'));
            confirmModal.show();

            // Handle form submission within the confirmation modal
            document.getElementById('confirmYesForPassword').addEventListener('click', function() {
                // document.getElementById('editPasswordForm').submit();
                const formData = $('#editPasswordForm').serialize();
                $.ajax({
                    url: '{{ route('edit_password') }}',
                    type: 'POST',
                    data: formData,
                    success: function(data) {
                        // if (data.success) {
                        //     // Password change successful, you can close the modal or redirect the user
                        //     // alert('Password changed successfully.');
                        //     location.reload();
                        if (data.success) {
                            $('#editPassword').modal('hide');
                            $('#messageBoxContainer').html(data.message);
                        } else {
                            // Show error messages
                            if (data.errors.oldpassword) {
                                $('#error-oldpassword').text(data.errors.oldpassword);
                            }
                            if (data.errors.newpassword) {
                                $('#error-newpassword').text(data.errors.newpassword);
                            }
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
                confirmModal.hide();
            });
        }
    }
</script>
    