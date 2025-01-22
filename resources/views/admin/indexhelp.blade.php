<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/fontawesome.min.css" integrity="sha512-UuQ/zJlbMVAw/UU8vVBhnI4op+/tFOpQZVT+FormmIEhRSCnJWyHiBbEVgM4Uztsht41f3FzVWgLuwzUqOObKw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/js/all.min.js" integrity="sha512-u3fPA7V8qQmhBPNT5quvaXVa1mnnLSXUep5PS1qo5NRzHwG19aHmNJnj1Q8hpA/nBWZtZD4r4AX6YOt5ynLN2g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<x-auth-layout>
    <!-- Create Coupon Table start -->
    <div class="page-body">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        @include('components.messagebox')
                        <div class="col-sm-12">
                            <div class="card">
                                <div class="card-body">
                                    <div class="title-header option-title d-sm-flex d-block">
                                        <h5>Contact</h5>
                                    </div>
                                    <div class="product-section-box ">
                                        <ul class="nav nav-tabs custom-nav right-options" id="myTab" role="tablist">
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link active" id="description-tab" data-bs-toggle="tab" data-bs-target="#description" type="button" role="tab"><i class="icon-cloud-down">Inbox</i></button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#info" type="button" role="tab"><i class="icon-cloud-up">Sent</i></button>
                                            </li>
                                            <li class="nav-item" role="presentation">
                                                <button class="nav-link" id="notice-tab" data-bs-toggle="tab" data-bs-target="#notice" type="button" role="tab"><i class="icon-cloud-up">Notice</i></button>
                                            </li>
                                        </ul>

                                        <div class="tab-content custom-tab" id="myTabContent">
                                            <div class="tab-pane fade show active" id="description" role="tabpanel">
                                                <!-- Content for Description tab -->
                                                <div class="table-responsive category-table">
                                                    <table class="table all-package theme-table" id="table_id">
                                                        <thead>
                                                            <tr>
                                                                <th>Title</th>
                                                                <th>Sender</th>
                                                                <th>Shop Name</th>
                                                                <th>Content</th>
                                                                <th>Date</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if ($received->isEmpty())
                                                            <tr>
                                                                <td colspan="9">No data available</td>
                                                            </tr>
                                                            @else
                                                            @foreach ($received as $item)
                                                            <tr>
                                                                <td>{{ $item->subject }}</td>
                                                                <td>{{ $item->name }}<br>{{ $item->from }}
                                                                </td>
                                                                <td>{{ $item->shop_name }}</td>
                                                                <td>{{ mb_strlen($item->body) > 50 ? mb_substr($item->body, 0, 50) . '...' : $item->body }}
                                                                </td>
                                                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y/m/d') }}<br>
                                                                    {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}
                                                                </td>
                                                                <td>
                                                                    <ul>
                                                                        <li>
                                                                            <a href="#" data-bs-toggle="modal" data-bs-target="#replyReceiveModal{{ $item->id }}">
                                                                                <i class="fa-solid fa-reply"></i>
                                                                            </a>
                                                                        </li>
                                                                        <li>
                                                                            <a href='{{ url('/helpdetails/' . $item->id) }}'>
                                                                                <i class="ri-eye-line"></i>
                                                                            </a>

                                                                        </li>
                                                                        <li>
                                                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deletereceiveModalToggle{{ $item->id }}">
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
                                                <div>
                                                    @include('components.pagination')
                                                </div>
                                            </div>


                                            <div class="tab-pane fade" id="notice" role="tabpanel">
                                                <div class="right-options" style="text-align:right;margin-bottom:20px">
                                                    <ul>
                                                        <li>
                                                            <a class="btn btn-solid" href="{{ route('admin.addnotice') }}">Notice</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="table-responsive category-table">
                                                    <table class="table all-package theme-table" id="table_id">
                                                        <thead>
                                                            <tr>
                                                                <th>Title</th>
                                                                <th>Name</th>
                                                                <th>Content</th>
                                                                <th>Date</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if ($notice->isEmpty())
                                                            <tr>
                                                                <td colspan="9">No data available</td>
                                                            </tr>
                                                            @else
                                                            @foreach ($notice as $item)
                                                            <tr>
                                                                <td>{{ $item->subject }}</td>
                                                                <td>All Seller</td>
                                                                <td>{{ mb_strlen($item->body) > 50 ? mb_substr($item->body, 0, 50) . '...' : $item->body }}
                                                                </td>
                                                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y/m/d') }}<br>
                                                                    {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}
                                                                </td>
                                                                <td>
                                                                    <ul>
                                                                        <li>
                                                                            <a href='{{ url('/helpdetails/' . $item->id) }}'>
                                                                                <i class="ri-eye-line"></i>
                                                                            </a>

                                                                        </li>
                                                                        <li>
                                                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deletenoticeModalToggle{{ $item->id }}">
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
                                                @php
                                                    $ttlpage = $sent_ttlpage;
                                                @endphp
                                                <div>
                                                    @include('components.pagination')
                                                </div>

                                            </div>

                                            <div class="tab-pane fade" id="info" role="tabpanel">
                                                <div class="right-options" style="text-align:right;margin-bottom:20px">
                                                    <ul>
                                                        <li>
                                                            <a class="btn btn-solid" href="{{ route('admin.addhelp') }}">Contact</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="table-responsive category-table">
                                                    <table class="table all-package theme-table" id="table_id">
                                                        <thead>
                                                            <tr>
                                                                <th>Title</th>
                                                                <th>Receiver</th>
                                                                <th>Shop Name</th>
                                                                <th>Content</th>
                                                                <th>Date</th>
                                                                <th></th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @if ($sent->isEmpty())
                                                            <tr>
                                                                <td colspan="9">No data available</td>
                                                            </tr>
                                                            @else
                                                            @foreach ($sent as $item)
                                                            <tr>
                                                                <td>{{ $item->subject }}</td>
                                                                <td>
                                                                    @if ($item->name == 'admin')
                                                                    {{ $item->name }}<br>{{ $item->to }}
                                                                    @else
                                                                    {{ $item->name }}<br>{{ $item->to }}
                                                                    @endif
                                                                </td>
                                                                <td>{{ $item->shop_name }}</td>
                                                                <td>{{ mb_strlen($item->body) > 50 ? mb_substr($item->body, 0, 50) . '...' : $item->body }}
                                                                </td>
                                                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('Y/m/d') }}<br>
                                                                    {{ \Carbon\Carbon::parse($item->created_at)->format('H:i') }}
                                                                </td>
                                                                <td>
                                                                    <ul>
                                                                        <li>
                                                                            <a href='{{ url('/helpdetails/' . $item->id) }}'>
                                                                                <i class="ri-eye-line"></i>
                                                                            </a>

                                                                        </li>
                                                                        <li>
                                                                            <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#deleteModalToggle{{ $item->id }}">
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
                                                @php
                                                    $ttlpage = $notice_ttlpage;
                                                @endphp
                                                <div>
                                                    @include('components.pagination')
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Create Coupon Table End -->

    <!-- Reply Modal -->
    @foreach ($received as $item)
    <div class="modal fade theme-modal remove-coupon" id="replyReceiveModal{{ $item->id }}" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <h5 class="modal-title">Reply</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('emailreply') }}" class="theme-form theme-form-2 mega-form" enctype="multipart/form-data">
                        @csrf

                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <input type="hidden" name="help_id" value="{{ $item->help_id }}">
                        <input type="hidden" name="subject" value="{{ $item->subject }}">

                        <div class="mb-2 row align-items-center">
                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Image</label>
                            <div class="col-md-9 col-lg-10">
                                <input class="form-control" type="file" id="image" name="image" onchange="validateImage(this)">
                                <img src="" id="mainThmb">
                                <span class="error" style="color:red" id="error-image"></span>
                            </div>
                        </div>

                        {{-- <div class="mb-2 row align-items-center">
                        <label
                            class="col-lg-2 col-md-3 col-form-label form-label-title">Image</label>
                        <div class="col-md-9 col-lg-10">
                            <input class="form-control" type="file" name="image" id="image" onchange="mainThamUrl(this)">
                            <img src="" id="mainThmb">
                        </div>
                    </div> --}}

                        <div class="row align-items-center">
                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Body
                            </label>
                            <div class="col-md-9 col-lg-10">
                                <textarea class="form-control" name="message" id="message" rows="8"></textarea>
                                <p style="display:none" class="body error text-danger"></p>
                                @if (!empty($error['body']))
                                @foreach ($error['body'] as $key => $value)
                                <p class="body error text-danger">{{ $value }}</p>
                                @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-animation">Reply</button>
                            <button type="button" class="btn btn-animation" data-bs-dismiss="modal" style="background-color: #ff6b6b;border-color: #ff6b6b;">Cancel</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    @endforeach
    <!-- Reply Modal End-->

    <!-- Reply Modal -->
    @foreach ($sent as $item)
    <div class="modal fade theme-modal remove-coupon" id="replyModal{{ $item->id }}" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-block">
                    <h5 class="modal-title">Reply</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('reply.sent') }}" class="theme-form theme-form-2 mega-form">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <input type="hidden" name="subject" value="{{ $item->subject }}">
                        <div class="mb-2 row align-items-center">
                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Image</label>
                            <div class="col-md-9 col-lg-10">
                                <input class="form-control" type="file" name="image" onchange="mainThamUrl(this)">
                                <img src="" id="mainThmb">
                            </div>
                        </div>

                        <div class="row align-items-center">
                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Body
                            </label>
                            <div class="col-md-9 col-lg-10">
                                <textarea class="form-control" name="body" id="" rows="8"></textarea>
                                <p style="display:none" class="body error text-danger"></p>
                                @if (!empty($error['body']))
                                @foreach ($error['body'] as $key => $value)
                                <p class="body error text-danger">{{ $value }}</p>
                                @endforeach
                                @endif
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-animation">Reply</button>
                            <button type="button" class="btn btn-animation" data-bs-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
    @endforeach
    <!-- Reply Modal End-->

    <!-- Delete Modal Box Start -->
    @foreach ($sent as $key => $item)
    <div class="modal fade theme-modal remove-coupon" id="deleteModalToggle{{ $item->id }}" aria-hidden="true" tabindex="-1">
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
                    <form method="POST" action="{{ route('noticedelete') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <button type="submit" class="btn btn-animation btn-md fw-bold">Yes</button>
                    </form>
                    <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal" style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- Delete Modal Box End -->


    <!-- Delete Modal Box Start -->
    @foreach ($received as $key => $item)
    <div class="modal fade theme-modal remove-coupon" id="deletereceiveModalToggle{{ $item->id }}" aria-hidden="true" tabindex="-1">
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
                    <form method="POST" action="{{ route('noticedelete') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <button type="submit" class="btn btn-animation btn-md fw-bold">Yes</button>
                    </form>
                    <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal" style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- Delete Modal Box End -->


    <!-- Delete Modal Box Start -->
    @foreach ($notice as $key => $item)
    <div class="modal fade theme-modal remove-coupon" id="deletenoticeModalToggle{{ $item->id }}" aria-hidden="true" tabindex="-1">
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
                    <form method="POST" action="{{ route('noticedelete') }}">
                        @csrf
                        <input type="hidden" name="id" value="{{ $item->id }}">
                        <button type="submit" class="btn btn-animation btn-md fw-bold">Yes</button>
                    </form>
                    <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal" style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <!-- Delete Modal Box End -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var descriptionTab = document.getElementById('description-tab');
            var infoTab = document.getElementById('info-tab');
            var noticeTab = document.getElementById('notice-tab');
            var infoPane = document.getElementById('info');
            var noticePane = document.getElementById('notice');
            var descriptionPane = document.getElementById('description');

            function toggleTabs(activeTab) {
                if (activeTab === 'description') {
                    descriptionPane.style.display = 'block';
                    infoPane.style.display = 'none';
                    noticePane.style.display = 'none';
                } else if (activeTab === 'info') {
                    descriptionPane.style.display = 'none';
                    infoPane.style.display = 'block';
                    noticePane.style.display = 'none';
                } else if (activeTab === 'notice') {
                    descriptionPane.style.display = 'none';
                    infoPane.style.display = 'none';
                    noticePane.style.display = 'block';
                }
            }

            // Initially hide the other tabs
            toggleTabs('description');

            descriptionTab.addEventListener('click', function() {
                toggleTabs('description'); // Show only the description tab content
            });

            infoTab.addEventListener('click', function() {
                toggleTabs('info'); // Show only the info tab content
            });

            noticeTab.addEventListener('click', function() {
                toggleTabs('notice'); // Show only the notice tab content
            });
        });
    </script>

    <script>
        function validateImage(input) {
            var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif)$/i;
            if (!allowedExtensions.exec(input.value)) {
                // alert('Invalid file type. Only images (JPG, JPEG, PNG, GIF) are allowed.');
                document.getElementById('error-image').textContent =
                    'Invalid file type. Only images (JPG, JPEG, PNG, GIF) are allowed.';
                input.value = '';
                return false;
            } else {
                if (input.files && input.files[0]) {
                    var reader = new FileReader();
                    reader.onload = function(e) {
                        document.getElementById('mainThmb').src = e.target.result;
                        document.getElementById('mainThmb').style.width = '100px';
                    }
                    reader.readAsDataURL(input.files[0]);
                }
            }
        }
    </script>
</x-auth-layout>