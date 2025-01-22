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
                                        <h5>Product Information</h5>
                                    </div>

                                    @if (!$product)
                                        <h3>This Product have been deleted !</h3>
                                    @else
                                        <form class="theme-form theme-form-2 mega-form">
                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-5 mb-0">Product Code:</label>
                                                <div class="col-sm-7">
                                                    <p>{{ $product->product_code }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-5 mb-0">Product Name:</label>
                                                <div class="col-sm-7">
                                                    <p>{{ $product->product_name }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-5 mb-0">Shop Name:</label>
                                                <div class="col-sm-7">
                                                    <p>{{ $product->Seller->shop_name }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="col-sm-5 col-form-label form-label-title">Made-in:</label>
                                                <div class="col-sm-7">
                                                    <p>{{ $product->country->name }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="col-sm-5 col-form-label form-label-title">Brand:</label>
                                                <div class="col-sm-7">
                                                    <p>{{ $product->brand->brand_name }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label
                                                    class="col-sm-5 col-form-label form-label-title">Category:</label>
                                                <div class="col-sm-7">
                                                    <p>{{ $product->category->category_name }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label
                                                    class="col-sm-5 col-form-label form-label-title">Subcategory:</label>
                                                <div class="col-sm-7">
                                                    <p>{{ $product->subcategory->sub_category_name }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="col-sm-5 col-form-label form-label-title">Subcategory
                                                    Title:</label>
                                                <div class="col-sm-7">
                                                    <p>{{ $product->subcategorytitle->sub_category_titlename }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-5 mb-0">Product Tags:</label>
                                                <div class="col-sm-7">
                                                    <p>{{ $product->product_tags }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-5 mb-0">Product Size:</label>
                                                <div class="col-sm-7">
                                                    <p>{{ $product->product_size }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-5 mb-0">Product Color:</label>
                                                <div class="col-sm-7">
                                                    <p>{{ $product->product_color }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-5 mb-0">Short Description:</label>
                                                <div class="col-sm-7">
                                                    <p>{{ $product->short_desc }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-5 mb-0">Long Description:</label>
                                                <div class="col-sm-7">
                                                    <p>{!! $product->long_desc !!}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-5 mb-0">Care Instructions:</label>
                                                <div class="col-sm-7">
                                                    <p>{!! $product->care_instructions !!}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="col-sm-5 col-form-label form-label-title">Thumbnail
                                                    Image:</label>
                                                <div class="col-sm-7">
                                                    <img width="80"
                                                        src="{{ asset('images/' . $product->product_thambnail) }}">
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="col-sm-5 col-form-label form-label-title">Multiple
                                                    Images:</label>
                                                <div class="col-sm-7">
                                                    @foreach ($multiImgs as $key => $img)
                                                        <img width="80"
                                                            src="{{ asset('upload/multiImg/' . $img->photo_name) }}">
                                                    @endforeach
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="col-sm-5 form-label-title">Price:</label>
                                                <div class="col-sm-7">
                                                    <p>¥{{ number_format($product->original_price) }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="col-sm-5 form-label-title">Discount:</label>
                                                <div class="col-sm-7">
                                                    <p>{{ $product->discount_percent }}%</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="col-sm-5 form-label-title">Price(tax inc):</label>
                                                <div class="col-sm-7">
                                                    <p>¥{{ number_format($product->selling_price) }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="col-sm-5 form-label-title">Commission:</label>
                                                <div class="col-sm-7">
                                                    <p>{{ $product->commission }}%</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="col-sm-5 form-label-title">Product Quantity:</label>
                                                <div class="col-sm-7">
                                                    <p>{{ $product->product_qty }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="col-sm-5 form-label-title">Delivey Estimate Day:</label>
                                                <div class="col-sm-7">
                                                    <p>{{ $product->estimate_date }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="col-sm-5 form-label-title">Delivey Price(tax inc):</label>
                                                <div class="col-sm-7">
                                                    <p>¥{{ number_format($product->delivery_price) }}</p>
                                                </div>
                                            </div>

                                            <div class="mb-2 row align-items-center">
                                                <label class="col-sm-5 form-label-title">Shipping From:</label>
                                                <div class="col-sm-7">
                                                    <p>{{ $product->shipping_country == 0 ? 'Japan' : 'Abroad' }}</p>
                                                </div>
                                            </div>

                                            <a href='{{ url('/editproduct/' . $product->id) }}'>
                                                <button type="button" class="btn btn-animation">Edit</button>
                                            </a>
                                        </form>
                                    @endif
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
