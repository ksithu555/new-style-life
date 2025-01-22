<!DOCTYPE html>
<html lang="en">

<head>
    {{-- <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="New Style Life">
    <meta name="keywords" content="New Style Life">
    <link rel="icon" href="../assets/images/favicon/7.png" type="image/x-icon">
    <title>New Style Life</title> --}}

    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="New Style Life">
    <meta name="keywords" content="New Style Life">

    <link rel="icon" href="{{ asset('frontend/assets/logos/newstyle_slogo.png') }}" type="image/x-icon">
    <title>New Style Life</title>

    <!-- Google font -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Russo+One&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Exo+2:wght@400;500;600;700;800;900&display=swap"
        rel="stylesheet">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap">

    <!-- bootstrap css -->
    <link id="rtl-link" rel="stylesheet" type="text/css"
        href="{{ asset('frontend/assets/css/vendors/bootstrap.css') }}">

    <!-- wow css -->
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/animate.min.css') }}">

    <!-- Iconly css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/bulk-style.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/vendors/animate.css') }}">

    <!-- Template css -->
    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/style.css') }}">

    <link rel="stylesheet" href="{{ asset('frontend/assets/scss/base/_typography.scss') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/review.min.css') }}">
</head>

<body class="bg-effect">

    <!-- latest jquery-->
    <script src="{{ asset('frontend/assets/js/jquery-3.6.0.min.js') }}"></script>

    <!-- jquery ui-->
    <script src="{{ asset('frontend/assets/js/jquery-ui.min.js') }}"></script>

    <!-- Price Range Js -->
    <script src="{{ asset('frontend/assets/js/ion.rangeSlider.min.js') }}"></script>

    <!-- Loader Start -->
    <div class="fullpage-loader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <!-- Loader End -->

    @php
        if (!empty(Auth::user()) && Auth::user()->role != 'buyer') {
            Auth::logout();
        }
    @endphp

    <!-- Header Start -->
    <header class="pb-md-4 pb-0">
        <div class="header-top">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-xxl-3 d-xxl-block d-none">
                        <div class="top-left-header">
                            <i class="iconly-Location icli text-white"></i>
                            <span class="text-white">{{ __('messages.top_bar_address') }}</span>
                        </div>
                    </div>

                    <div class="col-xxl-6 col-lg-9 d-lg-block d-none">
                        <div class="header-offer">
                            <div class="notification-slider">
                                <div>
                                    <div class="timer-notification">
                                        <h6><strong class="me-1">{{ __('messages.welcome') }}</strong>
                                        </h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-3">
                        <ul class="about-list right-nav-about">
                            <li class="right-nav-list dropdown">
                                <div class="dropdown theme-form-select" style="display: flex;">
                                    <img src="{{ asset('frontend/assets/images/country/japan.png') }}"
                                        class="img-fluid blur-up lazyload" alt="" width="30px">
                                    <img src="{{ asset('frontend/assets/images/country/united-states.png') }}"
                                        class="img-fluid blur-up lazyload" alt="" width="30px"
                                        style="margin-left: 5px;">
                                </div>
                            </li>
                            <li class="right-nav-list">
                                <div class="dropdown theme-form-select">
                                    @foreach(config('app.available_locales') as $locale_name => $available_locale)
                                        @if($available_locale === app()->getLocale())
                                            <a href="#" class="dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ $locale_name }}
                                            </a>
                                        @endif
                                    @endforeach
                                    <ul class="dropdown-menu" style="min-width: 80px;max-width: 100px; margin-left: -25px;">
                                        @foreach(config('app.available_locales') as $locale_name => $available_locale)
                                            @if($available_locale !== app()->getLocale())
                                                <li>
                                                    <a href="{{ url('/language/'.$available_locale) }}" class="dropdown-item">
                                                        {{ $locale_name }}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </li>
                            <li class="right-nav-list">
                                <div class="dropdown theme-form-select">
                                    <span>JPY</span>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="top-nav top-header sticky-header">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="navbar-top">
                            <button class="navbar-toggler d-xl-none d-inline navbar-menu-button" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#primaryMenu">
                                <span class="navbar-toggler-icon">
                                    <i class="fa-solid fa-bars"></i>
                                </span>
                            </button>
                            <a href="/" class="web-logo nav-logo">
                                <img src="{{ asset('images/logos/newstyle_logo.png') }}"
                                    class="img-fluid blur-up lazyload" alt="">
                            </a>

                            <div class="middle-box">
                                <div class="search-box">
                                    <form id="mainSearchForm" action="{{ route('show-product') }}" method="GET">
                                        <div class="input-group">
                                            <input type="search" class="form-control" name="mainSearch"
                                                placeholder="{{ __('messages.searching_for') }}"
                                                value="{{ request('mainSearch') }}">
                                            <button class="btn" type="submit" id="button-addon2">
                                                <i data-feather="search"></i>
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>

                            <div class="rightside-box">
                                <div class="search-full">
                                    <div class="input-group">
                                        <span class="input-group-text">
                                            <i data-feather="search" class="font-light"></i>
                                        </span>
                                        <input type="text" class="form-control search-type"
                                            placeholder="Search here..">
                                        <span class="input-group-text close-search">
                                            <i data-feather="x" class="font-light"></i>
                                        </span>
                                    </div>
                                </div>
                                <ul class="right-side-menu">
                                    <li class="right-side">
                                        <div class="delivery-login-box">
                                            <div class="delivery-icon">
                                                <div class="search-box">
                                                    <i data-feather="search"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="right-side">
                                        <a href="{{ url('/contact') }}" class="delivery-login-box">
                                            <div class="delivery-icon">
                                                <i data-feather="phone-call"></i>
                                            </div>
                                            <div class="delivery-detail">
                                                <h6>24/7 Delivery</h6>
                                                <h5>+91 888 104 2340</h5>
                                            </div>
                                        </a>
                                    </li>
                                    <li class="right-side">
                                        <a href="{{ url('/wishlist') }}"
                                            class="btn p-0 position-relative header-wishlist">
                                            <i data-feather="heart"></i>
                                        </a>
                                    </li>
                                    <li class="right-side">
                                        <div class="onhover-dropdown header-badge">
                                            <a href="{{ route('show_carts') }}">
                                                <button type="button"
                                                    class="btn p-0 position-relative header-wishlist">
                                                    <i data-feather="shopping-cart"></i>
                                                    @php
                                                        $userCarts = collect([]);
                                                        $count = 0;
                                                    @endphp
                                                    @if (!empty(Auth::user()))
                                                        @php
                                                            $userCarts = DB::table('carts')
                                                                ->join(
                                                                    'products',
                                                                    'carts.product_id',
                                                                    '=',
                                                                    'products.id',
                                                                )
                                                                ->join('buyers', 'carts.buyer_id', '=', 'buyers.id')
                                                                ->where('buyers.user_id', Auth::user()->id)
                                                                ->get();

                                                            $count = $userCarts->count();
                                                        @endphp
                                                    @endif
                                                    <span
                                                        class="position-absolute top-0 start-100 translate-middle badge"
                                                        id="unreadMessages">
                                                        {{ $count }}
                                                        <span class="visually-hidden">unread messages</span>
                                                    </span>
                                                </button>
                                            </a>

                                            @if (!empty(Auth::user()))
                                                <div class="onhover-div">
                                                    <ul class="cart-list">
                                                        @php
                                                            $total = 0;
                                                        @endphp
                                                        @foreach ($userCarts as $cart)
                                                            <li class="product-box-contain">
                                                                <div class="drop-cart">
                                                                    <a
                                                                        href="{{ route('show-product-left-thumbnail', ['id' => $cart->product_id]) }}">
                                                                        <img src="{{ asset('images/' . $cart->product_thambnail) }}"
                                                                            class="blur-up lazyload" alt=""
                                                                            width="87" height="73">
                                                                    </a>

                                                                    <div class="drop-contain">
                                                                        <a
                                                                            href="{{ route('show-product-left-thumbnail', ['id' => $cart->product_id]) }}">
                                                                            <h5>{{ $cart->product_name }}</h5>
                                                                        </a>
                                                                        <h6><span>{{ $cart->quantity }} x</span>
                                                                            ¥{{ number_format($cart->selling_price, 0, '.', ',') }}
                                                                        </h6>
                                                                        <button class="close-button close_button"
                                                                            data-product-id="{{ $cart->product_id }}">
                                                                            <i class="fa-solid fa-xmark"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="drop-contain">
                                                                        <h5>Total</h5>

                                                                        <h6>¥{{ number_format($cart->quantity * $cart->selling_price, 0, '.', ',') }}
                                                                        </h6>
                                                                        <button class="close-button close_button"
                                                                            data-product-id="{{ $cart->product_id }}">
                                                                            <i class="fa-solid fa-xmark"></i>
                                                                        </button>
                                                                    </div>

                                                                </div>
                                                            </li>
                                                            @php
                                                                $total += $cart->selling_price * $cart->quantity;
                                                            @endphp
                                                        @endforeach
                                                    </ul>

                                                    <div class="price-box">
                                                        <h5>Total :</h5>
                                                        <h4 class="theme-color fw-bold">
                                                            ¥{{ number_format($total, 0, '.', ',') }}</h4>
                                                    </div>

                                                    <div class="button-group">
                                                        <a href="{{ route('show_carts') }}"
                                                            class="btn btn-sm cart-button">View Cart</a>
                                                        {{-- <a href="{{ url('/checkout') }}" class="btn btn-sm cart-button theme-bg-color
                                                        text-white">Checkout</a> --}}
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    </li>
                                    <li class="profile-nav onhover-dropdown pe-0 me-0">
                                        @if (empty(Auth::user()))
                                            <div class="delivery-login-box">
                                                <div class="delivery-icon">
                                                    <i data-feather="user"></i>
                                                </div>
                                            </div>
                                            <div class="onhover-div onhover-div-login">
                                                <ul class="user-box-name">
                                                    <li class="product-box-contain">
                                                        <a href="{{ route('login') }}">{{ __('messages.login') }}</a>
                                                    </li>
                                                    <li class="product-box-contain">
                                                        <a href="{{ route('user_register') }}">{{ __('messages.buyer_register') }}</a>
                                                    </li>
                                                </ul>
                                            </div>
                                        @else
                                            <div class="media profile-media">
                                                <img src="{{ !empty(Auth::user()->user_photo) ? url('upload/profile/' . Auth::user()->user_photo) : url('backend/assets/images/users/4.jpg') }}"
                                                    class="user-profile rounded-circle" width="30px"
                                                    height="30px">

                                                <div class="user-name-hide media-body">
                                                    @if (mb_strlen(Auth::user()->name) > 3)
                                                        <span>{!! mb_substr(Auth::user()->name, 0, 3) !!}</span>
                                                    @else
                                                        {!! nl2br(e(Auth::user()->name)) !!}
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="onhover-div onhover-div-login">
                                                <ul class="profile-dropdown onhover-show-div">
                                                    <li>
                                                        <a data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                                            href="javascript:void(0)">
                                                            <i data-feather="log-out"></i>
                                                            <span style="margin-left: 10px;">{{ __('messages.logout') }}</span>
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                        @endif
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="header-nav">
                        <div class="header-nav-left">
                            <button class="dropdown-category">
                                <i data-feather="align-left"></i>
                                <span>{{ __('messages.all_categories') }}</span>
                            </button>

                            <div class="category-dropdown">
                                <div class="category-title">
                                    <h5>{{ __('messages.all_categories') }}</h5>
                                    <button type="button" class="btn p-0 close-button text-content">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>
                                <ul class="category-list">
                                    @foreach ($categories as $category)
                                        <li class="onhover-category-list">
                                            <a href="javascript:void(0)" class="category-name">
                                                <img src="{{ asset('images/' . $category->category_icon) }}"
                                                    alt="">
                                                <h6>{{ $category->{'category_name_' . app()->getLocale() } ?? $category->category_name }}</h6>
                                                <i class="fa-solid fa-angle-right"></i>
                                            </a>

                                            <div class="onhover-category-box" style="height: fit-content;">
                                                @foreach ($category->subCategoryTitle as $subCategoryTitle)
                                                    <div class="list-1" style="margin-left: 10px;margin-top: 10px;">
                                                        <div class="category-title-box">
                                                            <h5>{{ $subCategoryTitle->{'sub_category_titlename_' . app()->getLocale()} ?? $subCategoryTitle->sub_category_titlename }}</h5>
                                                        </div>
                                                        @foreach ($subCategoryTitle->subCategory as $subCategory)
                                                            <ul>
                                                                <li>
                                                                    <a
                                                                        href="{{ url('/subcategorysidebar/' . $subCategory->id) }}">{{ $subCategory->{'sub_category_name_' . app()->getLocale() } ?? $subCategory->sub_category_name }}</a>
                                                                </li>
                                                            </ul>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="header-nav-middle">
                            <div class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky">
                                <div class="offcanvas offcanvas-collapse order-xl-2" id="primaryMenu">
                                    <div class="offcanvas-header navbar-shadow">
                                        <h5>{{ __('messages.menu') }}</h5>
                                        <button class="btn-close lead" type="button"
                                            data-bs-dismiss="offcanvas"></button>
                                    </div>

                                    <div class="offcanvas-body">
                                        <ul class="navbar-nav">
                                            @if (empty(Auth::user()))
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link " href="{{ url('/') }}">{{ __('messages.home') }}</a>
                                                </li>
                                            @endif

                                            @if (!empty(Auth::user()))
                                                <li class="nav-item dropdown">
                                                    <a class="nav-link" href="{{ url('/user') }}">{{ __('messages.my_menu') }}</a>

                                                </li>
                                            @endif

                                            <li class="nav-item dropdown">
                                                <a class="nav-link " href="{{ url('/products') }}">{{ __('messages.products') }}</a>
                                            </li>


                                            <li class="nav-item dropdown">
                                                <a class="nav-link " href="{{ route('shoplist') }}">{{ __('messages.shop') }}</a>
                                            </li>

                                            @if ($specialCorner->isNotEmpty())
                                                <li class="nav-item dropdown dropdown-mega">
                                                    <a class="nav-link menu dropdown-toggle ps-xl-2 ps-0"
                                                        href="javascript:void(0)" data-bs-toggle="dropdown">
                                                        <span class="menu">{{ __('messages.special_corner') }}</span>
                                                    </a>

                                                    <div class="dropdown-menu dropdown-menu-2">
                                                        @foreach ($specialCorner as $category)
                                                            @foreach ($category->subCategoryTitle as $index => $subCategoryTitle)
                                                                @if ($index % 3 == 0)
                                                                    @if ($index > 1)
                                                                        <div class="row" style="margin-top: 10px;">
                                                                        @else
                                                                            <div class="row">
                                                                    @endif
                                                                @endif
                                                                <div class="dropdown-column col-xl-3">
                                                                    <h5 class="dropdown-header">
                                                                        {{ $subCategoryTitle->sub_category_titlename }}
                                                                    </h5>
                                                                    @foreach ($subCategoryTitle->subCategory as $subCategory)
                                                                        <a class="dropdown-item"
                                                                            href="{{ url('/specialsubcategorysidebar/' . $subCategory->id) }}">
                                                                            {{ $subCategory->sub_category_name }}
                                                                        </a>
                                                                    @endforeach
                                                                </div>
                                                                @if ($index % 3 == 2 || $loop->last)
                                                    </div>
                                            @endif
                                            @endforeach
                                            @endforeach
                                    </div>
                                    </li>
                                    @endif


                                    @if (empty(Auth::user()))
                                        <li class="nav-item dropdown">
                                            <a class="nav-link" href="{{ url('/faq') }}">{{ __('messages.faq') }}</a>

                                        </li>
                                    @endif

                                    @if (empty(Auth::user()))
                                        <li class="nav-item dropdown new-nav-item">
                                            @if ($newBlogsExist)
                                                <label class="new-dropdown">{{ __('messages.news') }}</label>
                                            @endif
                                            <a class="nav-link" href="{{ url('/news') }}">{{ __('messages.blog') }}</a>
                                        </li>
                                    @endif

                                    </ul>
                                </div>


                            </div>
                        </div>
                    </div>
                    @if (!empty(Auth::user()))
                        <div class="header-nav-right">
                            <button class="btn deal-button" data-bs-toggle="modal" data-bs-target="#deal-box">
                                <i data-feather="zap"></i>
                                <span>{{ __('messages.deal_today') }}</span>
                            </button>
                        </div>
                    @else
                        <div class="header-nav-right">
                            <button class="btn deal-button" data-bs-toggle="modal">
                                <i data-feather="zap"></i>
                                <a href="{{ route('login') }}" style="color: var(--theme-color)">
                                    <span>{{ __('messages.deal_today') }}</span>
                                </a>
                            </button>
                        </div>
                    @endif
                </div>
            </div>
        </div>
        </div>
    </header>
    <!-- Header End -->

    <!-- mobile fix menu start -->
    <div class="mobile-menu d-md-none d-block mobile-cart">
        <ul>
            <li class="active">
                <a href="{{ url('/') }}">
                    <i class="iconly-Home icli"></i>
                    <span>{{ __('messages.home') }}</span>
                </a>
            </li>

            <li class="mobile-category">
                <a href="javascript:void(0)">
                    <i class="iconly-Category icli js-link"></i>
                    <span>{{ __('messages.category') }}</span>
                </a>
            </li>

            <li>
                <a href="{{ url('/search') }}" class="search-box">
                    <i class="iconly-Search icli"></i>
                    <span>{{ __('messages.search') }}</span>
                </a>
            </li>

            <li>
                <a href="{{ url('/wishlist') }}" class="notifi-wishlist">
                    <i class="iconly-Heart icli"></i>
                    <span>{{ __('messages.my_wish') }}</span>
                </a>
            </li>

            <li>
                <a href="{{ url('/carts') }}">
                    <i class="iconly-Bag-2 icli fly-cate"></i>
                    <span>{{ __('messages.cart') }}</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- mobile fix menu end -->

    {{ $slot }}


    <!-- Footer Section Start -->
    <footer class="section-t-space footer-section-2 footer-color-3">
        <div class="container-fluid-lg">
            <div class="main-footer">
                <div class="row g-md-4 gy-sm-5">
                    <div class="col-xxl-3 col-xl-4 col-sm-6">
                        <a href="/" class="foot-logo theme-logo">
                            <img src="{{ asset('backend/assets/images/logo/nsl-logo.png') }}" class="img-fluid blur-up lazyload" alt="">
                        </a>
                        <p class="information-text information-text-2">
                            {{ __('messages.footer_paragraph') }}
                        </p>
                        <ul class="social-icon">
                            <li class="light-bg">
                                <a href="https://www.facebook.com/" class="footer-link-color">
                                    <i class="fab fa-facebook-f"></i>
                                </a>
                            </li>
                            <li class="light-bg">
                                <a href="https://accounts.google.com/signin/v2/identifier?flowName=GlifWebSignIn&flowEntry=ServiceLogin"
                                    class="footer-link-color">
                                    <i class="fab fa-google"></i>
                                </a>
                            </li>
                            <li class="light-bg">
                                <a href="https://twitter.com/i/flow/login" class="footer-link-color">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li class="light-bg">
                                <a href="https://www.instagram.com/" class="footer-link-color">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                            <li class="light-bg">
                                <a href="https://in.pinterest.com/" class="footer-link-color">
                                    <i class="fab fa-pinterest-p"></i>
                                </a>
                            </li>
                        </ul>
                    </div>



                    <div class="col-xxl-2 col-xl-4 col-sm-6">
                        <div class="footer-title">
                            <h4 class="text-white">{{ __('messages.useful_links') }}</h4>
                        </div>
                        <ul class="footer-list footer-list-light footer-contact">
                            <li>
                                <a href="{{ url('/') }}" class="light-text">{{ __('messages.home') }}</a>
                            </li>
                            <li>
                                <a class="light-text" href="{{ url('/products') }}">{{ __('messages.products') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('shoplist') }}" class="light-text">{{ __('messages.shop') }}</a>
                            </li>
                            <li>
                                <a href="{{ url('/news') }}" class="light-text">{{ __('messages.blog') }}</a>
                            </li>
                            <li>
                                <a href="{{ url('/contact') }}" class="light-text">{{ __('messages.contact_us') }}</a>
                            </li>
                            <li>
                                <a href="{{ url('/our-story') }}" class="light-text">{{ __('messages.our_story') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-xxl-2 col-xl-4 col-sm-6">
                        <div class="footer-title">
                            <h4 class="text-white">{{ __('messages.help_center') }}</h4>
                        </div>
                        <ul class="footer-list footer-contact footer-list-light">
                            @if (empty(Auth::user()))
                                <li>
                                    <a href="{{ route('seller.register') }}" class="light-text">{{ __('messages.seller_register') }}</a>
                                </li>
                            @endif
                            @if (!empty(Auth::user()))
                                <li>
                                    <a href="{{ route('user_profile') }}" class="light-text">{{ __('messages.your_account') }}</a>
                                </li>
                                <li>
                                    <a href="{{ route('user_order') }}" class="light-text">{{ __('messages.track_order') }}</a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ url('/wishlist') }}" class="light-text">{{ __('messages.your_wishlist') }}</a>
                            </li>
                            <li>
                                <a href="{{ url('/comparelist') }}" class="light-text">{{ __('messages.your_compare_list') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('footer_search') }}" class="light-text">{{ __('messages.search') }}</a>
                            </li>
                            <li>
                                <a href="{{ url('/faq') }}" class="light-text">{{ __('messages.faq') }}</a>
                            </li>
                            <li>
                                <a href="{{ url('/term-and-condition') }}" class="light-text">{{ __('messages.terms_and_conditions') }}</a>
                            </li>
                            <li>
                                <a href="{{ url('/privacy-policy') }}" class="light-text">{{ __('messages.privacy_policy') }}</a>
                            </li>
                        </ul>
                    </div>

                    <div class="col-xxl-2 col-xl-4 col-sm-6">
                        <div class="footer-title">
                            <h4 class="text-white">{{ __('messages.categories') }}</h4>
                        </div>
                        <ul class="footer-list footer-list-light footer-contact">
                            @foreach ($categories as $category)
                                <li>
                                    <a href="{{ url('/categorysidebar/' . $category->id) }}"
                                        class="light-text">{{ $category->{'category_name_' . app()->getLocale() } ?? $category->category_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="col-xxl-3 col-xl-4 col-sm-6">
                        <div class="footer-title">
                            <h4 class="text-white">{{ __('messages.contact_us') }}</h4>
                        </div>
                        <ul class="footer-address footer-contact">
                            <li>
                                <a href="javascript:void(0)" class="light-text">
                                    <div class="inform-box flex-start-box">
                                        <i data-feather="map-pin"></i>
                                        <p>{{ __('messages.top_bar_address') }}</p>
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)" class="light-text">
                                    <div class="inform-box">
                                        <i data-feather="phone"></i>
                                        <p>{{ __('messages.call_us') }}: (+81)03-3981-5090</p>
                                    </div>
                                </a>
                            </li>

                            <li>
                                <a href="javascript:void(0)" class="light-text">
                                    <div class="inform-box">
                                        <i data-feather="mail"></i>
                                        <p>{{ __('messages.email_us') }}: support@new-style.life</p>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>

            <div class="sub-footer sub-footer-lite section-b-space section-t-space">
                <div class="left-footer">
                    <p class="light-text">©2024 Asia Human Development, Inc. All rights reserved</p>
                </div>

                <ul class="payment-box">
                    <li>
                        <img src="{{ asset('frontend/assets/images/icon/paymant/paypal.png') }}" style="width:80px"
                            class="blur-up lazyload" alt="">
                    </li>
                    <li>
                        <img src="{{ asset('frontend/assets/images/icon/paymant/visa.png') }}"
                            class="blur-up lazyload" alt="">
                    </li>
                    <li>
                        <img src="{{ asset('frontend/assets/images/icon/paymant/jcbcard.png') }}"
                            class="blur-up lazyload" alt="">
                    </li>
                    <li>
                        <img src="{{ asset('frontend/assets/images/icon/paymant/american.png') }}" alt=""
                            class="blur-up lazyload">
                    </li>
                    <li>
                        <img src="{{ asset('frontend/assets/images/icon/paymant/master-card.png') }}" alt=""
                            class="blur-up lazyload">
                    </li>

                </ul>
            </div>
        </div>
    </footer>
    <!-- Footer Section End -->

    <!-- Deal Box Modal Start -->
    @php
        if (Auth::check()) {
            $buyer = DB::table('buyers')
                ->where('user_id', Auth::user()->id)
                ->first();
            if ($buyer) {
                // $todayDate = Carbon::today()->toDateString();
                $todayDate = date('Y-m-d');

                // Perform the query to get today's deals
        $deal = DB::table('products')
            ->leftJoin('order_details', 'products.id', '=', 'order_details.product_id')
            ->leftJoin('orders', 'order_details.order_id', '=', 'orders.id')
            ->select('products.*', 'order_details.payment_approved')
            ->where('order_details.buyer_id', $buyer->id)
            ->whereDate('order_details.created_at', $todayDate)
            ->orderBy('orders.order_code', 'desc')
                    ->get();
            } else {
                $deal = collect();
            }
        } else {
            $deal = collect();
        }
    @endphp
    <div class="modal fade theme-modal deal-modal" id="deal-box" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <div>
                        @if ($deal->count() > 0)
                            <h5 class="modal-title w-100" id="deal_today">{{ __('messages.deal_today') }}</h5>
                            <p class="mt-1 text-content">{{ __('messages.your_items_for_today') }}</p>
                        @else
                            <p class="mt-1 text-content">{{ __('messages.today_no_order_yet') }}</p>
                        @endif
                    </div>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="deal-offer-box">
                        <ul class="deal-offer-list">
                            @foreach ($deal as $list)
                                <li class="list-1">
                                    <div class="deal-offer-contain">
                                        <a href="{{ route('show-product-left-thumbnail', ['id' => $list->id]) }}"
                                            class="deal-image">
                                            <img src="{{ asset('images/' . $list->product_thambnail) }}"
                                                class="blur-up lazyload" alt="">
                                        </a>

                                        <a href="{{ route('show-product-left-thumbnail', ['id' => $list->id]) }}"
                                            class="deal-contain">
                                            <h5>{{ $list->product_name }}</h5>
                                            @if ($list->discount_percent != 0)
                                                <h6>¥{{ number_format($list->selling_price, '0', '', ',') }}<del>¥{{ number_format($list->original_price, '0', '', ',') }}</del>
                                                </h6>
                                            @else
                                                <h6>¥{{ number_format($list->selling_price, '0', '', ',') }}</h6>
                                            @endif
                                            @if ($list->payment_approved == 0)
                                                <span style="color: red">{{ __('messages.payment_transfer_not_yet') }}</span>
                                            @else
                                                @if ($list->estimate_date)
                                                    <span>{{ __('messages.estimated_waiting_time') }} : {{ $list->estimate_date }}
                                                        {{ $list->estimate_date > 1 ? 'days' : 'day' }}</span>
                                                @endif
                                            @endif
                                        </a>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Deal Box Modal End -->

    <!-- Tap to top and theme setting button start -->
    <div class="theme-option">
        <div class="setting-box">
            <button class="btn setting-button">
                <i class="fa-solid fa-gear"></i>
            </button>

            <div class="theme-setting-2">
                <div class="theme-box">
                    <ul>
                        <li>
                            <div class="setting-name">
                                <h4>{{ __('messages.color') }}</h4>
                            </div>
                            <div class="theme-setting-button color-picker">
                                <form class="form-control">
                                    <label for="colorPick" class="form-label mb-0">{{ __('messages.theme_color') }}</label>
                                    <input type="color" class="form-control form-control-color" id="colorPick"
                                        value="#417394" title="Choose your color">
                                </form>
                            </div>
                        </li>

                        <li>
                            <div class="setting-name">
                                <h4>{{ __('messages.dark') }}</h4>
                            </div>
                            <div class="theme-setting-button">
                                <button class="btn btn-2 outline" id="darkButton">{{ __('messages.dark') }}</button>
                                <button class="btn btn-2 unline" id="lightButton">{{ __('messages.light') }}</button>
                            </div>
                        </li>

                        <li>
                            <div class="setting-name">
                                <h4>RTL</h4>
                            </div>
                            <div class="theme-setting-button rtl">
                                <button class="btn btn-2 rtl-unline">LTR</button>
                                <button class="btn btn-2 rtl-outline">RTL</button>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="back-to-top">
            <a id="back-to-top" href="#">
                <i class="fas fa-chevron-up"></i>
            </a>
        </div>
    </div>
    <!-- Tap to top and theme setting button end -->
    <!-- Logout modal start -->
    <div class="modal fade theme-modal remove-profile" id="staticBackdrop" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-block text-center">
                    <h5 class="modal-title w-100" id="exampleModalLabel">{{ __('messages.loging_out') }}</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="remove-box">
                        <p>{{ __('messages.loging_out_confirm_message') }}</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('adminlogout') }}">
                        @csrf
                        <button type="submit" class="btn btn-animation btn-md fw-bold"
                            style="background: #417394; !important;">{{ __('messages.btn_yes') }}</button>
                    </form>
                    <button type="button" class="btn btn-animation btn-md fw-bold" data-bs-dismiss="modal"
                        style="background: #6c757d;">{{ __('messages.btn_no') }}</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Logout modal end -->

    <!-- Bg overlay Start -->
    <div class="bg-overlay"></div>
    <!-- Bg overlay End -->

    <!-- Bootstrap js-->
    <script src="{{ asset('frontend/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap/bootstrap-notify.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/bootstrap/popper.min.js') }}"></script>

    <!-- feather icon js-->
    <script src="{{ asset('frontend/assets/js/feather/feather.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/feather/feather-icon.js') }}"></script>

    <!-- Lazyload Js -->
    <script src="{{ asset('frontend/assets/js/lazysizes.min.js') }}"></script>

    <!-- Slick js-->
    <script src="{{ asset('frontend/assets/js/slick/slick.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/slick/slick-animation.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/slick/custom_slick.js') }}"></script>

    <!-- Auto Height Js -->
    <script src="{{ asset('frontend/assets/js/auto-height.js') }}"></script>

    <!-- Timer Js -->
    <script src="{{ asset('frontend/assets/js/timer1.js') }}"></script>

    <!-- Fly Cart Js -->
    <script src="{{ asset('frontend/assets/js/fly-cart.js') }}"></script>

    <!-- Quantity js -->
    <script src="{{ asset('frontend/assets/js/quantity-2.js') }}"></script>

    <!-- WOW js -->
    <script src="{{ asset('frontend/assets/js/wow.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/custom-wow.js') }}"></script>

    <!-- script js -->
    <script src="{{ asset('frontend/assets/js/script.js') }}"></script>

    <!-- theme setting js -->
    <script src="{{ asset('frontend/assets/js/theme-setting.js') }}"></script>

    <!-- sidebar open js -->
    <script src="{{ asset('frontend/assets/js/filter-sidebar.js') }}"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $('.close_button').click(function() {
                var productId = $(this).data('product-id');

                $.ajax({
                    url: '/remove-cart-product/' + productId,
                    method: 'get',
                    success: function(response) {
                        console.log(response);
                        var countElement = $('#unreadMessages');
                        var count = parseInt(countElement.text());
                        countElement.text(count - 1);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error deleting cart item:', error);
                    }
                });
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            function isDesktopView() {
                return window.matchMedia("(min-width: 769px)").matches;
            }

            function handleHover() {
                if (isDesktopView()) {
                    $('.onhover-category-list').hover(function() {
                        var $hoverBox = $(this).find('.onhover-category-box');
                        var offset = $(this).position(); // Get the position relative to the parent

                        // Calculate the top position of the hover box to match the list item
                        var topPosition = offset.top;

                        $hoverBox.css({
                            'top': topPosition,
                            'left': '100%',
                            'display': '-ms-flexbox'
                        });
                    });
                } else {
                    $('.onhover-category-list').off('mouseenter mouseleave');
                }
            }

            // Initial check
            handleHover();

            // Re-check on window resize
            $(window).resize(function() {
                handleHover();
            });
        });
    </script>
</body>

</html>