
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
                                        <h5>Seller Information</h5>
                                    </div>
                                    @if (!$editmode)
                                    @php $action= route('registerconfirm') ; @endphp
                                    @else
                                    @php $action= route('edithost') ; @endphp
                                    @endif
                                    <form class="theme-form theme-form-2 mega-form" id="registeruserform" method="POST" action="{{ $action }}">
                                        @csrf
                                            @include('components.messagebox')

                                            @if ($editmode)
                                            <input type="hidden" name="id" value="{{ $editseller->id }}">
                                            @else
                                            <input type="hidden" name="role" value="hcompany">
                                            @endif

                                            <!-- <input type="hidden" name="freecount" value="{{ $_GET['freecount'] ?? ''}}"> -->

                                             <div class="error-container"></div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Shop Name</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control form-control-email" placeholder="shop name" name="shopname" id="shopname"
                                                        type="text" value="{{ old('shopname') ?? $editseller->shop_name ?? '' }}" >
                                                    <p style="display:none" class="shopname error text-danger"></p>
                                                </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Established Year</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control form-control-email"
                                                    placeholder="Established Year" name="shopyear" id="shopyear"
                                                        type="date" value="{{ old('shopyear') ?? $editseller->shop_establish ?? '' }}" >
                                                    <p style="display:none" class="shopyear error text-danger"></p>
                                                </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-sm-3 col-form-label form-label-title">Shop Logo</label>
                                                <div class="col-sm-9">
                                                    <input type="file" name="shoplogo" id="shoplogo" class="form-control" >
                                                    <img id="preview-image-before-upload" alt="your image"
                                                        @if(!empty($editseller->shop_logo))
                                                            src="{{ asset('images'.( $editseller->shop_logo ?? 'blog/blog-details.jpg')   ) }}"
                                                            style="max-width: 100%;"
                                                        @else
                                                            style="display: none; max-width: 100%;"
                                                        @endif
                                                    />
                                                    <p style="display:none" class="shoplogo error text-danger"></p>
                                                    @if (!empty($error['shoplogo']))
                                                        @foreach ($error['shoplogo'] as  $key => $value)
                                                            <p class="shoplogo error text-danger">{{ $value }}</p>
                                                        @endforeach
                                                    @endif
                                                </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Phone</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control form-control-email" placeholder="Phone" name="phone" id="phone"
                                                        type="text" value="{{ old('phone') ?? $editseller->phone ?? '' }}" >
                                                    <p style="display:none" class="phone error text-danger"></p>
                                                </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Zip Code</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control form-control-email" placeholder="Zip Code" name="zipcode" id="zipcode"
                                                        type="text" value="{{ old('zipcode') ?? $editseller->zip_code ?? '' }}" >
                                                    <p style="display:none" class="zipcode error text-danger"></p>
                                                </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">  Shop Link</label>
                                            <div class="col-sm-9">
                                                <input class="form-control form-control-email" placeholder="Shop Link" name="shoplink" id="shoplink"
                                                    type="text" value="{{ old('shoplink') ?? $editseller->url ?? '' }}" >
                                                <p style="display:none" class="shoplink error text-danger"></p>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Address</label>
                                            <div class="col-sm-9">
                                                <input class="form-control form-control-email" placeholder="Address" name="address" id="address"
                                                    type="text" value="{{ old('address') ?? $editseller->address ?? '' }}" >
                                                <p style="display:none" class="address error text-danger"></p>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Bank Name</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" placeholder="Bank Name" name="bankname" id="bankname"
                                                    type="text" value="{{ old('bankname') ?? $editseller->bank_name ?? '' }}" >
                                                <p style="display:none" class="bankname error text-danger"></p>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Bank Account Type</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" placeholder="Bank Account Type" name="accounttype" id="accounttype"
                                                    type="text" value="{{ old('accounttype') ?? $editseller->bank_acc_type ?? '' }}" >
                                                <p style="display:none" class="accounttype error text-danger"></p>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Branch Name</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" placeholder="Branch Name" name="branchname" id="branchname"
                                                    type="text" value="{{ old('branchname') ?? $editseller->bank_branch ?? '' }}" >
                                                <p style="display:none" class="branchname error text-danger"></p>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Bank Account Name</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" placeholder="Bank Account Name" name="bankaccountname" id="bankaccountname"
                                                    type="text" value="{{ old('bankaccountname') ?? $editseller->bank_acc_name ?? '' }}" >
                                                <p style="display:none" class="bankaccountname error text-danger"></p>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Bank Account Number</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" placeholder="Bank Account Number" name="bankaccountnumber" id="bankaccountnumber"
                                                    type="number" value="{{ old('bankaccountnumber') ?? $editseller->bank_acc_no ?? '' }}" >
                                                <p style="display:none" class="bankaccountnumber error text-danger"></p>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Name</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control form-control-email" placeholder="name" name="name" id="name"
                                                        type="text" value="{{ old('name') ?? $editseller->name ?? '' }}" >
                                                    <p style="display:none" class="name error text-danger"></p>
                                                </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Email</label>
                                            <div class="col-sm-9">
                                                <input class="form-control form-control-email" placeholder="{{ __('auth.mailaddress') }}" name="email" id="email"
                                                    type="email" value="{{ old('email') ?? $editseller->email ?? '' }}" >
                                                <p style="display:none" class="email error text-danger"></p>
                                            </div>
                                        </div>



                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Password</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control form-control-password" placeholder="{{ __('auth.password') }}" id="password"
                                                        type="password"  autocomplete="new-password" value="{{ $editseller->password ?? '' }}">
                                                    <p style="display:none" class="password error text-danger"></p>
                                                </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Confirm Password</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control form-control-password" placeholder="{{ __('auth.confirmpassword') }}" id="password_confirmation"
                                                        type="password" value="{{ $editseller->password ?? '' }}">
                                                    <p style="display:none" class="password_confirmation  error text-danger"></p>
                                                </div>
                                        </div>

                                        <div class="text-center">
                                            <button class="btn btn-submit btn-animation ms-auto fw-bold" type="submit">
                                                @if (!$editmode)
                                                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                                                        登録する
                                                @else
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                        情報を修正する
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
                                                                <p>This data will be saved.</p>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">

                                                            <button type="submit" class="btn btn-animation btn-md fw-bold me-2">
                                                                @if (!$editmode)
                                                                    登録する
                                                                @else
                                                                    修正する
                                                                @endif
                                                            </button>
                                                            <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal"
                                                            style="background-color: #ff6b6b;border-color: #ff6b6b;">キャンセル</button>
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
        <!-- New Product Add End -->
    </div>

    <script type="text/javascript">

        $(document).ready(function() {

            $('#shoplogo').change(function(){
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