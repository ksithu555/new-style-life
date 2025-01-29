<x-guest-layout>
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>{{ __('messages.sign_up') }}</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">{{ __('messages.sign_up') }}</li>
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
                            <h3>{{ __('messages.shop_information') }}</h3>
                        </div>

                        <div class="input-box">
                            <form method="POST" action="{{ route('seller.registered') }}" enctype="multipart/form-data" class="row g-4" id="sellerRegister">
                                @csrf
                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" id="shop_name" name="shop_name" class="form-control" placeholder="{{ __('messages.shop_name') }}" value="{{ old('shop_name') }}">
                                        <label>{{ __('messages.shop_name') }}</label>
                                        <span class="error" style="color:red" id="error-shop_name"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="date" id="shop_establish" name="shop_establish" class="form-control" value="{{ old('shop_establish') }}">
                                        <label>{{ __('messages.established_year') }}</label>
                                        <span class="error" style="color:red" id="error-shop_establish"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="file" id="shop_logo" name="shop_logo" class="form-control" value="{{ old('shop_logo') }}">
                                        <label>{{ __('messages.shop_logo') }}</label>
                                        <span class="error" style="color:red" id="error-shop_logo"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="number" id="phone" name="phone" class="form-control" placeholder="{{ __('messages.phone') }}" value="{{ old('phone') }}" pattern="\d*">
                                        <label>{{ __('messages.phone') }}</label>
                                        <span class="error" style="color:red" id="error-phone"></span>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="form-floating theme-form-floating">
                                        <select class="form-control" name="country" value="{{ old('country') }}">
                                            <option>{{ __('messages.choose_country') }}</option>
                                            @foreach ($country as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        <span class="error" style="color:red" id="error-country"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="number" id="zip_code" name="zip_code" class="form-control" placeholder="{{ __('messages.zip_code') }}" value="{{ old('zip_code') }}" pattern="\d*">
                                        <label>{{ __('messages.zip_code') }}</label>
                                        <span class="error" style="color:red" id="error-zip_code"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" id="prefecture" name="prefecture" class="form-control" placeholder="{{ __('messages.prefecture') }}" value="{{ old('prefecture') }}">
                                        <label>{{ __('messages.prefecture') }}</label>
                                        <span class="error" style="color:red" id="error-prefecture"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" id="city" name="city" class="form-control" placeholder="Narita-shi,Furugome" value="{{ old('city') }}">
                                        <label>{{ __('messages.city_ward_town') }}</label>
                                        <span class="error" style="color:red" id="error-city"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" id="chome" name="chome" class="form-control" placeholder="1-2-3" value="{{ old('chome') }}">
                                        <label>{{ __('messages.chome_banchi_go') }}</label>
                                        <span class="error" style="color:red" id="error-chome"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" id="building" name="building" class="form-control" placeholder="Example Building" value="{{ old('building') }}">
                                        <label>{{ __('messages.building_apartment_company') }}</label>
                                        <span class="error" style="color:red" id="error-building"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" id="room" name="room" class="form-control" placeholder="101" value="{{ old('room') }}">
                                        <label>{{ __('messages.unit_room') }}</label>
                                        <span class="error" style="color:red" id="error-room"></span>
                                    </div>
                                </div>

                                <h3>{{ __('messages.bank_information') }}</h3>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" id="bank_name" name="bank_name" class="form-control" placeholder="{{ __('messages.bank_name') }}" value="{{ old('bank_name') }}">
                                        <label>{{ __('messages.bank_name') }}</label>
                                        <span class="error" style="color:red" id="error-bank_name"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" id="bank_branch" name="bank_branch" class="form-control" placeholder="{{ __('messages.branch_name') }}" value="{{ old('bank_branch') }}">
                                        <label>{{ __('messages.branch_name') }}</label>
                                        <span class="error" style="color:red" id="error-bank_branch"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <select class="form-control" name="bank_acc_type">
                                            <option value="">{{ __('messages.choose_bank_account_type') }}</option>
                                            <option value="普通" {{ old('bank_acc_type') == '普通' ? 'selected' : '' }}>{{ __('messages.bank_account_type_futsu') }}</option>
                                            <option value="当座" {{ old('bank_acc_type') == '当座' ? 'selected' : '' }}>{{ __('messages.bank_account_type_toza') }}</option>
                                            <option value="貯蓄" {{ old('bank_acc_type') == '貯蓄' ? 'selected' : '' }}>{{ __('messages.bank_account_type_chokin') }}</option>
                                        </select>
                                        <span class="error" style="color:red" id="error-bank_acc_type"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" id="bank_acc_no" name="bank_acc_no" class="form-control" placeholder="{{ __('messages.account_number') }}" value="{{ old('bank_acc_no') }}" pattern="\d*">
                                        <label>{{ __('messages.account_number') }}</label>
                                        <span class="error" style="color:red" id="error-bank_acc_no"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" id="bank_acc_name" name="bank_acc_name" class="form-control" placeholder="{{ __('messages.account_name') }}" value="{{ old('bank_acc_name') }}">
                                        <label>{{ __('messages.account_name') }}</label>
                                        <span class="error" style="color:red" id="error-bank_acc_name"></span>
                                    </div>
                                </div>

                                <h3>{{ __('messages.user_information') }}</h3>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" id="user_name" name="user_name" class="form-control" placeholder="{{ __('messages.name') }}" value="{{ old('user_name') }}">
                                        <label>{{ __('messages.name') }}</label>
                                        <span class="error" style="color:red" id="error-user_name"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" id="email" name="email" class="form-control" placeholder="{{ __('messages.email') }}" value="{{ old('email') }}">
                                        <label>{{ __('messages.email') }}</label>
                                        @if($errors->has('email'))
                                            <span class="error" style="color:red">{{ $errors->first('email') }}</span>
                                        @endif
                                            <span class="error" style="color:red" id="error-email"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="password" id="password" name="password" class="form-control" placeholder="{{ __('messages.password') }}" value="{{ old('passwords') }}">
                                        <label>{{ __('messages.password') }}</label>
                                        <span class="error" style="color:red" id="error-password"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="password" name="confirmed" class="form-control" placeholder="{{ __('messages.confirm_password') }}" value="{{ old('confirmed') }}">
                                        <label>{{ __('messages.confirm_password') }}</label>
                                        <span class="error" style="color:red" id="error-confirmed"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="forgot-box">
                                        <div class="form-check ps-0 m-0 remember-box">
                                            <input class="checkbox_animated check-box" type="checkbox" id="flexCheckDefault">
                                            <label class="form-check-label" for="flexCheckDefault">{{ __('messages.i_agree_with') }}
                                                <a href="{{ url('/seller-term-and-condition') }}"><span>{{ __('messages.terms_and_privacy') }}</span></a>
                                            </label>
                                        </div>
                                    </div>
                                    <span class="error" style="color:red" id="error-flexCheckDefault"></span>
                                </div>

                                <div class="col-md-12">
                                    <button class="btn btn-animation theme-bg-color w-100" type="submit" onclick="validateUserForm()">
                                        {{ __('messages.sign_up') }}
                                    </button>
                                </div>
                            </form>
                        </div>

                        <div class="sign-up-box">
                            <h4>{{ __('messages.already_have_account') }}</h4>
                            <a href="{{ route('login') }}">{{ __('messages.login') }}</a>
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
                document.getElementById('error-shop_name').textContent = '{{ __('messages.provide_shop_name_error_message') }}';
            } else if (shop_name.length > 255) {
                isValid = false;
                document.getElementById('error-shop_name').textContent = '{{ __('messages.shop_name_length_error_message') }}';
            }
            
            if (!shop_establish) {
                isValid = false;
                document.getElementById('error-shop_establish').textContent = '{{ __('messages.provide_shop_established_date_error_message') }}';
            }
            
            if (!shopLogoFile) {
                isValid = false;
                shopLogoError.textContent = '{{ __('messages.provide_shop_logo_error_message') }}';
            } else if (shopLogoFile.size > 2 * 1024 * 1024) {
                isValid = false;
                shopLogoError.textContent = '{{ __('messages.shop_logo_size_error_message') }}';
            }

            if (!phone) {
                isValid = false;
                document.getElementById('error-phone').textContent = '{{ __('messages.enter_phone_error_message') }}';
            } else if (!/^\d+$/.test(phone)) {
                isValid = false;
                document.getElementById('error-phone').textContent = '{{ __('messages.valid_phone_error_message') }}';
            }

            if (!zip_code) {
                isValid = false;
                document.getElementById('error-zip_code').textContent = '{{ __('messages.enter_zip_code_error_message') }}';
            } else if (!/^\d+$/.test(zip_code)) {
                isValid = false;
                document.getElementById('error-zip_code').textContent = '{{ __('messages.valid_zip_code_error_message') }}';
            }

            if (!country || country === '{{ __('messages.choose_country') }}') {
                isValid = false;
                document.getElementById('error-country').textContent = '{{ __('messages.select_valid_country_error_message') }}';
            }

            if (!prefecture) {
                isValid = false;
                document.getElementById('error-prefecture').textContent = '{{ __('messages.select_valid_prefecture_error_message') }}';
            } else if (prefecture.length > 255) {
                isValid = false;
                document.getElementById('error-prefecture').textContent = '{{ __('messages.select_valid_prefecture_error_message') }}';
            }

            if (!city) {
                isValid = false;
                document.getElementById('error-city').textContent = '{{ __('messages.enter_city_error_message') }}';
            } else if (city.length > 255) {
                isValid = false;
                document.getElementById('error-city').textContent = '{{ __('messages.valid_city_error_message') }}';
            }

            if (!chome) {
                isValid = false;
                document.getElementById('error-chome').textContent = '{{ __('messages.enter_chome_error_message') }}';
            } else if (chome.length > 255) {
                isValid = false;
                document.getElementById('error-chome').textContent = '{{ __('messages.valid_chome_error_message') }}';
            }

            if (!building) {
                isValid = false;
                document.getElementById('error-building').textContent = '{{ __('messages.enter_building_error_message') }}';
            } else if (building.length > 255) {
                isValid = false;
                document.getElementById('error-building').textContent = '{{ __('messages.valid_building_error_message') }}';
            }

            if (!room) {
                isValid = false;
                document.getElementById('error-room').textContent = '{{ __('messages.enter_room_error_message') }}';
            } else if (room.length > 255) {
                isValid = false;
                document.getElementById('error-room').textContent = '{{ __('messages.valid_room_error_message') }}';
            }

            if (!bank_name) {
                isValid = false;
                document.getElementById('error-bank_name').textContent = '{{ __('messages.provide_bank_name_error_message') }}';
            } else if (bank_name.length > 255) {
                isValid = false;
                document.getElementById('error-bank_name').textContent = '{{ __('messages.bank_name_length_error_message') }}';
            }
            
            if (!bank_branch) {
                isValid = false;
                document.getElementById('error-bank_branch').textContent = '{{ __('messages.provide_bank_branch_error_message') }}';
            } else if (bank_branch.length > 255) {
                isValid = false;
                document.getElementById('error-bank_branch').textContent = '{{ __('messages.bank_branch_length_error_message') }}';
            }
            
            if (!bank_acc_type || bank_acc_type === '{{ __('messages.choose_bank_account_type') }}') {
                isValid = false;
                document.getElementById('error-bank_acc_type').textContent = '{{ __('messages.select_valid_bank_account_error_message') }}';
            }
            
            if (!bank_acc_name) {
                isValid = false;
                document.getElementById('error-bank_acc_name').textContent = '{{ __('messages.provide_bank_account_name_error_message') }}';
            } else if (bank_acc_name.length > 255) {
                isValid = false;
                document.getElementById('error-bank_acc_name').textContent = '{{ __('messages.bank_account_name_length_error_message') }}';
            }
            
            if (!bank_acc_no) {
                isValid = false;
                document.getElementById('error-bank_acc_no').textContent = '{{ __('messages.provide_bank_account_number_error_message') }}';
            } else if (!/^\d+$/.test(bank_acc_no)) {
                isValid = false;
                document.getElementById('error-bank_acc_no').textContent = '{{ __('messages.valid_digit_error_message') }}';
            }

            if (!user_name) {
                isValid = false;
                document.getElementById('error-user_name').textContent = '{{ __('messages.enter_name_error_message') }}';
            } else if (user_name.length > 255) {
                isValid = false;
                document.getElementById('error-user_name').textContent = '{{ __('messages.valid_name_error_message') }}';
            }

            if (!email) {
                isValid = false;
                document.getElementById('error-email').textContent = '{{ __('messages.enter_email_error_message') }}';
            } else if (!/\S+@\S+\.\S+/.test(email)) {
                isValid = false;
                document.getElementById('error-email').textContent = '{{ __('messages.valid_email_error_message') }}';
            }

            if (!password) {
                isValid = false;
                document.getElementById('error-password').textContent = '{{ __('messages.enter_password_error_message') }}';
            } else if (password.length < 8) {
                isValid = false;
                document.getElementById('error-password').textContent = '{{ __('messages.valid_password_error_message') }}';
            }

            if (password && !confirmed) {
                isValid = false;
                document.getElementById('error-confirmed').textContent = '{{ __('messages.enter_confirm_password_error_message') }}';
            } else if (password !== confirmed) {
                isValid = false;
                document.getElementById('error-confirmed').textContent = '{{ __('messages.passwords_do_not_match_error_message') }}';
            }

            if (!checkbox.checked) {
                isValid = false;
                document.getElementById('error-flexCheckDefault').textContent = '{{ __('messages.agree_terms_privacy_error_message') }}';
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