<x-auth-layout>
    <style>
        .error{
            margin:0 auto;
            display:flex;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

        @php $error = $errors->toArray(); if(!isset($editmode)){$editmode = false;} if(!isset($editother)){$editother = false;} @endphp

            <div class="page-body">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-sm-8 m-auto">
                                    <div class="card">
                                        <div class="card-body">
                                            <div class="card-header-2">

                                                @php
                                                  if($editmode) {
                                                    if (!$editother) {
                                                      $subtitle="Edit Admin Information";
                                                    }
                                                  } else {
                                                    $subtitle="Register SubAdmin";
                                                  }
                                                @endphp

                                                @include('components.subtitle')

                                            </div>
                                                @if (!$editmode)
                                                    @php $action= route('registersubadmin'); @endphp
                                                @else
                                                    @php $action= route('edituser') ; @endphp
                                                @endif

                                                <form id="registeradminform" lass="theme-form theme-form-2 mega-form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                                                    @csrf

                                                    @include('components.messagebox')

                                                    <!-- Validation Errors -->

                                                    @php $error = $errors->toArray(); @endphp
                                                    @if(!empty($error))
                                                        {{ json_decode($error) }}
                                                    @endif

                                                    @if ($editmode)
                                                        <input type="hidden" name="id" value="{{ $edituser['id'] }}">
                                                    @endif

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
                                                        <label class="col-sm-3 col-form-label form-label-title">Select Image</label>
                                                            <div class="col-sm-9">
                                                                <input type="file" name="image" id="image" class="form-control" >
                                                                <img id="preview-image-before-upload" alt="your image"
                                                                    @if(!empty($edituser['user_photo']))
                                                                        src="{{ asset('images/'.( $edituser['user_photo'] ?? 'blog/blog-details.jpg')   ) }}"
                                                                        style="max-width: 100%;"
                                                                    @else
                                                                        style="display: none; max-width: 100%;"
                                                                    @endif
                                                                />
                                                                <p style="display:none" class="image error text-danger"></p>
                                                                @if (!empty($error['image']))
                                                                    @foreach ($error['image'] as  $key => $value)
                                                                        <p class="image error text-danger">{{ $value }}</p>
                                                                    @endforeach
                                                                @endif
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
                                                                <input class="form-control form-control-password" placeholder="{{ __('auth.password') }}" id="password" name="password"
                                                                    type="password"  autocomplete="new-password" value="{{ $edituser['password'] ?? '' }}">
                                                                <p style="display:none" class="password error text-danger"></p>
                                                            </div>
                                                    </div>

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-3 mb-0">Confirm Password</label>
                                                            <div class="col-sm-9">
                                                                <input class="form-control form-control-password" placeholder="{{ __('auth.confirmpassword') }}" id="password_confirmation"
                                                                    name="password_confirmation"
                                                                    type="password" value="{{ $edituser['password'] ?? '' }}">
                                                                <p style="display:none" class="password_confirmation  error text-danger"></p>
                                                            </div>
                                                    </div>

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-3 mb-0">Phone</label>
                                                            <div class="col-sm-9">
                                                                <input class="form-control form-control-email" placeholder="Phone" name="phone" id="phone"
                                                                    type="number" value="{{ old('phone') ?? $edituser['phone'] ?? '' }}" >
                                                                <p style="display:none" class="phone error text-danger"></p>
                                                            </div>
                                                    </div>

                                                    <div class="mb-4 row align-items-center">
                                                        <label class="form-label-title col-sm-3 mb-0">Address</label>
                                                            <div class="col-sm-9">
                                                                <input class="form-control form-control-email" placeholder="Address" name="address" id="address"
                                                                    type="text" value="{{ old('address') ?? $edituser['address'] ?? '' }}" >
                                                                <p style="display:none" class="address error text-danger"></p>
                                                            </div>
                                                    </div>

                                                    <div class="text-center">
                                                        <button class="btn btn-submit btn-animation ms-auto fw-bold" type="submit">
                                                            @if (!$editmode)
                                                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                                                                    Register
                                                            @else
                                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                                                   Edit
                                                            @endif
                                                        </button>
                                                    </div>

                                                    <div class="modal fade theme-modal remove-coupon" id="confirmModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
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
                                                                        <p>This changes will be updated.</p>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">

                                                                    <button type="submit" class="btn btn-animation btn-md fw-bold me-2">
                                                                        @if (!$editmode)
                                                                            Register
                                                                        @else
                                                                           Yes
                                                                        @endif
                                                                    </button>
                                                                    <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal"
                                                                    style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <script type="text/javascript">

                $(document).ready(function() {

                    $('#image').change(function(){
                        let reader = new FileReader();
                            reader.onload = (e) => {
                                $('#preview-image-before-upload').attr('src', e.target.result);
                                $('#preview-image-before-upload').show();
                            }
                            reader.readAsDataURL(this.files[0]);
                    });

                    var pwdchnge = false;
                        $("#password,#password_confirmation").on("input", function(){
                            pwdchnge = true;
                        });

                        $("#registeradminform").submit(function() {
                        // alert(pwdchnge);
                            if (!pwdchnge) {
                            // alert('remove');
                                $('#password').remove();
                                $('#password_confirmation').remove();
                            }
                        });

                        $(".btn-submit").click(function(e){

                            e.preventDefault();
                                var _token = $("input[name='_token']").val();
                                let formData = new FormData(registeradminform);

                                $.ajax({
                                    url: "{{ $action }}",
                                    type:'POST',
                                    data: formData,
                                    contentType: false,
                                    processData: false,

                                    success: function(data) {
                                        if($.isEmptyObject(data.error)){
                                        // alert("success");
                                            console.log(data.success);
                                            $('.error').hide()
                                            $('#confirmModal').modal('show');
                                        }else{
                                            // alert("err");
                                            console.log(data.error);
                                            $('.error').hide()
                                            $.each( data.error, function( key, value ) {
                                                if (key == 'password') {
                                                    $.each( value, function( k, val ) {
                                                        if (val == 'パスワードが一致しません') {
                                                            $('.error.password_confirmation').text(val)
                                                            $('.error.password_confirmation').show()
                                                            // alert('unset')
                                                        } else {
                                                            $('.error.'+key).text(val)
                                                            $('.error.'+key).show()
                                                        }
                                                    });
                                                } else {

                                                    $('.error.'+key).text(value[0])
                                                    $('.error.'+key).show()
                                                }
                                            });
                                        }
                                    },
                                    fail: function(data) {
                                        alert("エラー：ajax error");
                                    }
                                });

                            });

                        });


            </script>

</x-auth-layout>