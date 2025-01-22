<x-guest-layout>
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Sign Up</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Sign Up</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <section class="log-in-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row justify-content-center">
                <div class="col-lg-8 col-md-10 col-sm-12">
                    <div class="log-in-box">
                        <div class="log-in-title">
                            <h3>Shop Information</h3>
                        </div>

                        <div class="input-box">
                            <form method="POST" action="{{ route('seller.registered') }}" enctype="multipart/form-data" class="row g-4" id="sellerRegister">
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" id="shop_name" name="shop_name" class="form-control" placeholder="Shop Name" value="{{ old('shop_name') }}">
                                        <label>Shop Name</label>
                                        <span class="error" style="color:red" id="error-shop_name"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="date" id="shop_establish" name="shop_establish" class="form-control" value="{{ old('shop_establish') }}">
                                        <label>Established Year</label>
                                        <span class="error" style="color:red" id="error-shop_establish"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="file" id="shop_logo" name="shop_logo" class="form-control" value="{{ old('shop_logo') }}">
                                        <label>Shop Logo</label>
                                        <span class="error" style="color:red" id="error-shop_logo"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="number" id="phone" name="phone" class="form-control" placeholder="Phone" value="{{ old('phone') }}" pattern="\d*">
                                        <label>Phone</label>
                                        <span class="error" style="color:red" id="error-phone"></span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating theme-form-floating">
                                        <select class="form-control" name="country" value="{{ old('country') }}">
                                            <option>Choose Country</option>
                                            @foreach ($country as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="error" style="color:red" id="error-country"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="number" id="zip_code" name="zip_code" class="form-control" placeholder="Zip Code" value="{{ old('zip_code') }}" pattern="\d*">
                                        <label>Zip Code</label>
                                        <span class="error" style="color:red" id="error-zip_code"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" id="prefecture" name="prefecture" class="form-control" placeholder="Prefecture" value="{{ old('prefecture') }}">
                                        <label>Prefecture</label>
                                        <span class="error" style="color:red" id="error-prefecture"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" id="city" name="city" class="form-control" placeholder="Narita-shi,Furugome" value="{{ old('city') }}">
                                        <label>City, Ward, Town</label>
                                        <span class="error" style="color:red" id="error-city"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" id="chome" name="chome" class="form-control" placeholder="1-2-3" value="{{ old('chome') }}">
                                        <label>Chome, Banchi, Go</label>
                                        <span class="error" style="color:red" id="error-chome"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" id="building" name="building" class="form-control" placeholder="Example Building" value="{{ old('building') }}">
                                        <label>Building / Apt / Company name</label>
                                        <span class="error" style="color:red" id="error-building"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" id="room" name="room" class="form-control" placeholder="101" value="{{ old('room') }}">
                                        <label>Unit / Room no.</label>
                                        <span class="error" style="color:red" id="error-room"></span>
                                    </div>
                                </div>

                                <h3>Bank Information</h3>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" id="bank_name" name="bank_name" class="form-control" placeholder="Bank Name" value="{{ old('bank_name') }}">
                                        <label>Bank Name</label>
                                        <span class="error" style="color:red" id="error-bank_name"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" id="bank_branch" name="bank_branch" class="form-control" placeholder="Branch Name" value="{{ old('bank_branch') }}">
                                        <label>Branch Name</label>
                                        <span class="error" style="color:red" id="error-bank_branch"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <select class="form-control" name="bank_acc_type">
                                            <option value="">Choose Bank Account Type</option>
                                            <option value="普通" {{ old('bank_acc_type') == '普通' ? 'selected' : '' }}>普通</option>
                                            <option value="当座" {{ old('bank_acc_type') == '当座' ? 'selected' : '' }}>当座</option>
                                            <option value="貯蓄" {{ old('bank_acc_type') == '貯蓄' ? 'selected' : '' }}>貯蓄</option>
                                        </select>
                                        <span class="error" style="color:red" id="error-bank_acc_type"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" id="bank_acc_no" name="bank_acc_no" class="form-control" placeholder="Bank Account Number" value="{{ old('bank_acc_no') }}" pattern="\d*">
                                        <label>Bank Account Number</label>
                                        <span class="error" style="color:red" id="error-bank_acc_no"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" id="bank_acc_name" name="bank_acc_name" class="form-control" placeholder="Bank Account Name" value="{{ old('bank_acc_name') }}">
                                        <label>Bank Account Name</label>
                                        <span class="error" style="color:red" id="error-bank_acc_name"></span>
                                    </div>
                                </div>

                                <h3>User Information</h3>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" id="user_name" name="user_name" class="form-control" placeholder="Name" value="{{ old('user_name') }}">
                                        <label>Username</label>
                                        <span class="error" style="color:red" id="error-user_name"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" id="email" name="email" class="form-control" placeholder="Email Address" value="{{ old('email') }}">
                                        <label>Email Address</label>
                                        @if($errors->has('email'))
                                            <span class="error" style="color:red">{{ $errors->first('email') }}</span>
                                        @endif
                                            <span class="error" style="color:red" id="error-email"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Password" value="{{ old('passwords') }}">
                                        <label>Password</label>
                                        <span class="error" style="color:red" id="error-password"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="password" name="confirmed" class="form-control" placeholder="Confirm Password" value="{{ old('confirmed') }}">
                                        <label>Confirm Password</label>
                                        <span class="error" style="color:red" id="error-confirmed"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="forgot-box">
                                        <div class="form-check ps-0 m-0 remember-box">
                                            <input class="checkbox_animated check-box" type="checkbox" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">I agree with
                                                <a href="{{ url('/seller-term-and-condition') }}"><span>Terms and Privacy</span></a>
                                            </label>
                                        </div>
                                    </div>
                                    <span class="error" style="color:red" id="error-flexCheckDefault"></span>
                                </div>

                                <div class="col-md-12">
                                    <button class="btn btn-animation theme-bg-color w-100" type="submit" onclick="validateUserForm()">Sign Up</button>
                                </div>
                            </form>
                        </div>

                        <div class="sign-up-box">
                            <h4>Already have an account?</h4>
                            <a href="{{ route('login') }}">Log In</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script>
        function validateUserForm() {
            let isValid = true;

            const shop_name = document.getElementById('shop_name').value.trim();console.log(shop_name);
            const shop_establish = document.getElementById('shop_establish').value.trim();
            const shopLogoInput = document.getElementById('shop_logo');
            const shopLogoError = document.getElementById('error-shop_logo');
            const shopLogoFile = shopLogoInput.files[0];
            const phone = document.getElementById('phone').value.trim();
            const zip_code = document.getElementById('zip_code').value.trim();
            const country = document.querySelector('select[name="country"]').value;
            const prefecture = document.getElementById('prefecture').value.trim();
            const city = document.getElementById('city').value.trim();
            const chome = document.getElementById('chome').value.trim();
            const building = document.getElementById('building').value.trim();
            const room = document.getElementById('room').value.trim();
            const bank_name = document.getElementById('bank_name').value.trim();
            const bank_branch = document.getElementById('bank_branch').value.trim();
            const bank_acc_type = document.querySelector('select[name="bank_acc_type"]').value;
            const bank_acc_name = document.getElementById('bank_acc_name').value.trim();
            const bank_acc_no = document.getElementById('bank_acc_no').value.trim();
            const user_name = document.getElementById('user_name').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            const confirmed = document.querySelector('input[name="confirmed"]').value.trim();
            const checkbox = document.getElementById('flexCheckDefault');

            document.querySelectorAll('.error').forEach(el => el.textContent = '');

            if (!shop_name) {
                isValid = false;
                document.getElementById('error-shop_name').textContent = 'Please provide your shop name.';
            } else if (shop_name.length > 255) {
                isValid = false;
                document.getElementById('error-shop_name').textContent = 'Your shop name must not exceed 255 characters.';
            }

            if (!shop_establish) {
                isValid = false;
                document.getElementById('error-shop_establish').textContent = 'Please provide your shop established date.';
            }

            if (!shopLogoFile) {
                isValid = false;
                shopLogoError.textContent = 'Please provide your shop logo.';
            } else if (shopLogoFile.size > 2 * 1024 * 1024) {
                isValid = false;
                shopLogoError.textContent = 'Your shop logo must not exceed 2MB.';
            }

            if (!phone) {
                isValid = false;
                document.getElementById('error-phone').textContent = 'Please provide your shop phone number.';
            } else if (!/^\d+$/.test(phone)) {
                isValid = false;
                document.getElementById('error-phone').textContent = 'Please provide a valid phone number.(eg. 09077554361)';
            }

            if (!zip_code) {
                isValid = false;
                document.getElementById('error-zip_code').textContent = 'Please provide your zip code.';
            } else if (!/^\d+$/.test(zip_code)) {
                isValid = false;
                document.getElementById('error-zip_code').textContent = 'Please provide a valid digit.';
            }

            if (!country || country === 'Choose Country') {
                isValid = false;
                document.getElementById('error-country').textContent = 'Please select a valid country.';
            }

            if (!prefecture) {
                isValid = false;
                document.getElementById('error-prefecture').textContent = 'Please provide your prefecture.';
            } else if (prefecture.length > 255) {
                isValid = false;
                document.getElementById('error-prefecture').textContent = 'Your prefecture must not exceed 255 characters.';
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

            if (!room) {
                isValid = false;
                document.getElementById('error-room').textContent = 'Please provide your room number.';
            } else if (room.length > 255) {
                isValid = false;
                document.getElementById('error-room').textContent = 'Your room number must not exceed 255 characters.';
            }

            if (!bank_name) {
                isValid = false;
                document.getElementById('error-bank_name').textContent = 'Please provide your bank name.';
            } else if (bank_name.length > 255) {
                isValid = false;
                document.getElementById('error-bank_name').textContent = 'Your name must not exceed 255 characters.';
            }

            if (!bank_branch) {
                isValid = false;
                document.getElementById('error-bank_branch').textContent = 'Please provide your branch name.';
            } else if (bank_branch.length > 255) {
                isValid = false;
                document.getElementById('error-bank_branch').textContent = 'Your name must not exceed 255 characters.';
            }

            if (!bank_acc_type || bank_acc_type === 'Choose bank account type') {
                isValid = false;
                document.getElementById('error-bank_acc_type').textContent = 'Please select a valid bank account.';
            }

            if (!bank_acc_name) {
                isValid = false;
                document.getElementById('error-bank_acc_name').textContent = 'Please provide your bank account name.';
            } else if (bank_acc_name.length > 255) {
                isValid = false;
                document.getElementById('error-bank_acc_name').textContent = 'Your name must not exceed 255 characters.';
            }

            if (!bank_acc_no) {
                isValid = false;
                document.getElementById('error-bank_acc_no').textContent = 'Please provide your bank account number.';
            } else if (!/^\d+$/.test(bank_acc_no)) {
                isValid = false;
                document.getElementById('error-bank_acc_no').textContent = 'Please provide a valid digit.';
            }

            if (!user_name) {
                isValid = false;
                document.getElementById('error-user_name').textContent = 'Please provide your name.';
            } else if (user_name.length > 255) {
                isValid = false;
                document.getElementById('error-user_name').textContent = 'Your name must not exceed 255 characters.';
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

            if (!checkbox.checked) {
                isValid = false;
                document.getElementById('error-flexCheckDefault').textContent = 'You must agree to the Terms and Privacy to sign up.';
            }

            if (isValid) {
                document.getElementById('sellerRegister').submit();
            }
        }

        document.getElementById('sellerRegister').addEventListener('submit', function(event) {
            event.preventDefault();
            validateUserForm();
        });
    </script>

</x-guest-layout>