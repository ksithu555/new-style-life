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
    
                                        <form class="theme-form theme-form-2 mega-form">
                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Product Code:</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $data->product_code }}</p>
                                                </div>
                                            </div>
    
                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Product Name:</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $data->product_name }}</p>
                                                </div>
                                            </div>
    
                                            <div class="mb-2 row align-items-center">
                                                <label
                                                    class="col-sm-3 col-form-label form-label-title">Made-in:</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $data->country->name }}</p>
                                                </div>
                                            </div>
    
                                            <div class="mb-2 row align-items-center">
                                                <label
                                                    class="col-sm-3 col-form-label form-label-title">Brand:</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $data->brand->brand_name }}</p>
                                                </div>
                                            </div>
    
                                            <div class="mb-2 row align-items-center">
                                                <label
                                                    class="col-sm-3 col-form-label form-label-title">Category:</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $data->category->category_name }}</p>
                                                </div>
                                            </div>
    
                                            <div class="mb-2 row align-items-center">
                                                <label
                                                    class="col-sm-3 col-form-label form-label-title">Subcategory:</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $data->subcategory->sub_category_name }}</p>
                                                </div>
                                            </div>
    
                                            <div class="mb-2 row align-items-center">
                                                <label
                                                    class="col-sm-3 col-form-label form-label-title">Subcategory Title:</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $data->subcategorytitle->sub_category_titlename }}</p>
                                                </div>
                                            </div>
    
                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Product Tags:</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $data->product_tags }}</p>
                                                </div>
                                            </div>
    
                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Product Size:</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $data->product_size }}</p>
                                                </div>
                                            </div>
    
                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Product Color:</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $data->product_color }}</p>
                                                </div>
                                            </div>
    
                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Short Description:</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $data->short_desc }}</p>
                                                </div>
                                            </div>
    
                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Long Description:</label>
                                                <div class="col-sm-9">
                                                    <p>{!! $data->long_desc !!}</p>
                                                </div>
                                            </div>
    
                                            <div class="mb-2 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Care Instructions:</label>
                                                <div class="col-sm-9">
                                                    <p>{!! $data->care_instructions !!}</p>
                                                </div>
                                            </div>
    
                                            <div class="mb-2 row align-items-center">
                                                <label
                                                    class="col-sm-3 col-form-label form-label-title">Thumbnail
                                                    Image:</label>
                                                <div class="col-sm-9">
                                                    <img width="80" src="{{ asset('images/'.$data-> product_thambnail) }}">
                                                </div>
                                            </div>
    
                                            <div class="mb-2 row align-items-center">
                                                <label class="col-sm-3 col-form-label form-label-title">Multiple Images:</label>
                                                <div class="col-sm-9">
                                                    @foreach ($multiImgs as $key => $img)
                                                        <img width="80" src="{{ asset('upload/multiImg/'.$img->photo_name) }}">
                                                    @endforeach
                                                </div>
                                            </div>
    
                                            <div class="mb-2 row align-items-center">
                                                <label class="col-sm-3 form-label-title">Price:</label>
                                                <div class="col-sm-9">
                                                    <p>¥{{number_format($data->original_price) }}</p>
                                                </div>
                                            </div>
    
                                            <div class="mb-2 row align-items-center">
                                                <label class="col-sm-3 form-label-title">Discount:</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $data->discount_percent }}%</p>
                                                </div>
                                            </div>
    
                                            <div class="mb-2 row align-items-center">
                                                <label class="col-sm-3 form-label-title">Price(tax inc):</label>
                                                <div class="col-sm-9">
                                                    <p>¥{{number_format($data->selling_price) }}</p>
                                                </div>
                                            </div>
    
                                            <div class="mb-2 row align-items-center">
                                                <label class="col-sm-3 form-label-title">Commission:</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $data->commission }}%</p>
                                                </div>
                                            </div>
    
                                            <div class="mb-2 row align-items-center">
                                                <label class="col-sm-3 form-label-title">Product Quantity:</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $data->product_qty }}</p>
                                                </div>
                                            </div>
                                            <div class="mb-2 row align-items-center">
                                                <label class="col-sm-3 form-label-title">Delivey Estimate Day:</label>
                                                <div class="col-sm-9">
                                                    <p>{{ $data->estimate_date }}</p>
                                                </div>
                                            </div>
                                            <div class="mb-2 row align-items-center">
                                                <label class="col-sm-3 form-label-title">Delivey Price(tax inc):</label>
                                                <div class="col-sm-9">
                                                    <p>¥{{number_format($data->delivery_price) }}</p>
                                                </div>
                                            </div>
                                            <a href="{{ route('editproduct',$data->id) }}">
                                                <button type="button" class="btn btn-animation">Edit</button>
                                            </a>
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
    