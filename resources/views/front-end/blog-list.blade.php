<x-guest-layout>

    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Blog List</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Blog List</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->


    <!-- Blog Section Start -->
    <section class="blog-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-4">
                <div class="col-xxl-9 col-xl-8 col-lg-7 order-lg-2">
                    <div class="row g-4">
                        <div class="col-12">
                            @foreach ($blogs as $key => $blog)
                                <div class="blog-box blog-list wow fadeInUp">
                                    <div class="blog-image">
                                        <img src="{{ asset('images/' . $blog->image) }}" class="blur-up lazyload"
                                            alt="" style="width: 280px; height: 250px;">
                                    </div>

                                    <div class="blog-contain blog-contain-2">
                                        <div class="blog-label">
                                            <span class="time"><i data-feather="clock"></i> <span>
                                                    {{ date('Y/m/d', strtotime($blog->created_at)) }} </span></span>
                                            <span class="super"><i data-feather="user"></i>
                                                <span>{{ $blog->authorby }}</span></span>
                                        </div>
                                        <a href="{{ url('/blogdetail/' . $blog->id) }}">
                                            <h3>{{ $blog->title }}</h3>
                                        </a>
                                        @php
                                            $content = $blog->content;
                                            $content = str_replace(['<p>', '</p>'], '', $content);
                                            $content = str_replace('<br>', "\n", $content);
                                        @endphp
                                        <div
                                            style="white-space: pre-wrap; height: 150px; overflow: hidden; text-overflow: ellipsis;">
                                            {{ $content }}
                                        </div>
                                        <button onclick="location.href = '{{ url('/blogdetail/' . $blog->id) }}';"
                                            class="blog-button">Read More <i class="fa-solid fa-right-long"></i>
                                        </button>
                                    </div>
                                </div>
                            @endforeach
                        </div>


                    </div>

                    @include('components.toppagination')
                </div>

                <div class="col-xxl-3 col-xl-4 col-lg-5 order-lg-1">
                    <div class="left-sidebar-box wow fadeInUp">
                        <form id="searchForm" action="/news" method="GET">
                            <div class="accordion-item">
                                <div style="display: flex; align-items: center;">
                                    <input class="form-control form-control-sm mr-sm-2" type="search" placeholder="Search" aria-label="Search" id="search" name="search" value="{{ $search }}"
                                    style="font-size: 15px; padding: 0.25rem 0.5rem; border-radius: 5px 0 0 5px;">
                                    <button class="btn btn-outline-success btn-sm my-2 my-sm-0" type="submit" id="searchBtn"
                                    style="font-size: 15px; padding: 0.25rem 0.5rem; background-color: var(--theme-color); border-radius: 0 5px 5px 0;">
                                    <i data-feather="search" style="stroke: white;"></i></button>
                                </div>
                            </div>
                        </form>


                        <div class="accordion left-accordion-box" id="accordionPanelsStayOpenExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="panelsStayOpen-headingOne">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                        data-bs-target="#panelsStayOpen-collapseOne">
                                        Recent Post
                                    </button>
                                </h2>
                                <div id="panelsStayOpen-collapseOne" class="accordion-collapse collapse show">
                                    <div class="accordion-body pt-0">
                                        <div class="recent-post-box">
                                            @foreach ($latestblog as $list)
                                                <div class="recent-box">
                                                    <a href="{{ url('/blogdetail/' . $list->id) }}"
                                                        class="recent-image">
                                                        <img src="{{ asset('images/' . $list->image) }}"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </a>

                                                    <div class="recent-detail">
                                                        <a href="{{ url('/blogdetail/' . $list->id) }}">
                                                            <h5 class="recent-name">{{ $list->title }}</h5>
                                                        </a>
                                                        <h6>{{ date('Y/m/d', strtotime($list->created_at)) }}</h6>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Blog Section End -->

</x-guest-layout>