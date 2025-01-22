<x-auth-layout>
    <div class="page-body">
        <!-- Product Detail Start -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-8 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header-2">
                                        <h5>Shop Information</h5>
                                    </div>

                                    <form class="theme-form theme-form-2 mega-form">
                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-5 mb-0">Shop Name</label>
                                            <div class="col-sm-7">
                                                <p>{{ $shop->shop_name }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="col-sm-5 col-form-label form-label-title">Shop Logo
                                            </label>
                                            <div class="col-sm-7">
                                                <img width="100" src="{{ asset('images/' . $shop->shop_logo) }}">
                                            </div>
                                        </div>
                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-5 mb-0">Shop Establish</label>
                                            <div class="col-sm-7">
                                                <p>{{ $shop->shop_establish }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-5 mb-0">Phone</label>
                                            <div class="col-sm-7">
                                                <p>{{ $shop->phone }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-5 mb-0">Country</label>
                                            <div class="col-sm-7">
                                                <p>{{ $shop->country->name }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-5 mb-0">Zip Code</label>
                                            <div class="col-sm-7">
                                                <p>{{ $shop->zip_code }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-5 mb-0">City</label>
                                            <div class="col-sm-7">
                                                <p>{{ $shop->city }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-5 mb-0">Chome</label>
                                            <div class="col-sm-7">
                                                <p>{{ $shop->chome }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-5 mb-0">Building</label>
                                            <div class="col-sm-7">
                                                <p>{{ $shop->building }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-5 mb-0">Room</label>
                                            <div class="col-sm-7">
                                                <p>{{ $shop->room }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-5 mb-0">Coupon Code</label>
                                            <div class="col-sm-7">
                                                <p>{{ $coupon_code ? $coupon_code : '-' }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-5 mb-0">Commission</label>
                                            <div class="col-sm-7">
                                                <p>{{ $shop->commission }}%</p>
                                            </div>
                                        </div>
                                    </form>

                                    <div class="card-header-2" style="margin-top: 15px;">
                                        <h5>Bank Information</h5>
                                    </div>

                                    <form class="theme-form theme-form-2 mega-form">
                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-5 mb-0">Bank Name</label>
                                            <div class="col-sm-7">
                                                <p>{{ $shop->bank_name }}%</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-5 mb-0">Bank Branch</label>
                                            <div class="col-sm-7">
                                                <p>{{ $shop->bank_branch }}%</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-5 mb-0">Bank Account Type</label>
                                            <div class="col-sm-7">
                                                <p>{{ $shop->bank_acc_type }}%</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-5 mb-0">Bank Account Name</label>
                                            <div class="col-sm-7">
                                                <p>{{ $shop->bank_acc_name }}%</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-5 mb-0">Bank Account Number</label>
                                            <div class="col-sm-7">
                                                <p>{{ $shop->bank_acc_no }}%</p>
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
        <!-- Product Detail End -->
    </div>
</x-auth-layout>
