<x-auth-layout>
<script src="https://cdn.ckeditor.com/ckeditor5/41.1.0/classic/ckeditor.js"></script>
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
                                    <h5>News Information</h5>
                                </div>

                                <form class="theme-form theme-form-2 mega-form">
                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">News Name</label>
                                        <div class="col-sm-9">
                                            <input class="form-control" type="text" placeholder="News Name">
                                        </div>
                                    </div>


                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0"> Description</label>
                                        <div class="col-sm-9">
                                            <textarea class="form-control" name="long-descp" id="ckeditor" ></textarea>
                                        </div>
                                    </div>


                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Multiple Images</label>
                                        <div class="col-sm-9">
                                            <input type="file" class="form-control" multiple="" name="multi_img[]" id="multiImg" onchange="previewImages()">
                                            <div class="row" id="preview_img"></div>
                                        </div>
                                    </div>


                                    <button type="submit" class="btn btn-animation ms-auto fw-bold">Update</button>
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

</x-auth-layout>
