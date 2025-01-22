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
                        <h2>Addresses</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Addresses</li>
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
                                <a class="nav-link active" id="pills-address-tab"
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
                <!-- Address View Start -->
                <div class="col-xxl-9 col-lg-8">
                    <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">
                       My Menu</button>
                    <div class="dashboard-right-sidebar">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel">
                                <div class="dashboard-address">
                                    <div class="title title-flex">
                                        <div>
                                            <h2>My Address Book</h2>
                                            <span class="title-leaf">
                                                <svg class="icon-width bg-gray">
                                                    <use xlink:href="{{ asset('frontend/assets/svg/leaf.svg#leaf') }}"></use>
                                                </svg>
                                            </span>
                                        </div>

                                        <button class="btn theme-bg-color text-white btn-sm fw-bold mt-lg-0 mt-3"
                                            data-bs-toggle="modal" data-bs-target="#add-address"><i data-feather="plus"
                                                class="me-2"></i> Add New Address</button>
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
                                    <div class="row g-sm-4 g-3">
                                        @foreach($data as $item)
                                        <div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6">
                                            <div class="address-box">
                                                <div class="row">
                                                    <div class="col-md-2">
                                                    <div class="form-check">
                                                            <input class="form-check-input" type="radio" name="selected_address" 
                                                            value="{{ $item->id }}" id="address_{{ $item->id }}" {{ $item->default == 1 ? 'checked':''}}>
                                                    </div>
                                                    </div>
                                                    <div class="col-md-10">    
                                                            <label>{{ $item->place }}</label>
                                                    </div>
                                                </div>
                                            <div class="table-responsive address-table">
                                                    <table class="table">
                                                        <tbody>
                                                            <tr>
                                                                <td>Name:</td>
                                                                <td>
                                                                    <p>{{ $item->name }}</p>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td>Address:</td>
                                                                <td>
                                                                    <p>〒{{ formatZipCode($item->post_code) }}</p>
                                                                    <p>{{ $item->prefecture->name }}</p>
                                                                    <p>{{ $item->city }} {{ $item->chome }}</p>
                                                                    <p>{{ $item->building }} {{ $item->room_no }}</p>
                                                                </td>
                                                            </tr>

                                                            <tr>
                                                                <td>Phone:</td>
                                                                <td>{{ $item->phone }}</td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <div class="button-group">
                                                    <button class="btn theme-bg-color btn-sm add-button w-100 edit-address-btn"
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#editAddress{{ $item->id }}"
                                                            onclick="">
                                                            <i data-feather="edit"></i> Edit
                                                    </button>
                                                    @if ($item->main_address != 1)
                                                    <button class="btn btn-sm add-button w-100" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#removeProfile{{ $item->id }}"
                                                            onclick="showDeleteModal('{{ $item->id }}')" style="background-color: #ff6b6b;">
                                                        <i data-feather="trash-2"></i> Remove
                                                    </button>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <!-- Address View End -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- User Dashboard Section End -->

    <!-- Add Address Modal Box Start -->
    <div class="modal fade theme-modal" id="add-address" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a new address</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
    
                <form id="address-form" class="row g-4" action="{{ route('add_newaddress') }}" method="post">
                    @csrf
                    <div class="modal-body">
                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <input type="text" class="form-control" id="name" name="name" placeholder="Enter Name">
                            <label for="name">Name</label>
                            <span class="error" style="color:red" id="error-name"></span>
                        </div>
    
                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <input type="text" class="form-control" id="post_code" name="post_code" placeholder="Post Code">
                            <label for="post_code">Post Code</label>
                            <span class="error" style="color:red" id="error-post_code"></span>
                        </div>
    
                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <select class="form-control" id="prefectures" name="prefectures">
                                <option>Choose Prefecture</option>
                                @foreach ($prefecture as $item)
                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                @endforeach
                            </select>
                            <span class="error" style="color:red" id="error-prefectures"></span>
                        </div>
    
                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <input type="text" class="form-control" id="city" name="city" placeholder="City, Ward, Town">
                            <label for="city">City</label>
                            <span class="error" style="color:red" id="error-city"></span>
                        </div>
    
                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <input type="text" class="form-control" id="chome" name="chome" placeholder="Chome, Banchi, Go">
                            <label for="chome">Chome</label>
                            <span class="error" style="color:red" id="error-chome"></span>
                        </div>
    
                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <input type="text" class="form-control" id="building" name="building" placeholder="Building, Apartment, Company Name">
                            <label for="building">Building</label>
                            <span class="error" style="color:red" id="error-building"></span>
                        </div>
    
                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <input type="text" class="form-control" id="roomno" name="roomno" placeholder="Unit, Room No">
                            <label for="roomno">Room No</label>
                            <span class="error" style="color:red" id="error-roomno"></span>
                        </div>
    
                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <input class="form-control" id="phone" name="phone" placeholder="Enter your phone number">
                            <label for="phone">Phone Number</label>
                            <span class="error" style="color:red" id="error-phone"></span>
                        </div>
    
                        <div class="form-floating mb-4 theme-form-floating form-group">
                            <select class="form-control" id="place" name="place">
                                <option>Choose Place</option>
                                <option value="Home">Home</option>
                                <option value="Office">Office</option>
                                <option value="Other">Other</option>
                            </select>
                            <span class="error" style="color:red" id="error-place"></span>
                        </div>
                    </div>
    
                    <div class="modal-footer">
                        <button type="button" class="btn theme-bg-color btn-md text-white" onclick="validateForm()">Save</button>
                        <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal" style="background-color: #ff6b6b;">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Confirm Add Address Modal Start -->
    <div class="modal fade theme-modal remove-profile" id="confirmToAdd" tabindex="-1" aria-hidden="true">
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
                        <p>Add this address to your address book.</p>
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
    <!-- Confirm Add Address Modal End -->
    <!-- Add Address Modal Box End -->
    <!-- Edit Address Modal Box Start -->
    @foreach($data as $item)
        <div class="modal fade theme-modal" id="editAddress{{ $item->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit address</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <form method="post" action="{{ route('edit_address') }}" class="row g-4" id="edit-form-{{ $item->id }}">
                    @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        
                        <div class="modal-body">
                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="name-{{ $item->id }}" name="name" placeholder="Enter Name" value="{{ $item->name }}">
                                <label for="name">Name</label>
                                <span class="error" style="color:red" id="error-name-{{ $item->id }}"></span>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="post_code-{{ $item->id }}" name="post_code" placeholder="Post Code" value="{{ $item->post_code }}">
                                <label for="post_code">Post Code</label>
                                <span class="error" style="color:red" id="error-post_code-{{ $item->id }}"></span>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <select class="form-control" id="prefectures-{{ $item->id }}" name="prefectures">
                                    @foreach ($prefecture as $item1)
                                        <option value="{{ $item1->id }}" name="prefectures" {{ $item1->id == $item->prefecture_id ? 'selected' : '' }}>{{ $item1->name }}</option>
                                    @endforeach
                                </select>
                                <span class="error" style="color:red" id="error-prefectures-{{ $item->id }}"></span>
                            </div>
                            
                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="city-{{ $item->id }}" name="city" placeholder="City, Ward, Town" value="{{ $item->city }}">
                                <label for="city">City</label>
                                <span class="error" style="color:red" id="error-city-{{ $item->id }}"></span>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="chome-{{ $item->id }}" name="chome" placeholder="Chome, Banchi, Go" value="{{ $item->chome }}">
                                <label for="chome">Chome</label>
                                <span class="error" style="color:red" id="error-chome-{{ $item->id }}"></span>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="building-{{ $item->id }}" name="building" placeholder="Building, Apartment, Company Name" value="{{ $item->building }}">
                                <label for="building">Building</label>
                                <span class="error" style="color:red" id="error-building-{{ $item->id }}"></span>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="roomno-{{ $item->id }}" name="roomno" placeholder="Unit, Room No" value="{{ $item->room_no }}">
                                <label for="roomno">Room No</label>
                                <span class="error" style="color:red" id="error-roomno-{{ $item->id }}"></span>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input class="form-control" id="phone-{{ $item->id }}" name="phone" placeholder="Enter your phone number" value="{{ $item->phone }}">
                                <label for="phone">Phone Number</label>
                                <span class="error" style="color:red" id="error-phone-{{ $item->id }}"></span>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <select class="form-control" id="place-{{ $item->id }}" name="place">
                                    <option value="Home" {{ $item->place == 'Home' ? 'selected' : '' }}>Home</option>
                                    <option value="Office" {{ $item->place == 'Office' ? 'selected' : '' }}>Office</option>
                                    <option value="Other" {{ $item->place == 'Other' ? 'selected' : '' }}>Other</option>
                                </select>
                                <span class="error" style="color:red" id="error-place-{{ $item->id }}"></span>
                            </div>
                        </div>
                    
                        <div class="modal-footer">
                            <button type="button" class="btn theme-bg-color btn-md text-white" onclick="validateEditForm({{ $item->id }})">Save</button>
                            <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal" style="background-color: #ff6b6b;">Close</button>
                        </div>
                    </form> 
                </div>
            </div>
        </div>
        <!-- Confirmation Modal for Edit -->
        <div class="modal fade theme-modal remove-profile" id="confirmEdit{{ $item->id }}" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="max-width: 400px;">
                <div class="modal-content" style="background-color: #f5f5f5;">
                    <div class="modal-header d-block text-center">
                        <h5 class="modal-title w-100" id="exampleModalLabel{{ $item->id }}">Are You Sure?</h5>
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
                        <button type="button" class="btn theme-bg-color btn-md fw-bold text-light" onclick="submitEditForm({{ $item->id }})">Yes</button>
                        <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal"
                        style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Edit Address Modal Box End -->
    <!-- Remove Address Modal Start -->
    @foreach($data as $item)
    <div class="modal fade theme-modal remove-profile" id="removeProfile{{ $item->id }}" tabindex="-1" aria-hidden="true">
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
                        <p>You cannot see this address no more in your address book.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('remove_address', ['id' => $item->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn theme-bg-color btn-md fw-bold text-light">Yes</button>
                    </form>
                    <button type="button" class="btn btn-md fw-bold" data-bs-dismiss="modal"
                    style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- Remove Address Modal End -->
</x-guest-layout>
<!-- Edit Address Script-->
<script>
    $(document).ready(function() {
    $('.edit-btn').on('click', function() {
        var addressData = JSON.parse($(this).data('address'));
        alert(addressData);
        $('#address_id').val(addressData.id);
        $('#name').val(addressData.name);
        $('#post_code').val(addressData.post_code);
        $('#prefectures').val(addressData.prefectures);
        $('#city').val(addressData.city);
        $('#chome').val(addressData.chome);
        $('#building').val(addressData.building);
        $('#roomno').val(addressData.roomno);
        $('#place').val(addressData.place);
        $('#phone').val(addressData.phone);
    });

    $('#saveChanges').on('click', function() {
        var addressId = $('#address_id').val();
        var newName = $('#name').val();
        var newPostCode = $('#post_code').val();
        var newPrefectures = $('#prefectures').val();
        var newCity = $('#city').val();
        var newChome = $('#chome').val();
        var newBuilding = $('#building').val();
        var newRoomNo = $('#roomno').val();
        var newPlace = $('#place').val();
        var newPhone = $('#phone').val();

        // Perform AJAX request to update data in the controller
        $.ajax({
            url: '{{ route("edit_address") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: addressId,
                name: newName,
                post_code: newPostCode,
                prefectures: newPrefectures,
                city: newCity,
                chome: newChome,
                building: newBuilding,
                room_no: newRoomNo,
                place: newPlace,
                phone: newPhone
            },
            success: function(response) {
            alert("123");
                // Handle success response
                console.log(response);
                // Close the modal
                $('#editAddress').modal('hide');
            },
            error: function(xhr) {
                // Handle error response
                console.error(xhr.responseText);
            }
        });
    });
});
</script>

<!-- Remove Address Script -->
<script>
    function showDeleteModal(id) {
        $('#removeProfile').modal('show');
        // Update the form action URL dynamically with the selected address id
        $('#deleteForm').attr('action', '/user/remove-address/' + id);
    }
</script>

<!-- Set Default Address Script -->
<script>
    $(document).ready(function() {
        $('input[name="selected_address"]').change(function() {
            var addressId = $(this).val();
            $.ajax({
                url: '/set-default-address/' + addressId,
                type: 'GET',
                success: function(response) {
                    // Handle success response if needed
                    console.log(response.success);
                },
                error: function(xhr, status, error) {
                    // Handle error if needed
                    console.error('Error setting default address:', error);
                }
            });
        });
    });
</script>

<script>
    function validateForm() {
        let isValid = true;
    
        const name = document.getElementById('name').value.trim();
        const post_code = document.getElementById('post_code').value.trim();
        const prefectures = document.getElementById('prefectures').value;
        const city = document.getElementById('city').value.trim();
        const chome = document.getElementById('chome').value.trim();
        const building = document.getElementById('building').value.trim();
        const roomno = document.getElementById('roomno').value.trim();
        const phone = document.getElementById('phone').value.trim();
        const place = document.getElementById('place').value;
    
        // Clear previous error messages
        document.querySelectorAll('.error').forEach(el => el.textContent = '');
    
        if (!name) {
            isValid = false;
            document.getElementById('error-name').textContent = 'Please provide your name.';
        } else if (name.length > 255) {
            isValid = false;
            document.getElementById('error-name').textContent = 'Your name must not exceed 255 characters.';
        }
    
        if (!post_code) {
            isValid = false;
            document.getElementById('error-post_code').textContent = 'Please provide your post code.';
        } else if (post_code.length !== 7 || !/^\d{7}$/.test(post_code)) {
            isValid = false;
            document.getElementById('error-post_code').textContent = 'Please provide a valid 7-digit post code.';
        }
    
        if (!prefectures || prefectures === 'Choose Prefecture') {
            isValid = false;
            document.getElementById('error-prefectures').textContent = 'Please select a valid prefecture.';
        }
    
        if (!city) {
            isValid = false;
            document.getElementById('error-city').textContent = 'Please provide your city.';
        } else if (city.length > 255) {
            isValid = false;
            document.getElementById('error-city').textContent = 'Your city must not exceed 255 characters.';
        }
    
        if (!chome) {
            isValid = false;
            document.getElementById('error-chome').textContent = 'Please provide your chome.';
        } else if (chome.length > 255) {
            isValid = false;
            document.getElementById('error-chome').textContent = 'Your chome must not exceed 255 characters.';
        }
    
        if (!building) {
            isValid = false;
            document.getElementById('error-building').textContent = 'Please provide your building.';
        } else if (building.length > 255) {
            isValid = false;
            document.getElementById('error-building').textContent = 'Your building must not exceed 255 characters.';
        }
    
        if (!roomno) {
            isValid = false;
            document.getElementById('error-roomno').textContent = 'Please provide your room number.';
        } else if (roomno.length > 255) {
            isValid = false;
            document.getElementById('error-roomno').textContent = 'Your room number must not exceed 255 characters.';
        }
    
        if (!phone) {
            isValid = false;
            document.getElementById('error-phone').textContent = 'Please provide your phone number.';
        } else if (phone.length > 255) {
            isValid = false;
            document.getElementById('error-phone').textContent = 'The phone number must not exceed 255 characters.';
        }
    
        if (!place || place === 'Choose Place') {
            isValid = false;
            document.getElementById('error-place').textContent = 'Please select a valid place.';
        }
    
        if (isValid) {
        // Show confirmation modal
            const confirmModal = new bootstrap.Modal(document.getElementById('confirmToAdd'));
            confirmModal.show();

            // Handle form submission within the confirmation modal
            document.getElementById('confirmYes').addEventListener('click', function() {
                document.getElementById('address-form').submit();
            });
        }
    }
</script>
<script>
    function validateEditForm(id) {
        let isValid = true;
    
        const name = document.getElementById(`name-${id}`).value.trim();
        const post_code = document.getElementById(`post_code-${id}`).value.trim();
        const prefectures = document.getElementById(`prefectures-${id}`).value;
        const city = document.getElementById(`city-${id}`).value.trim();
        const chome = document.getElementById(`chome-${id}`).value.trim();
        const building = document.getElementById(`building-${id}`).value.trim();
        const roomno = document.getElementById(`roomno-${id}`).value.trim();
        const phone = document.getElementById(`phone-${id}`).value.trim();
        const place = document.getElementById(`place-${id}`).value;
    
        // Clear previous error messages
        document.querySelectorAll(`#edit-form-${id} .error`).forEach(el => el.textContent = '');
    
        if (!name) {
            isValid = false;
            document.getElementById(`error-name-${id}`).textContent = 'Please provide your name.';
        } else if (name.length > 255) {
            isValid = false;
            document.getElementById(`error-name-${id}`).textContent = 'Your name must not exceed 255 characters.';
        }
    
        if (!post_code) {
            isValid = false;
            document.getElementById(`error-post_code-${id}`).textContent = 'Please provide your post code.';
        } else if (post_code.length !== 7 || !/^\d{7}$/.test(post_code)) {
            isValid = false;
            document.getElementById(`error-post_code-${id}`).textContent = 'Please provide a valid 7-digit post code.';
        }
    
        if (!prefectures || prefectures === 'Choose Prefecture') {
            isValid = false;
            document.getElementById(`error-prefectures-${id}`).textContent = 'Please select a valid prefecture.';
        }
    
        if (!city) {
            isValid = false;
            document.getElementById(`error-city-${id}`).textContent = 'Please provide your city.';
        } else if (city.length > 255) {
            isValid = false;
            document.getElementById(`error-city-${id}`).textContent = 'Your city must not exceed 255 characters.';
        }
    
        if (!chome) {
            isValid = false;
            document.getElementById(`error-chome-${id}`).textContent = 'Please provide your chome.';
        } else if (chome.length > 255) {
            isValid = false;
            document.getElementById(`error-chome-${id}`).textContent = 'Your chome must not exceed 255 characters.';
        }
    
        if (!building) {
            isValid = false;
            document.getElementById(`error-building-${id}`).textContent = 'Please provide your building.';
        } else if (building.length > 255) {
            isValid = false;
            document.getElementById(`error-building-${id}`).textContent = 'Your building must not exceed 255 characters.';
        }
    
        if (!roomno) {
            isValid = false;
            document.getElementById(`error-roomno-${id}`).textContent = 'Please provide your room number.';
        } else if (roomno.length > 255) {
            isValid = false;
            document.getElementById(`error-roomno-${id}`).textContent = 'Your room number must not exceed 255 characters.';
        }

        if (!phone) {
            isValid = false;
            document.getElementById(`error-phone-${id}`).textContent = 'Please provide your phone number.';
        } else if (phone.length > 255) {
            isValid = false;
            document.getElementById(`error-phone-${id}`).textContent = 'The phone number must not exceed 255 characters.';
        }

        if (!place || place === 'Choose Place') {
            isValid = false;
            document.getElementById(`error-place-${id}`).textContent = 'Please select a valid place.';
        }

        if (isValid) {
            const confirmModal = new bootstrap.Modal(document.getElementById('confirmEdit' + id));
            confirmModal.show();
        }
    }
    function submitEditForm(id) {
        document.getElementById('edit-form-' + id).submit();
    }
</script>