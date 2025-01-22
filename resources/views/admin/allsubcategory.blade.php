<x-auth-layout>
    <script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>
    <style>
        .table>:not(caption)>*>* {
            border-bottom-width: 0px !important;
        }

        /* Extra small devices (phones, less than 576px) */
        @media (max-width: 575.98px) {
            .d-inline-flex {
                display: block !important;
            }

            .d-inline-flex .btn {
                width: 100%;
                margin-bottom: 10px;
            }
        }

        /* Small devices (phones, 576px and up) */
        @media (min-width: 576px) {
            .d-inline-flex {
                display: flex !important;
                flex-direction: row !important;
                justify-content: space-between;
            }

            .d-inline-flex .btn {
                width: auto;
                margin-bottom: 0;
            }
        }
    </style>

    <div class="page-body">
        <!-- All User Table Start -->
        <div class="container-fluid mt-5">
            <div class="row mt-5">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="title-header option-title">
                                <h5>All Category</h5>
                                <form class="d-inline-flex">
                                    <a href="{{ route('admin.all.addcategory') }}"
                                        class="align-items-center btn btn-theme d-flex">
                                        <i data-feather="plus-square"></i>Add Main Category
                                    </a>&nbsp;&nbsp;
                                    <a href="{{ route('admin.all.addsubtitle') }}"
                                        class="align-items-center btn btn-theme d-flex">
                                        <i data-feather="plus-square"></i>Add SubTitle Category
                                    </a>&nbsp;&nbsp;
                                    <a href="{{ route('admin.all.addsubcategory') }}"
                                        class="align-items-center btn btn-theme d-flex">
                                        <i data-feather="plus-square"></i>Add SubCategory
                                    </a>
                                </form>
                            </div>
                            @include('components.messagebox')
                            <div class="table-responsive category-table">
                                <div>
                                    <table class="table all-package theme-table" id="table_id">
                                        <thead>
                                            <tr>
                                                <th style="min-width: 5px">No</th>
                                                <th style="min-width: 5px">Main Category Name</th>
                                                <th style="min-width: 5px">SubTitle Category Name</th>
                                                <th style="min-width: 5px">SubCategory Name</th>
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
                                                        <td class="text-center" style="min-width: 5px !important">
                                                            {{ $ttl + 1 - ($lists->firstItem() + $key) }}
                                                        </td>
                                                        {{-- <td data-label="タイトル" style="font-size:14px;">{{ $list->category }}
                                                    <a href='' data-bs-t="modal"
                                                        data-bs-target="#categoryModal{{ $list->categoryId }}">
                                                        <i class="ri-pencil-line"></i>
                                                    </a>
                                                    </td> --}}

                                                        <td data-label="タイトル" style="font-size: 14px;">
                                                            <div style="vertical-align: middle;">
                                                                {!! $list->category !!}

                                                                <a href='' data-bs-toggle="modal"
                                                                    data-bs-target="#categoryModal{{ $list->categoryId }}">
                                                                    <i class="ri-pencil-line"></i>
                                                                </a>
                                                            </div>
                                                        </td>

                                                        <td data-label="タイトル" style="font-size: 14px;">
                                                            <div style="vertical-align: middle;">
                                                                {!! $list->sub_category_titlename !!}
                                                                <a href='' data-bs-toggle="modal"
                                                                    data-bs-target="#subTitleModal{{ $list->subCatTitleId }}">
                                                                    <i class="ri-pencil-line"></i>
                                                                </a>
                                                            </div>
                                                        </td>

                                                        <td data-label="タイトル" style="font-size:14px;">
                                                            {{ $list->sub_category_name }}
                                                        </td>
                                                        <td>
                                                            <ul>
                                                                @php
                                                                    $id = '0';
                                                                    $type = 0;

                                                                    if ($list->subCatId != null) {
                                                                        $id = $list->subCatId;
                                                                        $type = 3;
                                                                    } elseif ($list->subCatTitleId != null) {
                                                                        $id = $list->subCatTitleId;
                                                                        $type = 2;
                                                                    } elseif ($list->subCatId == null) {
                                                                        $id = $list->categoryId;
                                                                        $type = 1;
                                                                    }

                                                                @endphp

                                                                <li>
                                                                    <a
                                                                        href='{{ url('/editsubcategory/' . $type . '/' . $id) }}'>
                                                                        <i class="ri-pencil-line"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    @if (empty($list->sub_category_name) || $list->category == 'Special Corner')
                                                                        {{-- <a href='{{ url("/deletecategory/".$type.'/'.$id ) }}'>
                                                                <i class="ri-delete-bin-line"></i>
                                                                </a> --}}
                                                                        <a href="javascript:void(0)"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#deleteConfirmModal{{ $id . $type }}">
                                                                            <i class="ri-delete-bin-line"></i>
                                                                        </a>
                                                                    @endif
                                                                </li>
                                                            </ul>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endif
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                @include('components.pagination')
            </div>

        </div>

        <!-- Delete Modal Box Start -->
        @foreach ($lists as $key => $list)
            @php
                $id = '0';
                $type = 0;
                if ($list->subCatId != null) {
                    $id = $list->subCatId;
                    $type = 3;
                } elseif ($list->subCatTitleId != null) {
                    $id = $list->subCatTitleId;
                    $type = 2;
                } else {
                    $id = $list->categoryId;
                    $type = 1;
                }
            @endphp

            <div class="modal fade theme-modal remove-coupon" id="deleteConfirmModal{{ $id . $type }}"
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
                                <p>Category will deleted.</p>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <form method="POST" action="{{ route('deletecategory') }}" style="display:flex;">
                                @csrf
                                <input type="hidden" name="id" value="{{ $id }}">
                                <input type="hidden" name="type" value="{{ $type }}">
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

        <div class="modal fade theme-modal remove-commission" id="categoryModal{{ $list->categoryId }}"
            aria-hidden="true" aria-labelledby="subTitleModalLabel{{ $list->categoryId }}" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit Category</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                            <i class="fas fa-times"></i>
                        </button>
                    </div>
                    <form method="POST" action="{{ route('updatecategory_Name') }}">
                        @csrf
                        <div class="modal-body">

                            <div class="form-group">
                                <input type="text" class="form-control" id="category{{ $list->categoryId }}"
                                    value="{{ old('category') ?? ($list->category ?? '') }}" name="category"
                                    placeholder={{ $list->category }}>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <input type="hidden" id="category-id{{ $list->categoryId }}" name="categoryid"
                                value="{{ $list->categoryId }}">
                            <input type="hidden" name="id" value="{{ $list->categoryId }}">
                            <button type="submit" class="btn btn-animation btn-md fw-bold me-2">Save</button>
                            <button type="button" class="btn btn-animation btn-md fw-bold me-2"
                                data-bs-dismiss="modal"
                                style="background-color: #ff6b6b;border-color: #ff6b6b;">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>


        <div class="modal fade theme-modal remove-coupon" id="exampleModalToggle2" aria-hidden="true"
            tabindex="-1">
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
        <!-- All User Table Ends-->
        @foreach ($lists as $key => $list)
            {{-- <div class="modal fade theme-modal remove-commission" id="subTitleModal{{ $list->subCatTitleId }}"
    aria-labelledby="subTitleModalLabel{{ $list->subCatTitleId }}" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-block text-center">
                <h5 class="modal-title w-100" id="exampleModalLabel22">
                    Edit SubCategoryTitle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <form id="commission-form{{ $list->subCatTitleId }}" method="POST" action="{{ route('updatesubcat_Name') }}"
                style="display:flex;">
                @csrf
                <div class="modal-body">

                    <div class="form-group">
                        <input type="text" class="form-control" id="subcat{{ $list->subCatTitleId }}"
                            value="{{ old('subcat') ?? ($list->sub_category_titlename ?? '') }}" name="subcat"
                            placeholder={{ $list->sub_category_titlename }}>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="subcat-id{{ $list->subCatTitleId }}" name="subcatid"
                        value="{{ $list->subCatTitleId }}">
                    <input type="hidden" name="id" value="{{ $list->subCatTitleId }}">
                    <button type="submit" class="btn btn-animation btn-md fw-bold me-2">Save</button>
            </form>
            <button type="button" class="btn btn-animation btn-md fw-bold me-2" data-bs-dismiss="modal"
                style="background-color: #ff6b6b;border-color: #ff6b6b;">Cancel</button>

        </div>
    </div>
    </div> --}}

            <div class="modal fade theme-modal remove-commission" id="subTitleModal{{ $list->subCatTitleId }}"
                aria-hidden="true" aria-labelledby="subTitleModalLabel{{ $list->subCatTitleId }}" tabindex="-1">
                <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Edit Subtitle Category</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                <i class="fas fa-times"></i>
                            </button>
                        </div>
                        <form method="POST" action="{{ route('updatesubcat_Name') }}">
                            @csrf
                            <div class="modal-body">

                                <div class="form-group">
                                    <input type="text" class="form-control" id="subcat{{ $list->subCatTitleId }}"
                                        value="{{ old('subcat') ?? ($list->sub_category_titlename ?? '') }}"
                                        name="subcat" placeholder={{ $list->sub_category_titlename }}>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <input type="hidden" id="subcat-id{{ $list->subCatTitleId }}" name="subcatid"
                                    value="{{ $list->subCatTitleId }}">
                                <input type="hidden" name="id" value="{{ $list->subCatTitleId }}">
                                <button type="submit" class="btn btn-animation btn-md fw-bold me-2">Save</button>
                                <button type="button" class="btn btn-animation btn-md fw-bold me-2"
                                    data-bs-dismiss="modal"
                                    style="background-color: #ff6b6b;border-color: #ff6b6b;">Cancel</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach

    </div>

</x-auth-layout>
