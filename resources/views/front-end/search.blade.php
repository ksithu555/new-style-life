<x-guest-layout>
    <style>
        ul.nav{
            list-style-type: none !important;
        }

    </style>

    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Search</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="/">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Search</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->
<body>
    <!-- Search Bar Section Start -->
    <section class="search-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-6 col-xl-8 mx-auto">
                    <div class="title d-block text-center">
                        <h2>Search for products</h2>
                        <span class="title-leaf">
                            <svg class="icon-width">
                                <use xlink:href="{{ asset('frontend/assets/svg/leaf.svg#leaf') }}"></use>
                            </svg>
                        </span>
                    </div>

                    <div class="search-box">
                        <form id="mainSearchForm" action="{{ route('footer_search') }}" method="GET">
                            <div class="input-group">
                                <input type="search" class="form-control" name="footerSearch" placeholder="" value="{{ request("footerSearch") }}">
                                <button class="btn theme-bg-color text-white m-0" type="submit" id="button-addon1">
                                    <i data-feather="search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Search Bar Section End -->
    <!-- Product Section Start -->
    <section class="section-b-space">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="search-product product-wrapper category-slider-2 product-wrapper no-arrow">
                        @foreach ($products as $product)
                            @if ($product->status == 1)
                            <div>
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
                                <div class="product-box-3 h-100">
                                    <div class="product-header">
                                        <div class="product-image">
                                            <a href="{{ route('show-product-left-thumbnail', ['id' => $product->id]) }}">
                                                <img width="100" src="{{ asset('images/'.$product->product_thambnail) }}"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </a>
                                            <ul class="product-option d-flex justify-content-center">
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                    <a href="javascript:void(0)" data-bs-toggle="modal"
                                                        data-bs-target="#view-product{{ $product->id }}" data-product="{{ $product->id }}">
                                                        <i data-feather="eye"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                    <a href="{{ route('show-comparelist', ['id' => $product->id ]) }}">
                                                        <i data-feather="refresh-cw"></i>
                                                    </a>
                                                </li>
                                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                    <a href="{{ route('show-wishlist', ['id' => $product->id]) }}" class="notifi-wishlist">
                                                        <i data-feather="heart"></i>
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>

                                    <div class="product-footer">
                                        <div class="product-detail">
                                            <span class="span-name">{{ $product->Category->category_name }}</span>
                                            <a href="{{ route('show-product-left-thumbnail', ['id' => $product->id]) }}">
                                                <h5 class="name">{{ $product->product_name }}</h5>
                                            </a>
                                            <p class="text-content mt-1 mb-2 product-content">{{ $product->short_desc }}</p>
                                            <div class="product-rating mt-2">
                                                <ul class="rating">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $starRating)
                                                            <li><i data-feather="star" class="fill"></i></li>
                                                        @else
                                                            <li><i data-feather="star"></i></li>
                                                        @endif
                                                    @endfor
                                                </ul>
                                                <span>(<?php echo number_format($starRating, 1); ?>)</span>
                                            </div>
                                            <h6 class="unit">{{ $product->product_size }}</h6>
                                            <h5 class="price">
                                            @if ($product->discount_percent != 0)
                                                <h4 class="price"><span class="theme-color">¥{{ number_format($product->selling_price, 0, '', ',') }}</span>
                                                <del>¥{{ number_format($product->original_price, 0, '', ',') }}</del>
                                            @else
                                                <h4 class="price"><span class="theme-color">¥{{ number_format($product->selling_price, 0, '', ',') }}</span>
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
    <!-- Product Section End -->
    @foreach ($products as $product)
    @if ($product->status == 1)
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
    <!-- Quick View Modal Box Start -->
     <div class="modal fade theme-modal view-modal" id="view-product{{ $product->id }}" tabindex="-1">
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
                                <img src="{{ asset('images/'.$product-> product_thambnail) }}"
                                    class="img-fluid blur-up lazyload" alt="">
                            </div>
                        </div>

                        <div class="col-lg-6">
                            <div class="right-sidebar-modal">
                                <h4 class="title-name">{{ $product->product_name }}</h4>
                                @if ($product->discount_percent != 0)
                                    <h4 class="price"><span class="theme-color">¥{{ number_format($product->selling_price, 0, '', ',') }}</span>
                                    <del>¥{{ number_format($product->original_price, 0, '', ',') }}</del>
                                @else
                                    <h4 class="price"><span class="theme-color">¥{{ number_format($product->selling_price, 0, '', ',') }}</span>
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
                                    <span class="ms-2">{{ $count}} Reviews</span>
                                </div>

                                <div class="product-detail">
                                    <h4>Product Details :</h4>
                                    <p>{!! ($product->long_desc) !!}</p>
                                </div>

                                <ul class="brand-list">
                                    <li>
                                        <div class="brand-box">
                                            <h5>Brand Name:</h5>
                                            <h6>
                                                @php
                                                    $brand = DB::table('brands')->where('id',$product->brand_id)->first();
                                                @endphp
                                                {{ $brand->brand_name }}
                                            </h6>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="brand-box">
                                            <h5>Product Code:</h5>
                                            <h6>{{ $product->product_code }}</h6>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="brand-box">
                                            <h5>Category:</h5>
                                            <h6>
                                                @php
                                                    $category = DB::table('categories')->where('id',$product->category_id)->first();
                                                @endphp
                                                {{ $category->category_name }}
                                            </h6>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="brand-box">
                                            <h5>In Stock:</h5>
                                            <h6>{{ $product->in_stock }}</h6>
                                        </div>
                                    </li>
                                </ul>
                                <ul class="brand-list">
                                    @php
                                        $sizes = explode(',', $product->product_size);
                                    @endphp
                                    <li>
                                        <div class="product-contain" style="display: flex; flex-wrap: wrap;">
                                            @foreach($sizes as $key => $size)
                                                <div class="form-check" style="margin-left: 10px; margin-top: 15px;">
                                                    <input class="form-check-input" type="radio" name="selected_size_{{ $product->id }}" 
                                                        value="{{ $size }}" id="size_{{ $product->id }}_{{ $size }}" 
                                                        {{ $key === 0 ? 'checked' : '' }}>
                                                    <label for="size_{{ $product->id }}_{{ $size }}">{{ $size }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </li>
                                </ul>
                                <ul class="brand-list">
                                    @php
                                        $colors = explode(',', $product->product_color);
                                    @endphp
                                    <li>
                                        <div class="product-contain" style="display: flex; flex-wrap: wrap;">
                                            @foreach($colors as $key => $color)
                                                <div class="form-check" style="margin-left: 10px; margin-top: 15px;">
                                                    <input class="form-check-input" type="radio" name="selected_color_{{ $product->id }}" 
                                                        value="{{ $color }}" id="color_{{ $product->id }}_{{ $color }}" 
                                                        {{ $key === 0 ? 'checked' : '' }}>
                                                    <label for="color_{{ $product->id }}_{{ $color }}">{{ $color }}</label>
                                                </div>
                                            @endforeach
                                        </div>
                                    </li>
                                </ul>
                                <div class="modal-button">
                                    <button onclick="addToCart({{ $product->id }})"
                                        class="btn btn-md add-cart-button icon" @if ($product->in_stock < 1) disabled @endif>
                                        Add To Cart</button>

                                    <button onclick="location.href = '{{ route('show-product-left-thumbnail', ['id' => $product->id]) }}';"
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
    <!-- Quick View Modal Box End -->
    @endif
    @endforeach
    </body>
    <script>
        function addToCart(productId) {
            const selectedSize = document.querySelector(`input[name="selected_size_${productId}"]:checked`).value;
            const selectedColor = document.querySelector(`input[name="selected_color_${productId}"]:checked`).value;
            
            const url = new URL('{{ route('show_carts', ['id' => '__ID__']) }}'.replace('__ID__', productId));
            url.searchParams.append('size', selectedSize);
            url.searchParams.append('color', selectedColor);
            
            location.href = url.toString();
        }
    </script>

    </x-guest-layout>