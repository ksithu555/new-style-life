@extends('seller.seller_dashboard')
@section('seller')

<!-- Settings Section Start -->
<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            @include('components.messagebox')
            <div class="col-sm-12">
                <!-- Details Start -->
                <div class="card">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>Profile</h5>
                        </div>
                        <form method="POST" action="{{ route('store.profile') }}" enctype="multipart/form-data" class="theme-form theme-form-2 mega-form" id="storeProfile">
                            @csrf
                            <input type="hidden" name="old_img" value="{{ $user->user_photo }}">

                            <div class="row">
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Username</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="name" value="{{ $user->name }}">
                                        <p class="error" style="color:red" id="error-name"></p>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Email</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="email" value="{{ $user->email }}">
                                        <p class="error" style="color:red" id="error-email"></p>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" name="password" value="{{ $user->password }}">
                                        <p class="error" style="color:red" id="error-password"></p>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Confirm Password</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="password" name="confirmed" value="{{ $user->password }}">
                                        <p class="error" style="color:red" id="error-confirmed"></p>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Photo</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="file" id="formFile" name="photo" onchange="mainThamUrl(this)">
                                        <img src="" id="mainThmb">
                                        <img src="{{ !empty($user->user_photo) ? url('images/'.$user->user_photo) : url('upload/profile/profile.jpg') }}" width="100" id="existingProfileImage">
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Phone Number</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="phone" value="{{ $user->phone }}">
                                    </div>
                                </div>

                                <div class="d-grid gap-2 d-md-block">
                                    <button type="button" class="btn btn-animation btn-submit" data-bs-toggle="modal" data-bs-target="#confrimBox_{{ $user->id }}">Update Profile</button>
                                </div>
                            </div>

                            <!-- Confirm Modal Box -->
                            <div class="modal fade theme-modal remove-coupon" id="confrimBox_{{ $user->id }}" aria-hidden="true" tabindex="-1">
                                <div class="modal-dialog modal-dialog-centered">
                                    <div class="modal-content">
                                        <div class="modal-header d-block text-center">
                                            <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            <div class="remove-box">
                                                <p>The data will be added permanently.</p>
                                            </div>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-animation" id="confirmSubmit">Yes</button>
                                            <button type="button" class="btn btn-animation" data-bs-dismiss="modal" style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- Confirm Modal Box End-->
                        </form>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">
                        <div class="title-header option-title">
                            <h5>Shop Information</h5>
                        </div>
                        <form method="POST" action="{{ route('update.shop')}}" enctype="multipart/form-data" class="theme-form theme-form-2 mega-form">
                            @csrf
                            <input type="hidden" name="old_img" value="{{ $data->shop_logo }}">
                            <input type="hidden" name="seller_id" value="{{ $data->id }}">
                            <div class="row">
                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Shop Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="shop_name" value="{{ $data->shop_name }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Shop Logo</label>
                                    <div class="col-sm-10">
                                        @if(empty(Auth::user()->created_by))
                                            <input class="form-control" type="file" name="shop_logo">
                                        @endif
                                        <img src="{{ asset('images/'.$data->shop_logo) }}" width="100">
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Establilshed</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="date" name="shop_establish" value="{{ $data->shop_establish }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Phone
                                        Number</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="phone" value="{{ $data->phone }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Country</label>
                                    <div class="col-sm-10">
                                        <select class="js-example-basic-single w-100" name="country_id" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                            <option>Choose country</option>
                                            @foreach ($countries as $country)
                                                <option value="{{ $country->id }}" {{ $country->id == $data->country_id  ? 'selected' : '' }}> {{ $country->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Zip Code</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="zip_code" value="{{ $data->zip_code }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Prefecture</label>
                                    <div class="col-sm-10">
                                        <input type="text" id="prefecture" name="prefecture" class="form-control"  value="{{ $data->prefecture }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">City, Ward, Town</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="city" value="{{ $data->city }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Chome, Banchi, Go</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="chome" value="{{ $data->chome }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Building / Apt / Company name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="building" value="{{ $data->building }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Unit / Room no.</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="room" value="{{ $data->room }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">URL</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="url" value="{{ $data->url }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Bank Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="bank_name" value="{{ $data->bank_name }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Bank Account Type</label>
                                    <div class="col-sm-10">
                                        <select class="form-control" name="bank_acc_type" id="bank_acc_type" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                            <option value="">Choose Bank Account Type</option>
                                            <option value="普通" {{ old('bank_acc_type', $data->bank_acc_type) == '普通' ? 'selected' : '' }}>普通</option>
                                            <option value="当座" {{ old('bank_acc_type', $data->bank_acc_type) == '当座' ? 'selected' : '' }}>当座</option>
                                            <option value="貯蓄" {{ old('bank_acc_type', $data->bank_acc_type) == '貯蓄' ? 'selected' : '' }}>貯蓄</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Bank Branch</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="bank_branch" value="{{ $data->bank_branch }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Bank Account Name</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="bank_acc_name" value="{{ $data->bank_acc_name }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="form-label-title col-sm-2 mb-0">Bank Account No</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" type="text" name="bank_acc_no" value="{{ $data->bank_acc_no }}" @if(!empty(Auth::user()->created_by)) readonly @endif>
                                    </div>
                                </div>

                                @if(empty(Auth::user()->created_by))
                                    <div class="d-grid gap-2 d-md-block">
                                        <button type="button" class="btn btn-animation btn-submit" data-bs-toggle="modal" data-bs-target="#confrimBox_{{ $data->id }}">Update Profile</button>

                                        <!-- Confirm Modal Box -->
                                        <div class="modal fade theme-modal remove-coupon" id="confrimBox_{{ $data->id }}" aria-hidden="true" tabindex="-1">
                                            <div class="modal-dialog modal-dialog-centered">
                                                <div class="modal-content">
                                                    <div class="modal-header d-block text-center">
                                                        <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure?</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                            <i class="fas fa-times"></i>
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="remove-box">
                                                            <p>The data will be added permanently.</p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-animation btn-md fw-bold" >Yes</button>
                                                        <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal"
                                                        style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Confirm Modal Box End-->
                                    </div>
                                @endif
                            </div>
                        </form>
                    </div>
                </div>
                <!-- Details End -->
            </div>
        </div>
    </div>
</div>
<!-- Settings Section End -->

<script>
    document.querySelector('.btn-submit').addEventListener('click', function(event) {
        event.preventDefault();
        if (validateUserForm()) {
            const confirmModal = new bootstrap.Modal(document.getElementById('confrimBox_{{ $user->id }}'));
            confirmModal.show();
        }
    });

    document.getElementById('confirmSubmit').addEventListener('click', function() {
        document.getElementById('storeProfile').submit();
    });

    function validateUserForm() {
        let isValid = true;

        const user_name = document.querySelector('input[name="name"]').value.trim();
        const email = document.querySelector('input[name="email"]').value.trim();
        const password = document.querySelector('input[name="password"]').value.trim();
        const confirmed = document.querySelector('input[name="confirmed"]').value.trim();

        document.querySelectorAll('.error').forEach(el => el.textContent = '');

        if (!user_name) {
            isValid = false;
            document.getElementById('error-name').textContent = 'Please provide your name.';
        } else if (user_name.length > 255) {
            isValid = false;
            document.getElementById('error-name').textContent = 'Your name must not exceed 255 characters.';
        }

        if (!email) {
            isValid = false;
            document.getElementById('error-email').textContent = 'Please provide your email.';
        } else if (!/\S+@\S+\.\S+/.test(email)) {
            isValid = false;
            document.getElementById('error-email').textContent = 'Please provide a valid email address.';
        }

        if (!password) {
            isValid = false;
            document.getElementById('error-password').textContent = 'Please provide your password.';
        } else if (password.length < 8) {
            isValid = false;
            document.getElementById('error-password').textContent = 'Your password must be at least 8 characters long.';
        }

        if (password && !confirmed) {
            isValid = false;
            document.getElementById('error-confirmed').textContent = 'Please confirm your password.';
        } else if (password !== confirmed) {
            isValid = false;
            document.getElementById('error-confirmed').textContent = 'Passwords do not match.';
        }

        return isValid;
    }
</script>

<script>
    function mainThamUrl(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#mainThmb').attr('src', e.target.result).width(100);
                $('#existingProfileImage').hide(); // Hide the existing profile image
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

@endsection