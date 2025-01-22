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
                                    <h5>SubCategory Title Information</h5>
                                </div>

                                <form class="theme-form theme-form-2 mega-form">
                                    <div class="mb-4 row align-items-center">
                                        <label class="col-sm-3 col-form-label form-label-title">Category</label>
                                            <div class="col-sm-9">
                                                <select class="js-example-basic-single w-100" name="state">
                                                    <option disabled>Category Menu</option>
                                                    <option>Electronics</option>
                                                    <option>TV & Appliances</option>
                                                    <option>Home & Furniture</option>
                                                    <option>Another</option>
                                                    <option>Baby & Kids</option>
                                                    <option>Health, Beauty & Perfumes</option>
                                                    <option>Uncategorized</option>
                                                </select>
                                            </div>
                                    </div>


                                    <div class="mb-4 row align-items-center">
                                        <label class="form-label-title col-sm-3 mb-0">Sub Title</label>
                                        <div class="col-sm-9">
                                            <div class="input-group">
                                                <input class="form-control" type="text" placeholder="Sub Title">
                                                  
                                            </div>
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
