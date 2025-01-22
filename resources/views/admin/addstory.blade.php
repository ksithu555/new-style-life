
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
                                    <h5>Story</h5>
                                </div>

                                <form class="theme-form theme-form-2 mega-form" id="registerStoryForm" class="story-form" method="POST" action="{{ route('admin.store.story') }}" enctype="multipart/form-data">
                                    @csrf
                                    @if ($editmode)
                                        <input type="hidden" name="id" value="{{ $story->id }}">
                                    @endif

                                    @php
                                     $oldPart = 0;
                                     if ($editmode) {
                                        $oldPart = $story->part;
                                     }
                                    @endphp

                                    <div class="mb-4 row  align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Part</label>
                                        <div class="col-md-9 g-4">
                                            <select class="form-control" name="part" id="partSelect" value="{{ old('part') }}" style="color: #4A5567; font-size: 0.975rem;">
                                                @if ($editmode && $story->part == 0)
                                                <option value="0" {{ $oldPart == 0 ? 'selected' : '' }}>Title</option>
                                                @else
                                                <option>Choose Part</option>
                                                <option value="1" {{ $oldPart == 1 ? 'selected' : '' }}>First</option>
                                                <option value="2" {{ $oldPart == 2 ? 'selected' : '' }}>Second</option>
                                                <option value="3" {{ $oldPart == 3 ? 'selected' : '' }}>Third</option>
                                                <option value="4" {{ $oldPart == 4 ? 'selected' : '' }}>Last</option>
                                                @endif
                                            </select>
                                            <span class="error" style="color:red" id="error-part"></span>
                                        </div>
                                    </div>

                                    <div class="mb-4 row  align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Title</label>
                                        <div class="col-md-9 g-4">
                                            <input class="form-control title" type="text" placeholder="Enter Title In English" 
                                            name="title" id="title" value="{{ old('title') ?? $story->title ?? '' }}">
                                            <span class="error" style="color:red" id="error-title"></span>

                                            <input class="form-control title" type="text" placeholder="Enter Title In Japanese" 
                                            name="title_jp" id="title_jp" value="{{ old('title_jp') ?? $story->title_jp ?? '' }}">
                                            <span class="error" style="color:red" id="error-title-jp"></span>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Body</label>
                                        <div class="col-md-9">
                                            <span style="color: red; font-size: 10px;">
                                                *Enter Body in English.
                                            </span>
                                            <textarea class="form-control" placeholder="Enter Body in English - Use control+shift+V to paste within this text area." 
                                            name="body" id="body">
                                            {!! old('body') ?? $story->body ?? ''  !!}</textarea>
                                            <span class="error" style="color:red" id="error-body"></span>
                                            <br>
                                            <span style="color: red; font-size: 10px;">
                                                *Enter Body in Japanese.
                                            </span>
                                            <textarea class="form-control" placeholder="Enter Body in Japanese - Use control+shift+V to paste within this text area." 
                                            name="body_jp" id="body_jp">
                                            {!! old('body_jp') ?? $story->body_jp ?? ''  !!}</textarea>
                                            <span class="error" style="color:red" id="error-body-jp"></span>
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center" id="imageInput">
                                        <label class="form-label-title col-sm-3 mb-0">Image</label>
                                        <div class="col-md-9">
                                            <input type="file" name="image" id="image" class="form-control"  >
                                            <img id="preview-image-before-upload" alt="your image"
                                                @if(!empty($story->image))
                                                    src="{{ asset('images/'.($story->image ?? '')   ) }}"
                                                    style="max-width: 100px;"
                                                @else
                                                    style="display: none; max-width: 100px;"
                                                @endif
                                            />
                                            <span class="error" style="color:red" id="error-body"></span>
                                        </div>
                                    </div>

                                    <button type="button" class="btn btn-submit btn-animation ms-auto fw-bold" onclick="validateStoryForm()">
                                        @if (!$editmode)
                                            <i class="fa fa-user-plus" aria-hidden="true"></i>
                                               Save
                                        @else
                                            <i class="fa fa-edit" aria-hidden="true"></i>
                                                Update
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

    <!-- Confirm Modal Box -->
    <div class="modal fade theme-modal remove-coupon" id="confirmModal" tabindex="-1" data-bs-toggle="modal" role="dialog" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
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
                        @if (!$editmode)
                        <p>Story will be added?</p>
                        @else
                        <p>Story data will be updated.</p>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" id="confirmYes" class="btn btn-submit btn-animation btn-md fw-bold me-2">
                        Yes
                    </button>
                    <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal"
                     style="background-color: #ff6b6b;">No
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- Confirm Modal Box End-->
</div>

<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>
<script>
    $(document).ready(function() {
        $('#image').change(function(){
            let reader = new FileReader();
                reader.onload = (e) => {
                    $('#preview-image-before-upload').attr('src', e.target.result);
                    $('#preview-image-before-upload').show();
                }
                reader.readAsDataURL(this.files[0]);
        });
        // Function to update the visibility of the image input
        function updateImageInputVisibility() {
            var partValue = $('#partSelect').val();
            var imageInputDiv = $('#imageInput');
            var imageInput = $('#image');

            if (partValue === '1' || partValue === '4') { // First or Last
                imageInputDiv.hide();
                imageInput.val(''); // Clear any selected file
            } else {
                imageInputDiv.show();
            }
        }

        // Set up the initial state based on the current value
        updateImageInputVisibility();

        // Update on change
        $('#partSelect').change(function() {
            updateImageInputVisibility();
        });
    });
</script>
<script>
    function validateStoryForm() {
        let isValid = true;

        const part = document.querySelector('select[name="part"]').value;
        const title = document.getElementById('title').value.trim();
        const body = document.getElementById('body').value.trim();
        const title_jp = document.getElementById('title_jp').value.trim();
        const body_jp = document.getElementById('body_jp').value.trim();

        document.querySelectorAll('.error').forEach(el => el.textContent = '');

        if (!part || part === 'Choose Part') {
            isValid = false;
            document.getElementById('error-part').textContent = 'Please select a valid part.';
        }

        if (!title) {
            isValid = false;
            document.getElementById('error-title').textContent = 'Please provide story title for English.';
        } else if (title.length > 255) {
            isValid = false;
            document.getElementById('error-title').textContent = 'Your story title must not exceed 255 characters.';
        }

        if (!title_jp) {
            isValid = false;
            document.getElementById('error-title-jp').textContent = 'Please provide story title for Japanese.';
        } else if (title_jp.length > 255) {
            isValid = false;
            document.getElementById('error-title-jp').textContent = 'Your story title must not exceed 255 characters.';
        }

        if (!body) {
            isValid = false;
            document.getElementById('error-body').textContent = 'Please provide story body for English.';
        }

        if (!body_jp) {
            isValid = false;
            document.getElementById('error-body-jp').textContent = 'Please provide story body for Japanese.';
        }

        if (isValid) {
            // $('#confirmModal').modal('show');
            const confirmModal = new bootstrap.Modal(document.getElementById('confirmModal'));
            confirmModal.show();
            document.getElementById('confirmYes').addEventListener('click', function() {
                document.getElementById('registerStoryForm').submit();
            });
        }
    }

    document.getElementById('registerStoryForm').addEventListener('submit', function(event) {
        event.preventDefault();
        validateStoryForm();
    });
</script>
{{-- <script>
    ClassicEditor
        .create( document.querySelector( '#body' ) )
        .then( editor => {
            console.log( 'Editor was initialized', editor );
        } )
        .catch( error => {
            console.error( 'There was an error initializing the editor:', error );
        } );
    ClassicEditor
        .create( document.querySelector( '#body_jp' ) )
        .then( editor => {
            console.log( 'Editor was initialized', editor );
        } )
        .catch( error => {
            console.error( 'There was an error initializing the editor:', error );
        } );
</script> --}}
</x-auth-layout>