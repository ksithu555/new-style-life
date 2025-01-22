<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
@php $error = $errors->toArray();  @endphp
@extends('seller.seller_dashboard')
@section('seller')
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
                                    <h5>Product Information</h5>
                                </div>

                                <form method="POST" class="theme-form theme-form-2 mega-form" action="{{ route('store.product') }}" enctype="multipart/form-data" id="sellerRegister">
                                    @csrf
                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Brand</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <select class="custom-select" name="brand_id" id="brand_id">
                                                    <option>Choose brand</option>
                                                    @foreach ($brands as $brand)
                                                        <option value="{{ $brand->id }}">{{ $brand->brand_name }}</option>
                                                    @endforeach
                                                </select>
                                                <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#addBrandModal">
                                                    <i data-feather="plus-square"></i>
                                                </button>
                                            </div>
                                            <p class="error" style="color:red" id="error-brand_id"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="product_name" type="text" placeholder="Product Name" value="{{ old('product_name') }}" id="product_name">
                                            <p class="error" style="color:red" id="error-product_name"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label
                                            class="col-sm-3 col-form-label form-label-title">Made-in</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" name="country_id" id="country_id">
                                                <option>Choose country</option>
                                                @foreach ($countries as $country)
                                                    <option value="{{ $country->id }}">{{ $country->name }}</option>
                                                @endforeach
                                            </select>
                                            <p class="error" style="color:red" id="error-country_id"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label
                                            class="col-sm-3 col-form-label form-label-title">Category</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" name="category_id" id="category">
                                                <option>Choose Category</option>
                                                @foreach ($categories as $category)
                                                    @if ($category->category_name === "Special Corner")
                                                        <option value="{{ $category->id }}" disabled>{{ $category->category_name }}</option>
                                                    @else
                                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <p class="error" style="color:red" id="error-category_id"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label
                                            class="col-sm-3 col-form-label form-label-title">SubCategory Title</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100 get_sub" name="sub_category_title_id" id="subcategory">

                                            </select>
                                            <p class="error" style="color:red" id="error-sub_category_title_id"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label
                                            class="col-sm-3 col-form-label form-label-title">SubCategory</label>
                                        <div class="col-sm-9">
                                            <select class="js-example-basic-single w-100" name="sub_category_id" id="subname">

                                            </select>
                                            <p class="error" style="color:red" id="error-sub_category_id"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Tags</label>
                                        <div class="col-sm-9">
                                            <input type="text" name="product_tags" class="form-control" data-role="tagsinput" id="product_tags" value="New product,New" placeholder="Type & hit enter" value="{{ old('product_tags') }}">
                                            <p class="error" style="color:red" id="error-product_tags"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Size/Weight</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="product_size" data-role="tagsinput" value="Small,30Kg,40x20x10CM" placeholder="Type & hit enter" value="{{ old('product_size') }}" id="product_size">
                                            <p class="error" style="color:red" id="error-product_size"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Product Color</label>
                                        <div class="col-sm-9">
                                            <input type="text" class="form-control" name="product_color" data-role="tagsinput" value="Red,Blue,Pink" placeholder="Type & hit enter" value="{{ old('product_color') }}" id="product_color">
                                            <p class="error" style="color:red" id="error-product_color"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Short Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="short_desc" id="short_desc" rows="5" placeholder="Use control+shift+V to paste within this text area.">{{ old('short_desc') }}</textarea>
                                            <p class="error" style="color:red" id="error-short_desc"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Long Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="long_desc" id="long_desc" placeholder="Use control+shift+V to paste within this text area.">{{ old('content_long_desc') }}</textarea>
                                            <input type="hidden" name="content" id="content_long_desc">
                                            <p class="error" style="color:red" id="error-content_long_desc"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Care Instructions</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="care_instructions" id="care_instructions" placeholder="Use control+shift+V to paste within this text area.">{{ old('content_care_instructions') }}</textarea>
                                            <input type="hidden" name="content" id="content_care_instructions">
                                            <p class="error" style="color:red" id="error-content_care_instructions"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Thambnail Image</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" name="product_thambnail" id="formFile" onchange="mainThamUrl(this)" value="{{ old('product_thambnail') }}">
                                            <img src="" id="mainThmb">
                                            <p class="error" style="color:red" id="error-product_thambnail"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Multiple Images</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <div id="fileInputs" class="custom-select">
                                                    <input class="form-control" type="file" name="images[]" accept="image/*" id="multiImg" >
                                                </div>
                                                <button type="button" class="btn btn-light" id="addFileInput">
                                                    <i data-feather="plus-square"></i>
                                                </button>
                                            </div>
                                            <p class="error" style="color:red" id="error-images"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Original Price(tax inc)</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="original_price" id="original_price" type="number" placeholder="0" min="1" value="{{ old('original_price') }}" pattern="\d*">
                                            <p class="error" style="color:red" id="error-original_price"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Discount Percentage</label>
                                        <div class="col-sm-6">
                                            <input class="form-control" name="discount_percent" id="discount_percent" type="number" placeholder="0-100%" min="0" max="100" value="{{ old('discount_percent') }}" pattern="\d*">
                                        </div>
                                        <div class="col-sm-3">
                                            <input class="form-control" name="selling_price" id="selling_price" type="number" disabled>
                                            <input type="hidden" name="calculated_selling_price" id="calculated_selling_price">
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Product Quantity</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="product_qty" type="number" placeholder="0" min="1" value="{{ old('product_qty') }}" id="product_qty" pattern="\d*">
                                            <p class="error" style="color:red" id="error-product_qty"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Estimated Date</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="estimate_date" type="number" placeholder="0" min="1" value="{{ old('estimate_date') }}" id="estimate_date" pattern="\d*">
                                            <p class="error" style="color:red" id="error-estimate_date"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Delivery Price(tax inc)</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" name="delivery_price" type="number" placeholder="400" min="1" value="{{ old('delivery_price') }}" id="delivery_price" pattern="\d*">
                                            <p class="error" style="color:red" id="error-delivery_price"></p>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 form-label-title">Shipping From</label>
                                        <div class="col-sm-9">
                                            <div class="d-flex align-items-center">
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="shipping_country" id="japan" value="0" {{ old('shipping_country') == '0' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="japan">Japan</label>
                                                </div>
                                                <div class="form-check me-3">
                                                    <input class="form-check-input" type="radio" name="shipping_country" id="abroad" value="1" {{ old('shipping_country') == '1' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="abroad">Abroad</label>
                                                </div>
                                            </div>
                                            <p class="error" style="color:red; margin-top: 0.1rem;" id="error-shipping_country"></p>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-animation btn-submit" data-bs-toggle="modal" data-bs-target="#confrimModal">Save</button>

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
    <!-- New Product Add End -->
</div>

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
                        <button type="button" class="btn btn-animation btn-secondary" data-bs-dismiss="modal"
                                style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Add Brand Modal Box End-->

<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>

<script>
    $('.btn-brand').click(function() {
        $('.error').hide();

        let brand_name = $.trim($("#brand_name").val());
        let brand_icon = $("#brand_icon")[0].files[0];

        let isValid = true;

        if (!brand_name) {
            $('#error-brand_name').text('Please provide brand name.').show();
            isValid = false;
        } else if (brand_name.length > 255) {
            $('#error-brand_name').text('Brand name must not exceed 255 characters.').show();
            isValid = false;
        }

        if (!brand_icon) {
            $('#error-brand_icon').text('Please provide brand image.').show();
            isValid = false;
        } else if (brand_icon.size > 2 * 1024 * 1024) {
            $('#error-brand_icon').text('Brand image must not exceed 2MB.').show();
            isValid = false;
        }

        if (isValid) {
            $(this).closest('form').submit();
        }

        return false;
    });
</script>

<script>
    $('.btn-submit').click(function() {
    $('.error').hide();

    let product_name = $.trim($("#product_name").val());
    let country_id = $.trim($("#country_id").val());
    let brand_id = $.trim($("#brand_id").val());
    let category_id = $.trim($("#category").val());
    let sub_category_title_id = $.trim($("#subcategory").val());
    let sub_category_id = $.trim($("#subname").val());
    let product_tags = $.trim($("#product_tags").val());
    let product_size = $.trim($("#product_size").val());
    let product_color = $.trim($("#product_color").val());
    let short_desc = $.trim($("#short_desc").val());
    let long_desc = $.trim($("#content_long_desc").val());
    let care_instructions = $.trim($("#content_care_instructions").val());
    let productImage = $("#formFile")[0].files[0];
    let productImages = $("#multiImg")[0].files;
    let original_price = $.trim($("#original_price").val());
    let product_qty = $.trim($("#product_qty").val());
    let estimate_date = $.trim($("#estimate_date").val());
    let delivery_price = $.trim($("#delivery_price").val());
    let shipping_country = $('input[name="shipping_country"]:checked').val();

    let isValid = true;

    if (!product_name) {
        $('#error-product_name').text('Please provide product name.').show();
        isValid = false;
    } else if (product_name.length > 255) {
        $('#error-product_name').text('Product name must not exceed 255 characters.').show();
        isValid = false;
    }

    if (!country_id || country_id === 'Choose country') {
        $('#error-country_id').text('Please select a valid country.').show();
        isValid = false;
    }

    if (!brand_id || brand_id === 'Choose brand') {
        $('#error-brand_id').text('Please select a valid brand.').show();
        isValid = false;
    }

    if (!category_id || category_id === 'Choose Category') {
        $('#error-category_id').text('Please select a valid category.').show();
        isValid = false;
    }

    if (!sub_category_title_id) {
        $('#error-sub_category_title_id').text('Please select a valid subcategory title.').show();
        isValid = false;
    }

    if (!sub_category_id) {
        $('#error-sub_category_id').text('Please select a valid subcategory.').show();
        isValid = false;
    }

    if (!product_tags) {
        $('#error-product_tags').text('Please provide product tags.').show();
        isValid = false;
    } else if (product_tags.length > 255) {
        $('#error-product_tags').text('Product tags must not exceed 255 characters.').show();
        isValid = false;
    }

    if (!product_size) {
        $('#error-product_size').text('Please provide product size.').show();
        isValid = false;
    } else if (product_size.length > 255) {
        $('#error-product_size').text('Product size must not exceed 255 characters.').show();
        isValid = false;
    }

    if (!product_color) {
        $('#error-product_color').text('Please provide product color.').show();
        isValid = false;
    } else if (product_color.length > 255) {
        $('#error-product_color').text('Product color must not exceed 255 characters.').show();
        isValid = false;
    }

    if (!short_desc) {
        $('#error-short_desc').text('Please provide short description.').show();
        isValid = false;
    } else if (short_desc.length > 400) {
        $('#error-short_desc').text('Short description must not exceed 400 characters.').show();
        isValid = false;
    }

    if (!long_desc) {
        $('#error-content_long_desc').text('Please provide long description.').show();
        isValid = false;
    } else if (long_desc.length > 2000) {
        $('#error-content_long_desc').text('Long description must not exceed 2000 characters.').show();
        isValid = false;
    }

    if (!care_instructions) {
        $('#error-content_care_instructions').text('Please provide care instructions.').show();
        isValid = false;
    } else if (care_instructions.length > 1200) {
        $('#error-content_care_instructions').text('Care instructions must not exceed 1200 characters.').show();
        isValid = false;
    }

    if (!productImage) {
        $('#error-product_thambnail').text('Please provide product image.').show();
        isValid = false;
    } else if (productImage.size > 2 * 1024 * 1024) {
        $('#error-product_thambnail').text('Product image must not exceed 2MB.').show();
        isValid = false;
    }

    if (productImages.length === 0) {
        $('#error-images').text('Please provide multiple images.').show();
        isValid = false;
    } else {
        for (let i = 0; i < productImages.length; i++) {
            if (productImages[i].size > 2 * 1024 * 1024) {
                $('#error-images').text('Each image must not exceed 2MB.').show();
                isValid = false;
                break;
            }
        }
    }

    if (!original_price) {
        $('#error-original_price').text('Please provide product price.').show();
        isValid = false;
    } else if (!/^\d+$/.test(original_price)) {
        $('#error-original_price').text('Please provide a valid digit.').show();
        isValid = false;
    }

    if (!product_qty) {
        $('#error-product_qty').text('Please provide product quantity.').show();
        isValid = false;
    } else if (!/^\d+$/.test(product_qty)) {
        $('#error-product_qty').text('Please provide a valid digit.').show();
        isValid = false;
    }

    if (!estimate_date) {
        $('#error-estimate_date').text('Please provide delivery estimate date.').show();
        isValid = false;
    }

    if (!delivery_price) {
        $('#error-delivery_price').text('Please provide delivery price.').show();
        isValid = false;
    } else if (!/^\d+$/.test(delivery_price)) {
        $('#error-delivery_price').text('Please provide a valid digit.').show();
        isValid = false;
    }

    if (!shipping_country) {
        $('#error-shipping_country').text('Please select a valid type.').show();
        isValid = false;
    }

    if (isValid) {
        $('#confirmModal').modal('show');
    }

    return false;
    });
</script>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const addFileInputBtn = document.getElementById('addFileInput');
        const initialFileInput = document.getElementById('multiImg');
        const fileInputsContainer = document.getElementById('fileInputs');
        let imageCount = 0;

        function createImageContainer(file, fileInput) {
            const imageContainer = document.createElement('div');
            imageContainer.classList.add('file-input-container');

            const newImage = document.createElement('img');
            newImage.src = URL.createObjectURL(file);
            newImage.classList.add('uploaded-image');
            newImage.style.width = newImage.style.height = '70px';

            const closeButton = document.createElement('button');
            closeButton.innerHTML = '&#10006;';
            closeButton.classList.add('close-button');
            closeButton.addEventListener('click', () => {
                fileInputsContainer.removeChild(imageContainer);
                if (fileInput !== initialFileInput) {
                    fileInputsContainer.removeChild(fileInput);
                } else {
                    fileInput.value = '';
                }
                imageCount--;
            });

            imageContainer.appendChild(newImage);
            imageContainer.appendChild(closeButton);
            fileInputsContainer.appendChild(imageContainer);
        }

        function handleFileInputChange(event) {
            const fileInput = event.target;
            for (const file of fileInput.files) {
                if (imageCount < 5) {
                    createImageContainer(file, fileInput);
                    imageCount++;
                } else {
                    alert('You can only upload a maximum of 5 images.');
                    break;
                }
            }
        }

        initialFileInput.addEventListener('change', handleFileInputChange);

        addFileInputBtn.addEventListener('click', () => {
            if (imageCount < 5) {
                const newFileInput = document.createElement('input');
                newFileInput.type = 'file';
                newFileInput.name = 'images[]';
                newFileInput.accept = 'image/*';
                newFileInput.style.display = 'none';
                newFileInput.addEventListener('change', handleFileInputChange);
                fileInputsContainer.appendChild(newFileInput);
                newFileInput.click();
            } else {
                alert('You can only upload a maximum of 5 images.');
            }
        });
    });
</script>

<script>
    function mainThamUrl(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#mainThmb').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.getElementById('category').addEventListener('change', function() {
            var categoryId = this.value;
            var subcategorySelect = document.getElementById('subcategory');
            if (subcategorySelect) {
                subcategorySelect.innerHTML = '<option value="">Choose SubCategoryTitle</option>';

                if (!categoryId) {return;}

                var xhr = new XMLHttpRequest();
                xhr.onreadystatechange = function() {
                    if (xhr.readyState === XMLHttpRequest.DONE) {
                        if (xhr.status === 200) {
                            var subcategories = JSON.parse(xhr.responseText);
                            subcategories.forEach(function(subcategory) {
                                var option = document.createElement('option');
                                option.value = subcategory.id;
                                option.textContent = subcategory.sub_category_titlename;
                                subcategorySelect.appendChild(option);
                            });
                        } else {
                            console.error('Failed to fetch subcategories');
                        }
                    }
                };
                xhr.open('GET', '/get-subtitle/' + categoryId);
                xhr.send();
            } else {
                console.error('Subcategory select element not found');
            }
        });
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('subcategory').addEventListener('change', function() {
        var subcategoryTitleId = this.value;
        var subcategorySelect = document.getElementById('subname');
        subcategorySelect.innerHTML = '<option value="">Choose SubCategory</option>';

        if (!subcategoryTitleId) {
            return;
        }

        var xhr = new XMLHttpRequest();
        xhr.onreadystatechange = function() {
            if (xhr.readyState === XMLHttpRequest.DONE) {
                if (xhr.status === 200) {
                    var subcategories = JSON.parse(xhr.responseText);
                    subcategories.forEach(function(subcategory) {
                        var option = document.createElement('option');
                        option.value = subcategory.id;
                        option.textContent = subcategory.sub_category_name;
                        subcategorySelect.appendChild(option);
                    });
                } else {
                    console.error('Failed to fetch subcategories');
                }
            }
        };
        xhr.open('GET', '/get-subcategories-by-title/' + subcategoryTitleId);
        xhr.send();
    });

    document.getElementById('subname').addEventListener('change', function() {
        var subcategoryId = this.value;
    });
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

    if (!isNaN(originalPrice)) {
        if (!isNaN(discountPercent)) {
            const discountAmount = originalPrice * (discountPercent / 100);
            const sellingPrice = originalPrice - discountAmount;
            sellingPriceInput.value = Math.round(sellingPrice);
            calculatedSellingPriceInput.value = Math.round(sellingPrice);
        } else {
            sellingPriceInput.value = Math.round(originalPrice);
            calculatedSellingPriceInput.value = Math.round(originalPrice);
        }
        } else {
            sellingPriceInput.value = '';
            calculatedSellingPriceInput.value = '';
        }
    }
    originalPriceInput.addEventListener('input', calculateSellingPrice);
    discountPercentInput.addEventListener('input', calculateSellingPrice);
    calculateSellingPrice();
</script>

<script>
    $(document).ready(function() {
        ClassicEditor
            .create(document.querySelector('#long_desc'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    var editorData = editor.getData();
                    document.querySelector('#content_long_desc').value = editorData;
                });
            })
            .catch(error => {
                console.error(error);
            });

        ClassicEditor
            .create(document.querySelector('#care_instructions'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    var editorData = editor.getData();
                    document.querySelector('#content_care_instructions').value = editorData;
                });
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>

<script>
    function showBrand(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#showIcon').attr('src', e.target.result).width(80).height(80);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>


@endsection