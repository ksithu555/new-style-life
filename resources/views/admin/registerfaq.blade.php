
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
                                    <h5>FAQ</h5>
                                </div>

                                @php $action= route('registerfaq'); @endphp
                                <form class="theme-form theme-form-2 mega-form" id="registerfaq" class="contact-form" method="POST" action="{{ $action }}" enctype="multipart/form-data">
                                    @csrf
                                        @if ($editmode)
                                            <input type="hidden" name="id" value="{{ $faq->id }}">
                                        @endif

                                        <div class="mb-4 row  align-items-center">

                                            <label class="form-label-title col-sm-3 mb-0">FAQ Title</label>

                                            <div class="col-md-9 g-4">
                                                <input class="form-control title" type="text" placeholder="Eng" name="title_eng" id="title_eng" value="{{ old('title_eng') ?? $faq->title ?? '' }}">
                                                <p style="display:none" class="title_eng error text-danger"></p>
                                                @if (!empty($error['title_eng']))
                                                    @foreach ($error['title_eng'] as  $key => $value)
                                                        <p class="title_eng error text-danger">{{ $value }}</p>
                                                    @endforeach
                                                @endif <br>

                                                <input class="form-control title" type="text" placeholder="Jpn" name="title_japan" id="title_japan" value="{{ old('title_japan') ?? $faq->jptitle ?? '' }}">
                                                <p style="display:none" class="title_japan error text-danger"></p>
                                                @if (!empty($error['title_japan']))
                                                    @foreach ($error['title_japan'] as  $key => $value)
                                                        <p class="title_japan error text-danger">{{ $value }}</p>
                                                    @endforeach
                                                @endif
                                            </div>

                                        </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Question</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control"  placeholder="Use control+shift+V to paste within this text area.(Eng)" name="content" id="content" >{!! old('content') ?? $faq->que ?? ''  !!}</textarea>

                                            <p style="display:none" class="content_desc error text-danger"></p>
                                            @if (!empty($error['content_desc']))
                                                @foreach ($error['content_desc'] as  $key => $value)
                                                    <p class="content_desc error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                            <br>
                                            <textarea class="form-control" placeholder="このテキストエリア内で貼り付けるときは、control+shift+Vを使用してください。(Jpn)" name="jpcontent" id="jpcontent" value="{!! str_replace("<p />","&#013;",old('jpcontent') ?? $faq->jpque ?? '')  !!}"  >{!! old('jpcontent') ?? $faq->jpque ?? ''  !!}</textarea>
                                            <input type="hidden" name="jpcontent_desc" id="jpcontent_desc" value="{!! str_replace("<p />","&#013;",old('jpcontent') ?? $faq->jpque ?? '')  !!}">
                                            <p style="display:none" class="jpcontent_desc error text-danger"></p>
                                            @if (!empty($error['jpcontent_desc']))
                                                @foreach ($error['jpcontent_desc'] as  $key => $value)
                                                    <p class="jpcontent_desc error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>

                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Answer</label>
                                        <div class="col-md-9">
                                            <textarea class="form-control" placeholder="Use control+shift+V to paste within this text area.(Eng)" name="content_ansdesc"  id="content_ansdesc">{!! old('content_ansdesc') ?? $faq->ans ?? ''  !!}</textarea>
                                            <p style="display:none" class="content_ansdesc error text-danger"></p>
                                            @if (!empty($error['content_ansdesc']))
                                                @foreach ($error['content_ansdesc'] as  $key => $value)
                                                    <p class="content_ansdesc error text-danger">{{ $value }}</p>
                                                @endforeach
                                            @endif
                                            <br>
                                            <textarea class="form-control" placeholder="このテキストエリア内で貼り付けるときは、control+shift+Vを使用してください。(Jpn)" name="jpans" id="jpans" value="{!! str_replace("<p />","&#013;",old('jpans') ?? $faq->jpans ?? '')  !!}"  >{!! str_replace("<p />","&#013;",old('jpans') ?? $faq->jpans ?? '')  !!}</textarea>
                                            <input type="hidden" name="jpcontent_ansdesc" id="jpcontent_ansdesc" value="{!! str_replace("<p />","&#013;",old('jpans') ?? $faq->jpans ?? '')  !!}">
                                            <p style="display:none" class="jpcontent_ansdesc error text-danger"></p>
                                            @if (!empty($error['jpcontent_ansdesc']))
                                                @foreach ($error['jpcontent_ansdesc'] as  $key => $value)
                                                    <p class="jpcontent_ansdesc error text-danger">{{ $value }}</p>
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
                                                Update
                                        @endif
                                    </button>

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
                                                        <p>FAQ data will be added?</p>
                                                        @else
                                                        <p>FAQ data will be updated.</p>
                                                        @endif
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-submit btn-animation btn-md fw-bold me-2">
                                                        @if (!$editmode)
                                                            Yes
                                                        @else
                                                            Yes
                                                        @endif
                                                    </button>
                                                    <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal" style="background-color: #ff6b6b;">No</button>
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
                    document.querySelector('#content').value = editorData;
                });
            })
            .catch(error => {
                console.error(error);
            });

            ClassicEditor
            .create(document.querySelector('#jpcontent'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    var editorData = editor.getData();
                    document.querySelector('#jpcontent_desc').value = editorData;
                });
            })
            .catch(error => {
                console.error(error);
            });

            ClassicEditor
            .create(document.querySelector('#content_ansdesc'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    var editorData = editor.getData();
                    document.querySelector('#content_ansdesc').value = editorData;
                });
            })
            .catch(error => {
                console.error(error);
            });

            ClassicEditor
            .create(document.querySelector('#jpans'))
            .then(editor => {
                editor.model.document.on('change:data', () => {
                    var editorData = editor.getData();
                    document.querySelector('#jpcontent_ansdesc').value = editorData;
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

        // var imageSrc = $.trim($("#image").val());
        // var imageSrcs = $.trim($("#preview-image-before-upload").attr('src'));

if ($.trim($("#title_eng").val()) === "" || $.trim($("#title_japan").val()) === "" || $.trim($("#content").val()) === ""  || $.trim($("#jpcontent_desc").val()) === "" || $.trim($("#content_ansdesc").val()) === "" || $.trim($("#jpcontent_ansdesc").val()) === "") {
    if ($.trim($("#title_eng").val()) === "") {
        $('.error.title_eng').text('Title is required');
        $('.error.title_eng').show();
    }

    if ($.trim($("#title_japan").val()) === "") {
        $('.error.title_japan').text('Title is required');
        $('.error.title_japan').show();
    }

    if ($.trim($("#content").val()) === "") {
        $('.error.content').text('Question is required');
        $('.error.content').show();
    }

    if ($.trim($("#jpcontent_desc").val()) === "") {
        $('.error.jpcontent_desc').text('Question is required');
        $('.error.jpcontent_desc').show();
    }

    if ($.trim($("#content_ansdesc").val()) === "") {
        $('.error.content_ansdesc').text('Answer is required');
        $('.error.content_ansdesc').show();
    }

    if ($.trim($("#jpcontent_ansdesc").val()) === "") {
        $('.error.jpcontent_ansdesc').text('Answer is required');
        $('.error.jpcontent_ansdesc').show();
    }

    return false;
} else {

    $('.error').hide()
$('#confirmModal').modal('show');

}
});


    </script>
</x-auth-layout>
