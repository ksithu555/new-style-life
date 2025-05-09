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
            <div class="row justify-content-center align-items-center">
                <div class="col-lg-8 col-md-10 col-sm-12">
                    <div class="log-in-box center">
                        <div class="log-in-title">
                            <h3>{{ __('messages.create_account') }}</h3>
                        </div>
                            @if(Session::get('success'))
                                <div class="alert alert-success">
                                    {{ Session::get('success')}}
                                </div>
                            @endif

                            @if(Session::get('fail'))
                                <div class="alert alert-danger">
                                    {{ Session::get('fail')}}
                                </div>
                            @endif
                            
                            <form method="POST" action="{{ route('adduser') }}" class="row g-4" id="userRegisterForm">
                                @csrf
                                
                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" class="form-control" name="name" id="fullname" placeholder="{{ __('messages.enter_name') }}" value="{{ old('name') }}">
                                        <label for="fullname">{{ __('messages.name') }}</label>
                                        {{-- <span style="color:red">@error('name'){{$message}} @enderror</span> --}}
                                        <span class="error" style="color:red" id="error-name"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="email" class="form-control" name="email" id="email" placeholder="{{ __('messages.enter_email') }}" value="{{ old('email') }}">
                                        <label for="email">{{ __('messages.email') }}</label>
                                        @if($errors->has('email'))
                                            <span class="error" style="color:red">{{ $errors->first('email') }}</span>
                                        @endif
                                        <span class="error" style="color:red" id="error-email"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="password" class="form-control" name="password" id="password" placeholder="{{ __('messages.enter_password') }}" value="{{ old('password') }}">
                                        <label for="password">{{ __('messages.password') }}</label>
                                        {{-- <span style="color:red">@error('password'){{$message}} @enderror</span> --}}
                                        <span class="error" style="color:red" id="error-password"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="password" name="password_confirmation" class="form-control" placeholder="{{ __('messages.enter_confirm_password') }}">
                                        <label for="password">{{ __('messages.confirm_password') }}</label>
                                        {{-- <span style="color:red">@error('password'){{$message}} @enderror</span> --}}
                                        <span class="error" style="color:red" id="error-confirmed-password"></span>
                                    </div>
                                </div>

                                {{-- <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="date" class="form-control" name="birthday" id="birthday" placeholder="Email Address">
                                        <span style="color:red">@error('birthday'){{ $message }} @enderror</span>

                                    </div>
                                </div> --}}

                                <div class="col-md-12">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" class="form-control" name="phone" id="phone" placeholder="{{ __('messages.enter_phone') }}" value="{{ old('phone') }}">
                                        <label for="phone">{{ __('messages.phone') }}</label>
                                        {{-- <span style="color:red">@error('phone'){{$message}} @enderror</span> --}}
                                        <span class="error" style="color:red" id="error-phone"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" name="zip_code" class="form-control" placeholder="{{ __('messages.enter_zip_code') }}" max="7" value="{{ old('zip_code') }}">
                                        <label>{{ __('messages.zip_code') }}</label>
                                        {{-- <span style="color:red">@error('zip_code'){{ $message }}@enderror</span> --}}
                                        <span class="error" style="color:red" id="error-zip-code"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <select class="form-control" name="prefecture" value="{{ old('prefecture') }}">
                                            <option>{{ __('messages.choose_prefecture') }}</option>
                                            @foreach ($prefecture as $item)
                                                <option value="{{ $item->id }}" {{ old('prefecture') == $item->id ? 'selected' : '' }}>{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                        {{-- @error('prefecture')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror --}}
                                        <span class="error" style="color:red" id="error-prefectures"></span>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" name="city" class="form-control" placeholder="Narita-shi,Furugome" value="{{ old('city') }}">
                                        <label>{{ __('messages.city_ward_town') }}</label>
                                        {{-- <span style="color:red">@error('city'){{ $message }}@enderror</span> --}}
                                        <span class="error" style="color:red" id="error-city"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" name="chome" class="form-control" placeholder="1-2-3" value="{{ old('chome') }}">
                                        <label>{{ __('messages.chome_banchi_go') }}</label>
                                        {{-- <span style="color:red">@error('chome'){{ $message }}@enderror</span> --}}
                                        <span class="error" style="color:red" id="error-chome"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" name="building" class="form-control" placeholder="Example Building" value="{{ old('building') }}">
                                        <label>{{ __('messages.building_apartment_company') }}</label>
                                        {{-- @error('building')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror --}}
                                        <span class="error" style="color:red" id="error-building"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-floating theme-form-floating">
                                        <input type="text" name="room" class="form-control" placeholder="101" value="{{ old('room') }}">
                                        <label>{{ __('messages.unit_room') }}</label>
                                        {{-- @error('room')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror --}}
                                        <span class="error" style="color:red" id="error-room-no"></span>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="forgot-box">
                                        <div class="form-check ps-0 m-0 remember-box">
                                            <input class="checkbox_animated check-box" type="checkbox" id="flexCheckDefault" required>
                                            <label class="form-check-label" for="flexCheckDefault">
                                                {{ __('messages.i_agree_with') }}
                                                <a href="{{ url('buyer-term-and-condition') }}">
                                                    <span>{{ __('messages.terms_and_privacy') }}</span>
                                                </a>
                                            </label>
                                        </div>
                                    </div>
                                    <span class="error" style="color:red" id="error-flexCheckDefault"></span>
                                </div>

                                <input type="hidden" name="role" value="buyer">

                                <div class="col-md-12">
                                    <button class="btn btn-animation theme-bg-color w-100" type="button" onclick="validateUserForm()">{{ __('messages.sign_up') }}</button>
                                </div>
                            </form>
                        <div class="sign-up-box">
                            <h4> {{ __('messages.already_have_account') }}</h4>
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
    
            const fullname = document.getElementById('fullname').value.trim();
            const email = document.getElementById('email').value.trim();
            const password = document.getElementById('password').value.trim();
            const password_confirmation = document.querySelector('input[name="password_confirmation"]').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const zip_code = document.querySelector('input[name="zip_code"]').value.trim();
            const prefecture = document.querySelector('select[name="prefecture"]').value;
            const city = document.querySelector('input[name="city"]').value.trim();
            const chome = document.querySelector('input[name="chome"]').value.trim();
            const building = document.querySelector('input[name="building"]').value.trim();
            const room = document.querySelector('input[name="room"]').value.trim();
            const checkbox = document.getElementById('flexCheckDefault');

            document.querySelectorAll('.error').forEach(el => el.textContent = '');
    
            if (!fullname) {
                isValid = false;
                document.getElementById('error-name').textContent = '{{ __('messages.enter_name_error_message') }}';
            } else if (fullname.length > 255) {
                isValid = false;
                document.getElementById('error-name').textContent = '{{ __('messages.valid_name_error_message') }}';
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
    
            if (password && !password_confirmation) {
                isValid = false;
                document.getElementById('error-confirmed-password').textContent = '{{ __('messages.enter_confirm_password_error_message') }}';
            } else if (password !== password_confirmation) {
                isValid = false;
                document.getElementById('error-confirmed-password').textContent = '{{ __('messages.passwords_do_not_match_error_message') }}';
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
                document.getElementById('error-zip-code').textContent = '{{ __('messages.enter_zip_code_error_message') }}';
            } else if (zip_code.length !== 7 || !/^\d{7}$/.test(zip_code)) {
                isValid = false;
                document.getElementById('error-zip-code').textContent = '{{ __('messages.valid_zip_code_error_message') }}';
            }
    
            if (!prefecture || prefecture === '{{ __('messages.choose_prefecture') }}') {
                isValid = false;
                document.getElementById('error-prefectures').textContent = '{{ __('messages.select_valid_prefecture_error_message') }}';
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
                document.getElementById('error-room-no').textContent = '{{ __('messages.enter_room_error_message') }}';
            } else if (room.length > 255) {
                isValid = false;
                document.getElementById('error-room-no').textContent = '{{ __('messages.valid_room_error_message') }}';
            }

            if (!checkbox.checked) {
                isValid = false;
                document.getElementById('error-flexCheckDefault').textContent = '{{ __('messages.agree_terms_privacy_error_message') }}';
            }
    
            if (isValid) {
                document.getElementById('userRegisterForm').submit();
            }
        }
    
        document.getElementById('userRegisterForm').addEventListener('submit', function(event) {
            event.preventDefault();
            validateUserForm();
        });
    </script>    
</x-guest-layout>