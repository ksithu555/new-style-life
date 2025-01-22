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
                                        <h5>SubCategory Title Information</h5>
                                    </div>
                                    @php $action= route('registersubcategory'); @endphp

                                    <form class="theme-form theme-form-2 mega-form" id="registersubcategory" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                                        @csrf
                                        @if ($editmode)
                                            <input type="hidden" name="id" value="{{ $subtitle->id }}">
                                        @endif

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-sm-3 col-form-label form-label-title">Category</label>
                                            <div class="col-sm-8">
                                                <select class="js-example-basic-single w-100" name="category" id="category">
                                                    <option value="0">Select Category</option>
                                                    @foreach($categories as $category)
                                                        <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                                                    @endforeach
                                                </select>
                                                <p style="display:none" class="category error text-danger"></p>
                                                @if (!empty($error['category']))
                                                    @foreach ($error['category'] as $key => $value)
                                                        <p class="category error text-danger">{{ $value }}</p>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-sm-3 col-form-label form-label-title">SubCategory Title</label>
                                            <div class="col-sm-8">
                                                <select class="js-example-basic-single w-100 get_subcategory" name="subcategory" id="subcategory"></select>
                                                <p style="display:none" class="subcategory error text-danger"></p>
                                                @if (!empty($error['subcategory']))
                                                    @foreach ($error['subcategory'] as $key => $value)
                                                        <p class="subcategory error text-danger">{{ $value }}</p>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">SubCategory Name</label>
                                            <div class="col-sm-9">
                                                <div class="input-group">
                                                    <input class="form-control" type="text" placeholder="SubCategory Name" name="subname[]" id="subname" value="{{ old('subname') }}">
                                                    <div class="input-group-append align-self-center mx-auto justify-content-center">
                                                        <a href="#" class="align-items-center d-flex" id="add-more-field">
                                                            <i data-feather="plus-square"></i> Add
                                                        </a>
                                                    </div>
                                                </div>
                                                <div id="dynamic-form"></div>
                                                <p style="display:none" class="subname error text-danger"></p>
                                                @if (!empty($error['subname']))
                                                    @foreach ($error['subname'] as $key => $value)
                                                        <p class="subname error text-danger">{{ $value }}</p>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <button type="button" class="btn btn-submit btn-animation ms-auto fw-bold">
                                            @if (!$editmode)
                                                <i class="fa fa-user-plus" aria-hidden="true"></i> Save
                                            @else
                                                <i class="fa fa-edit" aria-hidden="true"></i> Edit
                                            @endif
                                        </button>

                                        <!-- Confirm Modal Box -->
                                        <div class="modal fade theme-modal remove-coupon" id="confirmModal" tabindex="-1" data-bs-toggle="modal" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
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
                                                            <p>SubCategory will be added.</p>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-submit btn-animation btn-md fw-bold me-2">
                                                            Yes
                                                        </button>
                                                        <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal" style="background-color: #ff6b6b; border-color: #ff6b6b;">No</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Confirm Modal Box End -->
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

        $('.btn-submit').click(function() {
            $('.error').hide();

            if ($.trim($("#category").val()) === "0" || $.trim($("#subcategory").val()) === "" || $.trim($("#subname").val()) === "") {
                if ($.trim($("#category").val()) === "0") {
                    $('.error.category').text('Category Name is required').show();
                }
                if ($.trim($("#subcategory").val()) === "") {
                    $('.error.subcategory').text('Subcategory Title Name is required').show();
                }
                if ($.trim($("#subname").val()) === "") {
                    $('.error.subname').text('Subcategory Name is required').show();
                }
                if ($.trim($("#addedsubname").val()) === "") {
                    $('.error.subname').text('Subcategory Name is required').show();
                }
                return false;
            } else {
                $('.error').hide();
                $('#confirmModal').modal('show');
            }
        });

        function addInputField() {
            var inputGroup = document.createElement('div');
            inputGroup.classList.add('mb-4', 'row', 'align-items-center');
            inputGroup.innerHTML = `
                <div class="col-sm-12">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="SubCategory Name" name="subname[]" id="addedsubname">
                        <div class="input-group-append align-self-center mx-auto justify-content-center">
                            <a href="#" class="align-items-center d-flex remove-field">
                                <i data-feather="minus-square" class="remove-field"></i> Remove
                            </a>
                        </div>
                    </div>
                </div>
            `;
            document.getElementById('dynamic-form').appendChild(inputGroup);
            feather.replace();
        }

        document.getElementById('add-more-field').addEventListener('click', function(event) {
            event.preventDefault();
            addInputField();
        });

        document.getElementById('dynamic-form').addEventListener('click', function(event) {
            if (event.target.classList.contains('remove-field')) {
                event.preventDefault();
                event.target.closest('.row').remove();
            }
        });
    </script>
</x-auth-layout>