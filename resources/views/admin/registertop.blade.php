<x-auth-layout>

    <style>
        .error{
            margin:0 auto;
            display:flex;
        }
    </style>

   <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    @php $error = $errors->toArray(); if(!isset($editmode)){$editmode = false;} if(!isset($editother)){$editother = false;}
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
                                        <h5>Edit Top page</h5>
                                    </div>
                                    @php $action= route('registertop'); @endphp

                                    <form class="theme-form theme-form-2 mega-form" id="registertop" class="contact-form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                                        @csrf

                                        @if ($editmode)
                                        <input type="hidden" name="id" value="{{ $data->id }}">
                                        @endif

                                        <div class="mb-4 row  align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Discount</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" placeholder="discount" name="discount" id="phaseone"
                                                    value="{{ old('discount') ?? $data->discount ?? '' }}" disabled>
                                                <p style="display:none" class="discount error text-danger"></p>
                                                    @if (!empty($error['discount']))
                                                        @foreach ($error['discount'] as  $key => $value)
                                                            <p class="discount error text-danger">{{ $value }}</p>
                                                        @endforeach
                                                    @endif
                                            </div>
                                        </div>

                                        <div class="mb-4 row  align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Phase one</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" placeholder="Blog Name" name="phaseone" id="phaseone"
                                                    value="{{ old('phaseone') ?? $data->phaseone ?? '' }}">
                                                <p style="display:none" class="phaseone error text-danger"></p>
                                                    @if (!empty($error['phaseone']))
                                                        @foreach ($error['phaseone'] as  $key => $value)
                                                            <p class="phaseone error text-danger">{{ $value }}</p>
                                                        @endforeach
                                                    @endif
                                            </div>
                                        </div>

                                        @if(!empty($data->phasetwo))
                                        <div class="mb-4 row  align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Phase two</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" placeholder="Blog Name" name="phasetwo" id="phasetwo"
                                                    value="{{ old('phasetwo') ?? $data->phasetwo ?? '' }}">
                                                <p style="display:none" class="phasetwo error text-danger"></p>
                                                    @if (!empty($error['phasetwo']))
                                                        @foreach ($error['phasetwo'] as  $key => $value)
                                                            <p class="phasetwo error text-danger">{{ $value }}</p>
                                                        @endforeach
                                                    @endif
                                            </div>
                                        </div>
                                        @endif

                                        @if(!empty($data->phasethree))
                                        <div class="mb-4 row  align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Phase three</label>
                                            <div class="col-sm-9">
                                                <textarea class="form-control" placeholder="Blog Name" name="phasethree" id="phasethree" rows="4">{{ old('phasethree') ?? $data->phasethree ?? '' }}</textarea>
                                                <p style="display:none" class="phasethree error text-danger"></p>
                                                    @if (!empty($error['phasethree']))
                                                        @foreach ($error['phasethree'] as  $key => $value)
                                                            <p class="phasethree error text-danger">{{ $value }}</p>
                                                        @endforeach
                                                    @endif
                                            </div>
                                        </div>
                                        @endif

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-sm-3 col-form-label form-label-title">Select Image</label>
                                            <div class="col-sm-9">
                                                <input type="file" name="image" id="image" class="form-control" >
                                                <img id="preview-image-before-upload" alt="your image"
                                                    @if(!empty($data->image))
                                                        src="{{ asset('frontend/assets/images/furniture/banner/'.($data->image ?? 'images/'.($data->image))  ) }}"
                                                        style="max-width: 100%;"
                                                    @else
                                                        style="display: none; max-width: 100%;"
                                                    @endif
                                                />
                                                <p style="display:none" class="image error text-danger"></p>
                                                    @if (!empty($error['image']))
                                                        @foreach ($error['image'] as  $key => $value)
                                                            <p class="image error text-danger">{{ $value }}</p>
                                                        @endforeach
                                                    @endif
                                            </div>
                                        </div>

                                        <button class="btn btn-submit btn-animation ms-auto fw-bold" type="button"data-bs-toggle="modal"
                                                data-bs-target="#confirmModal">
                                            @if (!$editmode)
                                                <i class="fa fa-user-plus" aria-hidden="true"></i>
                                                Save
                                            @else
                                                <i class="fa fa-edit" aria-hidden="true"></i>
                                                Edit
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
                                                            <p>Top data will be updated.</p>
                                                        </div>
                                                    </div>

                                                    <div class="modal-footer">

                                                        <button type="submit" class="btn btn-animation btn-md fw-bold me-2">
                                                            @if (!$editmode)
                                                                Yes
                                                            @else
                                                                Yes
                                                            @endif
                                                        </button>
                                                        <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal"
                                                        style="background-color: #ff6b6b;border-color: #ff6b6b;">No</button>
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
        document.getElementById("image").addEventListener("change", function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImage = document.getElementById("preview-image-before-upload");
                    previewImage.src = e.target.result;
                    previewImage.style.display = "block";
                }
                reader.readAsDataURL(file);
            }
        });
    </script>
    <script>
        document.getElementById("image").addEventListener("change", function() {
            const file = this.files[0];
            const allowedTypes = ["image/jpeg", "image/jpg", "image/png", "image/gif"]; // Add more types if needed
            if (file && allowedTypes.includes(file.type)) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const previewImage = document.getElementById("preview-image-before-upload");
                    previewImage.src = e.target.result;
                    previewImage.style.display = "block";
                    document.querySelector(".image.error").style.display = "none";
                }
                reader.readAsDataURL(file);
            } else {
                // Show error message
                document.querySelector(".image.error").style.display = "block";
                document.querySelector(".image.error").innerText = "Please select a valid image file (JPEG, PNG, GIF,JPG).";
                // Clear the file input
                this.value = null;
            }
        });
    </script>


    </x-auth-layout>
