<x-auth-layout>
    <div class="page-body">
        <!-- FAQ Detail Start -->
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="row">
                        <div class="col-sm-8 m-auto">
                            <div class="card">
                                <div class="card-body">
                                    <div class="card-header-2">
                                        <h5>FAQ Information</h5>
                                    </div>

                                    <form class="theme-form theme-form-2 mega-form">

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Created Date</label>
                                            <div class="col-sm-9">
                                                <span class="post-meta-date">{{ date('Y/m/d', strtotime($faq->created_at)) }}
                                                </span>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">FAQ Title (English)</label>
                                            <div class="col-sm-9">
                                                <p>{{ $faq->title }}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">FAQ Title (Japan)</label>
                                            <div class="col-sm-9">
                                                <p>{{ $faq->jptitle ?? '' }}</p>
                                            </div>
                                        </div>


                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Question (English)</label>
                                            <div class="col-sm-9">
                                                <p>{!! $faq->que !!}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Question (Japan)</label>
                                            <div class="col-sm-9">
                                                <p>{!! $faq->jpque !!}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Answer(English)</label>
                                            <div class="col-sm-9">
                                                <p>{!! $faq->ans !!}</p>
                                            </div>
                                        </div>

                                        <div class="mb-2 row align-items-center">
                                            <label class="form-label-title col-sm-3 mb-0">Answer(Japan)</label>
                                            <div class="col-sm-9">
                                                <p>{!! $faq->jpans ?? '' !!}</p>
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
        <!-- FAQ Detail End -->
    </div>
</x-auth-layout>
