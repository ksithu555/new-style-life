
<x-auth-layout>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    @php $error = $errors->toArray(); if(!isset($editmode)){$editmode = false;} if(!isset($editother)){$editother = false;} @endphp

    <div class="page-body">
    <!-- New Product Add Start -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-8 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header-2">
                                        <h5>Buyer Information</h5>
                                    </div>
                                    @if (!$editmode)
                                    @php $action= route('registerconfirm') ; @endphp
                                    @else
                                    @php $action= route('edituser') ; @endphp
                                    @endif
                                    <form class="theme-form theme-form-2 mega-form" id="registeruserform" method="POST" action="{{ $action }}">
                                        @csrf
                                        @if ($message = Session::get('success'))
                                        <div class="alert alert-success alert-block" id="alert-success">
                                            <button type="button" class="close" data-dismiss="alert">×</button>
                                            <strong>{{ $message }}</strong>
                                        </div>
                                        @endif

                                            @if ($editmode)
                                            <input type="hidden" name="id" value="{{ $edituser['id'] }}">
                                            @else
                                            <input type="hidden" name="role" value="hcompany">
                                            @endif

                                            <!-- <input type="hidden" name="freecount" value="{{ $_GET['freecount'] ?? ''}}"> -->

                                             <div class="error-container"></div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Name</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control form-control-email" placeholder="name" name="name" id="name"
                                                        type="text" value="{{ old('name') ?? $edituser['name'] ?? '' }}" >
                                                    <p style="display:none" class="name error text-danger"></p>
                                                </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Name</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control form-control-email" placeholder="name" name="name" id="name"
                                                        type="text" value="{{ old('name') ?? $edituser['name'] ?? '' }}" >
                                                    <p style="display:none" class="name error text-danger"></p>
                                                </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Email</label>
                                            <div class="col-sm-9">
                                                <input class="form-control form-control-email" placeholder="{{ __('auth.mailaddress') }}" name="email" id="email"
                                                    type="email" value="{{ old('email') ?? $edituser['email'] ?? '' }}" >
                                                <p style="display:none" class="email error text-danger"></p>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Password</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control form-control-password" placeholder="{{ __('auth.password') }}" id="password"
                                                        type="password"  autocomplete="new-password" value="{{ $edituser['password'] ?? '' }}">
                                                    <p style="display:none" class="password error text-danger"></p>
                                                </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Confirm Password</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control form-control-password" placeholder="{{ __('auth.confirmpassword') }}" id="password_confirmation"
                                                        type="password" value="{{ $edituser['password'] ?? '' }}">
                                                    <p style="display:none" class="password_confirmation  error text-danger"></p>
                                                </div>
                                        </div>

                                        <button type="submit" class="btn btn-animation ms-auto fw-bold"> <i class="fa fa-edit" aria-hidden="true"></i>
                                            {{ __('auth.dochange') }}</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- New Product Add End -->
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#ckeditor'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        function mainThamUrl(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#mainThmb').attr('src', e.target.result).width(70).height(70);
                };
                reader.readAsDataURL(input.files[0]); // Corrected method name
            }
        }
    </script>
    <script>
        document.getElementById('multiImg').addEventListener('change', function(event) {
            const preview = document.getElementById('preview_img');
            preview.innerHTML = '';

            Array.from(event.target.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '100px';
                    img.style.maxHeight = '100px';
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>

    </x-auth-layout>




