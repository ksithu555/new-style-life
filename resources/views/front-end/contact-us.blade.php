<x-guest-layout>

    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Contact Us</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Contact Us</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Contact Box Section Start -->
    <section class="contact-box-section">
        <div class="container-fluid-lg">
            <div class="row g-lg-5 g-3">
                <div class="col-lg-6">
                    <div class="left-sidebar-box">
                        <div class="row">
                            <div class="col-xl-12">
                                <div class="contact-image">
                                    <img src="../assets/images/inner-page/contact-us.png" class="img-fluid blur-up lazyloaded" alt="">
                                </div>
                            </div>
                            <div class="col-xl-12">
                                <div class="contact-title">
                                    <h3>Get In Touch</h3>
                                </div>

                                <div class="contact-detail">
                                    <div class="row g-4">
                                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                                            <div class="contact-detail-box">
                                                <div class="contact-icon">
                                                    <i class="fa-solid fa-phone"></i>
                                                </div>
                                                <div class="contact-detail-title">
                                                    <h4>Phone</h4>
                                                </div>

                                                <div class="contact-detail-contain">
                                                    <p>(+81) 03-3981-5090</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                                            <div class="contact-detail-box">
                                                <div class="contact-icon">
                                                    <i class="fa-solid fa-envelope"></i>
                                                </div>
                                                <div class="contact-detail-title">
                                                    <h4>Email</h4>
                                                </div>

                                                <div class="contact-detail-contain">
                                                    <p>support@asian-food.site</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                                            <div class="contact-detail-box">
                                                <div class="contact-icon">
                                                    <i class="fa-solid fa-location-dot"></i>
                                                </div>
                                                <div class="contact-detail-title">
                                                    <h4>Office</h4>
                                                </div>

                                                <div class="contact-detail-contain">
                                                    <p>4-27-5 Ikebukuro, Toshima-ku, Tokyo</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-xxl-6 col-lg-12 col-sm-6">
                                            <div class="contact-detail-box">
                                                <div class="contact-icon">
                                                    <i class="fa-solid fa-building"></i>
                                                </div>
                                                <div class="contact-detail-title">
                                                    <h4>Company</h4>
                                                </div>

                                                <div class="contact-detail-contain">
                                                    <p>Asia Human Development, Inc.</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                        <form class="contact-form" method="POST" action="{{ route('contact') }}" id="contact-form">
                            @csrf
                            <input type="hidden" name="from" value="contact">
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
                                            <input type="tel" class="form-control" id="phone" placeholder="Enter Phone Number" maxlength="10" oninput="javascript: if (this.value.length > this.maxLength) this.value =
                                            this.value.slice(0, this.maxLength);" name="phone" value="{{ old('phone') }}">
                                            <i class="fa-solid fa-mobile-screen-button"></i>
                                        </div>
                                        <span class="error" style="color:red" id="error-phone"></span>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="mb-md-4 mb-3 custom-form">
                                        <label for="exampleFormControlTextarea" class="form-label">Message</label>
                                        <div class="custom-textarea">
                                            <textarea class="form-control" id="message" placeholder="Enter Your Message" rows="6" name="message" value="{{ old('message') }}">{{ old('message') }}</textarea>
                                            <i class="fa-solid fa-message"></i>
                                        </div>
                                        <span class="error" style="color:red" id="error-message"></span>
                                    </div>
                                </div>
                            </div>
                            <button class="btn btn-animation theme-bg-color ms-auto fw-bold" type="button" onclick="validateContactForm()">Send Message</button>
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
                <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3238.5229059407397!2d139.7105441!3d35.7379503!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x601892a013f7dbb3%3A0x5366f1c6bc45f33f!2z44CSMTcxLTAwMTQgVG9reW8sIFRvc2hpbWEgQ2l0eSwgSWtlYnVrdXJvLCA0LWNoxY1tZeKIkjI34oiSNSDlkoznlLDjg5Pjg6s!5e0!3m2!1sen!2sjp!4v1713423525200!5m2!1sen!2sjp" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
            </div>
        </div>
    </section>
    <!-- Map Section End -->
    <script>
        function validateContactForm() {
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
                document.getElementById('error-phone').textContent =
                    'Please provide a valid phone number.(eg. 09077554361)';
            }

            if (!message) {
                isValid = false;
                document.getElementById('error-message').textContent = 'Please provide your message.';
            }

            if (isValid) {
                document.getElementById('contact-form').submit();
            }
        }

        document.getElementById('contact-form').addEventListener('submit', function(event) {
            event.preventDefault();
            validateContactForm();
        });
    </script>

</x-guest-layout>