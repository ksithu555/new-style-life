



<x-auth-layout>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
   <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <style>
        .error{
            margin:0 auto;
            display:flex;
        }
    </style>

    @php $error = $errors->toArray(); if(!isset($editmode)){$editmode = false;} if(!isset($editother)){$editother = false;}
    @endphp
    <div class="page-body">
    <!-- New Coupon Add Start -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-8 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header-2">
                                        <h5>Coupon Information</h5>
                                    </div>
                                    @php $action= route('registercoupon'); @endphp
                                    <form class="theme-form theme-form-2 mega-form" id="registercoupon" class="contact-form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                                        @csrf
                                            @if ($editmode)
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                            @endif

                                            <div class="mb-4 row  align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Name</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" placeholder="Coupon Name" name="title" id="title"
                                                        value="{{ old('title') ?? $data->name ?? '' }}">
                                                    <p style="display:none" class="title error text-danger"></p>
                                                        @if (!empty($error['title']))
                                                            @foreach ($error['title'] as  $key => $value)
                                                                <p class="title error text-danger">{{ $value }}</p>
                                                            @endforeach
                                                        @endif
                                                </div>
                                            </div>

                                            <div class="mb-4 row  align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Coupon Code</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" placeholder="Coupon Code" name="code" id="code"
                                                        value="{{ old('code') ?? $data->coupon_code ?? '' }}">
                                                    <p style="display:none" class="code error text-danger"></p>
                                                        @if (!empty($error['code']))
                                                            @foreach ($error['code'] as  $key => $value)
                                                                <p class="code error text-danger">{{ $value }}</p>
                                                            @endforeach
                                                        @endif
                                                </div>
                                            </div>


                                            <div class="mb-4 row  align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Discount Amount</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="number" placeholder="Discount Amount" name="disamount" id="disamount"
                                                        value="{{ old('disamount') ?? $data->discount_amount ?? '' }}">
                                                    <p style="display:none" class="disamount error text-danger"></p>
                                                        @if (!empty($error['disamount']))
                                                            @foreach ($error['disamount'] as  $key => $value)
                                                                <p class="disamount error text-danger">{{ $value }}</p>
                                                            @endforeach
                                                        @endif
                                                </div>
                                            </div>

                                            <div class="mb-4 row  align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Minimum Amount</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="number" placeholder="Minimum Amount" name="miniamount" id="miniamount"
                                                        value="{{ old('miniamount') ?? $data->mini_amount ?? '' }}">
                                                    <p style="display:none" class="miniamount error text-danger"></p>
                                                        @if (!empty($error['miniamount']))
                                                            @foreach ($error['miniamount'] as  $key => $value)
                                                                <p class="miniamount error text-danger">{{ $value }}</p>
                                                            @endforeach
                                                        @endif
                                                </div>
                                            </div>


                                            <div class="mb-4 row  align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Valid Count</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="number" placeholder="Valid Count" name="validcount" id="validcount"
                                                        value="{{ old('validcount') ?? $data->valid_count ?? '' }}">
                                                    <p style="display:none" class="validcount error text-danger"></p>
                                                        @if (!empty($error['validcount']))
                                                            @foreach ($error['validcount'] as  $key => $value)
                                                                <p class="validcount error text-danger">{{ $value }}</p>
                                                            @endforeach
                                                        @endif
                                                </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0" for="startdate">Start Date</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="date" placeholder="Start Date" name="startdate"
                                                        id="startdate" value="{{ !empty($data->startdate) ? date('Y-m-d', strtotime($data->startdate)) : 'no data' }}">
                                                    <p style="display:none" class="startdate error text-danger"></p>
                                                    @if (!empty($error['startdate']))
                                                        @foreach ($error['startdate'] as $key => $value)
                                                            <p class="startdate error text-danger">{{ $value }}</p>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0" for="enddate">End Date</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="date" placeholder="End Date" name="enddate"
                                                        id="enddate" value="{{ !empty($data->enddate) ? date('Y-m-d', strtotime($data->enddate)) : 'no data' }}">
                                                    <p style="display:none" class="enddate error text-danger"></p>
                                                    @if (!empty($error['enddate']))
                                                        @foreach ($error['enddate'] as $key => $value)
                                                            <p class="enddate error text-danger">{{ $value }}</p>
                                                        @endforeach
                                                    @endif
                                                </div>
                                            </div>

                                            <button type="button" class="btn btn-submit btn-animation ms-auto fw-bold">
                                                @if (!$editmode)
                                                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                                                       Save
                                                @else
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                        Edit
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
                                                        @if (!$editmode)
                                                        <p>Coupon data will be added.</p>
                                                        @else
                                                        <p>Coupon data will be updated.</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-submit btn-animation btn-md fw-bold me-2">
                                                        Yes
                                                    </button>
                                                    <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal"
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
        <!-- New Coupon Add End -->
    </div>

    <script>
        ClassicEditor
            .create(document.querySelector('#ckeditor'))
            .catch(error => {
                console.error(error);
            });
    </script>
    <script>
        function mainThamUrl(input){
            if(input.files && input.files[0]){
                var reader = new FileReader();
                reader.onload = function(e){
                    $('#mainThmb').attr('src', e.target.result).width(70).height(70);
                };
                reader.readAsDataURL(input.files[0]); // Corrected method name
            }
        }
    </script>
    <script>
        document.getElementById('multiImg').addEventListener('change', function(event) {
            const preview = document.getElementById('preview_img');
            preview.innerHTML = '';

            Array.from(event.target.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '100px';
                    img.style.maxHeight = '100px';
                    preview.appendChild(img);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>

    <script>
        function selectIcon(iconPath) {
            document.getElementById('selectedIcon').value = iconPath;
            document.getElementById('selectedIconPreview').src = iconPath;
            document.getElementById('selectedIconPreview').style.display = 'block';
        }
    </script>

<script>
    $('.btn-submit').click(function() {

        $('.error').hide();

        // var imageSrc = $.trim($("#image").val());
        // var imageSrcs = $.trim($("#preview-image-before-upload").attr('src'));

if ($.trim($("#title").val()) === "" || $.trim($("#code").val()) === "" || $.trim($("#disamount").val()) === "" || $.trim($("#miniamount").val()) === ""
|| $.trim($("#validcount").val()) === "" || $.trim($("#startdate").val()) === "" || $.trim($("#enddate").val()) === "") {
    if ($.trim($("#title").val()) === "") {
        $('.error.title').text('Coupon Name is required');
        $('.error.title').show();
    }

    if ($.trim($("#code").val()) === "") {
        $('.error.code').text('Coupon Code is required');
        $('.error.code').show();
    }

    if ($.trim($("#disamount").val()) === "") {
        $('.error.disamount').text('Discount Amount is required');
        $('.error.disamount').show();
    }

    if ($.trim($("#miniamount").val()) === "") {
        $('.error.miniamount').text('Minimum Amount is required');
        $('.error.miniamount').show();
    }

    if ($.trim($("#validcount").val()) === "") {
        $('.error.validcount').text('Valid Count is required');
        $('.error.validcount').show();
    }

    if ($.trim($("#startdate").val()) === "") {
        $('.error.startdate').text('StartDate is required');
        $('.error.startdate').show();
    }

    if ($.trim($("#enddate").val()) === "") {
        $('.error.enddate').text('EndDate is required');
        $('.error.enddate').show();
    }

    return false;
} else {

    $('.error').hide()
$('#confirmModal').modal('show');

}
});


    </script>

</x-auth-layout>