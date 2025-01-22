@extends('seller.seller_dashboard')
@section('seller')

<!-- Settings Section Start -->
<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-12">
                        <!-- Details Start -->
                        <div class="card">
                            <div class="card-body">
                                <div class="title-header option-title">
                                    <h5>Profile</h5>
                                </div>
                                <form method="POST" action="{{ route('seller.store.profile') }}" enctype="multipart/form-data" class="theme-form theme-form-2 mega-form">
                                    @csrf
                                    <input type="hidden" name="old_img" value="{{ $data->user_photo }}">
                                    @if (session('flash_message'))
                                        <div class="flash_message bg-gradient-success text-center py-3 my-0">
                                            {{ session('flash_message') }}
                                        </div>
                                    @endif

                                    <div class="row">
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Username</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="name" value="{{ $data->name }}">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Email</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="email" name="email" value="{{ $data->email }}" >
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Password</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="password" name="password" value="{{ $data->password }}" id="password">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Confirm
                                                Password</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="password" id="confirm_password">
                                                <span id="confirm-password-error" style="color: red;"></span>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label
                                                class="form-label-title col-sm-2 mb-0">Photo</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="file" id="formFile" onchange="mainThamUrl(this)" name="photo">
                                                <img src="" id="mainThmb">
                                            </div>
                                        </div>
                                        <div class="d-grid gap-2 d-md-block">
                                            <button class="btn btn-animation" type="submit">Update Profile</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="title-header option-title">
                                    <h5>Shop Information</h5>
                                </div>
                                <form method="POST" action="{{ route('seller.update.shop')}}" enctype="multipart/form-data" class="theme-form theme-form-2 mega-form">
                                    @csrf
                                    <input type="hidden" name="old_img" value="{{ $shop->shop_logo }}">
                                    <input type="hidden" name="seller_id" value="{{ $shop->id }}">
                                    <div class="row">
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Shop Name</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="shop_name" value="{{ $shop->shop_name }}">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Shop Logo</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="file" name="shop_logo">
                                                <img src="{{ asset('upload/shop/'.$shop->shop_logo) }}" width="100">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Establilshed</label>
                                             <div class="col-sm-10">
                                                <input class="form-control" type="date" name="shop_establish" value="{{ $shop->shop_establish }}">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Phone
                                                Number</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="phone" value="{{ $shop->phone }}">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Zip Code</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="zip_code" value="{{ $shop->zip_code }}">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Prefecture</label>
                                            <div class="col-sm-10">
                                                <select class="js-example-basic-single w-100" name="category_id">
                                                    <option>Choose Prefecture</option>
                                                    @foreach ($prefecture as $item)
                                                        <option value="{{ $item->id }}" {{ $item->id == $item->prefecture_id  ? 'selected' : '' }}>{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">City, Ward, Town</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="city" value="{{ $shop->city }}">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Chome, Banchi, Go</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="chome" value="{{ $shop->chome }}">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Building / Apt / Company name</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="building" value="{{ $shop->building }}">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Unit / Room no.</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="room" value="{{ $shop->room }}">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">URL</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="url" value="{{ $shop->url }}">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Bank Name</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="bank_name" value="{{ $shop->bank_name }}">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Bank Account Type</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="bank_acc_type" value="{{ $shop->bank_acc_type }}">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Bank Branch</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="bank_branch" value="{{ $shop->bank_branch }}">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Bank Account Name</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="bank_acc_name" value="{{ $shop->bank_acc_name }}">
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-2 mb-0">Bank Account No</label>
                                            <div class="col-sm-10">
                                                <input class="form-control" type="text" name="bank_acc_no" value="{{ $shop->bank_acc_no }}">
                                            </div>
                                        </div>

                                        <div class="d-grid gap-2 d-md-block">
                                            <button class="btn btn-animation" type="submit">Update</button>
                                        </div>

                                    </div>
                                </form>
                            </div>
                        </div>
                        <!-- Details End -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Settings Section End -->

<script>
    function mainThamUrl(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#mainThmb').attr('src', e.target.result).width(100).height(100);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
<script>
    let password = document.getElementById("password");
        let confirm_password = document.getElementById("confirm_password");
        let passwordError = document.getElementById("password-error");
        let confirmPasswordError = document.getElementById("confirm-password-error");
        function validatePassword() {
            if (password.value !== confirm_password.value) {
                confirmPasswordError.textContent = "Passwords Don't Match";
            } else {
                confirmPasswordError.textContent = "";
            }
        }
        password.onchange = validatePassword;
        confirm_password.onkeyup = validatePassword;

        document.addEventListener("DOMContentLoaded", function() {
            $('#image').change(function(e){
                let reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        });
</script>
@endsection
