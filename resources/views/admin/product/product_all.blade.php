<x-auth-layout>

    <style>
        .table thead th,
        .table tbody td {
            white-space: nowrap;
        }

        .table thead th.sticky,
        .table tbody td.sticky {
            position: sticky;
            background: white;
            z-index: 1;
        }

        .table thead th.sticky-1,
        .table tbody td.sticky-1 {
            left: 0;
            min-width: 50px;
            z-index: 2;
        }

        .table thead th.sticky-2,
        .table tbody td.sticky-2 {
            left: 50px;
            min-width: 200px;
            z-index: 2;
        }

        .table thead th.sticky-3,
        .table tbody td.sticky-3 {
            left: 250px;
            min-width: 300px;
            z-index: 2;
        }

        .table-product {
            overflow-x: auto;
        }

        /* Add alternating row colors */
        .table tbody tr:nth-child(odd) {
            background-color: #f9f9f9;
        }

        .table tbody tr:nth-child(even) {
            background-color: #ffffff;
        }

        .table tbody tr:hover {
            background-color: #f1f1f1;
        }

        .table tbody tr:nth-child(odd) .sticky {
            background-color: #f9f9f9;
        }

        .table tbody tr:nth-child(even) .sticky {
            background-color: #ffffff;
        }

        .table tbody tr:hover .sticky {
            background-color: #f1f1f1;
        }

        @media (max-width: 575.98px) {
            .table thead th.sticky-1,
            .table tbody td.sticky-1 {
                left: 0px;
                min-width: 20px;
            }
            .table thead th.sticky-2,
            .table tbody td.sticky-2 {
                left: 40px;
                min-width: 30px;
            }

            .table thead th.sticky-3,
            .table tbody td.sticky-3 {
                left: 40px;
                min-width: 50px;
                max-width: 140px;
            }
        }

        @media (max-width: 767.98px) {
            .table thead th.sticky-1,
            .table tbody td.sticky-1 {
                left: 0px;
                min-width: 20px;
            }
            .table thead th.sticky-2,
            .table tbody td.sticky-2 {
                left: 40px;
                min-width: 30px;
            }

            .table thead th.sticky-3,
            .table tbody td.sticky-3 {
                left: 40px;
                min-width: 50px;
                max-width: 140px;
            }
        }
    </style>

    <div class="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="title-header option-title d-sm-flex d-block">
                                <h5>Products</h5>
                                <!--message box -->
                                @include('components.messagebox')
                            </div>
                            <div>
                                <div class="table-responsive">
                                    <table class="table all-package theme-table table-product" id="table_id">
                                        <thead>
                                            <tr>
                                                <th class="sticky sticky-1" style="min-width: 50px">No</th>
                                                <th>Date</th>
                                                <th class="sticky sticky-2" style="min-width: 200px">Product Image</th>
                                                <th class="sticky sticky-3" style="min-width: 300px">Product Name</th>
                                                <th style="min-width: 120px">Shop Name</th>
                                                <th style="min-width: 120px">Current Qty</th>
                                                <th style="min-width: 120px">Price<br>(Tax inc)</th>
                                                <th style="min-width: 150px">Commision(%)</th>
                                                <th style="min-width: 150px">Commision</th>
                                                <th style="min-width: 150px;">Coupon Code</th>
                                                <th style="min-width: 100px">Coupon</th>
                                                <th>Special Corner</th>
                                                <th style="min-width: 150px;">Status</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if ($lists->isEmpty())
                                                <tr>
                                                    <td colspan="9">No data available</td>
                                                </tr>
                                            @else
                                                @foreach ($lists as $key => $list)
                                                    <tr>
                                                        <td class="sticky sticky-1">
                                                            {{ $ttl + 1 - ($lists->firstItem() + $key) }}</td>
                                                        <td data-label="登録日">
                                                            {{ date('Y/m/d', strtotime($list->created_at)) }}<br>{{ date('H:i', strtotime($list->created_at)) }}
                                                        </td>
                                                        <td class="sticky sticky-2" data-label="{{ __('auth.image') }}"><img
                                                                src="{{ asset('images/' . $list->product_thambnail) }}"
                                                                alt="thumb" style="width: 50px;height: 50px;"></td>
                                                        <td class="sticky sticky-3"
                                                            style="text-align:left; max-width: 200px;overflow: hidden;"
                                                            data-label="{{ $list->product_name }}">
                                                            @if (mb_strlen($list->product_name) > 30)
                                                                {!! mb_substr($list->product_name, 0, 30) . '<br>' . mb_substr($list->product_name, 30, 30) . '...' !!}
                                                            @else
                                                                {!! nl2br(e($list->product_name)) !!}
                                                            @endif
                                                        </td>
                                                        <td>{{ $list->Seller->shop_name }}</td>
                                                        <td data-label="">{{ $list->product_qty }}</td>
                                                        <td data-label="">
                                                            ¥{{ number_format($list->selling_price, 0, '', ',') }}</td>
                                                        <td class="col-sm-9">
                                                            {{ $list->commission ? $list->commission . '%' : '' }}
                                                        </td>
                                                        <td class="col-sm-9">
                                                            @if ($list->commission_status == 1)
                                                                <button class="btn w-50"
                                                                    style = "background-color: #ff6b6b;margin-left: 50px;"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#removeCommission{{ $list->id }}"
                                                                    onclick="showDeleteModal('{{ $list->id }}')">Reset
                                                                </button>
                                                            @else
                                                                <button class="btn w-50 theme-bg-color"
                                                                    style = "margin-left: 50px;" data-bs-toggle="modal"
                                                                    data-bs-target="#commissionModal{{ $list->id }}"
                                                                    onclick="">Commission
                                                                </button>
                                                            @endif
                                                        </td>
                                                        @if ($list->coupon_status == 1)
                                                            <td data-label=""><a
                                                                    href='{{ url('/coupon/' . $list->coupon_id) }}'>{{ $list->coupon_code }}</a>
                                                            </td>
                                                        @else
                                                            <td data-label="">-</td>
                                                        @endif
                                                        <td class="col-sm-9">
                                                            @if ($list->coupon_status == 1)
                                                                <button class="btn w-50"
                                                                    style = "background-color: #ff6b6b;margin-left: 30px;"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#removeCoupon{{ $list->id }}"
                                                                    onclick="showDeleteModal('{{ $list->id }}')">Remove
                                                                </button>
                                                            @else
                                                                <button class="btn w-50 theme-bg-color"
                                                                    style = "margin-left: 30px;" data-bs-toggle="modal"
                                                                    data-bs-target="#couponModal{{ $list->id . $list->coupon_id }}"
                                                                    onclick="">Coupon
                                                                </button>
                                                            @endif
                                                        </td>
                                                        <td class="col-sm-9">
                                                            @if ($list->special_sub_category_id)
                                                                <button class="btn w-50"
                                                                    style = "background-color: #ff6b6b;margin-left: 30px;"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#removeProfile{{ $list->id }}"
                                                                    onclick="showDeleteModal('{{ $list->id }}')">Remove
                                                                </button>
                                                            @else
                                                                <button class="btn w-50 theme-bg-color"
                                                                    style = "margin-left: 30px;" data-bs-toggle="modal"
                                                                    data-bs-target="#editAddress{{ $list->id }}"
                                                                    onclick="">Add
                                                                </button>
                                                            @endif
                                                        </td>
                                                        @if ($list->user->created_by == 78)
                                                            @dd($list->user->subSeller)
                                                        @endif
                                                        <td class="col-sm-9">
                                                            <label class="switch" style="margin-top: 8px;">
                                                                <input data-width="100" data-id="{{ $list->id }}"
                                                                    class="toggle-class" type="checkbox"
                                                                    data-offstyle="outline-secondary" data-toggle="toggle"
                                                                    data-on="Active" data-off="InActive"
                                                                    {{ $list->status ? 'checked' : '' }}
                                                                    {{ $list->Seller->status == 0 ? 'disabled' : '' }}>
                                                            </label>
                                                        </td>
                                                        <td>
                                                            <ul>
                                                                <li>
                                                                    <a
                                                                        href="{{ route('admin.detailproduct', $list->id) }}">
                                                                        <i class="ri-eye-line"></i>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href='{{ url('/editproduct/' . $list->id) }}'>
                                                                        <i class="ri-pencil-line"></i>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                        data-bs-target="#deleteConfirmModal{{ $list->id }}">
                                                                        <i class="ri-delete-bin-line"></i>
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                    {{-- Edit Product Commission Start --}}
                                                    <div class="modal fade theme-modal remove-commission"
                                                        id="commissionModal{{ $list->id }}" aria-hidden="true"
                                                        tabindex="-1">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header d-block text-center">
                                                                    <h5 class="modal-title w-100" id="exampleModalLabel22">
                                                                        Enter Commission(%)</h5>
                                                                    <button type="button" class="btn-close"
                                                                        data-bs-dismiss="modal" aria-label="Close">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                </div>
                                                                <form id="commission-form{{ $list->id }}"
                                                                    method="POST"
                                                                    action="{{ route('updateproductcommission') }}"
                                                                    style="display:flex;">
                                                                    @csrf
                                                                    <div class="modal-body">
                                                                        <div class="form-group">
                                                                            <input type="number" class="form-control"
                                                                                id="commission{{ $list->id }}"
                                                                                value="{{ old('commission') ?? ($list->commission ?? '') }}"
                                                                                name="commission"
                                                                                placeholder="Enter commission">
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <input type="hidden"
                                                                            id="commission-id{{ $list->id }}"
                                                                            name="commissionid"
                                                                            value="{{ $list->id }}">
                                                                        <input type="hidden" name="id"
                                                                            value="{{ $list->id }}">
                                                                        <button type="submit"
                                                                            class="btn btn-animation btn-md fw-bold me-2">Save</button>
                                                                </form>
                                                                <button type="button"
                                                                    class="btn btn-animation btn-md fw-bold me-2"
                                                                    data-bs-dismiss="modal"
                                                                    style="background-color: #ff6b6b;border-color: #ff6b6b;">Cancel</button>

                                                            </div>
                                                        </div>
                                                    </div>
                                                    </div>
                                                    {{-- Edit Product Commission End --}}
                                                    {{-- Reser Product Commission Start --}}
                                                    <div class="modal fade theme-modal remove-commission"
                                                        id="removeCommission{{ $list->id }}" aria-hidden="true" tabindex="-1">
                                                        <div class="modal-dialog modal-dialog-centered">
                                                            <div class="modal-content">
                                                                <div class="modal-header d-block text-center">
                                                                    <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure?
                                                                    </h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                        aria-label="Close">
                                                                        <i class="fas fa-times"></i>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="remove-box">
                                                                        <p>This product's commission will be reset according to the shop.
                                                                        </p>
                                                                    </div>
                                                                </div>

                                                                <div class="modal-footer">
                                                                    <form method="POST" action="{{ route('deletecommission') }}"
                                                                        style="display:flex;">
                                                                        @csrf
                                                                        <input type="hidden" name="id"
                                                                            value="{{ $list->id }}">
                                                                        <button type="submit"class="btn btn-animation btn-md fw-bold me-2"
                                                                            data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"
                                                                            data-bs-dismiss="modal">Yes</button>
                                                                        <button type="button" class="btn btn-animation btn-md fw-bold"
                                                                            data-bs-dismiss="modal"
                                                                            style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    {{-- Reser Product Commission End --}}
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!--pagination -->
                @include('components.pagination')

            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
    <!-- Coupon Modal -->
    @foreach ($lists as $key => $list)
        <div class="modal fade theme-modal remove-coupon" id="couponModal{{ $list->id . $list->coupon_id }}"
            aria-hidden="true" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header d-block text-center">
                        <h5 class="modal-title w-100" id="exampleModalLabel22">Select Coupon</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Clost">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <!-- Add class "js-example-basic-single" to select element to initialize Select2 -->
                            <select class="form-control js-example-basic-single" id="coupon-select">
                                @foreach ($coupons as $coupon)
                                    <option value="{{ $coupon->id }}"
                                        @if ($coupon->id == $list->coupon_id) selected @endif>{{ $coupon->coupon_code }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form id="coupon-form" method="POST" action="{{ route('updateproductcoupon') }}"
                            style="display:flex;">
                            @csrf
                            <input type="hidden" id="coupon-id" name="couponid" value="">
                            <input type="hidden" name="id" value="{{ $list->id }}">
                            <button type="submit" class="btn btn-animation btn-md fw-bold me-2"
                                data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"
                                data-bs-dismiss="modal">Yes</button>
                            <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal"
                                style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Delete Modal Box Start -->
    @foreach ($lists as $key => $list)
        <div class="modal fade theme-modal remove-coupon" id="deleteConfirmModal{{ $list->id }}"
            aria-hidden="true" tabindex="-1">
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
                            <p>This product will be deleted.</p>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <form method="POST" action="{{ route('deleteproduct') }}" style="display:flex;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $list->id }}">
                            <button type="submit"class="btn btn-animation btn-md fw-bold me-2"
                                data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"
                                data-bs-dismiss="modal">Yes</button>
                            <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal"
                                style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="modal fade theme-modal remove-coupon" id="exampleModalToggle2" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel12">Done!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="remove-box text-center">
                        <div class="wrapper">
                            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                <circle class="checkmark__circle" cx="26" cy="26" r="25"
                                    fill="none" />
                                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                            </svg>
                        </div>
                        <h4 class="text-content">It's Removed.</h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal Box End -->

    <!-- Edit Special Modal Box Start -->
    @foreach ($lists as $item)
        <div class="modal fade theme-modal" id="editAddress{{ $item->id }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add To Special Corner</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <form method="post" action="{{ route('add_to_special_corner') }}"
                                class="row g-4 theme-form theme-form-2 mega-form">
                                @csrf
                                <input type="hidden" name="productId" id="productId" value="{{ $item->id }}">
                                <div class="mb-4 row align-items-center">
                                    <label class="col-sm-3 col-form-label form-label-title w-50">Category</label>
                                    <div class="col-sm-9">
                                        <select class="js-example-basic-single w-100" name="category_id"
                                            id="category">
                                            <option>Special Corner</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="col-sm-3 col-form-label form-label-title w-50">SubCategory
                                        Title</label>
                                    <div class="col-sm-9">
                                        <select class="js-example-basic-single w-100 get_sub"
                                            name="sub_category_title_id" id="subcategory_{{ $item->id }}">
                                            <option>Choose SubCategoryTitle</option>
                                            @foreach ($subCatTitle as $subCategoryTitle)
                                                <option value="{{ $subCategoryTitle->id }}">
                                                    {{ $subCategoryTitle->sub_category_titlename }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="mb-4 row align-items-center">
                                    <label class="col-sm-3 col-form-label form-label-title w-50">SubCategory</label>
                                    <div class="col-sm-9">
                                        <select class="js-example-basic-single w-100" name="sub_category_id"
                                            id="subname_{{ $item->id }}">

                                        </select>
                                    </div>
                                </div>

                                <div class="modal-footer">
                                    <button type="submit" class="btn theme-bg-color btn-md text-white"
                                        data-bs-dismiss="modal" id="saveChanges">
                                        Add
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
    <!-- Edit Special Modal Box End -->
    <!-- Remove Address Modal Start -->
    @foreach ($lists as $item)
        <div class="modal fade theme-modal remove-profile" id="removeProfile{{ $item->id }}" tabindex="-1"
            aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header d-block text-center">
                        <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="remove-box">
                            <p>This product will be removed from Special Corner.</p>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <form action="{{ route('remove_from_special_corner', ['id' => $item->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn theme-bg-color btn-md fw-bold text-light">Yes</button>
                        </form>
                        <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal"
                            style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <!-- Remove Address Modal End -->


    <!-- Delete Modal Box Start -->
    @foreach ($lists as $key => $list)
        <div class="modal fade theme-modal remove-coupon" id="removeCoupon{{ $list->id }}" aria-hidden="true"
            tabindex="-1">
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
                            <p>This coupon code will be removed from this item and shop's coupon will be applied.</p>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <form method="POST" action="{{ route('removeCoupon') }}" style="display:flex;">
                            @csrf
                            <input type="hidden" name="id" value="{{ $list->id }}">
                            <button type="submit"class="btn btn-animation btn-md fw-bold me-2"
                                data-bs-target="#exampleModalToggle2" data-bs-toggle="modal"
                                data-bs-dismiss="modal">Yes</button>
                            <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal"
                                style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    <div class="modal fade theme-modal remove-coupon" id="exampleModalToggle2" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title text-center" id="exampleModalLabel12">Done!</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="remove-box text-center">
                        <div class="wrapper">
                            <svg class="checkmark" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 52 52">
                                <circle class="checkmark__circle" cx="26" cy="26" r="25"
                                    fill="none" />
                                <path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" />
                            </svg>
                        </div>
                        <h4 class="text-content">It's Removed.</h4>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Delete Modal Box End -->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script>
        $(function() {
            $('.toggle-class').change(function() {

                var status = $(this).prop('checked') ? 1 : 0;

                var product_id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    dataType: "json",
                    url: "{{ route('tt') }}",
                    data: {
                        'status': status,
                        'product_id': product_id,
                        '_token': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        alert('2');
                        console.log(data.success);
                    }
                });
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var subcategoryElements = document.querySelectorAll('.get_sub');
            subcategoryElements.forEach(function(element) {
                element.addEventListener('change', function() {
                    var subcategoryTitleId = this.value;
                    var itemId = this.id.split('_')[1];
                    var subcategorySelect = document.getElementById('subname_' + itemId);
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
            });
        });
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        $(document).ready(function() {
            // When the "Yes" button is clicked within any modal
            $(document).on('click', '.remove-coupon .btn-animation', function() {
                // Find the closest modal to the clicked button
                var modal = $(this).closest('.remove-coupon');
                // Get the selected value from the coupon-select dropdown within the modal
                var selectedValue = modal.find('.js-example-basic-single').val();

                // Update the value of the hidden input field within the modal
                modal.find('#coupon-id').val(selectedValue);
            });
        });
    </script>
</x-auth-layout>