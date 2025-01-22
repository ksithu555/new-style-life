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
                                            <h5>Coupon Detail</h5>
                                        </div>

                                        <form class="theme-form theme-form-2 mega-form">
                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Coupon Name</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $coupon->name }}</p>
                                                </div>
                                            </div>


                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Coupon Code</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $coupon->coupon_code }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Discount Amount</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $coupon->discount_amount }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Minimum Amount</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $coupon->mini_amount }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Valid Count</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $coupon->valid_count }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Start Date</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $coupon->startdate}}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">End Date</label>
                                                <div class="col-sm-9">
                                                    <p>{{$coupon->enddate }}</p>
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
