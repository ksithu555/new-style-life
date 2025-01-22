<x-guest-layout>
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Our Story</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Our Story</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
    <div id="EnglishVersion">
        <!-- About Section Start -->
        <section class="seller-poster-section">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-xxl-7 seller-title">
                        <h2>{{ $stories[0]->title }}</h2>
                    </div>
                    <div class="col-xxl-4 seller-title">
                        <div class="title-header option-title" id="japaneseBtnDiv" style="display: flex; justify-content: flex-end;">
                            <button class="align-items-center btn btn-theme d-flex" id="japaneseBtn" style="background-color: var(--theme-color); color: #fff;">
                                日本語で確認する
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xxl-4 order-lg-2">
                        <div class="poster-box" style="display: flex; align-items: center; justify-content: center; height: 100%;">
                            <div class="poster-image">
                                <img src="{{ asset('images/' . $stories[0]->image) }}" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-7">
                        <div class="seller-title h-100 d-flex align-items-center">
                            <div>
                                @php
                                    $firstStories = $stories->where('part', 1);
                                @endphp
                                @foreach ($firstStories as $key => $firstStory)
                                <div style="margin-top: 15px;">
                                    <h3>{{ $firstStory->title }}</h3>
                                    <p>{{ $firstStory->body }}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Section End -->

        <!-- Service Section Start -->
        <section class="become-service section-b-space">
            <div class="container-fluid-lg">
                <div class="seller-title mb-5">
                    <h2>{{ $stories[1]->title }}</h2>
                </div>

                @php
                    $secondStories = $stories->where('part', 2);
                    $counter = 0;
                @endphp
                @foreach ($secondStories as $secondStory)
                    @if ($counter % 4 == 0)
                        @if ($counter != 0)
                            </div>
                        @endif
                        <div class="row">
                    @endif
                    <div class="col-xxl-3">
                        <div class="service-box">
                            <div class="service-svg">
                                <img src="{{ asset('images/' . $secondStory->image) }}" class="img-fluid" alt="">
                            </div>
            
                            <div class="service-detail">
                                <h4>{{ $secondStory->title }}</h4>
                                <p>{{ $secondStory->body }}</p>
                            </div>
                        </div>
                    </div>
                    @php $counter++; @endphp
                @endforeach
                </div> <!-- Close the last row -->
            </div>
        </section>
        <!-- Service Section End -->

        <!-- Business Section Start -->
        <section class="business-section section-b-space">
            <div class="container-fluid-lg">
                <div class="vendor-title mb-5">
                    <h2>{{ $stories[2]->title }}</h2>
                </div>

                @php
                    $thirdStories = $stories->where('part', 3);
                    $numberImage = 1;
                    $counter = 0;
                @endphp
                <div class="business-contain">
                    @foreach ($thirdStories as $thirdStory)
                        @if ($counter % 3 == 0)
                            @if ($counter != 0)
                                </div> <!-- Close the previous row -->
                            @endif
                            <div class="row">
                        @endif
                        <div class="col-xxl-4">
                            <div class="business-box">
                                <div>
                                    <div class="business-number">
                                        @if ($thirdStory->image)
                                            <img src="{{ asset('images/' . $thirdStory->image) }}" class="img-fluid" alt="">
                                        @else
                                            <h2>{{ $numberImage++ }}</h2>
                                        @endif
                                    </div>
                                    <div class="business-detail">
                                        <h4>{{ $thirdStory->title }}</h4>
                                        <p>{{ $thirdStory->body }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php $counter++; @endphp
                    @endforeach
                    </div> <!-- Close the last row -->
                </div>
            </div>
        </section>
        <!-- Business Section End -->

        <!-- Selling Section Start -->
        <section class="selling-section section-b-space">
            <div class="container-fluid-lg">
                <div class="row">
                    <h2>{{ $stories[3]->title }}</h2>
                </div>
                <div class="row">
                    <div class="col-xxl-9">
                        @php
                            $lastStories = $stories->where('part', 4);
                        @endphp
                        @foreach ($lastStories as $lastStory)
                        <div class="vendor-title" style="margin-top: 15px;">
                            <h5>{{ $lastStory->title }}</h5>
                            <p>{{ $lastStory->body }}</p>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-xxl-3">
                        <div class="poster-box" style="display: flex; align-items: center; justify-content: center; height: 100%;">
                            <div class="poster-image">
                                <img src="{{ asset('images/' . $stories[3]->image) }}" class="img-fluid" alt="" style="max-width: 100%; height: auto;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <a href="{{ route('seller.register') }}" style="width: 300px;"
                        class="btn btn-md mt-3 theme-bg-color text-white">Start Selling
                        <i class="fa-solid fa-right-long ms-2 icon"></i></a>
                </div>
            </div>
        </section>
        <!-- Selling Section End -->
    </div>

    <div id="JapaneseVersion" style="display: none;">
        <!-- About Section Start -->
        <section class="seller-poster-section">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-xxl-7 seller-title">
                        <h2>{{ $stories[0]->title_jp }}</h2>
                    </div>
                    <div class="col-xxl-4 seller-title">
                        <div class="title-header option-title" id="englishBtnDiv" style="display: flex; justify-content: flex-end;">
                            <button class="align-items-center btn btn-theme d-flex" id="englishBtn" style="background-color: var(--theme-color); color: #fff;">
                                Check in English
                            </button>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-xxl-4 order-lg-2">
                        <div class="poster-box" style="display: flex; align-items: center; justify-content: center; height: 100%;">
                            <div class="poster-image">
                                <img src="{{ asset('images/' . $stories[0]->image) }}" class="img-fluid" alt="">
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-7">
                        <div class="seller-title h-100 d-flex align-items-center">
                            <div>
                                @php
                                    $firstStories = $stories->where('part', 1);
                                @endphp
                                @foreach ($firstStories as $key => $firstStory)
                                <div style="margin-top: 15px;">
                                    <h3>{{ $firstStory->title_jp }}</h3>
                                    <p>{{ $firstStory->body_jp }}</p>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <!-- About Section End -->

        <!-- Service Section Start -->
        <section class="become-service section-b-space">
            <div class="container-fluid-lg">
                <div class="seller-title mb-5">
                    <h2>{{ $stories[1]->title_jp }}</h2>
                </div>

                @php
                    $secondStories = $stories->where('part', 2);
                    $counter = 0;
                @endphp
                @foreach ($secondStories as $secondStory)
                    @if ($counter % 4 == 0)
                        @if ($counter != 0)
                            </div>
                        @endif
                        <div class="row">
                    @endif
                    <div class="col-xxl-3">
                        <div class="service-box">
                            <div class="service-svg">
                                <img src="{{ asset('images/' . $secondStory->image) }}" class="img-fluid" alt="">
                            </div>
            
                            <div class="service-detail">
                                <h4>{{ $secondStory->title_jp }}</h4>
                                <p>{{ $secondStory->body_jp }}</p>
                            </div>
                        </div>
                    </div>
                    @php $counter++; @endphp
                @endforeach
                </div> <!-- Close the last row -->
            </div>
        </section>
        <!-- Service Section End -->

        <!-- Business Section Start -->
        <section class="business-section section-b-space">
            <div class="container-fluid-lg">
                <div class="vendor-title mb-5">
                    <h2>{{ $stories[2]->title_jp }}</h2>
                </div>

                @php
                    $thirdStories = $stories->where('part', 3);
                    $numberImage = 1;
                    $counter = 0;
                @endphp
                <div class="business-contain">
                    @foreach ($thirdStories as $thirdStory)
                        @if ($counter % 3 == 0)
                            @if ($counter != 0)
                                </div> <!-- Close the previous row -->
                            @endif
                            <div class="row">
                        @endif
                        <div class="col-xxl-4">
                            <div class="business-box">
                                <div>
                                    <div class="business-number">
                                        @if ($thirdStory->image)
                                            <img src="{{ asset('images/' . $thirdStory->image) }}" class="img-fluid" alt="">
                                        @else
                                            <h2>{{ $numberImage++ }}</h2>
                                        @endif
                                    </div>
                                    <div class="business-detail">
                                        <h4>{{ $thirdStory->title_jp }}</h4>
                                        <p>{{ $thirdStory->body_jp }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @php $counter++; @endphp
                    @endforeach
                    </div> <!-- Close the last row -->
                </div>
            </div>
        </section>
        <!-- Business Section End -->

        <!-- Selling Section Start -->
        <section class="selling-section section-b-space">
            <div class="container-fluid-lg">
                <div class="row">
                    <h2>{{ $stories[3]->title_jp }}</h2>
                </div>
                <div class="row">
                    <div class="col-xxl-9">
                        @php
                            $lastStories = $stories->where('part', 4);
                        @endphp
                        @foreach ($lastStories as $lastStory)
                        <div class="vendor-title" style="margin-top: 15px;">
                            <h5>{{ $lastStory->title_jp }}</h5>
                            <p>{{ $lastStory->body_jp }}</p>
                        </div>
                        @endforeach
                    </div>
                    <div class="col-xxl-3">
                        <div class="poster-box" style="display: flex; align-items: center; justify-content: center; height: 100%;">
                            <div class="poster-image">
                                <img src="{{ asset('images/' . $stories[3]->image) }}" class="img-fluid" alt="" style="max-width: 100%; height: auto;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <a href="{{ route('seller.register') }}" style="width: 300px;"
                        class="btn btn-md mt-3 theme-bg-color text-white">販売を開始する
                        <i class="fa-solid fa-right-long ms-2 icon"></i></a>
                </div>
            </div>
        </section>
        <!-- Selling Section End -->
    </div>
    <script>
        document.getElementById('japaneseBtn').addEventListener('click', function() {
            document.getElementById('EnglishVersion').style.display = 'none';
            document.getElementById('JapaneseVersion').style.display = 'block';
        });

        document.getElementById('englishBtn').addEventListener('click', function() {
            document.getElementById('JapaneseVersion').style.display = 'none';
            document.getElementById('EnglishVersion').style.display = 'block';
        });
    </script>
</x-guest-layout>