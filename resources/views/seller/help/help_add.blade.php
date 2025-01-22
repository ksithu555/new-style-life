
@php $error = $errors->toArray();  @endphp
@extends('seller.seller_dashboard')
@section('seller')

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
                                    <h5>Contact-Us</h5>
                                </div>

                                @php $action= route('help.store'); @endphp
                                <form class="theme-form theme-form-2 mega-form" id="registerblog" class="contact-form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                                    @csrf
                                        @if ($editmode)
                                            <input type="hidden" name="id" value="{{ $data->id }}">
                                        @endif

                                        <div class="mb-4 row align-items-center">
                                            <label
                                                class="form-label-title col-lg-2 col-md-3 mb-0">Subject</label>
                                            <div class="col-md-9 col-lg-10">
                                                <input class="form-control" type="text" name="title" id="title">
                                                <p style="display:none" class="title error text-danger"></p>
                                                @if (!empty($error['title']))
                                                    @foreach ($error['title'] as  $key => $value)
                                                        <p class="title error text-danger">{{ $value }}</p>
                                                    @endforeach
                                                @endif
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-lg-2 col-md-3 col-form-label form-label-title">Image</label>
                                            <div class="col-md-9 col-lg-10">
                                                <input class="form-control" type="file" id="image" name="image" onchange="validateImage(this)">
                                                <img src="" id="mainThmb">
                                                <span class="error" style="color:red" id="error-image"></span>
                                            </div>
                                        </div>
                                    <div class="row align-items-center">
                                        <label
                                            class="col-lg-2 col-md-3 col-form-label form-label-title">Content
                                            </label>
                                        <div class="col-md-9 col-lg-10">
                                            <textarea class="form-control" name="message" id="message" rows="5"></textarea>
                                            <p style="display:none" class="message error text-danger"></p>
                                            @if (!empty($error['message']))
                                                @foreach ($error['message'] as  $key => $value)
                                                    <p class="message error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="d-grid gap-2 d-md-block">
                                        <button class="btn btn-submit btn-animation" type="submit">Send</button>
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

  $('.error').hide()

  if ($.trim($("#title").val()) === "" ||  $.trim($("#message").val()) === ""    )  {

     if ($.trim($("#title").val()) === "") {
          $('.error.title').text('Title is required')
          $('.error.title').show()
     }

     if ($.trim($("#message").val()) === "") {
          $('.error.message').text('Message is required')
          $('.error.message').show()
     }

     if ($.trim($("#selleremail").val()) === "0") {
          $('.error.selleremail').text('Choose email')
          $('.error.selleremail').show()
     }



     return false;
  } else {

    $('.error').hide()
$('#confirmModal').modal('show');

}

});
    </script>

<script>
    function validateImage(input) {
        var allowedExtensions = /(\.jpg|\.jpeg|\.png|\.gif|\.avif)$/i;
        if (!allowedExtensions.exec(input.value)) {
            // alert('Invalid file type. Only images (JPG, JPEG, PNG, GIF) are allowed.');
            document.getElementById('error-image').textContent = 'Invalid file type. Only images (JPG, JPEG, PNG, GIF) are allowed.';
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
@endsection
