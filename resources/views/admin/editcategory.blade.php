<x-auth-layout>
    @php
        $error = $errors->toArray();
        $editmode = $editmode ?? false;
        $editother = $editother ?? false;
    @endphp

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
                                        <h5>Category Information</h5>
                                    </div>
                                    @php $action = route('registersubcategory'); @endphp

                                    <form class="theme-form theme-form-2 mega-form" id="registersubcategory" class="contact-form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                                        @csrf
                                        @if ($editmode)
                                            <input type="hidden" name="id" value="{{ $subtitle->id }}">
                                        @endif

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-sm-3 col-form-label form-label-title">Category</label>
                                            <div class="col-sm-9">
                                                <select class="js-example-basic-single w-100" name="category" id="category" style="width:400px">
                                                    <option>select Category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}" data-image="{{ $category->category_icon }}" @if($category->id == $subtitle->category_id) selected @endif>
                                                            {{ $category->category_name }}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-sm-3 col-form-label form-label-title">Select Category Icon</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="image" id="image" class="form-control">
                                                <div id="categoryImageContainer">
                                                    @foreach($categories as $category)
                                                        @if($category->id == $subtitle->category_id)
                                                            <img id="category-image" alt="your image" 
                                                                @if(!empty($category->category_icon))
                                                                    src="{{ asset('images/' . ($category->category_icon ?? 'blog/blog-details.jpg')) }}"
                                                                    style="width: 100px;"
                                                                @else
                                                                    style="display: none; width: 100px;"
                                                                @endif
                                                            />
                                                        @endif
                                                    @endforeach
                                                </div>
                                                <p style="display:none" class="image error text-danger"></p>
                                                @if (!empty($error['image']))
                                                    @foreach ($error['image'] as $value)
                                                        <p class="image error text-danger">{{ $value }}</p>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-sm-3 col-form-label form-label-title">SubCategory Title</label>
                                            <div class="col-sm-9">
                                                <select class="js-example-basic-single w-100 get_subcategory" name="subcategory" id="subcategory">
                                                    <option value="{{ $subcategory_titlename->id }}">{{ $subcategory_titlename->sub_category_titlename }}</option>
                                                </select>
                                                <p style="display:none" class="subcategory error text-danger"></p>
                                                @if (!empty($error['subcategory']))
                                                    @foreach ($error['subcategory'] as $value)
                                                        <p class="subcategory error text-danger">{{ $value }}</p>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">SubCategory Name</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" name="subname" id="subname" type="text" placeholder="SubCategory Name"
                                                    value="{{ old('subname') ?? $subcategory_name->sub_category_name ?? '' }}">
                                                <p style="display:none" class="subname error text-danger"></p>
                                                @if (!empty($error['subname']))
                                                    @foreach ($error['subname'] as $value)
                                                        <p class="subname error text-danger">{{ $value }}</p>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <button class="btn btn-submit btn-animation ms-auto fw-bold" type="submit">
                                            @if (!$editmode)
                                                <i class="fa fa-user-plus" aria-hidden="true"></i> Save
                                            @else
                                                <i class="fa fa-edit" aria-hidden="true"></i> Edit
                                            @endif
                                        </button>

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
                                                            <p>Category data will be updated.</p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-submit btn-animation btn-md fw-bold me-2">
                                                            @if (!$editmode)
                                                                登録する
                                                            @else
                                                                Yes
                                                            @endif
                                                        </button>
                                                        <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal"
                                                            style="background-color: #ff6b6b; border-color: #ff6b6b;">No
                                                        </button>
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

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $(document).on('change', '#category', function() {
                let category = $(this).val();
                console.log("Category changed:", category); // Debug statement

                $.ajax({
                    method: 'post',
                    url: "{{ route('getSubcategories') }}",
                    data: {
                        _token: "{{ csrf_token() }}", // Ensure CSRF token is included
                        category: category
                    },
                    success: function(res) {
                        if (res.status == 'success') {
                            let all_options = "<option value=''>Select Sub Category</option>";
                            let all_subcategories = res.subcategories;
                            $.each(all_subcategories, function(index, value) {
                                all_options += "<option value='" + value.id + "'>" + value.sub_category_titlename + "</option>";
                            });
                            $(".get_subcategory").html(all_options);
                        } else {
                            console.error("Failed to fetch subcategories:", res);
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error occurred:", error);
                    }
                });
            });
        });
    </script>
    <script>
        // Get reference to the select element
        var categorySelect = document.getElementById('category');
        // Get reference to the image container
        var categoryImageContainer = document.getElementById('categoryImageContainer');

        // Add event listener for change event on select element
        categorySelect.addEventListener('change', function() {
            // Get the selected option
            var selectedOption = this.options[this.selectedIndex];
            // Get the data-image attribute value
            var imageUrl = selectedOption.getAttribute('data-image');
            // Update the image in the container
            categoryImageContainer.innerHTML = `<img src="{{ asset('images/${imageUrl}') }}" alt="Category Image" id='new-category-image'>`;
            document.getElementById('new-category-image').style.width = '100px';
        });
    </script>

    <script>
        $(".btn-submit").click(function(e) {
            e.preventDefault();
            var _token = $("input[name='_token']").val();
            let formData = new FormData(registersubcategory);
            $('#confirmModal').modal('show');
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#confirmModal').on('shown.bs.modal', function() {});

            $('#confirmModal').on('hidden.bs.modal', function() {});

            $('#confirmModal').on('click', '.btn-submit', function() {
                if ($.trim($("#subcategory").val()) === "" || $.trim($("#subname").val()) === "") {
                    if ($.trim($("#subcategory").val()) === "") {
                        $('.error.subcategory').text('subcategory is required')
                        $('.error.subcategory').show()
                    } else {
                        $('.error.subcategory').hide()
                    }

                    if ($.trim($("#subname").val()) === "") {
                        $('.error.subname').text('subname is required')
                        $('.error.subname').show()
                    } else {
                        $('.error.subname').hide()
                    }

                    $('#confirmModal').modal('hide');
                    return false;
                } else {
                    $('#registersubcategory').submit();
                }
            });
        });
    </script>
</x-auth-layout>