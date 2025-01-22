<x-guest-layout>

    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Product details</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="{{ url('/') }}">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>

                                <li class="breadcrumb-item active">Product</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Left Sidebar Start -->
    @if (!$product)
        <h1 class="text-center">Product Not Found</h1>
    @else
        <section class="product-section">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-xxl-9 col-xl-8 col-lg-7 wow fadeInUp">
                        <div class="row g-4">
                            <div class="col-xl-6 wow fadeInUp">
                                <div class="product-left-box">
                                    <div class="row g-2">
                                        <div class="col-xxl-10 col-lg-12 col-md-10 order-xxl-2 order-lg-1 order-md-2">
                                            <div class="product-main-2 no-arrow">
                                                <div>
                                                    <div class="slider-image">
                                                        <img src="{{ asset('images/' . $product->product_thambnail) }}"
                                                            id="img-1"
                                                            data-zoom-image="{{ asset('images/' . $product->product_thambnail) }}"
                                                            class="img-fluid image_zoom_cls-0 blur-up lazyload"
                                                            alt="">
                                                    </div>
                                                </div>
                                                @foreach ($multiImages as $image)
                                                    <div>
                                                        <div class="slider-image">
                                                            <img src="{{ asset('upload/multiImg/' . $image->photo_name) }}"
                                                                data-zoom-image="{{ asset('upload/multiImg/' . $image->photo_name) }}"
                                                                class="img-fluid image_zoom_cls-1 blur-up lazyload"
                                                                alt="">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>

                                        <div class="col-xxl-2 col-lg-12 col-md-2 order-xxl-1 order-lg-2 order-md-1">
                                            <div class="left-slider-image-2 left-slider no-arrow slick-top">
                                                <div>
                                                    <div class="sidebar-image">
                                                        <img src="{{ asset('images/' . $product->product_thambnail) }}"
                                                            class="img-fluid blur-up lazyload" alt="">
                                                    </div>
                                                </div>
                                                @foreach ($multiImages as $image)
                                                    <div>
                                                        <div class="sidebar-image">
                                                            <img src="{{ asset('upload/multiImg/' . $image->photo_name) }}"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xl-6 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="right-box-contain">
                                    @if ($product->discount_percent != 0)
                                        <h6 class="offer-top">{{ $product->discount_percent }}% Off</h6>
                                    @endif
                                    <h2 class="name">{{ $product->product_name }}</h2>
                                    <div class="price-rating">
                                        @if ($product->discount_percent != 0)
                                            <h5 class="price"><span
                                                    class="theme-color">¥{{ number_format($product->selling_price, 0, '', ',') }}</span>
                                                <del>¥{{ number_format($product->original_price, 0, '', ',') }}</del>
                                                <span class="offer theme-color">({{ $product->discount_percent }}%
                                                    off)</span></h3>
                                            @else
                                                <h5 class="price"><span
                                                        class="theme-color">¥{{ number_format($product->selling_price, 0, '', ',') }}</span>
                                        @endif
                                        @php
                                            $starRating = 0;
                                            $count = 0;
                                        @endphp
                                        @foreach ($reviews as $review)
                                            @if ($product->id == $review->product_id)
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
                                        <div class="product-rating custom-rate">
                                            <ul class="rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $starRating)
                                                        <li><i data-feather="star" class="fill"></i></li>
                                                    @else
                                                        <li><i data-feather="star"></i></li>
                                                    @endif
                                                @endfor
                                            </ul>
                                            <span class="review"><?php echo $count; ?> Customer Review</span>
                                        </div>
                                    </div>

                                    <div class="product-contain">
                                        <p>
                                            {{ $product->short_desc }}
                                        </p>
                                    </div>

                                    @php
                                        $sizes = explode(',', $product->product_size);
                                    @endphp
                                    <div class="product-contain" style="display: flex; flex-wrap: wrap;">
                                        @foreach ($sizes as $key => $size)
                                            <div class="form-check" style="margin-left: 10px; margin-top: 15px;">
                                                <input class="form-check-input" type="radio" name="selected_size"
                                                    value="{{ $size }}" id="size_{{ $size }}"
                                                    {{ $key === 0 ? 'checked' : '' }}>
                                                {{ $size }}
                                            </div>
                                        @endforeach
                                    </div>

                                    @php
                                        $colors = explode(',', $product->product_color);
                                    @endphp
                                    <div class="product-contain" style="display: flex; flex-wrap: wrap;">
                                        @foreach ($colors as $key => $color)
                                            <div class="form-check" style="margin-left: 10px; margin-top: 15px;">
                                                <input class="form-check-input" type="radio" name="selected_color"
                                                    value="{{ $color }}" id="color_{{ $color }}"
                                                    {{ $key === 0 ? 'checked' : '' }}>
                                                {{ $color }}
                                            </div>
                                        @endforeach
                                    </div>

                                    <div class="note-box product-package">
                                        <button onclick="addToCart({{ $product->id }})"
                                            class="btn btn-md bg-dark cart-button text-white w-100"
                                            @if ($product->in_stock < 1) disabled @endif>
                                            Add To Cart
                                        </button>
                                    </div>

                                    <div class="progress-sec">
                                        <div class="left-progressbar">
                                            @if ($product->in_stock > 0)
                                                <h6>Please hurry! Only {{ $product->in_stock }} left in stock</h6>
                                            @else
                                                <h6>No stock left</h6>
                                            @endif
                                            <div role="progressbar" class="progress warning-progress">
                                                <?php
                                                if ($product->in_stock >= 10) {
                                                    $percentage = 100;
                                                } else {
                                                    $percentage = $product->in_stock * 10;
                                                }
                                                ?>
                                                <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                    style="width: <?php echo $percentage; ?>%;"></div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="buy-box">
                                        <a href="{{ route('show-wishlist', ['id' => $id]) }}">
                                            <i data-feather="heart"></i>
                                            <span>Add To Wishlist</span>
                                        </a>
                                        <a href="{{ route('show-comparelist', ['id' => $id]) }}">
                                            <i data-feather="shuffle"></i>
                                            <span>Add To Compare</span>
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="product-section-box">
                                    <ul class="nav nav-tabs custom-nav" id="myTab" role="tablist">
                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                                data-bs-target="#description" type="button"
                                                role="tab">Description</button>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="info-tab" data-bs-toggle="tab"
                                                data-bs-target="#info" type="button" role="tab">Additional
                                                info</button>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="care-tab" data-bs-toggle="tab"
                                                data-bs-target="#care" type="button" role="tab">Care
                                                Instructions</button>
                                        </li>

                                        <li class="nav-item" role="presentation">
                                            <button class="nav-link" id="review-tab" data-bs-toggle="tab"
                                                data-bs-target="#review" type="button"
                                                role="tab">Review</button>
                                        </li>
                                    </ul>

                                    <div class="tab-content custom-tab" id="myTabContent">
                                        <div class="tab-pane fade show active" id="description" role="tabpanel">
                                            <div class="product-description">
                                                <div class="nav-desh">
                                                    <p>{!! $product->long_desc !!}</p>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="info" role="tabpanel">
                                            <div class="table-responsive">
                                                <table class="table info-table">
                                                    <tbody>
                                                        <tr>
                                                            <td>Brand</td>
                                                            <td>
                                                                @php
                                                                    $brand = DB::table('brands')
                                                                        ->where('id', $product->brand_id)
                                                                        ->first();
                                                                @endphp
                                                                {{ $brand->brand_name }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Made In</td>
                                                            <td>
                                                                @php
                                                                    $country = DB::table('countries')
                                                                        ->where('id', $product->country_id)
                                                                        ->first();
                                                                @endphp
                                                                {{ $country->name }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Shop</td>
                                                            <td>
                                                                @php
                                                                    $seller = DB::table('sellers')
                                                                        ->where('user_id', $product->seller_id)
                                                                        ->first();
                                                                @endphp
                                                                {{ $seller->shop_name }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Category</td>
                                                            <td>
                                                                @php
                                                                    $category = DB::table('categories')
                                                                        ->where('id', $product->category_id)
                                                                        ->first();
                                                                @endphp
                                                                {{ $category->category_name }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Sub Category</td>
                                                            <td>
                                                                @php
                                                                    $sub_category = DB::table('sub_categories')
                                                                        ->where('id', $product->sub_category_id)
                                                                        ->first();
                                                                @endphp
                                                                {{ $sub_category->sub_category_name }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>In Stock</td>
                                                            <td>{{ $product->in_stock }}</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Delivery Fee</td>
                                                            <td>¥
                                                                {{ number_format($product->delivery_price, '0', '', ',') }}
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td>Estimated Day</td>
                                                            <td>{{ $product->estimate_date }} days</td>
                                                        </tr>
                                                        <tr>
                                                            <td>Shipping From</td>
                                                            <td>
                                                                @if ($product->shipping_country == 1)
                                                                    Abroad
                                                                @else
                                                                    Japan
                                                                @endif
                                                            </td>
                                                        </tr>
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="care" role="tabpanel">
                                            <div class="">
                                                <ul>
                                                    <li>{!! $product->care_instructions !!}</li>
                                                </ul>
                                            </div>
                                        </div>

                                        <div class="tab-pane fade" id="review" role="tabpanel">
                                            <div class="review-box">
                                                <div class="row">
                                                    <div class="col-xl-5">
                                                        <div class="product-rating-box">
                                                            <div class="row">
                                                                <div class="col-xl-12">
                                                                    <div class="product-main-rating">
                                                                        @php
                                                                            $starRating = 0;
                                                                            $count = 0;
                                                                            $rate1 = 0;
                                                                            $rate2 = 0;
                                                                            $rate3 = 0;
                                                                            $rate4 = 0;
                                                                            $rate5 = 0;
                                                                        @endphp
                                                                        @foreach ($reviews as $review)
                                                                            @php
                                                                                $count += 1;
                                                                                $starRating += $review->stars_rated;
                                                                                if ($review->stars_rated == 1) {
                                                                                    $rate1 += 1;
                                                                                } elseif ($review->stars_rated == 2) {
                                                                                    $rate2 += 1;
                                                                                } elseif ($review->stars_rated == 3) {
                                                                                    $rate3 += 1;
                                                                                } elseif ($review->stars_rated == 4) {
                                                                                    $rate4 += 1;
                                                                                } elseif ($review->stars_rated == 5) {
                                                                                    $rate5 += 1;
                                                                                }
                                                                            @endphp
                                                                        @endforeach
                                                                        @if ($count != 0)
                                                                            @php
                                                                                $starRating = $starRating / $count;
                                                                            @endphp
                                                                        @endif
                                                                        <h2>{{ number_format($starRating, 1) }}
                                                                            <i data-feather="star"></i>
                                                                        </h2>

                                                                        <h5>{{ $count }} Overall Ratings</h5>
                                                                    </div>
                                                                </div>

                                                                <div class="col-xl-12">
                                                                    <ul class="product-rating-list">
                                                                        <li>
                                                                            <div class="rating-product">
                                                                                <h5>5<i data-feather="star"></i></h5>
                                                                                <div class="progress">
                                                                                    <div class="progress-bar"
                                                                                        style="width: {{ $count != 0 ? ($rate5 * 100) / $count . '%' : '0%' }};">
                                                                                    </div>
                                                                                </div>
                                                                                <h5 class="total">{{ $rate5 }}
                                                                                </h5>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="rating-product">
                                                                                <h5>4<i data-feather="star"></i></h5>
                                                                                <div class="progress">
                                                                                    <div class="progress-bar"
                                                                                        style="width: {{ $count != 0 ? ($rate4 * 100) / $count . '%' : '0%' }};">
                                                                                    </div>
                                                                                </div>
                                                                                <h5 class="total">{{ $rate4 }}
                                                                                </h5>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="rating-product">
                                                                                <h5>3<i data-feather="star"></i></h5>
                                                                                <div class="progress">
                                                                                    <div class="progress-bar"
                                                                                        style="width: {{ $count != 0 ? ($rate3 * 100) / $count . '%' : '0%' }};">
                                                                                    </div>
                                                                                </div>
                                                                                <h5 class="total">{{ $rate3 }}
                                                                                </h5>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="rating-product">
                                                                                <h5>2<i data-feather="star"></i></h5>
                                                                                <div class="progress">
                                                                                    <div class="progress-bar"
                                                                                        style="width: {{ $count != 0 ? ($rate2 * 100) / $count . '%' : '0%' }};">
                                                                                    </div>
                                                                                </div>
                                                                                <h5 class="total">{{ $rate2 }}
                                                                                </h5>
                                                                            </div>
                                                                        </li>
                                                                        <li>
                                                                            <div class="rating-product">
                                                                                <h5>1<i data-feather="star"></i></h5>
                                                                                <div class="progress">
                                                                                    <div class="progress-bar"
                                                                                        style="width: {{ $count != 0 ? ($rate1 * 100) / $count . '%' : '0%' }};">
                                                                                    </div>
                                                                                </div>
                                                                                <h5 class="total">{{ $rate1 }}
                                                                                </h5>
                                                                            </div>
                                                                        </li>

                                                                    </ul>

                                                                    <div class="review-title-2">
                                                                        <h4 class="fw-bold">Review this product</h4>
                                                                        <p>Let other customers know what you think</p>
                                                                        <button class="btn" type="button"
                                                                            data-bs-toggle="modal"
                                                                            data-bs-target="#writereview"
                                                                            <?php if (!Auth::user()) {
                                                                                echo 'disabled';
                                                                            } ?>>Write a
                                                                            review</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-xl-7">
                                                        <div class="review-people">
                                                            <ul class="review-list">
                                                                @foreach ($reviews as $review)
                                                                    @php
                                                                        $user = DB::table('users')
                                                                            ->where('id', $review->user_id)
                                                                            ->first();
                                                                    @endphp
                                                                    <li>
                                                                        <div class="people-box">
                                                                            <div>
                                                                                <div class="people-image people-text">
                                                                                    @if ($user->user_photo)
                                                                                        <img alt="user"
                                                                                            class="img-fluid "
                                                                                            src="{{ asset('upload/profile/' . $user->user_photo) }}">
                                                                                    @else
                                                                                        <img alt="user"
                                                                                            class="img-fluid "
                                                                                            src="{{ asset('upload/profile/profile.jpg') }}">
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                            <div class="people-comment">
                                                                                <div class="people-name"><a
                                                                                        href="javascript:void(0)"
                                                                                        class="name">{{ $user->name }}</a>
                                                                                    <div class="date-time">
                                                                                        <h6 class="text-content">
                                                                                            {{ date('Y/m/d H:i:s', strtotime($review->updated_at)) }}
                                                                                        </h6>
                                                                                        <div class="product-rating">
                                                                                            <ul class="rating">
                                                                                                @for ($i = 1; $i <= 5; $i++)
                                                                                                    @if ($i <= $review->stars_rated)
                                                                                                        <li><i data-feather="star"
                                                                                                                class="fill"></i>
                                                                                                        </li>
                                                                                                    @else
                                                                                                        <li><i
                                                                                                                data-feather="star"></i>
                                                                                                        </li>
                                                                                                    @endif
                                                                                                @endfor
                                                                                            </ul>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <div class="reply">
                                                                                    <p>{{ $review->comment }}</p>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-3 col-xl-4 col-lg-5 d-none d-lg-block wow fadeInUp">
                        <div class="right-sidebar-box">
                            <div class="vendor-box">
                                <div class="vendor-contain">
                                    <div class="vendor-image">
                                        <img src="{{ asset('images/' . $product->user->seller->shop_logo) }}"
                                            class="blur-up lazyload" alt="">
                                    </div>

                                    <div class="vendor-name">
                                        <h5 class="fw-500">{{ $product->user->seller->shop_name }}</h5>

                                        <div class="product-rating mt-1">
                                            <ul class="rating">
                                                @for ($i = 1; $i <= 5; $i++)
                                                    @if ($i <= $ratingWithProductCount[0])
                                                        <li><i data-feather="star" class="fill"></i></li>
                                                    @else
                                                        <li><i data-feather="star"></i></li>
                                                    @endif
                                                @endfor
                                            </ul>
                                            <span>({{ $ratingWithProductCount[1] }} Reviews)</span>
                                        </div>

                                    </div>
                                </div>

                                <div class="vendor-list">
                                    <ul>
                                        <li>
                                            <div class="address-contact">
                                                <i data-feather="map-pin"></i>
                                                <h5>Address: <span
                                                        class="text-content">〒{{ $product->user->seller->zip_code }}</span><br>
                                                    <span
                                                        class="text-content">{{ $product->user->seller->country->name }}</span><br>
                                                    <span
                                                        class="text-content">{{ $product->user->seller->prefecture }}</span><br>
                                                    <span
                                                        class="text-content">{{ $product->user->seller->city }}</span><br>
                                                    <span
                                                        class="text-content">{{ $product->user->seller->chome }}</span><br>
                                                    <span
                                                        class="text-content">{{ $product->user->seller->building }}</span><br>
                                                    <span
                                                        class="text-content">{{ $product->user->seller->room }}</span>
                                                </h5>
                                            </div>
                                        </li>

                                        <li>
                                            <div class="address-contact">
                                                <i data-feather="headphones"></i>
                                                <h5>Contact Seller: <span
                                                        class="text-content">{{ $product->user->seller->phone }}</span>
                                                </h5>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <!-- Trending Product -->
                            @if ($topProducts->count() > 0)
                                <div class="pt-25">
                                    <div class="category-menu">
                                        <h3>Trending Products</h3>

                                        <ul class="product-list product-right-sidebar border-0 p-0">
                                            @foreach ($topProducts as $topProduct)
                                                @php
                                                    $prod = DB::table('products')
                                                        ->where('id', $topProduct->product_id)
                                                        ->first();
                                                @endphp
                                                @if ($prod)
                                                    <li>
                                                        <div class="offer-product">
                                                            <a href="{{ route('show-product-left-thumbnail', ['id' => $prod->id]) }}"
                                                                class="offer-image">
                                                                <img src="{{ asset('images/' . $prod->product_thambnail) }}"
                                                                    class="img-fluid blur-up lazyload" alt="">
                                                            </a>

                                                            <div class="offer-detail">
                                                                <div>
                                                                    <a
                                                                        href="{{ route('show-product-left-thumbnail', ['id' => $prod->id]) }}">
                                                                        <h6 class="name">
                                                                            @if (mb_strlen($prod->product_name) > 15)
                                                                                {!! mb_substr($prod->product_name, 0, 15) . '<br>' . mb_substr($prod->product_name, 15, 15) . '...' !!}
                                                                            @else
                                                                                {!! nl2br(e($prod->product_name)) !!}
                                                                            @endif
                                                                        </h6>
                                                                    </a>
                                                                    @if ($prod->discount_percent != 0)
                                                                        <h6 class="price"><span
                                                                                class="theme-color">¥{{ number_format($prod->selling_price) }}</span>
                                                                            <del>¥{{ number_format($prod->original_price) }}</del>
                                                                        @else
                                                                            <h5 class="price"><span
                                                                                    class="theme-color">¥{{ number_format($prod->selling_price) }}</span>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endif
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
        <!-- Product Left Sidebar End -->

        <!-- Related Product Section Start -->
        @if ($relatedProducts->count() > 0)
            <section class="product-list-section section-b-space">
                <div class="container-fluid-lg">
                    <div class="title">
                        <h2>Related Products</h2>
                        <span class="title-leaf">
                            <svg class="icon-width">
                                <use xlink:href="{{ asset('frontend/assets/svg/leaf.svg#leaf') }}"></use>
                            </svg>
                        </span>
                    </div>
                    <div class="row">
                        <div class="col-12">
                            <div class="slider-6_1 product-wrapper">
                                @foreach ($relatedProducts as $relatedProduct)
                                    @if ($relatedProduct->status == 1)
                                        @php
                                            $starRating = 0;
                                            $count = 0;
                                        @endphp
                                        @foreach ($reviewAll as $review)
                                            @if ($relatedProduct->id == $review->product_id)
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
                                        <div>
                                            <div class="product-box-3 wow fadeInUp">
                                                <div class="product-header">
                                                    <div class="product-image">
                                                        <a
                                                            href="{{ route('show-product-left-thumbnail', ['id' => $relatedProduct->id]) }}">
                                                            <img src="{{ asset('images/' . $relatedProduct->product_thambnail) }}"
                                                                class="img-fluid blur-up lazyload" alt="">
                                                        </a>

                                                        <ul class="product-option">
                                                            <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="View">
                                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                    data-bs-target="#view-product{{ $relatedProduct->id }}"
                                                                    data-product="{{ $relatedProduct->id }}">
                                                                    <i data-feather="eye"></i>
                                                                </a>
                                                            </li>

                                                            <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Compare">
                                                                <a
                                                                    href="{{ route('show-comparelist', ['id' => $product->id]) }}">
                                                                    <i data-feather="refresh-cw"></i>
                                                                </a>
                                                            </li>

                                                            <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                                title="Wishlist">
                                                                <a href="{{ route('show-wishlist', ['id' => $product->id]) }}"
                                                                    class="notifi-wishlist">
                                                                    <i data-feather="heart"></i>
                                                                </a>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </div>

                                                <div class="product-footer">
                                                    <div class="product-detail">
                                                        <span
                                                            class="span-name">{{ $relatedProduct->Category->category_name }}</span>
                                                        <a
                                                            href="{{ route('show-product-left-thumbnail', ['id' => $relatedProduct->id]) }}">
                                                            <h5 class="name">
                                                                @if (mb_strlen($relatedProduct->product_name) > 18)
                                                                    {!! mb_substr($relatedProduct->product_name, 0, 18) . '...' !!}
                                                                @else
                                                                    {!! nl2br(e($relatedProduct->product_name)) !!}
                                                                @endif
                                                            </h5>
                                                        </a>
                                                        <div class="product-rating mt-2">
                                                            <ul class="rating">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($i <= $starRating)
                                                                        <li><i data-feather="star" class="fill"></i>
                                                                        </li>
                                                                    @else
                                                                        <li><i data-feather="star"></i></li>
                                                                    @endif
                                                                @endfor
                                                            </ul>
                                                            <span>(<?php echo number_format($starRating, 1); ?>)</span>
                                                        </div>
                                                        <h6 class="unit">
                                                            @if (mb_strlen($relatedProduct->product_size) > 20)
                                                                {!! mb_substr($relatedProduct->product_size, 0, 20) . '...' !!}
                                                            @else
                                                                {!! nl2br(e($relatedProduct->product_size)) !!}
                                                            @endif
                                                        </h6>
                                                        @if ($product->discount_percent != 0)
                                                            <h5 class="price"><span
                                                                    class="theme-color">¥{{ number_format($product->selling_price, 0, '', ',') }}</span>
                                                                <del>¥{{ number_format($product->original_price, 0, '', ',') }}</del>
                                                            @else
                                                                <h5 class="price"><span
                                                                        class="theme-color">¥{{ number_format($product->selling_price, 0, '', ',') }}</span>
                                                        @endif
                                                        </h5>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        @endif
        <!-- Related Product Section End -->


        <!-- Quick View Modal Box Start -->
        @foreach ($relatedProducts as $relproduct)
            @if ($relproduct->status == 1)
                @php
                    $starRating = 0;
                    $count = 0;
                @endphp
                @foreach ($reviews as $review)
                    @if ($relproduct->id == $review->product_id)
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
                <div class="modal fade theme-modal view-modal" id="view-product{{ $relproduct->id }}"
                    tabindex="-1">
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
                                            <img src="{{ asset('images/' . $relproduct->product_thambnail) }}"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </div>
                                    </div>

                                    <div class="col-lg-6">
                                        <div class="right-sidebar-modal">
                                            <h4 class="title-name">{{ $relproduct->product_name }}</h4>
                                            @if ($relproduct->discount_percent != 0)
                                                <h4 class="price"><span
                                                        class="theme-color">¥{{ number_format($relproduct->selling_price, 0, '', ',') }}</span>
                                                    <del>¥{{ number_format($relproduct->original_price, 0, '', ',') }}</del>
                                                @else
                                                    <h4 class="price"><span
                                                            class="theme-color">¥{{ number_format($relproduct->selling_price, 0, '', ',') }}</span>
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
                                                <span class="ms-2">{{ $count }} Reviews</span>
                                            </div>

                                            <div class="product-detail">
                                                <h4>Product Details :</h4>
                                                <p>{!! $relproduct->long_desc !!}</p>
                                            </div>

                                            <ul class="brand-list">
                                                <li>
                                                    <div class="brand-box">
                                                        <h5>Brand Name:</h5>
                                                        <h6>
                                                            @php
                                                                $brand = DB::table('brands')
                                                                    ->where('id', $relproduct->brand_id)
                                                                    ->first();
                                                            @endphp
                                                            {{ $brand->brand_name }}
                                                        </h6>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="brand-box">
                                                        <h5>Product Code:</h5>
                                                        <h6>{{ $relproduct->product_code }}</h6>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="brand-box">
                                                        <h5>Category:</h5>
                                                        <h6>
                                                            @php
                                                                $category = DB::table('categories')
                                                                    ->where('id', $relproduct->category_id)
                                                                    ->first();
                                                            @endphp
                                                            {{ $category->category_name }}
                                                        </h6>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="brand-box">
                                                        <h5>In Stock:</h5>
                                                        <h6>{{ $relproduct->in_stock }}</h6>
                                                    </div>
                                                </li>
                                            </ul>
                                            <ul class="brand-list">
                                                @php
                                                    $sizes = explode(',', $relproduct->product_size);
                                                @endphp
                                                <li>
                                                    <div class="product-contain"
                                                        style="display: flex; flex-wrap: wrap;">
                                                        @foreach ($sizes as $key => $size)
                                                            <div class="form-check"
                                                                style="margin-left: 10px; margin-top: 15px;">
                                                                <input class="form-check-input" type="radio"
                                                                    name="selected_size_{{ $relproduct->id }}"
                                                                    value="{{ $size }}"
                                                                    id="size_{{ $relproduct->id }}_{{ $size }}"
                                                                    {{ $key === 0 ? 'checked' : '' }}>
                                                                <label
                                                                    for="size_{{ $relproduct->id }}_{{ $size }}">{{ $size }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </li>
                                            </ul>
                                            <ul class="brand-list">
                                                @php
                                                    $colors = explode(',', $relproduct->product_color);
                                                @endphp
                                                <li>
                                                    <div class="product-contain"
                                                        style="display: flex; flex-wrap: wrap;">
                                                        @foreach ($colors as $key => $color)
                                                            <div class="form-check"
                                                                style="margin-left: 10px; margin-top: 15px;">
                                                                <input class="form-check-input" type="radio"
                                                                    name="selected_color_{{ $relproduct->id }}"
                                                                    value="{{ $color }}"
                                                                    id="color_{{ $relproduct->id }}_{{ $color }}"
                                                                    {{ $key === 0 ? 'checked' : '' }}>
                                                                <label
                                                                    for="color_{{ $relproduct->id }}_{{ $color }}">{{ $color }}</label>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </li>
                                            </ul>
                                            <div class="modal-button">
                                                <button
                                                    onclick="location.href = '{{ route('show_carts', ['id' => $relproduct->id]) }}';"
                                                    class="btn btn-md add-cart-button icon"
                                                    @if ($relproduct->in_stock < 1) disabled @endif>Add
                                                    To Cart</button>

                                                <button
                                                    onclick="location.href = '{{ route('show-product-left-thumbnail', ['id' => $relproduct->id]) }}';"
                                                    class="btn theme-bg-color view-button icon text-white fw-bold btn-md">
                                                    View More Details</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
        <!-- Quick View Modal Box End -->

        <!-- Review Modal Start -->
        <div class="modal fade theme-modal question-modal" id="writereview" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel">Write a review</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal">
                            <i class="fa-solid fa-xmark"></i>
                        </button>
                    </div>
                    <form class="product-review-form" action="{{ route('reviews') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="modal-body">
                            <div class="product-wrapper">
                                <div class="product-image">
                                    <img class="img-fluid" alt="{{ $product->product_name }}"
                                        src="{{ asset('images/' . $product->product_thambnail) }}">
                                </div>
                                <div class="product-content">
                                    <h5 class="name">{{ $product->product_name }}</h5>
                                    <div class="product-review-rating">
                                        <div class="product-rating">
                                            <h6 class="price">
                                                <span
                                                    class="theme-color">¥{{ number_format($product->selling_price, 0, '', ',') }}</span>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="review-box">
                                <div class="rating-css">
                                    <div class="star-icon">
                                        <input type="radio" value="1" name="rating" checked id="rating1">
                                        <label for="rating1" class="fa fa-star"></label>
                                        <input type="radio" value="2" name="rating" id="rating2">
                                        <label for="rating2" class="fa fa-star"></label>
                                        <input type="radio" value="3" name="rating" id="rating3">
                                        <label for="rating3" class="fa fa-star"></label>
                                        <input type="radio" value="4" name="rating" id="rating4">
                                        <label for="rating4" class="fa fa-star"></label>
                                        <input type="radio" value="5" name="rating" id="rating5">
                                        <label for="rating5" class="fa fa-star"></label>
                                    </div>
                                </div>
                            </div>
                            <div class="review-box">
                                <label for="comment" class="form-label">Your Comment *</label>
                                <textarea id="comment" name="comment" rows="3" class="form-control" placeholder="Your Comment"></textarea>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-md fw-bold text-light theme-bg-color">Save</button>
                            <button type="button" class="btn btn-md fw-bold text-light" data-bs-dismiss="modal"
                                style="background-color: #ff6b6b;">Close</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- Review Modal End -->
        <!-- Bg overlay Start -->
        </div>
    @endif
    <!-- Bg overlay End -->
    <script>
        function addToCart(productId) {
            const selectedSize = document.querySelector('input[name="selected_size"]:checked').value;
            const selectedColor = document.querySelector('input[name="selected_color"]:checked').value;

            const url = new URL('{{ route('show_carts', ['id' => '__ID__']) }}'.replace('__ID__', productId));
            url.searchParams.append('size', selectedSize);
            url.searchParams.append('color', selectedColor);

            location.href = url.toString();
        }
    </script>
</x-guest-layout>
