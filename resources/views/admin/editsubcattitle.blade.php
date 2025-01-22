
<x-auth-layout>
    <script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
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
                                        <h5>Edit SubCategory Title Information</h5>
                                    </div>
                                    @php $action= route('registersubtitle'); @endphp

                                    <form class="theme-form theme-form-2 mega-form" id="registersubtitle" class="contact-form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                                        @csrf
                                        @if ($editmode)
                                        <input type="hidden" name="id" value="{{ $subtitle->id }}">

                                        @endif

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-sm-3 col-form-label form-label-title">Category</label>
                                                <div class="col-sm-8">
                                                    <select class="js-example-basic-single w-100" name="category" id="category">
                                                        <option  value="0">Select Category</option>
                                                        @foreach($categories as $category)
                                                            <option value="{{ $category -> id }}" @if($category -> id == $subtitle->category_id ) selected @endif >
                                                                {{ $category -> category_name }}  </option>
                                                        @endforeach
                                                    </select>

                                                    <p style="display:none" class="category error text-danger"></p>
                                                    @if (!empty($error['category']))
                                                        @foreach ($error['category'] as  $key => $value)
                                                            <p class="category error text-danger">{{ $value }}</p>
                                                        @endforeach
                                                    @endif
                                                </div>

                                        </div>
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Sub Title</label>
                                            <div class="col-sm-8">
                                                <div class="input-group">
                                                    <input class="form-control" type="text" placeholder="Sub Title" name="subtitle[]" id="subtitle"
                                                        value="{{ old('sub_category_titlename') ?? $subtitle->sub_category_titlename ?? '' }}">

                                                </div>
                                                    <div id="dynamic-form"></div>
                                                        <p style="display:none" class="subtitle error text-danger"></p>
                                                            @if (!empty($error['subtitle']))
                                                                @foreach ($error['subtitle'] as  $key => $value)
                                                                    <p class="subtitle error text-danger">{{ $value }}</p>
                                                                @endforeach
                                                            @endif
                                                    </div>
                                            </div>
                                                <button type="submit" class="btn btn-animation ms-auto fw-bold">
                                                    @if (!$editmode)
                                                        <i class="fa fa-user-plus" aria-hidden="true"></i>
                                                            {{ __('auth.doregister') }}
                                                    @else
                                                        <i class="fa fa-edit" aria-hidden="true"></i>
                                                            {{ __('auth.yeschange') }}
                                                    @endif
                                                </button>
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
        // Function to add new input field
        function addInputField()
        {
            var inputGroup = document.createElement('div');
            inputGroup.classList.add('mb-4', 'row', 'align-items-center');
            inputGroup.innerHTML = `

                <div class="col-sm-8">
                    <div class="input-group">
                        <input class="form-control" type="text" placeholder="Sub Title" name="subtitle[]">
                        <div class="input-group-append align-self-center mx-auto justify-content-center">
                            <a href="#" class="align-items-center d-flex remove-field">
                                <i data-feather="minus-square"></i> Remove
                            </a>
                        </div>
                    </div>
                </div>
            `;
            document.getElementById('dynamic-form').appendChild(inputGroup);
            feather.replace(); // Refresh Feather icons
        }

            // Add event listener to the add button
            document.getElementById('add-more-field').addEventListener('click', function(event) {
                event.preventDefault();
                addInputField();
            });

            // Event delegation to handle remove button click
            document.getElementById('dynamic-form').addEventListener('click', function(event) {
                if (event.target.classList.contains('remove-field')) {
                    event.preventDefault();
                    event.target.closest('.row').remove();
                }
            });
    </script>

</x-auth-layout>