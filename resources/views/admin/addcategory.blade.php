
<x-auth-layout>

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
                                    <h5>Category Information</h5>
                                </div>

                                @php $action= route('registercategory'); @endphp
                                <form class="theme-form theme-form-2 mega-form" id="registerblog" class="contact-form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                                    @csrf
                                        @if ($editmode)
                                            <input type="hidden" name="id" value="{{ $data->id }}">
                                        @endif

                                        <div class="mb-4 row  align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Category Name</label>
                                            <div class="col-sm-9">
                                                <input class="form-control" type="text" placeholder="Category Name" name="title" id="title"
                                                    value="{{ old('title') ?? $data->category_name ?? '' }}">
                                                <p style="display:none" class="title error text-danger"></p>
                                                    @if (!empty($error['title']))
                                                        @foreach ($error['title'] as  $key => $value)
                                                            <p class="title error text-danger">{{ $value }}</p>
                                                        @endforeach
                                                    @endif
                                            </div>
                                        </div>


                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Select Icon</label>
                                        <div class="col-sm-9">
                                            <input type="file" name="image" id="image" class="form-control"  >

                                            <img id="preview-image-before-upload" alt="your image"
                                                @if(!empty($data->category_icon))
                                                    src="{{ asset('images/'.($data->category_icon ?? '')   ) }}"
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
                                                        <p>Category will be added.</p>
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
    <!-- New Product Add End -->
</div>

<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
<script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script>
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
</script>

<script>
    $(document).ready(function() {
        ClassicEditor
            .create(document.querySelector('#content'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    var editorData = editor.getData();
                    document.querySelector('#content_desc').value = editorData;
                });
            })
            .catch(error => {
                console.error(error);
            });
    });
</script>

<script>
    function mainThamUrl(input){
        if(input.files && input.files[0]){
            var reader = new FileReader();
            reader.onload = function(e){
                $('#mainThmb').attr('src', e.target.result).width(70).height(70);
            };
            reader.readAsDataURL(input.files[0]);
        }
    }
</script>

<script>
    document.getElementById('multiImg').addEventListener('change', function(event) {
        const files = event.target.files;
        const preview = document.getElementById('preview_img');
        preview.innerHTML = '';

        if (files.length > 5) {
            alert('Please select a maximum of 5 images.');
            this.value = '';
            return;
        }

        Array.from(files).forEach(file => {
            const reader = new FileReader();
            reader.onload = function(e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '80px';
                img.style.maxHeight = '80px';
                preview.appendChild(img);
            };
            reader.readAsDataURL(file);
        });
    });
</script>

<script>
    $('.btn-submit').click(function() {

        $('.error').hide();

        var imageSrc = $.trim($("#image").val());
        var imageSrcs = $.trim($("#preview-image-before-upload").attr('src'));

if ($.trim($("#title").val()) === ""  ||  (imageSrc === "" && imageSrcs =='')) {
    if ($.trim($("#title").val()) === "") {
        $('.error.title').text('Category Name is required');
        $('.error.title').show();
    }
    if (imageSrc === "" && imageSrcs =='') {
        $('.error.image').text('Category Icon is required');
        $('.error.image').show();
    }
    return false;
} else {

    $('.error').hide()
$('#confirmModal').modal('show');

}
});
    </script>
</x-auth-layout>