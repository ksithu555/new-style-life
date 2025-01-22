<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@php $error = $errors->toArray();  @endphp

@extends('seller.seller_dashboard')
@section('seller')
<div class="page-body">
<!-- New Subseller Add Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-8 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Subseller Information</h5>
                                </div>

                                <form method="POST" action="{{ route('store.subseller') }}" class="theme-form theme-form-2 mega-form" >
                                    @csrf
                                    <input type="hidden" name="seller_id" value="{{ Auth::user()->id }}">
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Name</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="user_name" value="{{ old('user_name') }}" id="user_name">
                                            <p style="display:none" class="user_name error text-danger"></p>
                                            @if (!empty($error['user_name']))
                                                @foreach ($error['user_name'] as  $key => $value)
                                                    <p class="user_name error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Email</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="email" name="mail" value="{{ old('mail') }}" id="mail">
                                            <p style="display:none" class="mail error text-danger"></p>
                                            @if (!empty($error['mail']))
                                                @foreach ($error['mail'] as  $key => $value)
                                                    <p class="mail error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="passwords" class="form-control" value="{{ old('passwords') }}" id="passwords">
                                            <p style="display:none" class="passwords error text-danger"></p>
                                            @if (!empty($error['passwords']))
                                                @foreach ($error['passwords'] as  $key => $value)
                                                    <p class="passwords error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Confirm Password</label>
                                        <div class="col-sm-10">
                                            <input type="password" name="confirmed" class="form-control" value="{{ old('confirmed') }}" id="confirmed">
                                            <p style="display:none" class="confirmed error text-danger"></p>
                                            @if (!empty($error['confirmed']))
                                                @foreach ($error['confirmed'] as $key => $value)
                                                    <p class="confirmed error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-2 mb-0">Phone
                                            Number</label>
                                        <div class="col-sm-10">
                                            <input class="form-control" type="text" name="phone" value="{{ old('phone') }}" pattern="\d*">
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-animation btn-submit" data-toggle="modal" data-target="#confirmModal">Save</button>

                                    <!-- Confirm Modal Box -->
                                    <div class="modal fade theme-modal remove-coupon" id="confirmModal" aria-hidden="true" tabindex="-1">
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
                                                        <p>The data will be added permanently.</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-animation" >Yes</button>
                                                    <button type="button" class="btn btn-animation btn-secondary" data-bs-dismiss="modal"
                                                    style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Confirm Modal Box End-->
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New Subseller Add End -->
</div>


<script>
    $('.btn-submit').click(function() {
        $('.error').hide();

        let userName = $.trim($("#user_name").val());
        let email = $.trim($("#mail").val());
        let password = $.trim($("#passwords").val());
        let confirmedPassword = $.trim($("#confirmed").val());

        let isValid = true;

        if (userName === "") {
            $('.error.user_name').text('Name must be present');
            $('.error.user_name').show();
            isValid = false;
        }

        if (email === "") {
            $('.error.mail').text('Email must be present');
            $('.error.mail').show();
            isValid = false;
        } else if (!/\S+@\S+\.\S+/.test(email)) {
            $('.error.mail').text('Please provide a valid email address.');
            $('.error.mail').show();
            isValid = false;
        }

        if (password === "") {
            $('.error.passwords').text('Password must be present');
            $('.error.passwords').show();
            isValid = false;
        } else if (password.length < 8) {
            $('.error.passwords').text('Your password must be at least 8 characters long.');
            $('.error.passwords').show();
            isValid = false;
        }

        if (confirmedPassword === "") {
            $('.error.confirmed').text('Confirmed password must be present');
            $('.error.confirmed').show();
            isValid = false;
        } else if (password !== confirmedPassword) {
            $('.error.confirmed').text('Password do not match');
            $('.error.confirmed').show();
            isValid = false;
        }

        if (isValid) {
            $('#confirmModal').modal('show');
        }

        return false;
    });
</script>

@endsection