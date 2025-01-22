@php $error = $errors->toArray(); @endphp
@extends('seller.seller_dashboard')
@section('seller')
<style>
    .btn-group {
        display: flex;
        border
    }

    .btn-group input[type="submit"],
    .btn-group a {
        flex: 1;
        border-radius: 0%;
    }

    .btn-group input,
    .btn-group button {
        border-radius: 0%;
    }
</style>
<div class="page-body">
    <!-- New Product Add Start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    @include('components.messagebox')
                    <div class="col-sm-8 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Product Information</h5>
                                </div>

                                <form method="POST" class="theme-form theme-form-2 mega-form" action="{{ route('update.product') }}" enctype="multipart/form-data" id="tagsForm">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $products->id }}">
                                    <input type="hidden" name="old_img" value="{{ $products->product_thambnail }}">
                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Brand</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <select class="custom-select" name="brand_id">
                                                    <option>Choose brand</option>
                                                    @foreach ($brands as $brand)
                                                    <option value="{{ $brand->id }}" {{ $brand->id == $products->brand_id ? 'selected' : '' }}>
                                                        {{ $brand->brand_name }}
                                                    </option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addBrandModal">
                                                    <i data-feather="plus-square"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="product_name" type="text" value="{{ $products->product_name }}">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Made-in</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" name="country_id">
                                                <option>Choose country</option>
                                                @foreach ($countries as $country)
                                                <option value="{{ $country->id }}" {{ $country->id == $products->country_id ? 'selected' : '' }}>
                                                    {{ $country->name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Category</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" name="category_id">
                                                <option>Choose Category</option>
                                                @foreach ($categories as $category)
                                                <option value="{{ $category->id }}" {{ $category->id == $products->category_id ? 'selected' : '' }}>
                                                    {{ $category->category_name }}
                                                </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">SubCategory
                                            Title</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100 get_sub" name="sub_category_title_id" id="subcategory">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">SubCategory</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" name="sub_category_id" id="subname">

                                            </select>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Tags</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="product_tags" class="form-control" data-role="tagsinput" id="product_tags" value="{{ $products->product_tags }}" value="{{ old('product_tags') }}">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Size</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="product_size" data-role="tagsinput" value="{{ $products->product_size }}" value="{{ old('product_size') }}">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Color</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="product_color" data-role="tagsinput" value="{{ $products->product_color }}" value="{{ old('product_color') }}">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Short Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="short_desc">{{ $products->short_desc }}</textarea>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Long Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="long_desc" id="ckeditor">{!! $products->long_desc !!}</textarea>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Care Instructions</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="care_instructions" id="ckeditor1">{!! $products->care_instructions !!}</textarea>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Thambnail Image</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" name="product_thambnail">
                                            <img id="prev_thambnail" src="{{ asset('images/' . $products->product_thambnail) }}" width="80">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Original Price(tax inc)</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="original_price" id="original_price" type="number" min="1" value="{{ $products->original_price }}" pattern="\d*">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Discount Percentage</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" name="discount_percent" id="discount_percent" type="number" min="0" max="100" value="{{ $products->discount_percent }}" pattern="\d*">
                                        </div>
                                        <div class="col-sm-3">
                                            <input class="form-control" name="selling_price" id="selling_price" type="number" value="" disabled>
                                            <input type="hidden" name="calculated_selling_price" id="calculated_selling_price" value="{{ $products->calculated_selling_price }}" pattern="\d*">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Product Quantity</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="product_qty" type="number" min="1" value="{{ $products->product_qty }}" pattern="\d*">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Estimated Date</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="estimate_date" type="number" min="1" value="{{ $products->estimate_date }}" pattern="\d*">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Delivery Price(tax inc)</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="delivery_price" type="number" value="{{ $products->delivery_price }}" pattern="\d*">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Shipping Country</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex align-items-center">
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="shipping_country" id="japan" value="0" {{ $products->shipping_country == '0' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="japan">Japan</label>
                                                </div>
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="shipping_country" id="abroad" value="1" {{ $products->shipping_country == '1' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="abroad">Abroad</label>
                                                </div>
                                            </div>
                                            <p class="error" style="color:red; margin-top: 0.1rem;" id="error-shipping_country"></p>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-animation" data-bs-toggle="modal" data-bs-target="#confirmModal">Update</button>

                                    <!-- Confirm Modal Box -->
                                    <div class="modal fade theme-modal remove-coupon" id="confirmModal" aria-hidden="true" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header d-block text-center">
                                                    <h5 class="modal-title w-100" id="exampleModalLabel22">Are You
                                                        Sure?</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                        <i class="fas fa-times"></i>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="remove-box">
                                                        <p>The data will be updated permanently.</p>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-animation">Yes</button>
                                                    <button type="button" class="btn btn-animation btn-secondary" data-bs-dismiss="modal" style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Confirm Modal Box End-->
                                </form>
                            </div>
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <div class="title-header option-title d-sm-flex d-block">
                                    <h5>Multiple Image</h5>
                                    <div class="right-options">
                                        <ul>
                                            @if (count($multiImgs) < 5) <li>
                                                <a data-bs-toggle="modal" data-bs-target="#addImage" href="javascript:void(0)">
                                                    <button class="align-items-center btn btn-theme d-flex">
                                                        <i data-feather="plus-square"></i>Add New
                                                    </button>
                                                </a>
                                                </li>
                                                @endif
                                        </ul>
                                    </div>
                                </div>
                                <table class="table variation-table table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">Image</th>
                                            <th scope="col">Change Image</th>
                                            <th scope="col"></th>
                                        </tr>
                                    </thead>
                                    <tbody id="imageTableBody">
                                        <form class="theme-form theme-form-2 mega-form" method="POST" action="{{ route('update.multiImg') }}" enctype="multipart/form-data" id="imageForm">
                                            @csrf
                                            @foreach ($multiImgs as $key => $img)
                                            <tr>
                                                <th>{{ $key + 1 }}</th>
                                                <td><img src="{{ asset('upload/multiImg/' . $img->photo_name) }}" width="80"></td>
                                                <td>
                                                    <input type="file" class="form-control" name="multi_img[{{ $img->id }}]" onchange="checkFile(this)">
                                                    @error('multi_img.' . $img->id)
                                                    <p class="multi_img error text-danger">{{ $message }}</p>
                                                    @enderror
                                                </td>
                                                <td>
                                                    <div class="btn-group">
                                                        <button type="button" class="btn btn-primary px-4" data-bs-toggle="modal" data-bs-target="#confirmBox_{{ $img->id }}" disabled>Update</button>
                                                        <button type="button" class="btn btn-secondary px-4 ms-2" data-bs-toggle="modal" data-bs-target="#deleteModal_{{ $img->id }}">Delete</button>
                                                    </div>
                                                </td>
                                            </tr>

                                            <!-- Confirm Modal Box -->
                                            <div class="modal fade theme-modal remove-coupon" id="confirmBox_{{ $img->id }}" aria-hidden="true" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header d-block text-center">
                                                            <h5 class="modal-title w-100" id="exampleModalLabel22">Are
                                                                You Sure?</h5>
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
                                                            <button type="submit" class="btn btn-animation">Yes</button>
                                                            <button type="button" class="btn btn-animation btn-secondary" data-bs-dismiss="modal" style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Confirm Modal Box End-->
                                            @endforeach
                                        </form>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New Product Add End -->

    <!-- Add Brand Modal Box -->
    <div class="modal fade theme-modal remove-coupon" id="addBrandModal" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-block text-center">
                    <h5 class="modal-title w-100" id="exampleModalLabel22">Add new brand</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3 row align-items-center">
                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Name:</label>
                            <div class="col-md-9 col-lg-10">
                                <input class="form-control" id="brand_name" type="text" name="brand_name">
                                <p class="error" style="color:red" id="error-brand_name"></p>
                            </div>
                        </div>
                        <div class="mb-3 row align-items-center">
                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Icon:</label>
                            <div class="col-md-9 col-lg-10">
                                <input class="form-control" id="brand_icon" type="file" name="brand_icon" onchange="showBrand(this)">
                                <img src="" id="showIcon">
                                <p class="error" style="color:red" id="error-brand_icon"></p>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-animation btn-brand">Yes</button>
                            <button type="button" class="btn btn-animation btn-secondary" data-bs-dismiss="modal" style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Add Brand Modal Box End-->

    <!-- Modal Start -->
    <div class="modal fade theme-modal remove-coupon" id="addImage" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title w-100" id="exampleModalLabel22">Add Image</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <form method="POST" action="{{ route('update.multiImg') }}" enctype="multipart/form-data" id="new-img-form">
                    @csrf
                    <input type="hidden" name="product_id" value="{{ $products->id }}">
                    <div class="modal-body">
                        <div class="remove-box">
                            <input type="file" class="form-control" id="new_img" name="new_img" onchange="mainThamUrl(this)">
                            <img src="" id="mainThmb">
                            <span style="color:red" id="error-new_img"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-animation" onclick="validateForm()">Yes</button>
                        <button type="button" class="btn btn-animation btn-secondary" data-bs-dismiss="modal">No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- Modal End -->

    <!-- Delete Modal Box Start -->
    @foreach ($multiImgs as $key => $img)
    <div class="modal fade theme-modal remove-coupon" id="deleteModal_{{ $img->id }}" aria-hidden="true" tabindex="-1">
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
                        <p>The data will be deleted permanently.</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('delete.multiImg') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $img->id }}">
                        <button type="submit" class="btn btn-animation">Yes</button>
                    </form>
                    <button type="button" class="btn btn-animation btn-secondary" data-bs-dismiss="modal" style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- Delete Modal Box End -->

</div>

<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
    function validateForm() {
        let isValid = true;
        const new_img = document.getElementById('new_img').value.trim(); // Access the file input value
        document.querySelectorAll('#new-img-form .error').forEach(el => el.textContent = '');
        if (!new_img) { // Check if the file input is empty
            isValid = false;
            document.getElementById('error-new_img').textContent = 'Please add an image.';
        }
        if (isValid) {
            document.getElementById('new-img-form').submit();
        } else {
            // Prevent form submission
            event.preventDefault();
        }
    }
</script>

<script>
    function mainThamUrl(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function(e) {
                $('#mainThmb').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script>
    function checkFile(input) {
        var btn = input.parentNode.parentNode.querySelector('button[type="button"]');
        if (input.files.length > 0) {
            btn.removeAttribute('disabled');
        } else {
            btn.setAttribute('disabled', 'disabled');
        }
    }
</script>

<script>
    var categorySelect = document.querySelector('[name="category_id"]');
    var subcategorySelect = document.getElementById('subcategory');
    var selectedSubcategory = '{{ $products->sub_category_title_id }}';

    categorySelect.addEventListener('change', function() {
        var categoryId = this.value;
        subcategorySelect.innerHTML = '<option>Choose SubCategoryTitle</option>';

        if (categoryId) {
            fetch('/get-subtitle/' + categoryId)
                .then(response => response.json())
                .then(data => {
                    data.forEach(subcategory => {
                        subcategorySelect.innerHTML +=
                            `<option value="${subcategory.id}">${subcategory.sub_category_titlename}</option>`;
                    });
                    if (selectedSubcategory) {
                        subcategorySelect.value = selectedSubcategory;
                        selectedSubcategory = '';
                    }
                });
        }
    });

    if (categorySelect.value) {
        categorySelect.dispatchEvent(new Event('change'));
    }
</script>


<script>
    document.addEventListener('DOMContentLoaded', function() {
        var selectedSubcategoryTitleId = '{{ $products->sub_category_title_id }}';
        var subcategorySelect = document.getElementById('subcategory');
        var subcategoryNameSelect = document.getElementById('subname');

        subcategoryNameSelect.innerHTML =
            '<option value="{{ $products->sub_category_id }}">{{ $products->subcategory->sub_category_name }}</option>';

        subcategorySelect.addEventListener('change', function() {
            var subcategoryTitleId = this.value;

            fetch('/get-subcategories-by-title/' + subcategoryTitleId)
                .then(response => response.json())
                .then(subcategories => {
                    subcategoryNameSelect.innerHTML = '';
                    subcategories.forEach(subcategory => {
                        subcategoryNameSelect.innerHTML +=
                            `<option value="${subcategory.id}">${subcategory.sub_category_name}</option>`;
                    });

                    subcategoryNameSelect.value = '{{ $products->sub_category_id }}';
                })
                .catch(error => console.error('Failed to fetch subcategories'));
        });

        var event = new Event('change');
        subcategorySelect.dispatchEvent(event);
    });
</script>



<script>
    const originalPriceInput = document.getElementById('original_price');
    const discountPercentInput = document.getElementById('discount_percent');
    const sellingPriceInput = document.getElementById('selling_price');
    const calculatedSellingPriceInput = document.getElementById('calculated_selling_price');

    function calculateSellingPrice() {
        const originalPrice = parseFloat(originalPriceInput.value);
        const discountPercent = parseFloat(discountPercentInput.value);

        if (!isNaN(discountPercent)) {
            const discountAmount = originalPrice * (discountPercent / 100);
            const sellingPrice = originalPrice - discountAmount;
            sellingPriceInput.value = Math.round(sellingPrice);
            calculatedSellingPriceInput.value = Math.round(sellingPrice);
        } else {
            selling_price.value = originalPriceInput.value;
            calculatedSellingPriceInput.value = originalPriceInput.value;
        }
    }

    originalPriceInput.addEventListener('input', calculateSellingPrice);
    discountPercentInput.addEventListener('input', calculateSellingPrice);
    calculateSellingPrice();
</script>

<script>
    ClassicEditor.create(document.querySelector('#ckeditor'))
        .catch(error => {
            console.error(error);
        });

    ClassicEditor.create(document.querySelector('#ckeditor1'))
        .catch(error => {
            console.error(error);
        });
</script>
@endsection