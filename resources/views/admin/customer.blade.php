
<x-auth-layout>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <style>
        .error{
            margin:0 auto;
            display:flex;
        }
    </style>

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
                                        <h5>Customer Information</h5>
                                    </div>
                                    @php $action= route('registercustomer'); @endphp
                                    <form class="theme-form theme-form-2 mega-form" id="registercustomer" class="contact-form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                                        @csrf
                                            @if ($editmode)
                                                <input type="hidden" name="id" value="{{ $data->id }}">
                                            @endif

                                            <div class="mb-4 row  align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Title</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" placeholder="Title Name" name="title" id="title"
                                                        value="{{ old('title') ?? $data->title ?? '' }}">
                                                    <p style="display:none" class="title error text-danger"></p>
                                                        @if (!empty($error['title']))
                                                            @foreach ($error['title'] as  $key => $value)
                                                                <p class="title error text-danger">{{ $value }}</p>
                                                            @endforeach
                                                        @endif
                                                </div>
                                            </div>

                                            <div class="mb-4 row  align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">SubTitle</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" placeholder="subtitle Name" name="subtitle" id="subtitle"
                                                        value="{{ old('subtitle') ?? $data->subtitle ?? '' }}">
                                                    <p style="display:none" class="subtitle error text-danger"></p>
                                                        @if (!empty($error['subtitle']))
                                                            @foreach ($error['subtitle'] as  $key => $value)
                                                                <p class="subtitle error text-danger">{{ $value }}</p>
                                                            @endforeach
                                                        @endif
                                                </div>
                                            </div>

                                            <div class="mb-4 row  align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Description</label>
                                                <div class="col-sm-9">
                                                    <textarea class="form-control" name="content" id="ckeditor" value="{!! str_replace("<p />","&#013;",old('content') ?? $data->content ?? '')  !!}" >{!! str_replace("<p />","&#013;",old('content') ?? $data->content ?? '')  !!}</textarea>
                                                    <p style="display:none" class="content error text-danger"></p>
                                                        @if (!empty($error['content']))
                                                            @foreach ($error['content'] as  $key => $value)
                                                                <p class="content error text-danger">{{ $value }}</p>
                                                            @endforeach
                                                        @endif

                                                </div>
                                            </div>

                                            <div class="mb-4 row  align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Name</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" placeholder="Name" name="name" id="name"
                                                        value="{{ old('name') ?? $data->name ?? '' }}">
                                                    <p style="display:none" class="name error text-danger"></p>
                                                        @if (!empty($error['name']))
                                                            @foreach ($error['name'] as  $key => $value)
                                                                <p class="name error text-danger">{{ $value }}</p>
                                                            @endforeach
                                                        @endif
                                                </div>
                                            </div>

                                            <div class="mb-4 row  align-items-center">
                                                <label class="form-label-title col-sm-3 mb-0">Position</label>
                                                <div class="col-sm-9">
                                                    <input class="form-control" type="text" placeholder="Position" name="position" id="position"
                                                        value="{{ old('position') ?? $data->position ?? '' }}">
                                                    <p style="display:none" class="position error text-danger"></p>
                                                        @if (!empty($error['position']))
                                                            @foreach ($error['position'] as  $key => $value)
                                                                <p class="position error text-danger">{{ $value }}</p>
                                                            @endforeach
                                                        @endif
                                                </div>
                                            </div>

                                            <div class="mb-4 row align-items-center">
                                                <label class="col-sm-3 col-form-label form-label-title">Select Image</label>
                                                <div class="col-sm-9">
                                                    <input type="file" name="image" id="image" class="form-control" >
                                                    <img id="preview-image-before-upload" alt="your image"
                                                        @if(!empty($data->image))
                                                            src="{{ asset('images/'.($data->image ?? 'images/'.($data->image))  ) }}"
                                                            style="max-width: 100px;"
                                                        @else
                                                            style="display: none; max-width: 100px;"
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


                                            <button class="btn btn-submit btn-animation ms-auto fw-bold" type="submit">
                                                @if (!$editmode)
                                                    <i class="fa fa-user-plus" aria-hidden="true"></i>
                                                    Register
                                                @else
                                                    <i class="fa fa-edit" aria-hidden="true"></i>
                                                     Update
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
                                                                <p>Customer data will be updated.</p>
                                                            </div>
                                                        </div>

                                                        <div class="modal-footer">

                                                            <button type="submit" class="btn btn-animation btn-md fw-bold me-2">
                                                                @if (!$editmode)
                                                                    登録する
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
    $(".btn-submit").click(function(e){

        e.preventDefault();
            var _token = $("input[name='_token']").val();
            let formData = new FormData(registercustomer);
            $('#confirmModal').modal('show');

        });

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
            const allowedTypes = ["image/jpeg", "image/png", "image/jpg", "image/gif"]; // Add more types if needed
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
                document.querySelector(".image.error").innerText = "Please select a valid image file (JPEG, JPG, PNG, GIF).";
                // Clear the file input
                this.value = null;
            }
        });
    </script>

</x-auth-layout>