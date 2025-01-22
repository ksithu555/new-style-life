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
                        <h2>Payment Methods</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Payment Methods</li>
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
                        </ul>
                    </div>
                </div>
                <!-- User Dashboard Section End -->
                <div class="col-xxl-9 col-lg-8">
                    <button class="btn left-dashboard-show btn-animation btn-md fw-bold d-block mb-4 d-lg-none">Show
                        Menu</button>
                    <div class="dashboard-right-sidebar">
                        <div class="tab-content" id="pills-tabContent">
                            <div class="tab-pane fade show active" id="pills-dashboard" role="tabpanel">
                                <div class="dashboard-address">
                                    <div class="title title-flex">
                                        <div>
                                            <h2>Payment Methods</h2>
                                            <span class="title-leaf">
                                                <svg class="icon-width bg-gray">
                                                    <use xlink:href="{{ asset('frontend/assets/svg/leaf.svg#leaf') }}"></use>
                                                </svg>
                                            </span>
                                        </div>

                            <button class="btn theme-bg-color text-white btn-sm fw-bold mt-lg-0 mt-3"
                                data-bs-toggle="modal" data-bs-target="#addCard"><i data-feather="plus"
                                    class="me-2"></i> Add New Payment Method</button>
                        </div>

                        <div class="row g-sm-4 g-3">
                        @foreach($data as $item)
                            <div class="col-xxl-4 col-xl-6 col-lg-12 col-md-6">
                                <div class="address-box">
                                    <div class="row">
                                        <div class="col-md-2">
                                        <div class="form-check">
                                                <input class="form-check-input" type="radio" name="selected_card" 
                                                value="{{ $item->id }}" id="card_{{ $item->id }}">
                                        </div>
                                        </div>
                                        <div class="col-md-10">    
                                                <label>{{ $item->card_type }}</label>
                                        </div>
                                    </div>
                                    <div class="table-responsive address-table">
                                        <table class="table">
                                            <tbody>
                                                <tr>
                                                    <td>{{ $item->acc_no }}</td>
                                                    <td>
                                                        <p></p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Valid Date :</td>
                                                    <td>
                                                        <p>{{ $item->expired_date }}</p>
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td>{{ $item->acc_name }}</td>
                                                    <td>
                                                        <p></p>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="button-group">
                                        <button class="btn btn-sm add-button w-100 edit-address-btn"
                                                data-bs-toggle="modal" 
                                                data-bs-target="#editCard{{ $item->id }}"
                                                onclick="">
                                                <i data-feather="edit"></i> Edit
                                        </button>
                                        <button class="btn btn-sm add-button w-100" 
                                                data-bs-toggle="modal" 
                                                data-bs-target="#removeCard" 
                                                onclick="showDeleteModal('{{ $item->id }}')">
                                            <i data-feather="trash-2"></i> Remove
                                        </button>
                                        <!-- <button class="btn btn-sm add-button w-100" data-bs-toggle="modal" data-bs-target="#removeProfile"
                                        onclick="showDeleteModal('{{ $item->id }}')">
                                            <i data-feather="trash-2"></i> Remove
                                        </button> -->

                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>                        
                <!-- Payment Method View End -->
            </div>
        </div>
    </section>
    <!-- User Dashboard Section End -->
</x-guest-layout>

    <!-- Add New Card Modal Box Start -->
    <div class="modal fade theme-modal" id="addCard" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add a payment method</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                    <form method="POST" action="{{ route('add_newcard') }}" class="row g-4" >
                    @csrf
                    <div class="modal-body">
                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="acc_name" name="acc_name" placeholder="Your account name">
                                <label for="acc_name">Name on card</label>
                                <span style="color:red">@error('acc_name'){{ $message }}@enderror</span>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <div class="d-flex">
                                    <label for="acc_no">Card Number</label>
                                    <input type="text" class="form-control mx-1" id="acc_no_1" name="acc_no_1" maxlength="4" pattern="\d{4}" title="Please enter 4 digits" placeholder="1234">
                                    
                                    <span class="mx-1" style="padding-top: 15px;">/</span>
                                    <input type="text" class="form-control mx-1" id="acc_no_2" name="acc_no_2" maxlength="4" pattern="\d{4}" title="Please enter 4 digits" placeholder="1234">
                                    
                                    <span class="mx-1" style="padding-top: 15px;">/</span>
                                    <input type="text" class="form-control mx-1" id="acc_no_3" name="acc_no_3" maxlength="4" pattern="\d{4}" title="Please enter 4 digits" placeholder="1234">
                                    
                                    <span class="mx-1" style="padding-top: 15px;">/</span>
                                    <input type="text" class="form-control mx-1" id="acc_no_4" name="acc_no_4" maxlength="4" pattern="\d{4}" title="Please enter 4 digits" placeholder="1234">
                                    
                                </div>
                                <span style="color:red">@error('acc_no_*'){{ $message }}@enderror</span>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <div class="d-flex">
                                    <label for="expired_date">Expired Date</label>
                                    <input type="text" class="form-control mx-1" id="expired_date_1" name="expired_date_1" maxlength="2" pattern="\d{2}" title="Please enter 2 digits" placeholder="YY">
                            
                                    <span class="mx-1" style="padding-top: 15px;">/</span>
                                    <input type="text" class="form-control mx-1" id="expired_date_2" name="expired_date_2" maxlength="2" pattern="\d{2}" title="Please enter 2 digits" placeholder="MM">
                            
                                </div>
                                <span style="color:red">@error('expired_date_*'){{ $message }}@enderror</span>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <select class="form-select" id="floatingSelect12" name="card_type" placeholder="Your card type">
                                    <option selected>Card Type</option>
                                    <option value="Visa">Visa Card</option>
                                    <option value="Master">Master Card</option>
                                    <option value="RuPay">RuPay Card</option>
                                    <option value="Maestro">Maestro Card</option>
                                </select>
                                <span style="color:red">@error('card_type'){{ $message }}@enderror</span>
                            </div>
                            <input type="hidden" name="buyer_id" value="1">
                        </div>
                   
                        <div class="modal-footer">
                            <button type="submit" class="btn theme-bg-color btn-md text-white" data-bs-dismiss="modal">Save
                            </button>
                            <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form> 
            </div>
        </div>
    </div>
    <!-- Add Address Modal Box End -->

    <!-- Edit Card Modal Start -->
    @foreach($data as $item)
    <div class="modal fade theme-modal" id="editCard{{ $item->id }}" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit payment method</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>

                    <form method="post" action="{{ route('edit_card') }}" class="row g-4" >
                    @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        
                        <div class="modal-body">
                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="acc_name" name="acc_name" value="{{ $item->acc_name }}">
                                <label for="acc_name">Name on card</label>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="acc_no" name="acc_no" value="{{ $item->acc_no }}">
                                <label for="acc_no">Card Number</label>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <input type="text" class="form-control" id="expired_date" name="expired_date" value="{{ $item->expired_date }}">
                                <label for="expired_date">Expiration Date</label>
                            </div>

                            <div class="form-floating mb-4 theme-form-floating form-group">
                                <select class="form-select" id="floatingSelect12" name="card_type" value="{{ $item->card_type }}">
                                    <option selected>Card Type</option>
                                    <option value="Visa">Visa Card</option>
                                    <option value="Master">Master Card</option>
                                    <option value="RuPay">RuPay Card</option>
                                    <option value="Maestro">Maestro Card</option>
                                </select>
                            </div>
                            <input type="hidden" name="buyer_id" value="1">
                        </div>
                   
                        <div class="modal-footer">
                            <button type="submit" class="btn theme-bg-color btn-md text-white" data-bs-dismiss="modal" id="saveChanges">Save</button>
                            <button type="button" class="btn btn-secondary btn-md" data-bs-dismiss="modal">Close</button>
                        </div>
                    </form> 
            </div>
        </div>
    </div>
    @endforeach
    <!-- Edit Card Modal End -->

    <!-- Remove Card Modal Start -->
    @foreach($data as $item)
    <div class="modal fade theme-modal remove-profile" id="removeCard" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header d-block text-center">
                    <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure?</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="remove-box">
                        <p>You cannot see this payment no more in your payment list.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <form action="{{ route('remove_card', ['id' => $item->id]) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn theme-bg-color btn-md fw-bold text-light">Yes</button>
                    </form>
                    <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal"
                    style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div class="modal fade theme-modal remove-profile" id="removeAddress" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered modal-fullscreen-sm-down">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel12">Done!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="remove-box text-center">
                        <h4 class="text-content">It's Removed.</h4>
                    </div>
                </div>
                <div class="modal-footer pt-0">
                    <button type="button" class="btn theme-bg-color btn-md fw-bold text-light"
                        data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Remove Card Modal End -->

<!-- Edit Address Script-->
<script>
    $(document).ready(function() {
    $('.edit-btn').on('click', function() {
        var cardData = JSON.parse($(this).data('card'));
        $('#id').val(cardData.id);
        $('#email').val(cardData.email);
        $('#address').val(cardData.address);
        $('#phone').val(cardData.phone);

    });

    $('#saveChanges').on('click', function() {
        var newcardId = $('#id').val();
        var newName = $('#edit_name').val();
        var newNumber = $('#acc_no').val();
        var newExpireddate = $('#expired_date').val();
        var newCardtype = $('#card_type').val();


        // Perform AJAX request to update data in the controller
        $.ajax({
            url: '{{ route("edit_card") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                id: newcardId,
                acc_name: newName,
                acc_no: newNumber,
                expired_date: newExpireddate,
                card_type: newCardtype, 
            },
            success: function(response) {
            alert("123");
                // Handle success response
                console.log(response);
                // Close the modal
                $('#editCard').modal('hide');
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
        $('#removeCard').modal('show');
        // Update the form action URL dynamically with the selected address id
        $('#deleteForm').attr('action', '/remove-cards/' + id);
    }
</script>