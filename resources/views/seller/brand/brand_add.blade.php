@extends('seller.seller_dashboard')
@section('seller')
<div class="page-body">
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-sm-8 m-auto">
                        <div class="card">
                            <div class="card-body">
                                <div class="card-header-2">
                                    <h5>Brand Information</h5>
                                </div>
                                <form id="myForm" method="POST" action="{{ route('store.brand') }}" enctype="multipart/form-data">
                                    @csrf
                                    <div class="theme-form theme-form-2 mega-form">
                                        <div class="mb-4 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Brand Name</label>
                                            <div class="col-sm-9 form-group">
                                                <input class="form-control" type="text"
                                                    placeholder="Brand Name" name="brand_name">
                                                    @error('brand_name')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="mb-4 row align-items-center">
                                            <label class="col-sm-3 col-form-label form-label-title">Brand Image</label>
                                            <div class="form-group col-sm-9">
                                                <input class="form-control" type="file" id="image" name="brand_icon">
                                                <img width="100" id="showImage">
                                                    @error('brand_icon')
                                                        <div class="text-danger">{{ $message }}</div>
                                                    @enderror
                                            </div>
                                        </div>

                                        <div class="d-grid gap-2 d-md-block">
                                            <button class="btn btn-primary" type="submit">SAVE</button>
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
</div>
<script>
    document.addEventListener("DOMContentLoaded", function() {
            $('#image').change(function(e){
                let reader = new FileReader();
                reader.onload = function(e){
                    $('#showImage').attr('src',e.target.result);
                }
                reader.readAsDataURL(e.target.files['0']);
            })
        });
</script>

@endsection