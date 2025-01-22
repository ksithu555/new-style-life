@extends('seller.seller_dashboard')
@section('seller')
<!-- Page Sidebar Start -->
<div class="page-body">
    <!-- New User start -->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-8 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="tab-content" id="pills-tabContent">
                                    @if ($start)
                                    <div class="tab-pane fade show active" id="pills-home" role="tabpanel">
                                        <form method="GET" action="{{ route('help.add') }}" class="theme-form theme-form-2 mega-form" >
                                            @csrf
                                            <div class="card-header-1">
                                                <h5>Contact</h5>
                                            </div>
                                            <div class="mb-4 row">
                                                <div class="row align-items-center">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label form-label-title">
                                                            Conversation with
                                                        </label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <h4>
                                                            @if ($start->from == Auth::user()->email)
                                                                @php
                                                                $converWith = DB::table('users')->where('email', $start->to)->first();
                                                                @endphp
                                                            @else
                                                                @php
                                                                $converWith = DB::table('users')->where('email', $start->from)->first();
                                                                @endphp
                                                            @endif
                                                            {{ $converWith->name }}
                                                        </h4>
                                                    </div>
                                                </div>

                                                <div class="row align-items-center">
                                                    <div class="col-md-4">
                                                        <label class="col-form-label form-label-title">
                                                            Subject
                                                        </label>
                                                    </div>
                                                    <div class="col-md-8">
                                                        <h4>
                                                            {{ $start->subject }}
                                                        </h4>
                                                    </div>
                                                </div>
                                            </div>

                                            @if(isset($reply))
                                                @foreach ($reply as $item)
                                                <div class="mb-4 row" style="background-color: #F3F3F3;">
                                                    @if (!empty($item->img))
                                                        <div class="mb-4 row align-items-center">
                                                            <label class="col-lg-2 col-md-3 col-form-label form-label-title"></label>
                                                            <div class="col-md-9 col-lg-10">
                                                                <img width="100" src="{{ asset('images/'.$item->img) }}">
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <div class="row align-items-center">
                                                        <label class="col-lg-2 col-md-3 col-form-label form-label-title">
                                                            @if ($item->from == Auth::user()->email)
                                                            Me
                                                            @else
                                                            {{ $converWith->name }}
                                                            @endif
                                                        </label>
                                                        <div class="col-md-9 col-lg-10">
                                                            <p>{{ $item->body }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endforeach
                                            @endif


                                            <div class="d-grid gap-2 d-md-block"  style="margin-top: 20px;">
                                                <a href="#" data-bs-toggle="modal" data-bs-target="#replyModal">
                                                    <button class="btn btn-animation" type="button">Reply</button>
                                                </a>
                                            </div>
                                        </form>
                                    </div>
                                    @else
                                    <h3>This contact have been deleted!</h3>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- New User End -->
</div>
<!-- Page Sidebar End -->

<!-- Reply Modal -->
<div class="modal fade theme-modal remove-coupon" id="replyModal" aria-hidden="true" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header d-block">
                <h5 class="modal-title" >Reply</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                    <i class="fas fa-times"></i>
                </button>
            </div>
            <div class="modal-body">
                <form method="POST" action="{{ route('reply.sent') }}" enctype="multipart/form-data">
                    <input type="hidden" name="id" value="{{ $start->id }}">
                    @csrf
                    <div class="mb-2 row align-items-center">
                        <label
                            class="col-lg-2 col-md-3 col-form-label form-label-title">Image</label>
                        <div class="col-md-9 col-lg-10">
                            <input class="form-control" type="file" name="image" onchange="validateImage(this)">
                            <img src="" id="mainThmb">
                        </div>
                    </div>

                    <div class="row align-items-center">
                        <label
                            class="col-lg-2 col-md-3 col-form-label form-label-title">Body
                            </label>
                        <div class="col-md-9 col-lg-10">
                            <textarea class="form-control" name="body" id="" rows="8"></textarea>
                            <p style="display:none" class="body error text-danger"></p>
                            @if (!empty($error['body']))
                                @foreach ($error['body'] as  $key => $value)
                                    <p class="body error text-danger">{{ $value }}</p>
                                @endforeach
                            @endif
                        </div>
                    </div>
            </div>
            <div class="modal-footer">
                    <button type="submit" class="btn btn-animation">Reply</button>
                </form>
                <button type="button" class="btn btn-animation btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>
<!-- Reply Modal End-->
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
                    var img = document.getElementById('mainThmb');
                    img.src = e.target.result;
                    img.style.width = '100px';
                    img.style.height = '100px';
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
    }
</script>
@endsection