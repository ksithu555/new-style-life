<x-auth-layout>
    <div class="page-body">
        <!-- Blog Detail Start -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-8 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header-2">
                                        <h5>Blog Information</h5>
                                    </div>

                                    <form class="theme-form theme-form-2 mega-form">
                                        <img class="img-fluid" src="{{ asset('images/'.($blog->headimg ?? 'blog/blog-details.jpg')   ) }}" alt="">
                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Blog Name</label>
                                            <div class="col-sm-9">
                                                <p>{{ $blog->title }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Created Date</label>
                                            <div class="col-sm-9">
                                               
                                                <span class="post-meta-date"> {{ date('Y/m/d', strtotime($blog->created_at)) }}</span>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Description</label>
                                            <div class="col-sm-9">
                                                <p>{!! $blog->content !!}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="col-sm-3 col-form-label form-label-title">Images</label>
                                            <div class="col-sm-9">
                                                <p> <img class="img-fluid" src="{{ asset('images/'.($blog->image ?? 'blog/blog-details.jpg')   ) }}" alt=""></p>
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
        <!-- Blog Detail End -->
    </div>
</x-auth-layout>
