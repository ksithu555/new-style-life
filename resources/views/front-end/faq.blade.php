<x-guest-layout>
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>FAQ</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">FAQ</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Box Section Start -->
    <section class="contact-box-section faq-box-contain section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-lg-5 g-3">
                <div class="col-lg-6" id="EnglishVersion">
                    <div class="title-header option-title" id="japaneseBtnDiv">
                        <button class="align-items-center btn btn-theme d-flex" id="japaneseBtn" style="background-color: var(--theme-color); color: #fff;">
                            日本語で確認する
                        </button>
                    </div>
                    <br>
                    <div class="faq-accordion">
                        <div class="accordion" id="accordionExampleEnglish">
                            @foreach($lists as $key => $list)
                                @if($loop->first)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingEnglish{{ (count($lists)+1) - ($lists->firstItem() + $key) }}">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseEnglish{{ (count($lists)+1) - ($lists->firstItem() + $key) }}">
                                                {!! $list->que !!}
                                                <i class="fa-solid fa-angle-down"></i>
                                            </button>
                                        </h2>
                                        <div id="collapseEnglish{{ (count($lists)+1) - ($lists->firstItem() + $key) }}"
                                            class="accordion-collapse collapse show"
                                            aria-labelledby="headingEnglish{{ (count($lists)+1) - ($lists->firstItem() + $key) }}" data-bs-parent="#accordionExampleEnglish">
                                            <div class="accordion-body">
                                                <p>{!! $list->ans !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingEnglish{{ (count($lists)+1) - ($lists->firstItem() + $key) }}">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseEnglish{{ (count($lists)+1) - ($lists->firstItem() + $key) }}">
                                                {!! $list->que !!}
                                                <i class="fa-solid fa-angle-down"></i>
                                            </button>
                                        </h2>
                                        <div id="collapseEnglish{{ (count($lists)+1) - ($lists->firstItem() + $key) }}"
                                            class="accordion-collapse collapse"
                                            aria-labelledby="headingEnglish{{ (count($lists)+1) - ($lists->firstItem() + $key) }}" data-bs-parent="#accordionExampleEnglish">
                                            <div class="accordion-body">
                                                <p>{!! $list->ans !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-6" id="JapaneseVersion" style="display:none">
                    <div class="title-header option-title" id="englishBtnDiv">
                        <button class="align-items-center btn btn-theme d-flex" id="englishBtn" style="background-color: var(--theme-color); color: #fff;">
                            Check in English
                        </button>
                    </div>
                    <br>
                    <div class="faq-accordion">
                        <div class="accordion" id="accordionExampleJapanese">
                            @foreach($lists as $key => $list)
                                @if($loop->first)
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingJapanese{{ (count($lists)+1) - ($lists->firstItem() + $key) }}">
                                            <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseJapanese{{ (count($lists)+1) - ($lists->firstItem() + $key) }}">
                                                {!! $list->jpque !!}
                                                <i class="fa-solid fa-angle-down"></i>
                                            </button>
                                        </h2>
                                        <div id="collapseJapanese{{ (count($lists)+1) - ($lists->firstItem() + $key) }}"
                                            class="accordion-collapse collapse show"
                                            aria-labelledby="headingJapanese{{ (count($lists)+1) - ($lists->firstItem() + $key) }}" data-bs-parent="#accordionExampleJapanese">
                                            <div class="accordion-body">
                                                <p>{!! $list->jpans !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                @else
                                    <div class="accordion-item">
                                        <h2 class="accordion-header" id="headingJapanese{{ (count($lists)+1) - ($lists->firstItem() + $key) }}">
                                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                                data-bs-target="#collapseJapanese{{ (count($lists)+1) - ($lists->firstItem() + $key) }}">
                                                {!! $list->jpque !!}
                                                <i class="fa-solid fa-angle-down"></i>
                                            </button>
                                        </h2>
                                        <div id="collapseJapanese{{ (count($lists)+1) - ($lists->firstItem() + $key) }}"
                                            class="accordion-collapse collapse"
                                            aria-labelledby="headingJapanese{{ (count($lists)+1) - ($lists->firstItem() + $key) }}" data-bs-parent="#accordionExampleJapanese">
                                            <div class="accordion-body">
                                                <p>{!! $list->jpans !!}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="title d-xxl-none d-block">
                        <h2>Contact Us</h2>
                    </div>
                    @if ($message = Session::get('success'))
                        <div class="alert alert-success alert-block" id="alert-success">
                            <!-- <button type="button" class="close" data-dismiss="alert">×</button>     -->
                            <strong>{{ $message }}</strong>
                        </div>
                    @endif
                    @php $error = $errors->toArray(); @endphp
                    <div class="right-sidebar-box">
                        <form class="contact-form" method="POST" action="{{ route('contact') }}" id="faq-form">
                            @csrf
                            <input type="hidden" name="from" value="faq">
                            <div class="row">
                                <div class="col-xxl-12 col-lg-12 col-sm-6">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlInput" class="form-label">Name</label>
                                        <div class="custom-input">
                                            <input type="text" class="form-control" id="name" placeholder="Enter Name" name="name" value="{{ old('name') }}">
                                            <i class="fa-solid fa-user"></i>
                                        </div>
                                        <span class="error" style="color:red" id="error-name"></span>
                                    </div>
                                </div>

                                <div class="col-xxl-6 col-lg-12 col-sm-6">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlInput2" class="form-label">Email Address</label>
                                        <div class="custom-input">
                                            <input type="email" class="form-control" id="email" placeholder="Enter Email Address" name="email" value="{{ old('email') }}">
                                            <i class="fa-solid fa-envelope"></i>
                                        </div>
                                        <span class="error" style="color:red" id="error-email"></span>
                                    </div>
                                </div>

                                <div class="col-xxl-6 col-lg-12 col-sm-6">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlInput3" class="form-label">Phone Number</label>
                                        <div class="custom-input">
                                            <input type="tel" class="form-control" id="phone" placeholder="Enter Phone Number" maxlength="10"
                                                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" name="phone" value="{{ old('phone') }}">
                                            <i class="fa-solid fa-mobile-screen-button"></i>
                                        </div>
                                        <span class="error" style="color:red" id="error-phone"></span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlTextarea" class="form-label">Message</label>
                                        <div class="custom-textarea">
                                            <textarea class="form-control" id="message" placeholder="Enter Your Message" rows="6" name="message">{{ old('message') }}</textarea>
                                            <i class="fa-solid fa-message"></i>
                                        </div>
                                        <span class="error" style="color:red" id="error-message"></span>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-animation theme-bg-color ms-auto fw-bold" type="button" onclick="validateFaqForm()">Send Message</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Box Section End -->

    <!-- Map Section Start -->
    <section class="map-section">
        <div class="container-fluid p-0">
            <div class="map-box">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3238.5229059407397!2d139.7105441!3d35.7379503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x601892a013f7dbb3%3A0x5366f1c6bc45f33f!2z44CSMTcxLTAwMTQgVG9reW8sIFRvc2hpbWEgQ2l0eSwgSWtlYnVrdXJvLCA0LWNoxY1tZeKIkjI34oiSNSDlkoznlLDjg5Pjg6s!5e0!3m2!1sen!2sjp!4v1713423525200!5m2!1sen!2sjp"
                    style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
    <!-- Map Section End -->
    <script src="frontend/assets/js/feather/feather.min.js"></script>
    <script src="frontend/assets/js/feather/feather-icon.js"></script>
    <script>
        document.getElementById('japaneseBtn').addEventListener('click', function() {
            document.getElementById('EnglishVersion').style.display = 'none';
            document.getElementById('JapaneseVersion').style.display = 'block';
        });

        document.getElementById('englishBtn').addEventListener('click', function() {
            document.getElementById('JapaneseVersion').style.display = 'none';
            document.getElementById('EnglishVersion').style.display = 'block';
        });
    </script>
    <script>
        function validateFaqForm() {
            let isValid = true;

            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const phone = document.getElementById('phone').value.trim();
            const message = document.getElementById('message').value.trim();

            document.querySelectorAll('.error').forEach(el => el.textContent = '');

            if (!name) {
                isValid = false;
                document.getElementById('error-name').textContent = 'Please provide your name.';
            } else if (name.length > 255) {
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

            if (!phone) {
                isValid = false;
                document.getElementById('error-phone').textContent = 'Please provide your phone number.';
            } else if (!/^\d+$/.test(phone)) {
                isValid = false;
                document.getElementById('error-phone').textContent = 'Please provide a valid phone number.(eg. 09077554361)';
            }

            if (!message) {
                isValid = false;
                document.getElementById('error-message').textContent = 'Please provide your message.';
            }

            if (isValid) {
                document.getElementById('faq-form').submit();
            }
        }

        document.getElementById('faq-form').addEventListener('submit', function(event) {
            event.preventDefault();
            validateFaqForm();
        });
    </script>
</x-guest-layout>
