@extends('seller.seller_dashboard')
@section('seller')
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
                                        <h5>Product Information</h5>
                                    </div>

                                    <form class="theme-form theme-form-2 mega-form">
                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Product Code</label>
                                            <div class="col-sm-9">
                                                <p>CN-1230</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Product Name</label>
                                            <div class="col-sm-9">
                                                <p>Orange</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label
                                                class="col-sm-3 col-form-label form-label-title">Brand</label>
                                            <div class="col-sm-9">
                                                <p>Grocery</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label
                                                class="col-sm-3 col-form-label form-label-title">Category</label>
                                            <div class="col-sm-9">
                                                <p>Fruit</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label
                                                class="col-sm-3 col-form-label form-label-title">Subcategory</label>
                                            <div class="col-sm-9">
                                                <p>-</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Product Tags</label>
                                            <div class="col-sm-9">
                                                <p>Tags</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Product Size</label>
                                            <div class="col-sm-9">
                                                <p>30g</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Product Color</label>
                                            <div class="col-sm-9">
                                                <p>-</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Short Description</label>
                                            <div class="col-sm-9">
                                                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. </p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Long Description</label>
                                            <div class="col-sm-9">
                                                <p>Doloribus tenetur, fugit maxime soluta aperiam obcaecati velit blanditiis magnam earum eum incidunt, quis amet deserunt at laborum modi quisquam quidem rerum?</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label
                                                class="col-sm-3 col-form-label form-label-title">Thumbnail
                                                Image</label>
                                            <div class="col-sm-9">
                                                <p>Image</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="col-sm-3 col-form-label form-label-title">Multiple Images</label>
                                            <div class="col-sm-9">
                                                <p>Images</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="col-sm-3 form-label-title">Price</label>
                                            <div class="col-sm-9">
                                                <p>120</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="col-sm-3 form-label-title">Discount Price</label>
                                            <div class="col-sm-9">
                                                <p>100</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="col-sm-3 form-label-title">Product Quantity</label>
                                            <div class="col-sm-9">
                                                <p>30</p>
                                            </div>
                                        </div>

                                        <button type="submit" class="btn btn-animation ms-auto fw-bold">Edit</button>
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
@endsection
