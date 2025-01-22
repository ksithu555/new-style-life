
<x-auth-layout>

    <style>
        .table>:not(caption)>*>*
        {
            border-bottom-width:0px !important;
        }
    </style>

    <div class="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card card-table">
                        <div class="card-body">
                            <div class="title-header option-title d-sm-flex d-block">
                                <h5>All SubAdmin</h5>
                                <form class="d-inline-flex">
                                    <a href="{{ url('/admin/registersubadmin' ) }}"
                                        class="align-items-center btn btn-theme d-flex">
                                            <i data-feather="plus-square"></i>Add New
                                    </a>
                                </form>
                            </div>
                            <div>
                                <div class="table-responsive">
                                    <table class="table all-package theme-table table-product" id="table_id">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Date</th>
                                                <th>Name</th>
                                                <th>Email</th>
                                                <th>Type</th>
                                                <th>Status</th>
                                                <th>Option</th>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @if ($subadmins->isEmpty())
                                                <tr>
                                                    <td colspan="9">No data available</td>
                                                </tr>
                                            @else
                                                @foreach( $subadmins as $key => $user )

                                                    <tr>
                                                        <th data-label="登録日" class="text-center">{{ ($ttl+1) - ($subadmins->firstItem() + $key) }}</th>
                                                        <td data-label="登録日">{{ date('Y/m/d', strtotime($user->created_at)) }}<br>{{ date('H:i', strtotime($user->created_at)) }}</td>
                                                        <td data-label="氏名"><a @if($user->role == 'buyer') href="{{ url('/takeremote/'.rand ( 10000 , 99999 ).$user->id ) }}" @endif
                                                            @if($user->role == 'seller') href="{{ url('/takeremote/'.rand ( 10000 , 99999 ).$user->id ) }}" @endif
                                                        >{{ $user->name }}</a></td>
                                                        <td data-label="タイトル">{{ $user->email }}</td>
                                                        <td data-label="タイトル">{{ $user->role }}</td>
                                                        <td class="col-sm-9">
                                                            <label class="switch">
                                                                <input data-width="100" data-id="{{$user->id}}" class="toggle-class" type="checkbox"
                                                                data-offstyle="outline-secondary" data-toggle="toggle" data-on="Active"
                                                                data-off="InActive"  {{ $user->status ? 'checked' : '' }}>
                                                            </label>

                                                        </td>

                                                        <td>
                                                            <ul>
                                                                <li>
                                                                    <a href="{{ url("/subadmindetail/".$user->id ) }}">
                                                                        <i class="ri-eye-line"></i>
                                                                    </a>
                                                                </li>

                                                                <li>
                                                                    <a href="{{ url('/edit/'.$user->role.'/'.rand ( 10000 , 99999 ).$user->id ) }}">
                                                                        <i class="ri-pencil-line"></i>
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                        data-bs-target="#deleteConfirmModal{{ $user->id }}">
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
            @foreach( $subadmins as $key => $user )
                <div class="modal fade theme-modal remove-coupon" id="deleteConfirmModal{{ $user->id }}" aria-hidden="true" tabindex="-1">
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
                                    <p>This subadmin will be deleted.</p>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <form method="POST" action="{{ route('deletesubadmin') }}" style="display:flex;">
                                    @csrf
                                        <input type="hidden" name="id" value="{{ $user->id }}">
                                            <button type="submit"class="btn btn-animation btn-md fw-bold me-2" data-bs-target="#exampleModalToggle2"
                                                data-bs-toggle="modal" data-bs-dismiss="modal">Yes</button>
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

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

<script>
    $(function() {
        $('.toggle-class').change(function() {

            var status = $(this).prop('checked') ? 1 : 0;
            var userid = $(this).data('id');

            $.ajax({
                type: "POST",
                dataType: "json",
                url: "{{ route('subadminstataus') }}",
                data: {
                    'status': status,
                    'userid': userid,
                    '_token': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(data) {
                    alert(data.success);
                    console.log(data.success);
                }
            });
        });
    });
    </script>


</x-auth-layout>