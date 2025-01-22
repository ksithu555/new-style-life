<x-guest-layout>


    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2 class="mb-2">Log In</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Log In</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    @php $subtitle=__('auth.userlogin'); @endphp

    <section class="log-in-section background-image-2 section-b-space">
        <div class="container-fluid-lg w-100">
            <div class="row">
                <div class="col-xxl-4 col-xl-5 col-lg-6 col-sm-8 mx-auto">
                    <div class="log-in-box">
                        @include('components.messagebox')
                        <div class="log-in-title">
                            <h3 style="text-wrap">Welcome to New Style Life </h3>
                            <h5>Log In Your Account</h5>
                        </div>
                        @php $error = $errors->toArray(); @endphp
                        <div class="input-box">
                            <form id="contact-form" class="contact-form" method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="error-container"></div>
                                <div class="row g-4">
                                    <div class="col-12 mx-auto">
                                        <div class="form-group">
                                            <label for="email"><b>{{ __('auth.mailaddress') }}</b></label>
                                            <input class="form-control form-control-email" placeholder="{{ __('auth.mailaddress') }}" name="email" id="email" type="text" value="{{ old('email') }}" autofocus>
                                            @if (!empty($error['inflhide']))
                                                @foreach ($error['inflhide'] as  $key => $value)
                                                    <p class="inflhide error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @elseif (!empty($error['email']))
                                                @foreach ($error['email'] as  $key => $value)
                                                    <p class="email error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                            @if(session('incorrect'))
                                                <span class="error" style="color:red">{{ session('incorrect') }}</span>
                                            @endif
                                        </div>
                                    </div>
                            
                                    <div class="col-12 mx-auto">
                                        <div class="form-group">
                                            <label for="pwd"><b>{{ __('auth.password') }}</b></label>
                                            <input class="form-control form-control-password" placeholder="{{ __('auth.password') }}" name="password" id="password" type="password" autocomplete="current-password">
                                            @if (!empty($error['password']))
                                                @foreach ($error['password'] as  $key => $value)
                                                    <p class="password error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                            
                                    <div class="col-12">
                                        <div class="forgot-box">
                                            <div class="form-check ps-0 m-0 remember-box">
                                                <input class="checkbox_animated check-box" type="checkbox" id="rememberMeCheckbox" {{ old('remember') ? 'checked' : '' }}>
                                                <label class="form-check-label" for="rememberMeCheckbox">Remember me</label>
                                            </div>
                                            <a href="{{ route('password.request') }}"><i class="fa fa-key"></i> Forgot Password?</a>
                                        </div>
                                    </div>
                            
                                    <div class="text-center">
                                        <button class="btn btn-animation theme-bg-color w-100 justify-content-center" type="submit">Log In</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="speaker-shap">
                    <img class="shap1" src="images/shap/home_schedule_memphis2.png" alt="">
                </div>
            </div>
        </div>
    </section>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var rememberMeCheckbox = document.getElementById('rememberMeCheckbox');
            var emailInput = document.getElementById('email');
            var passwordInput = document.getElementById('password');
    
            // Check if there is a stored cookie and set the checkbox accordingly
            if (document.cookie.includes('rememberMe=true')) {
                rememberMeCheckbox.checked = true;
                // If the "Remember Me" cookie is set, populate the email and password fields
                var rememberMeData = document.cookie.split('; ').find(row => row.startsWith('rememberMeData='));
                if (rememberMeData) {
                    var data = rememberMeData.split('=')[1].split('|');
                    emailInput.value = decodeURIComponent(data[0]);
                    passwordInput.value = decodeURIComponent(data[1]);
                }
            }
    
            rememberMeCheckbox.addEventListener('change', function() {
                if (this.checked) {
                    var email = emailInput.value.trim();
                    var password = passwordInput.value.trim();
                    // If checkbox is checked, set a cookie to remember the user
                    var cookieValue = encodeURIComponent(email) + '|' + encodeURIComponent(password);
                    document.cookie = 'rememberMeData=' + cookieValue + '; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
                    document.cookie = 'rememberMe=true; expires=Thu, 31 Dec 2099 23:59:59 UTC; path=/';
                } else {
                    // If checkbox is unchecked, remove the rememberMe cookie
                    document.cookie = 'rememberMeData=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                    document.cookie = 'rememberMe=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
                }
            });
        });
    </script>    
</x-guest-layout>