<x-auth-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .table>:not(caption)>*>*
        {
            border-bottom-width:0px !important;
        }
    </style>

    <div class="page-body">
        <div class="container-fluid">
            @include('components.messagebox')
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">

                            <div class="title-header option-title d-sm-flex d-block">
                                <h5>NewsLetter</h5>
                            </div>
                            <div>
                                <div class="table-responsive">
                                    <table class="table all-package theme-table table-product" id="table_id">
                                        <thead>
                                            <tr>
                                                <th style="min-width: 50px">No</th>
                                                <th style="min-width: 50px">Date</th>
                                                <th style="min-width: 50px">Email</th>
                                                <th style="min-width: 50px">Option</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if ($lists->isEmpty())
                                                <tr>
                                                    <td colspan="9">No data available</td>
                                                </tr>
                                            @else
                                                @foreach( $lists as $key => $list )

                                                    <tr>
                                                        <td  class="text-center">{{ ($ttl+1) - ($lists->firstItem() + $key) }}</td>
                                                        <td data-label="登録日">{{ date('Y/m/d', strtotime($list->created_at)) }}<br>{{ date('H:i', strtotime($list->created_at)) }}</td>
                                                        <td data-label="タイトル">{{ $list->email }}</td>
                                                        <td>
                                                            <ul>
                                                                <li>
                                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                        data-bs-target="#deleteConfirmModal{{ $list->id }}">
                                                                        <i class="ri-delete-bin-line"></i>
                                                                    </a>
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
                    <!--pagination -->
                    @include('components.pagination')
            </div>
        </div>
        <!-- Container-fluid Ends-->
    </div>
        <!-- Delete Modal Box Start -->
            @foreach( $lists as $key => $list )
                <div class="modal fade theme-modal remove-coupon" id="deleteConfirmModal{{ $list->id }}" aria-hidden="true" tabindex="-1">
                    <div class="modal-dialog modal-dialog-centered">
                        <div class="modal-content">
                            <div class="modal-header d-block text-center">
                                <h5 class="modal-title w-100" id="exampleModalLabel22">Are You Sure ?</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                                        <i class="fas fa-times"></i>
                                    </button>
                            </div>
                            <div class="modal-body">
                                <div class="remove-box">
                                </div>
                            </div>

                            <div class="modal-footer">
                                <form method="POST" action="{{ route('deletenewsletter') }}" style="display:flex;">
                                    @csrf
                                        <input type="hidden" name="id" value="{{ $list->id }}">
                                            <button type="submit"class="btn btn-animation btn-md fw-bold me-2" data-bs-target="#exampleModalToggle2"
                                                data-bs-toggle="modal" data-bs-dismiss="modal">Yes</button>
                                            <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal">No</button>
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
                                        <circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" />
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
</x-auth-layout>
