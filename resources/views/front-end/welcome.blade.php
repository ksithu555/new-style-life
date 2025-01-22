<x-guest-layout>
    @php
        $error = $errors->toArray();
    @endphp
    <style>
        .home-section pt-2 {
            background-image: url(../assets/images/vegetable/banner/1.jpg);
            background-size: cover;
            background-position: center center;
            background-repeat: no-repeat;
            display: block;
        }
    </style>
    <!-- Home Section Start -->
    <section class="home-section pt-2 ratio_50">
        <div class="container-fluid-lg">
            <div class="row g-4">
                <div class="col-xl-9 col-lg-8 ratio_50_1">
                    <div class="home-contain furniture-contain-2">
                        <img src="{{ asset('frontend/assets/images/furniture/banner/' . $tops[0]->image) }}"
                            class="bg-img blur-up lazyload" alt="">
                        <div class="home-detail p-top-left mend-auto w-100">
                            <div>
                                <h6>Exclusive offer <span>{{ $tops[0]->discount }} Off</span></h6>
                                <h1 class="text-uppercase poster-1 text-content furniture-heading">
                                    {{ $tops[0]->phaseone }}
                                    <span class="daily">{{ $tops[0]->phasetwo }}</span>
                                </h1>
                                @if ($productsGroupedByDiscount[30] != null)
                                    <button
                                        onclick="location.href = '{{ route('show-discount-product', ['ids' => $productsGroupedByDiscount[30]]) }}';"
                                        class="btn btn-furniture mt-xxl-4 mt-3 home-button mend-auto">{{ __('messages.shop_now') }} <i
                                            class="fa-solid fa-right-long ms-2 icon"></i></button>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-3 col-lg-4 d-lg-inline-block d-none">
                    <div class="home-contain h-100 home-furniture">
                        <img src="{{ asset('frontend/assets/images/furniture/banner/' . $tops[1]->image) }}"
                            class="bg-img blur-up lazyload" alt="">
                        <div class="home-detail p-top-left home-p-sm feature-detail mend-auto">
                            <div>
                                <h2 class="mt-0 text-danger">
                                    {{ $tops[1]->discount }} <span class="discount text-title">OFF</span>
                                </h2>
                                <h2 class="mt-0 theme-color text-kaushan fw-normal">{{ $tops[1]->phaseone }}</h2>
                                <h3 class="furniture-content">{{ $tops[1]->phasetwo }}</h3>
                                @if ($productsGroupedByDiscount[50] != null)
                                    <a href="{{ route('show-discount-product', ['ids' => $productsGroupedByDiscount[50]]) }}"
                                        class="shop-button btn btn-furniture mt-0 d-inline-block btn-md text-content">
                                        {{ __('messages.shop_now') }} <i class="fa-solid fa-right-long ms-2"></i></a>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Home Section End -->

    <!-- Service Section Start -->
    <section class="service-section">
        <div class="container-fluid-lg">
            <div class="row g-3 row-cols-xxl-5 row-cols-lg-3 row-cols-md-2">
                <div>
                    <div class="service-contain-2">
                        <svg class="icon-width">
                            <use xlink:href="{{ asset('frontend/assets/svg/svg/service-icon-4.svg#shipping') }}"></use>
                        </svg>
                        <div class="service-detail">
                            <h3>{{ __('messages.free_shipping') }}</h3>
                            <h6 class="text-content">{{ __('messages.free_shipping_message') }}</h6>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="service-contain-2">
                        <svg class="icon-width">
                            <use xlink:href="{{ asset('frontend/assets/svg/svg/service-icon-4.svg#service') }}"></use>
                        </svg>
                        <div class="service-detail">
                            <h3>{{ __('messages.24_7_service') }}</h3>
                            <h6 class="text-content">{{ __('messages.24_7_service_message') }}</h6>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="service-contain-2">
                        <svg class="icon-width">
                            <use xlink:href="{{ asset('frontend/assets/svg/svg/service-icon-4.svg#pay') }}"></use>
                        </svg>
                        <div class="service-detail">
                            <h3>{{ __('messages.online_pay') }}</h3>
                            <h6 class="text-content">{{ __('messages.online_pay_message') }}</h6>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="service-contain-2">
                        <svg class="icon-width">
                            <use xlink:href="{{ asset('frontend/assets/svg/svg/service-icon-4.svg#offer') }}"></use>
                        </svg>
                        <div class="service-detail">
                            <h3>{{ __('messages.discount') }}</h3>
                            <h6 class="text-content">{{ __('messages.discount_message') }}</h6>
                        </div>
                    </div>
                </div>
                <div>
                    <div class="service-contain-2">
                        <svg class="icon-width">
                            <use xlink:href="{{ asset('frontend/assets/svg/svg/service-icon-4.svg#return') }}"></use>
                        </svg>
                        <div class="service-detail">
                            <h3>{{ __('messages.coupon') }}</h3>
                            <h6 class="text-content">{{ __('messages.coupon_message') }}</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Service Section End -->

    <!-- Product Section Start -->
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row g-sm-4 g-3">
                <div class="col-xxl-9 col-xl-8">
                    @if ($coupons->count() > 0)
                        @if (count($couponProducts) > 0)
                            <div class="title title-flex">
                                <div>
                                    <h2>{{ __('messages.today_coupon_items') }}</h2>
                                    <span class="title-leaf">
                                        <svg class="icon-width">
                                            <use xlink:href="{{ asset('frontend/assets/svg/leaf.svg#leaf') }}"></use>
                                        </svg>
                                    </span>
                                    <p>{{ __('messages.today_coupon_items_message') }}</p>
                                </div>
                                <div class="timing-box">
                                    <div class="timing">
                                        <i data-feather="clock"></i>
                                        <h6 class="name">{{ __('messages.today') }} :</h6>
                                        <h6 class="name" id="formatted-date"></h6>
                                    </div>
                                </div>
                            </div>

                            <div class="section-b-space">
                                <div
                                    class="row row-cols-xxl-5 row-cols-md-4 row-cols-sm-3 row-cols-2 g-sm-4 g-3 no-arrow">
                                    @foreach ($couponProducts as $keycoupon => $couponProduct)
                                    @if ($keycoupon < 30)
                                        <div>
                                            <div class="product-box product-white-bg wow fadeIn" data-wow-delay="0.1s">
                                                <div class="product-image">
                                                    <a
                                                        href="{{ route('show-product-left-thumbnail', ['id' => $couponProduct->id]) }}">
                                                        <img src="{{ asset('images/' . $couponProduct->product_thambnail) }}"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </a>
                                                    <ul class="product-option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#view-product{{ $couponProduct->id }}"
                                                                data-product="{{ $couponProduct->id }}">
                                                                <i data-feather="eye"></i>
                                                            </a>
                                                        </li>

                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a
                                                                href="{{ route('show-comparelist', ['id' => $couponProduct->id]) }}">
                                                                <i data-feather="refresh-cw"></i>
                                                            </a>
                                                        </li>

                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="{{ route('show-wishlist', ['id' => $couponProduct->id]) }}"
                                                                class="notifi-wishlist">
                                                                <i data-feather="heart"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                                <div class="product-detail position-relative">
                                                    <a
                                                        href="{{ route('show-product-left-thumbnail', ['id' => $couponProduct->id]) }}">
                                                        <h6 class="name">{{ $couponProduct->product_name }}
                                                        </h6>
                                                    </a>

                                                    <h6 class="sold weight text-content fw-normal">
                                                        {{ $couponProduct->product_color }}
                                                    </h6>

                                                    <span
                                                        class="price theme-color">¥{{ number_format($couponProduct->selling_price, 0, '.', ',') }}</span>
                                                    @if ($couponProduct->discount_percent != 0)
                                                        <del>¥{{ number_format($couponProduct->original_price, 0, '.', ',') }}</del>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Quick View Modal Box Start -->
                                        @if ($couponProduct->status == 1)
                                            @php
                                                $starRating = 0;
                                                $count = 0;
                                            @endphp
                                            @foreach ($reviews as $review)
                                                @if ($couponProduct->id == $review->product_id)
                                                    @php
                                                        $count += 1;
                                                        $starRating += $review->stars_rated;
                                                    @endphp
                                                @endif
                                            @endforeach
                                            @if ($count != 0)
                                                @php
                                                    $starRating = $starRating / $count;
                                                @endphp
                                            @endif
                                            <div class="modal fade theme-modal view-modal"
                                                id="view-product{{ $couponProduct->id }}" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered modal-xl">
                                                    <div class="modal-content">
                                                        <div class="modal-header p-0">
                                                            <button type="button" class="btn-close"
                                                                data-bs-dismiss="modal">
                                                                <i class="fa-solid fa-xmark"></i>
                                                            </button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row g-sm-4 g-2">
                                                                <div class="col-lg-6">
                                                                    <div class="slider-image">
                                                                        <img src="{{ asset('images/' . $couponProduct->product_thambnail) }}"
                                                                            class="img-fluid blur-up lazyload"
                                                                            alt="">
                                                                    </div>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <div class="right-sidebar-modal">
                                                                        <h4 class="title-name">
                                                                            {{ $couponProduct->product_name }}</h4>
                                                                        @if ($couponProduct->discount_percent != 0)
                                                                            <h4 class="price"><span
                                                                                    class="theme-color">¥{{ number_format($couponProduct->selling_price, 0, '', ',') }}</span>
                                                                                <del>¥{{ number_format($couponProduct->original_price, 0, '', ',') }}</del>
                                                                            @else
                                                                                <h4 class="price"><span
                                                                                        class="theme-color">¥{{ number_format($couponProduct->selling_price, 0, '', ',') }}</span>
                                                                        @endif
                                                                        <div class="product-rating">
                                                                            <ul class="rating">
                                                                                @for ($i = 1; $i <= 5; $i++)
                                                                                    @if ($i <= $starRating)
                                                                                        <li><i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                    @else
                                                                                        <li><i data-feather="star"></i>
                                                                                        </li>
                                                                                    @endif
                                                                                @endfor
                                                                            </ul>
                                                                            <span class="ms-2">{{ $count }}
                                                                                {{ __('messages.reviews') }}</span>
                                                                        </div>

                                                                        <div class="product-detail">
                                                                            <h4>{{ __('messages.product_details') }} :</h4>
                                                                            <p>{!! $couponProduct->long_desc !!}</p>
                                                                        </div>

                                                                        <ul class="brand-list">
                                                                            <li>
                                                                                <div class="brand-box">
                                                                                    <h5>{{ __('messages.brand_name') }}:</h5>
                                                                                    <h6>
                                                                                        @php
                                                                                            $brand = DB::table('brands')
                                                                                                ->where(
                                                                                                    'id',
                                                                                                    $couponProduct->brand_id,
                                                                                                )
                                                                                                ->first();
                                                                                        @endphp
                                                                                        {{ $brand->brand_name }}
                                                                                    </h6>
                                                                                </div>
                                                                            </li>

                                                                            <li>
                                                                                <div class="brand-box">
                                                                                    <h5>{{ __('messages.product_code') }}:</h5>
                                                                                    <h6>{{ $couponProduct->product_code }}
                                                                                    </h6>
                                                                                </div>
                                                                            </li>

                                                                            <li>
                                                                                <div class="brand-box">
                                                                                    <h5>{{ __('messages.category') }}:</h5>
                                                                                    <h6>
                                                                                        @php
                                                                                            $category = DB::table(
                                                                                                'categories',
                                                                                            )
                                                                                                ->where(
                                                                                                    'id',
                                                                                                    $couponProduct->category_id,
                                                                                                )
                                                                                                ->first();
                                                                                        @endphp
                                                                                        {{ $category->{'category_name_' . app()->getLocale() } ?? $category->category_name }}
                                                                                    </h6>
                                                                                </div>
                                                                            </li>

                                                                            <li>
                                                                                <div class="brand-box">
                                                                                    <h5>{{ __('messages.in_stock') }}:</h5>
                                                                                    <h6>{{ $couponProduct->in_stock }}
                                                                                    </h6>
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                        <ul class="brand-list">
                                                                            @php
                                                                                $sizes = explode(
                                                                                    ',',
                                                                                    $couponProduct->product_size,
                                                                                );
                                                                            @endphp
                                                                            <li>
                                                                                <div class="product-contain"
                                                                                    style="display: flex; flex-wrap: wrap;">
                                                                                    @foreach ($sizes as $key => $size)
                                                                                        <div class="form-check"
                                                                                            style="margin-left: 10px; margin-top: 15px;">
                                                                                            <input
                                                                                                class="form-check-input"
                                                                                                type="radio"
                                                                                                name="selected_coupon_size_{{ $couponProduct->id }}"
                                                                                                value="{{ $size }}"
                                                                                                id="size_{{ $couponProduct->id }}_{{ $size }}"
                                                                                                {{ $key === 0 ? 'checked' : '' }}>
                                                                                            <label
                                                                                                for="size_{{ $couponProduct->id }}_{{ $size }}">{{ $size }}</label>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                        <ul class="brand-list">
                                                                            @php
                                                                                $colors = explode(
                                                                                    ',',
                                                                                    $couponProduct->product_color,
                                                                                );
                                                                            @endphp
                                                                            <li>
                                                                                <div class="product-contain"
                                                                                    style="display: flex; flex-wrap: wrap;">
                                                                                    @foreach ($colors as $key => $color)
                                                                                        <div class="form-check"
                                                                                            style="margin-left: 10px; margin-top: 15px;">
                                                                                            <input
                                                                                                class="form-check-input"
                                                                                                type="radio"
                                                                                                name="selected_coupon_color_{{ $couponProduct->id }}"
                                                                                                value="{{ $color }}"
                                                                                                id="color_{{ $couponProduct->id }}_{{ $color }}"
                                                                                                {{ $key === 0 ? 'checked' : '' }}>
                                                                                            <label
                                                                                                for="color_{{ $couponProduct->id }}_{{ $color }}">{{ $color }}</label>
                                                                                        </div>
                                                                                    @endforeach
                                                                                </div>
                                                                            </li>
                                                                        </ul>
                                                                        <div class="modal-button">
                                                                            <button
                                                                                onclick="addToCartCoupon({{ $couponProduct->id }})"
                                                                                class="btn btn-md add-cart-button icon"
                                                                                @if ($couponProduct->in_stock < 1) disabled @endif>
                                                                                {{ __('messages.add_to_cart') }}</button>

                                                                            <button
                                                                                onclick="location.href = '{{ route('show-product-left-thumbnail', ['id' => $couponProduct->id]) }}';"
                                                                                class="btn theme-bg-color view-button icon text-white fw-bold btn-md">
                                                                                {{ __('messages.view_more_details') }}</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- Quick View Modal Box End -->
                                        @endif
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    @endif
                    <div class="slider-1 product-wrapper no-arrow">
                        @if ($coupons->count() > 0)
                            @foreach ($coupons as $coupon)
                                <a href="{{ route('show-coupon-product', ['id' => $coupon->id]) }}">
                                    <div class="">
                                        <div class="banner-contain">
                                            <img src="{{ asset('frontend/assets/images/homepage/coupon1.jpg') }}"
                                                class="bg-img blur-up lazyload" alt="">
                                            <div class="banner-details p-center p-4 text-white text-center">
                                                <div>
                                                    <h3 class="lh-base fw-bold offer-text" style="color: #417394;">
                                                        {{ __('messages.coupon_name') }}: {{ $coupon->name }}
                                                    </h3>
                                                    <h4 class="lh-base fw-bold offer-text" style="color: #417394;">
                                                        {{ __('messages.get_cashback', ['amount' => number_format($coupon->discount_amount, 0, '', ','), 'min_amount' => number_format($coupon->mini_amount, 0, '', ',')]) }}
                                                    </h4>
                                                    <h5 class="lh-base fw-bold offer-text" style="color: #417394;">
                                                        {{ __('messages.expired_date', ['start_date' => date('Y/m/d', strtotime($coupon->startdate)), 'end_date' => date('Y/m/d', strtotime($coupon->enddate))]) }}
                                                    </h5>
                                                    @if ($coupon->seller)
                                                        @if ($coupon->seller->coupon_status == 1)
                                                            <h4 class="lh-base fw-bold offer-text" style="color: #417394;">
                                                                {{ __('messages.publisher', ['publisher' => $coupon->seller->shop_name]) }}
                                                            </h4>
                                                        @endif
                                                    @elseif ($coupon->product->first())
                                                        @if ($coupon->product->first()->coupon_status == 1)
                                                            <h4 class="lh-base fw-bold offer-text" style="color: #417394;">
                                                                {{ __('messages.publisher', ['publisher' => 'New Style Life']) }}
                                                            </h4>
                                                        @endif
                                                    @endif
                                                    <h6 class="coupon-code">
                                                        {{ __('messages.use_code', ['code' => $coupon->coupon_code]) }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                    </div>

                    @if (count($categories) > 0)
                        <div class="title">
                            <h2>{{ __('messages.browse_by_categories') }}</h2>
                            <span class="title-leaf">
                                <svg class="icon-width">
                                    <use xlink:href="{{ asset('frontend/assets/svg/leaf.svg#leaf') }}"></use>
                                </svg>
                            </span>
                            <p>{{ __('messages.explore_top_categories') }}</p>
                        </div>

                        <div class="category-slider-2 product-wrapper no-arrow">
                            @foreach ($categories as $list)
                                <div>
                                    <a href="{{ route('show-category-left-side-bar', ['categoryid' => $list->id]) }}"
                                        class="category-box category-dark">
                                        <div>
                                            <img src="{{ asset('images/' . $list->category_icon) }}"
                                                class="blur-up lazyload" alt="">
                                            <h5>{{ $list->{'category_name_' . app()->getLocale() } ?? $list->category_name }}</h5>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        </div>
                    @endif

                    <div class="section-t-space section-b-space">
                        <div class="row g-md-4 g-3">
                            <div class="col-md-6">
                                <div class="banner-contain hover-effect">
                                    <img src="{{ asset('frontend/assets/images/furniture/banner/' . $tops[2]->image) }}"
                                        class="bg-img blur-up lazyload" alt="">
                                    <div class="banner-details p-center-left p-4">
                                        <div>
                                            <h3 class="text-kaushan text-yellow">{{ $tops[2]->discount }}</h3>
                                            <h4 class="theme-color mb-2 fw-normal"><span
                                                    class="theme-color fw-bold">{{ $tops[2]->phaseone }}</span>
                                                {{ $tops[2]->phasetwo }}</h4>
                                            @if ($meatHalfDiscount != null)
                                                <button
                                                    onclick="location.href = '{{ route('show-discount-product', ['ids' => $meatHalfDiscount]) }}';"
                                                    class="btn btn-furniture btn-sm mend-auto">{{ __('messages.shop_now') }} <i
                                                        class="fa-solid fa-arrow-right icon"></i></button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="banner-contain hover-effect">
                                    <img src="{{ asset('frontend/assets/images/furniture/banner/' . $tops[3]->image) }}"
                                        class="bg-img blur-up lazyload" alt="">
                                    <div class="banner-details p-center-left p-4">
                                        <div>
                                            <h3 class="text-kaushan text-yellow">{{ $tops[3]->discount }}</h3>
                                            <h4 class="theme-color mb-2 fw-normal"><span class="theme-color fw-bold">
                                                    {{ $tops[3]->phaseone }}
                                                </span> {{ $tops[3]->phasetwo }}</h4>
                                            @if ($vegetableHalfDiscount != null)
                                                <button
                                                    onclick="location.href = '{{ route('show-discount-product', ['ids' => $vegetableHalfDiscount]) }}';"
                                                    class="btn btn-furniture btn-sm mend-auto">{{ __('messages.shop_now') }} <i
                                                        class="fa-solid fa-arrow-right icon"></i></button>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (count($latestProducts) > 0)
                        <div class="title d-block">
                            <h2>{{ __('messages.newest_products') }}</h2>
                            <span class="title-leaf">
                                <svg class="icon-width">
                                    <use xlink:href="{{ asset('frontend/assets/svg/leaf.svg#leaf') }}"></use>
                                </svg>
                            </span>
                            <p>{{ __('messages.discover_latest_additions') }}</p>
                        </div>

                        <div class="row row-cols-xxl-5 row-cols-md-4 row-cols-sm-3 row-cols-2 g-sm-4 g-3 no-arrow">
                            @foreach ($latestProducts as $latestProduct)
                                <div>
                                    <div class="product-box product-white-bg wow fadeIn" data-wow-delay="0.1s">
                                        <div class="product-image">
                                            <a
                                                href="{{ route('show-product-left-thumbnail', ['id' => $latestProduct->id]) }}">
                                                <img src="{{ asset('images/' . $latestProduct->product_thambnail) }}"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </a>
                                            <ul class="product-option">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#view-newest-product{{ $latestProduct->id }}"
                                                        data-product="{{ $latestProduct->id }}">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <a
                                                        href="{{ route('show-comparelist', ['id' => $latestProduct->id]) }}">
                                                        <i data-feather="refresh-cw"></i>
                                                    </a>
                                                </li>

                                                <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="Wishlist">
                                                    <a href="{{ route('show-wishlist', ['id' => $latestProduct->id]) }}"
                                                        class="notifi-wishlist">
                                                        <i data-feather="heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                        <div class="product-detail position-relative">
                                            <a
                                                href="{{ route('show-product-left-thumbnail', ['id' => $latestProduct->id]) }}">
                                                <h6 class="name">{{ $latestProduct->product_name }}</h6>
                                            </a>

                                            <h6 class="sold weight text-content fw-normal">
                                                {{ $latestProduct->product_color }}</h6>

                                            <span
                                                class="price theme-color">¥{{ number_format($latestProduct->selling_price, 0, '.', ',') }}</span>
                                            @if ($latestProduct->discount_percent != 0)
                                                <del>¥{{ number_format($latestProduct->original_price, 0, '.', ',') }}</del>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                <!-- Quick View Modal Box Start -->
                                @if ($latestProduct->status == 1)
                                    @php
                                        $starRating = 0;
                                        $count = 0;
                                    @endphp
                                    @foreach ($reviews as $review)
                                        @if ($latestProduct->id == $review->product_id)
                                            @php
                                                $count += 1;
                                                $starRating += $review->stars_rated;
                                            @endphp
                                        @endif
                                    @endforeach
                                    @if ($count != 0)
                                        @php
                                            $starRating = $starRating / $count;
                                        @endphp
                                    @endif
                                @endif
                                <div class="modal fade theme-modal view-modal"
                                    id="view-newest-product{{ $latestProduct->id }}" tabindex="-1">
                                    <div class="modal-dialog modal-dialog-centered modal-xl">
                                        <div class="modal-content">
                                            <div class="modal-header p-0">
                                                <button type="button" class="btn-close" data-bs-dismiss="modal">
                                                    <i class="fa-solid fa-xmark"></i>
                                                </button>
                                            </div>
                                            <div class="modal-body">
                                                <div class="row g-sm-4 g-2">
                                                    <div class="col-lg-6">
                                                        <div class="slider-image">
                                                            <img src="{{ asset('images/' . $latestProduct->product_thambnail) }}"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                        </div>
                                                    </div>

                                                    <div class="col-lg-6">
                                                        <div class="right-sidebar-modal">
                                                            <h4 class="title-name">{{ $latestProduct->product_name }}
                                                            </h4>
                                                            @if ($latestProduct->discount_percent != 0)
                                                                <h4 class="price"><span
                                                                        class="theme-color">¥{{ number_format($latestProduct->selling_price, 0, '', ',') }}</span>
                                                                    <del>¥{{ number_format($latestProduct->original_price, 0, '', ',') }}</del>
                                                                @else
                                                                    <h4 class="price"><span
                                                                            class="theme-color">¥{{ number_format($latestProduct->selling_price, 0, '', ',') }}</span>
                                                            @endif
                                                            <div class="product-rating">
                                                                <ul class="rating">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        @if ($i <= $starRating)
                                                                            <li><i data-feather="star" class="fill"></i></li>
                                                                        @else
                                                                            <li><i data-feather="star"></i></li>
                                                                        @endif
                                                                    @endfor
                                                                </ul>
                                                                <span class="ms-2">{{ $count }} {{ __('messages.reviews') }}</span>
                                                            </div>
                                                            
                                                            <div class="product-detail">
                                                                <h4>{{ __('messages.product_details') }} :</h4>
                                                                <p>{!! $latestProduct->long_desc !!}</p>
                                                            </div>
                                                            
                                                            <ul class="brand-list">
                                                                <li>
                                                                    <div class="brand-box">
                                                                        <h5>{{ __('messages.brand_name') }}:</h5>
                                                                        <h6>
                                                                            @php
                                                                                $brand = DB::table('brands')->where('id', $latestProduct->brand_id)->first();
                                                                            @endphp
                                                                            {{ $brand->brand_name }}
                                                                        </h6>
                                                                    </div>
                                                                </li>
                                                            
                                                                <li>
                                                                    <div class="brand-box">
                                                                        <h5>{{ __('messages.product_code') }}:</h5>
                                                                        <h6>{{ $latestProduct->product_code }}</h6>
                                                                    </div>
                                                                </li>
                                                            
                                                                <li>
                                                                    <div class="brand-box">
                                                                        <h5>{{ __('messages.category') }}:</h5>
                                                                        <h6>
                                                                            @php
                                                                                $category = DB::table('categories')->where('id', $latestProduct->category_id)->first();
                                                                            @endphp
                                                                            {{ $category->{'category_name_' . app()->getLocale() } ?? $category->category_name }}
                                                                        </h6>
                                                                    </div>
                                                                </li>
                                                            
                                                                <li>
                                                                    <div class="brand-box">
                                                                        <h5>{{ __('messages.in_stock') }}:</h5>
                                                                        <h6>{{ $latestProduct->in_stock }}</h6>
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                            
                                                            <ul class="brand-list">
                                                                @php
                                                                    $sizes = explode(',', $latestProduct->product_size);
                                                                @endphp
                                                                <li>
                                                                    <div class="product-contain" style="display: flex; flex-wrap: wrap;">
                                                                        @foreach ($sizes as $key => $size)
                                                                            <div class="form-check" style="margin-left: 10px; margin-top: 15px;">
                                                                                <input class="form-check-input" type="radio" name="selected_latest_size_{{ $latestProduct->id }}" value="{{ $size }}" id="size_{{ $latestProduct->id }}_{{ $size }}" {{ $key === 0 ? 'checked' : '' }}>
                                                                                <label for="size_{{ $latestProduct->id }}_{{ $size }}">{{ $size }}</label>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                            
                                                            <ul class="brand-list">
                                                                @php
                                                                    $colors = explode(',', $latestProduct->product_color);
                                                                @endphp
                                                                <li>
                                                                    <div class="product-contain" style="display: flex; flex-wrap: wrap;">
                                                                        @foreach ($colors as $key => $color)
                                                                            <div class="form-check" style="margin-left: 10px; margin-top: 15px;">
                                                                                <input class="form-check-input" type="radio" name="selected_latest_color_{{ $latestProduct->id }}" value="{{ $color }}" id="color_{{ $latestProduct->id }}_{{ $color }}" {{ $key === 0 ? 'checked' : '' }}>
                                                                                <label for="color_{{ $latestProduct->id }}_{{ $color }}">{{ $color }}</label>
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                </li>
                                                            </ul>
                                                            
                                                            <div class="modal-button">
                                                                <button onclick="addToCartLatest({{ $latestProduct->id }})" class="btn btn-md add-cart-button icon" @if ($latestProduct->in_stock < 1) disabled @endif>
                                                                    {{ __('messages.add_to_cart') }}
                                                                </button>
                                                            
                                                                <button onclick="location.href = '{{ route('show-product-left-thumbnail', ['id' => $latestProduct->id]) }}';" class="btn theme-bg-color view-button icon text-white fw-bold btn-md">
                                                                    {{ __('messages.view_more_details') }}
                                                                </button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <!-- Quick View Modal Box End -->
                            @endforeach
                        </div>
                    @endif
                </div>

                <div class="col-xxl-3 col-xl-4 d-none d-xl-block">
                    <div class="p-sticky">
                        @if (count($categories) > 0)
                            <div class="category-menu">
                                <h3>{{ __('messages.categories') }}</h3>
                                <ul class="border-bottom-0">
                                    @foreach ($categories as $categorie)
                                        <li>
                                            <div class="category-list">
                                                <img src="{{ asset('images/' . $categorie->category_icon) }}"
                                                    class="blur-up lazyload" alt="">
                                                <h5>
                                                    <a
                                                        href="{{ route('show-category-left-side-bar', ['categoryid' => $categorie->id]) }}">
                                                        {{ $categorie->{'category_name_' . app()->getLocale() } ?? $categorie->category_name }}
                                                    </a>
                                                </h5>
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <div class="ratio_156 section-t-space">
                            <div class="home-contain hover-effect">
                                <img src="{{ asset('frontend/assets/images/furniture/banner/' . $tops[4]->image) }}"
                                    class="bg-img blur-up lazyload" alt="">
                                <div class="home-detail p-top-left home-p-medium">
                                    <div>
                                        <h4 class="text-yellow home-banner text-kaushan">{{ $tops[4]->discount }}
                                        </h4>
                                        <h3 class="text-uppercase theme-color fw-bold mb-1">{{ $tops[4]->phaseone }}
                                        </h3>
                                        <p class="text-content mb-3">{{ $tops[4]->phasetwo }}
                                            {{ $tops[4]->phasethree }}</p>
                                        <button
                                            onclick="location.href = '{{ route('show-discount-product', ['topic' => 'new-arrivals']) }}';"
                                            class="btn btn-furniture btn-md mend-auto">{{ __('messages.shop_now') }} <i
                                                class="fa-solid fa-arrow-right icon"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        @if (count($trendingProducts) > 0)
                            <div class="section-t-space">
                                <div class="category-menu">
                                    <h3>{{ __('messages.trending_products') }}</h3>

                                    <ul class="product-list border-0 p-0 d-block">
                                        @foreach ($trendingProducts as $trending)
                                            <li>
                                                <div class="offer-product">
                                                    <a href="{{ route('show-product-left-thumbnail', ['id' => $trending->id]) }}"
                                                        class="offer-image">
                                                        <img src="{{ asset('images/' . $trending->product_thambnail) }}"
                                                            class="blur-up lazyload" alt="">
                                                    </a>

                                                    <div class="offer-detail">
                                                        <div>
                                                            <a href="{{ route('show-product-left-thumbnail', ['id' => $trending->id]) }}"
                                                                class="text-title">
                                                                <h6 class="name">
                                                                    @if (mb_strlen($trending->product_name) > 15)
                                                                        {!! mb_substr($trending->product_name, 0, 15) . '<br>' . mb_substr($trending->product_name, 15, 15) . '...' !!}
                                                                    @else
                                                                        {!! nl2br(e($trending->product_name)) !!}
                                                                    @endif
                                                                </h6>
                                                            </a>
                                                            <span>
                                                                @if (mb_strlen($trending->product_color) > 15)
                                                                    {!! mb_substr($trending->product_color, 0, 15) . '<br>' . mb_substr($trending->product_color, 15, 15) . '...' !!}
                                                                @else
                                                                    {!! nl2br(e($trending->product_color)) !!}
                                                                @endif
                                                            </span>
                                                            <span
                                                                class="price theme-color">¥{{ number_format($latestProduct->selling_price, 0, '.', ',') }}</span>
                                                            @if ($latestProduct->discount_percent != 0)
                                                                <del>¥{{ number_format($latestProduct->original_price, 0, '.', ',') }}</del>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Banner Section Start -->
    <section class="banner-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="banner-contain-3 section-b-space section-t-space hover-effect overflow-visible">
                        <img src="{{ asset('frontend/assets/images/furniture/banner/' . $tops[5]->image) }}"
                            class="bg-img" alt="">
                        <img src="{{ asset('frontend/assets/images/furniture/banner/7.jpg') }}"
                            class="flower-pot img-fluid" alt="">
                        <div
                            class="banner-detail p-center-left position-relative d-block py-0 banner-furniture mend-auto">
                            <div class="row">
                                <div class="col-xl-6 offset-xxl-2 offset-xl-1 col-md-8 col-sm-9">
                                    <h4 class="text-uppercase text-yellow text-kaushan furniture-title">
                                        {{ $tops[5]->discount }}
                                        <img src="{{ asset('frontend/assets/images/furniture/arrow.svg') }}"
                                            alt="">
                                    </h4>
                                    <h2 class="mt-sm-3 mt-1 mb-2 text-content">{{ $tops[5]->phaseone }} <span
                                            class="theme-color fw-bold">{{ $tops[5]->phasetwo }}</span></h2>
                                    <p class="text-content">
                                        {{ $tops[5]->phasethree }}
                                    </p>
                                    <button class="btn theme-bg-color mt-sm-4 mt-2 btn-md text-white fw-bold"
                                        onclick="location.href = '{{ route('show-discount-product', ['topic' => 'value-of-the-day']) }}';">
                                        {{ __('messages.shop_now') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Banner Section End -->

    <!-- Best Seller Section Start -->
    <section>
        <div class="container-fluid-lg">
            @if (count($bestSellerProducts) > 0)
                <div class="title d-block">
                    <div>
                        <h2>{{ __('messages.best_seller') }}</h2>
                        <span class="title-leaf">
                            <svg class="icon-width">
                                <use xlink:href="{{ asset('frontend/assets/svg/leaf.svg#leaf') }}"></use>
                            </svg>
                        </span>
                        <p>{{ __('messages.explore_popular_products') }}</p>
                    </div>
                </div>
                <div class="banner-slider product-wrapper wow fadeInUp">
                    @php
                        $productCount = $bestSellerProducts->count();
                    @endphp
                    @for ($i = 0; $i < ceil($productCount / 4); $i++)
                        <div>
                            <ul class="product-list">
                                @php
                                    $index = $i * 4;
                                @endphp
                                @for ($j = 0; $j < 4 && $index + $j < $productCount; $j++)
                                    @php
                                        $product = $bestSellerProducts[$index + $j];
                                    @endphp
                                    <li>
                                        <div class="offer-product">
                                            <a href="{{ route('show-product-left-thumbnail', ['id' => $product->id]) }}"
                                                class="offer-image">
                                                <img src="{{ asset('images/' . $product->product_thambnail) }}"
                                                    class="blur-up lazyload" alt="">
                                            </a>

                                            <div class="offer-detail">
                                                <div>
                                                    <a href="{{ route('show-product-left-thumbnail', ['id' => $product->id]) }}"
                                                        class="text-title">
                                                        <h6 class="name">
                                                            @if (mb_strlen($product->product_name) > 15)
                                                                {!! mb_substr($product->product_name, 0, 15) . '<br>' . mb_substr($product->product_name, 15, 15) . '...' !!}
                                                            @else
                                                                {!! nl2br(e($product->product_name)) !!}
                                                            @endif
                                                        </h6>
                                                    </a>
                                                    <span>
                                                        @if (mb_strlen($product->product_size) > 15)
                                                            {!! mb_substr($product->product_size, 0, 15) . '<br>' . mb_substr($product->product_size, 15, 15) . '...' !!}
                                                        @else
                                                            {!! nl2br(e($product->product_size)) !!}
                                                        @endif
                                                    </span>
                                                    <h6 class="price theme-color">
                                                        ¥{{ number_format($product->selling_price, 0, '.', ',') }}
                                                    </h6>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                @endfor
                            </ul>
                        </div>
                    @endfor
                </div>
            @endif
        </div>
    </section>
    <!-- Best Seller Section End -->

    <!-- Newsletter Section Start -->
    <section class="newsletter-section section-b-space">
        <div class="container-fluid-lg">
            <div class="newsletter-box newsletter-box-2">
                <div class="newsletter-contain py-5">
                    <div class="container-fluid">
                        @include('components.messagebox')
                        <div class="row">
                            <div class="col-xxl-4 col-lg-5 col-md-7 col-sm-9 offset-xxl-2 offset-md-1">
                                <div class="newsletter-detail">
                                    <h2>{{ __('messages.join_our_newsletter') }}</h2>
                                    <h5>{{ __('messages.get_latest_info') }}</h5>
                                    @php $action= route('registernewsletter'); @endphp
                                    <form class="theme-form theme-form-2 mega-form" id="registernewsletter"
                                        class="contact-form" method="POST" action="{{ $action }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="input-box">
                                            <input type="email" class="form-control" id="newsletter"
                                                name="newsletter" placeholder="{{ __('messages.enter_your_email') }}">
                                            <i class="fa-solid fa-envelope arrow"></i>
                                            <button class="sub-btn btn-submit btn-animation">
                                                <span class="d-sm-block d-none">{{ __('messages.subscribe') }}</span>
                                                <i class="fa-solid fa-arrow-right icon"></i>
                                            </button>
                                        </div>
                                        <p style="display:none" class="newsletter error text-danger"></p>
                                        @if (!empty($error['newsletter']))
                                            @foreach ($error['newsletter'] as $key => $value)
                                                <p class="newsletter error text-danger">{{ $value }}</p>
                                            @endforeach
                                        @endif
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Newsletter Section End -->

    <!-- Cookie Bar Box Start -->
    <div class="cookie-bar-box">
        <div class="cookie-box">
            <div class="cookie-image">
                <img src="{{ asset('frontend/assets/images/cookie-bar.png') }}" class="blur-up lazyload"
                    alt="">
                <h2>{{ __('messages.cookies') }}</h2>
            </div>

            <div class="cookie-contain">
                <h5 class="text-content">{{ __('messages.cookies_message') }}</h5>
            </div>
        </div>

        <div class="button-group">
            <a href="{{ url('/privacy-policy') }}" class="text-content">
                <button class="btn privacy-button">{{ __('messages.privacy_policy') }}</button>
            </a>
            <button class="btn ok-button">{{ __('messages.btn_ok') }}</button>
        </div>
    </div>
    <!-- Cookie Bar Box End -->

    <script>
        var today = new Date();
        var formattedDate = today.getFullYear() + '/' + ('0' + (today.getMonth() + 1)).slice(-2) + '/' + ('0' + today
            .getDate()).slice(-2);
        document.getElementById("formatted-date").innerText = formattedDate;
    </script>
    <script>
        $('.btn-submit').click(function() {
            $('.error').hide();
            var email = $.trim($("#newsletter").val());
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
            const localeMessages = {
                enterYourEmail: "{{ __('messages.enter_your_email_error_message') }}",
                validYourEmail: "{{ __('messages.valid_your_email_error_message') }}"
            };
            if (email === "") {
                $('.error.newsletter').text(localeMessages.enterYourEmail);
                $('.error.newsletter').show();
                return false;
            } else if (!emailPattern.test(email)) {
                $('.error.newsletter').text(localeMessages.validYourEmail);
                $('.error.newsletter').show();
                return false;
            } else {
                $('.error').hide();
                $('#confirmModal').modal('show');
            }
        });
    </script>
    <script>
        function addToCartCoupon(productId) {
            const selectedSize = document.querySelector(`input[name="selected_coupon_size_${productId}"]:checked`).value;
            const selectedColor = document.querySelector(`input[name="selected_coupon_color_${productId}"]:checked`).value;

            const url = new URL('{{ route('show_carts', ['id' => '__ID__']) }}'.replace('__ID__', productId));
            url.searchParams.append('size', selectedSize);
            url.searchParams.append('color', selectedColor);

            location.href = url.toString();
        }
        function addToCartLatest(productId) {
            const selectedSize = document.querySelector(`input[name="selected_latest_size_${productId}"]:checked`).value;
            const selectedColor = document.querySelector(`input[name="selected_latest_color_${productId}"]:checked`).value;

            const url = new URL('{{ route('show_carts', ['id' => '__ID__']) }}'.replace('__ID__', productId));
            url.searchParams.append('size', selectedSize);
            url.searchParams.append('color', selectedColor);

            location.href = url.toString();
        }
    </script>
</x-guest-layout>