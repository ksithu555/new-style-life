<!DOCTYPE html>
<html lang="en" dir="ltr">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description"
        content="New Style Life admin is super flexible, powerful, clean &amp; modern responsive bootstrap 5 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, New Style Life admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <meta name="csrf-token" content="{{ csrf_token() }}">
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

    <!-- Template css -->

    <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/style.css') }}">

    <!-- remixicon css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/remixicon.css') }}">

    <!-- Fontawesome css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/font-awesome.css') }}">

    <!-- Themify icon css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/themify.css') }}">

    <!-- ratio css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/ratio.css') }}">

    <!-- Feather icon css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/feather-icon.css') }}">

    <!-- Plugins css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/scrollbar.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/animate.css') }}">

    <!-- datepicker css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/date-picker.css') }}">

    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vendors/bootstrap.css') }}">

    <!-- vector map css  -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/vector-map.css') }}">

    <!-- slick slider css-->
    <link rel="stylesheet" href="{{ asset('backend/assets/css/vendors/slick.css') }}">

    <!-- App css -->
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/style.css') }}">
    {{-- <link id="color-link" rel="stylesheet" type="text/css" href="{{ asset('frontend/assets/css/style.css') }}"> --}}
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/custom-css.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/input-tags/css/tagsinput.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/bootstrap_toggle/bootstrap-toggle.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/toastr/toastr.css') }}">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('backend/assets/bootstrap_tagsinput/bootstrap-tagsinput.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/linearicon.css') }}">
    <style>
        /* Base style for search box */
        .search-box1 {
            width: 300px;
            padding: 10px;
            border: 1px solid #fff;
            border-radius: 5px;
            font-size: 14px;
            margin: 0 auto;
        }

        .input-group1 {
            display: flex;
            align-items: center;
        }

        input.form-control1 {
            height: 40px;
            border-radius: 5px 0 0 5px;
            border: 1px solid #ccc;
            padding: 0 10px;
            flex: 1;
        }

        button.btn1 {
            height: 40px;
            border-radius: 0 5px 5px 0;
            border: none;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Extra small devices (phones, less than 576px) */
        @media (max-width: 575.98px) {
            .search-box1 {
                width: 100%;
            }

            input.form-control1 {
                font-size: 14px;
            }

            button.btn1 {
                font-size: 14px;
                padding: 0 10px;
            }
        }

        /* Small devices (phones, 576px and up) */
        @media (min-width: 576px) and (max-width: 767.98px) {
            .search-box1 {
                width: 100%;
            }

            input.form-control1 {
                font-size: 14px;
            }

            button.btn1 {
                font-size: 14px;
                padding: 0 10px;
            }
        }

        /* Medium devices (tablets, 768px and up) */
        @media (min-width: 768px) and (max-width: 991.98px) {
            .search-box1 {
                width: 100%;
            }

            input.form-control1 {
                font-size: 14px;
            }

            button.btn1 {
                font-size: 14px;
                padding: 0 15px;
            }
        }

        /* Large devices (desktops, 992px and up) */
        @media (min-width: 992px) and (max-width: 1199.98px) {
            .search-box1 {
                width: 400px;
            }

            input.form-control1 {
                font-size: 14px;
            }

            button.btn1 {
                font-size: 14px;
                padding: 0 15px;
            }
        }

        /* Extra large devices (large desktops, 1200px and up) */
        @media (min-width: 1200px) {
            .search-box1 {
                width: 500px;
            }

            input.form-control1 {
                font-size: 14px;
            }

            button.btn1 {
                font-size: 14px;
                padding: 0 20px;
            }
        }

        .active-link {
            /* background-color: #7faec9; */
            background: linear-gradient(-45deg, #3f525e, #2b6b95, #021d2c);
            /* Add any other styles you need */
        }

        .scrollable-dropdown {
            max-height: 500px;
            overflow-y: auto;
            z-index: 1000;
            /* Ensure it's above other elements */
        }
    </style>
</head>

<body>
    <!-- tap on top start -->
    <div class="tap-top">
        <span class="lnr lnr-chevron-up"></span>
    </div>
    <!-- tap on tap end -->

    <!-- page-wrapper Start-->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
        <!-- Page Header Start-->
        <div class="page-header">
            <div class="header-wrapper m-0">
                <div class="header-logo-wrapper p-0">
                    <div class="logo-wrapper">
                        <a href="{{ route('admin.dashboard') }}">
                            <img class="img-fluid main-logo"
                                src="{{ asset('backend/assets/images/logo/nsl-logo.png') }}" alt="logo">
                            <img class="img-fluid white-logo"
                                src="{{ asset('backend/assets/images/logo/nsl-logo.png') }}" alt="logo">
                        </a>
                    </div>
                    <div class="toggle-sidebar">
                        <i class="status_toggle middle sidebar-toggle" data-feather="align-center"></i>
                        <a href="{{ route('admin.dashboard') }}">
                            <img src="{{ asset('backend/assets/images/logo/nsl-logo.png') }}" class="img-fluid"
                                alt="">
                        </a>
                    </div>
                </div>

                @if (request()->is('admin/shoplist') ||
                        request()->is('admin/product') ||
                        request()->is('admin/category') ||
                        request()->is('admin/all/blog') ||
                        request()->is('admin/indexfaq') ||
                        request()->is('admin/coupon') ||
                        request()->is('admin/orderlist') ||
                        request()->is('admin/review/product') ||
                        request()->is('admin/all/users'))
                    <div class="search-box1">
                        <form id="mainSearchForm" action="{{ url()->current() }}" method="GET">
                            <div class="input-group1">
                                <input type="search" class="form-control1" name="mainSearch" placeholder=""
                                    value="{{ request('mainSearch') }}">
                                <button class="btn1 theme-bg-color" type="submit" id="button-addon2">
                                    <i data-feather="search"></i>
                                </button>
                            </div>
                        </form>
                    </div>
                @endif
                @php
                    use App\Models\Notification;
                    use Carbon\Carbon;
                    $startDate = Carbon::now()->subDays(10)->startOfDay();
                    $endDate = Carbon::now()->endOfDay();
                    $notifications = Notification::whereBetween('created_at', [$startDate, $endDate])
                        ->orderBy('seen', 'ASC')
                        ->orderBy('created_at', 'DESC')
                        ->get();
                    $notiCount = $notifications
                        ->filter(function ($notify) {
                            return $notify->seen == 0;
                        })
                        ->count();
                @endphp
                <div class="nav-right col-6 pull-right right-header p-0">
                    <ul class="nav-menus">
                        <li class="onhover-dropdown">
                            <div class="notification-box">
                                <i class="ri-notification-line"></i>
                                <span id="notification-badge"
                                    class="badge rounded-pill badge-theme">{{ $notiCount }}</span>
                            </div>
                            <ul class="onhover-show-div">
                                <div class="scrollable-dropdown">
                                    <li style="display:block">
                                        <i class="ri-notification-line"></i>
                                        <h6 class="f-18 mb-0">Notifications (Last 10 Days)</h6>
                                        <p class="date-range">From: {{ date('Y/m/d', strtotime($startDate)) }}
                                            To: {{ date('Y/m/d', strtotime($endDate)) }}</p>
                                    </li>
                                    @php
                                        $iro = [
                                            '#0da487',
                                            '#9e65c2',
                                            '#a927f9',
                                            '#6670bd',
                                            '#9944ff',
                                            '#dc3545',
                                            '#0da487',
                                            '#dc3545',
                                            '#6670bd',
                                        ];
                                    @endphp

                                    @foreach ($notifications as $key => $notify)
                                        @if (!empty($notify->time))
                                            <li
                                                style="display: block; background-color: {{ $key % 2 == 0 ? '#f9f9f9' : '#f1f1f1' }}">
                                                @if ($notify->message == 'A new store added:')
                                                    <a href="{{ url('/shop/' . $notify->related_id) }}"
                                                        class="notification-link" data-id="{{ $notify->id }}">
                                                    @elseif ($notify->message == 'A new user added:')
                                                        <a href="{{ url('/userdetail/' . $notify->related_id) }}"
                                                            class="notification-link" data-id="{{ $notify->id }}">
                                                        @elseif ($notify->message == 'A new product added:')
                                                            <a href="{{ url('admin/productdetail/' . $notify->related_id) }}"
                                                                class="notification-link"
                                                                data-id="{{ $notify->id }}">
                                                            @elseif ($notify->message == 'A new order added:')
                                                                <a href="{{ url('/admin/orderdetail/' . $notify->related_id) }}"
                                                                    class="notification-link"
                                                                    data-id="{{ $notify->id }}">
                                                                @elseif ($notify->message == 'A new contact added:')
                                                                    <a href="{{ url('helpdetails/' . $notify->related_id) }}"
                                                                        class="notification-link"
                                                                        data-id="{{ $notify->id }}">
                                                                    @elseif (Str::contains($notify->message, 'Product deleted by'))
                                                                        <a href="" class="notification-link"
                                                                            data-id="{{ $notify->id }}">
                                                                        @elseif (Str::contains($notify->message, 'A new sub seller added by'))
                                                                            <a href=""
                                                                                class="notification-link"
                                                                                data-id="{{ $notify->id }}">
                                                                            @elseif (Str::contains($notify->message, 'did not pay in time for cash order'))
                                                                                <a href="{{ url('admin/orderlist') }}"
                                                                                    class="notification-link"
                                                                                    data-id="{{ $notify->id }}">
                                                @endif
                                                @if ($notify->seen == 0)
                                                    @php
                                                        $color = '';
                                                        if ($notify->message == 'A new store added:') {
                                                            $color = $iro[0];
                                                        } elseif ($notify->message == 'A new user added:') {
                                                            $color = $iro[1];
                                                        } elseif ($notify->message == 'A new product added:') {
                                                            $color = $iro[2];
                                                        } elseif ($notify->message == 'A new order added:') {
                                                            $color = $iro[3];
                                                        } elseif ($notify->message == 'A new contact added:') {
                                                            $color = $iro[4];
                                                        } elseif (
                                                            Str::contains($notify->message, 'Product deleted by')
                                                        ) {
                                                            $color = $iro[5];
                                                        } elseif (
                                                            Str::contains($notify->message, 'A new sub seller added by')
                                                        ) {
                                                            $color = $iro[6];
                                                        } elseif (
                                                            Str::contains(
                                                                $notify->message,
                                                                'did not pay in time for cash order',
                                                            )
                                                        ) {
                                                            $color = $iro[7];
                                                        }
                                                    @endphp
                                                @else
                                                    @php
                                                        $color = $key % 2 == 0 ? '#f9f9f9' : '#f1f1f1';
                                                    @endphp
                                                @endif
                                                <span>
                                                    <span style="color: var(--theme-color);">
                                                        <i class="fa fa-circle me-2 font-primary notification-circle"
                                                            style="font-size:11px;color: {{ $color }} !important">
                                                        </i>{{ $notify->message }}</span>
                                                    <span style="float: right;color: var(--theme-color);">
                                                        &nbsp;{{ \Carbon\Carbon::parse($notify->time)->format('y/m/d H:i') }}
                                                    </span>
                                                </span>
                                                </a>
                                            </li>
                                        @endif
                                    @endforeach
                                    <li style="display:block">
                                        <a class="btn btn-primary mx-auto"
                                            href="{{ url('/notifications/allseen') }}">Check all notification</a>
                                    </li>
                                </div>
                            </ul>
                        </li>

                        <li>
                            <div class="mode">
                                <i class="ri-moon-line"></i>
                            </div>
                        </li>
                        <li class="profile-nav onhover-dropdown pe-0 me-0">
                            <div class="media profile-media">
                                <img src="{{ !empty(Auth::user()->user_photo) ? url('images/' . Auth::user()->user_photo) : url('backend/assets/images/users/4.jpg') }}"
                                    class="user-profile rounded-circle">

                                <div class="user-name-hide media-body">
                                    <span>{{ auth()->user()->name }}</span>
                                </div>
                            </div>
                            <ul class="profile-dropdown onhover-show-div">
                                <li>
                                    <a href="{{ url('/edit/' . auth()->user()->role . '/' . rand(10000, 99999)) }}">
                                        <i data-feather="user"></i>
                                        <span>Profile</span>
                                    </a>
                                </li><br>
                                <li>
                                    <a data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                                        href="javascript:void(0)">
                                        <i data-feather="log-out"></i>
                                        <span>Log out</span>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <!-- Page Header Ends-->

        <!-- Page Body Start-->
        <div class="page-body-wrapper">
            <!-- Page Sidebar Start-->
            <div class="sidebar-wrapper">
                <div id="sidebarEffect"></div>
                <div>
                    <div class="logo-wrapper logo-wrapper-center">
                        <a href="{{ route('admin.dashboard') }}" data-bs-original-title="" title="">
                            <img class="img-fluid for-white"
                                src="{{ asset('backend/assets/images/logo/nsl-logo.png') }}" alt="logo">
                        </a>
                        <div class="back-btn">
                            <i class="fa fa-angle-left"></i>
                        </div>
                        <div class="toggle-sidebar">
                            <i class="ri-apps-line status_toggle middle sidebar-toggle"></i>
                        </div>
                    </div>
                    <div class="logo-icon-wrapper">
                        <a href="{{ route('admin.dashboard') }}">
                            <img class="img-fluid main-logo main-white"
                                src="{{ asset('backend/assets/images/logo/nsl-logo.png') }}" alt="logo">
                            <img class="img-fluid main-logo main-dark"
                                src="{{ asset('backend/assets/images/logo/logo-white.png') }}" alt="logo">
                        </a>
                    </div>
                    <nav class="sidebar-main">
                        <div class="left-arrow" id="left-arrow">
                            <i data-feather="arrow-left"></i>
                        </div>

                        <div id="sidebar-menu">
                            <ul class="sidebar-links" id="simple-bar">
                                <li class="back-btn"></li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav
                                     {{ request()->routeIs('admin.dashboard') || request()->is('admin/transfer-order-details/*') ? 'active-link' : '' }}"
                                        href="{{ route('admin.dashboard') }}">
                                        <i class="ri-home-line"></i>
                                        <span>Dashboard</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav
                                    {{ request()->routeIs('admin.all.shop') || request()->is('shop/*') ? 'active-link' : '' }}"
                                        href="{{ route('admin.all.shop') }}">
                                        <i class="ri-store-3-line"></i>
                                        <span>Shops</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav
                                    {{ request()->routeIs('admin.all.product') ||
                                    request()->is('admin/productdetail/*') ||
                                    request()->is('editproduct/*')
                                        ? 'active-link'
                                        : '' }}"
                                        href="{{ route('admin.all.product') }}">
                                        <i class="ri-product-hunt-line"></i>
                                        <span>Products</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav
                                    {{ request()->routeIs('admin.category') ||
                                    request()->is('admin/addcategory') ||
                                    request()->is('admin/addsubtitle') ||
                                    request()->is('admin/addsubcategory') ||
                                    request()->is('editsubcategory/*/*')
                                        ? 'active-link'
                                        : '' }}"
                                        href="{{ route('admin.category') }}">
                                        <i class="ri-list-check-2"></i>
                                        <span>Categories</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav
                                    {{ request()->routeIs('orderlist') ||
                                    request()->is('admin/orderdetail/*') ||
                                    request()->is('admin/ordertracking/*')
                                        ? 'active-link'
                                        : '' }}"
                                        href="{{ route('orderlist') }}">
                                        <i class="ri-archive-line"></i>
                                        <span>Orders</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav
                                    {{ request()->routeIs('admin.coupon') || request()->is('admin/addcoupon') || request()->is('editcoupon/*')
                                        ? 'active-link'
                                        : '' }}"
                                        href="{{ route('admin.coupon') }}">
                                        <i class="ri-coupon-3-line"></i>
                                        <span>Coupon</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav
                                    {{ request()->routeIs('admin.product.review') ? 'active-link' : '' }}"
                                        href="{{ route('admin.product.review') }}">
                                        <i class="ri-star-line"></i>
                                        <span>Review</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav
                                    {{ request()->routeIs('admin.all.users') ||
                                    request()->is('userdetail/*') ||
                                    request()->is('edit/seller/*') ||
                                    request()->is('edit/buyer/*')
                                        ? 'active-link'
                                        : '' }}"
                                        href="{{ route('admin.all.users') }}">
                                        <i class="ri-file-user-line"></i>
                                        <span>Users</span>
                                    </a>
                                </li>
                                @if (auth()->user()->id == '1')
                                    <li class="sidebar-list">
                                        <a class="sidebar-link sidebar-title link-nav
                                    {{ request()->routeIs('admin.subadmin') ||
                                    request()->is('admin/registersubadmin') ||
                                    request()->is('subadmindetail/*')
                                        ? 'active-link'
                                        : '' }}"
                                            href="{{ route('admin.subadmin') }}">
                                            <i class="ri-admin-line"></i>
                                            <span>SubAdmin</span>
                                        </a>
                                    </li>
                                @endif

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav
                                    {{ request()->routeIs('admin.bank_account') ||
                                    request()->is('admin/add-bank-account') ||
                                    request()->is('admin/edit-bank-account/*')
                                        ? 'active-link'
                                        : '' }}"
                                        href="{{ route('admin.bank_account') }}">
                                        <i class="ri-file-user-line"></i>
                                        <span>Bank Account</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav
                                    {{ request()->routeIs('admin.faq') ||
                                    request()->is('admin/registerfaq') ||
                                    request()->is('faq/*') ||
                                    request()->is('editfaq/*')
                                        ? 'active-link'
                                        : '' }}"
                                        href="{{ route('admin.faq') }}">
                                        <i class="ri-question-answer-line"></i>
                                        <span>FAQ</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav
                                    {{ request()->routeIs('admin.indexhelp') || request()->is('helpdetails/*') ? 'active-link' : '' }}"
                                        href="{{ route('admin.indexhelp') }}">
                                        <i class="ri-mail-line"></i>
                                        <span>Contact</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav
                                    {{ request()->routeIs('admin.indexcustomer') || request()->is('editcustomer/*') ? 'active-link' : '' }}"
                                        href="{{ route('admin.indexcustomer') }}">
                                        <i class="ri-customer-service-2-line"></i>
                                        <span>Customer</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav
                                    {{ request()->routeIs('admin.newsletter') ? 'active-link' : '' }}"
                                        href="{{ route('admin.newsletter') }}">
                                        <i class="ri-profile-line"></i>
                                        <span>NewsLetter</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav
                                    {{ request()->routeIs('admin.all.blog') ||
                                    request()->is('admin/add/blog') ||
                                    request()->is('blog/*') ||
                                    request()->is('editblog/*')
                                        ? 'active-link'
                                        : '' }}"
                                        href="{{ route('admin.all.blog') }}">
                                        <i class="ri-newspaper-line"></i>
                                        <span>News</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav
                                    {{ request()->routeIs('admin.top') || request()->is('edittop/*') ? 'active-link' : '' }}"
                                        href="{{ route('admin.top') }}">
                                        <i class="ri-list-settings-line"></i>
                                        <span>Top</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav
                                    {{ request()->routeIs('admin.story') || 
                                    request()->is('admin/addstory') || 
                                    request()->is('editstory/*') ? 'active-link' : '' }}" href="{{ route('admin.story') }}">
                                        <i class="ri-list-settings-line"></i>
                                        <span>Story</span>
                                    </a>
                                </li>

                                <li class="sidebar-list">
                                    <a class="sidebar-link sidebar-title link-nav
                                    {{ request()->is('edit/admin/*') ? 'active-link' : '' }}"
                                        href="{{ url('/edit/' . auth()->user()->role . '/' . rand(10000, 99999)) }}">
                                        <i class="ri-user-3-line"></i>
                                        <span>Profile</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                        <div class="right-arrow" id="right-arrow">
                            <i data-feather="arrow-right"></i>
                        </div>
                    </nav>
                </div>
            </div>
            <!-- Page Sidebar Ends-->
            {{ $slot }}
        </div>
        <!-- Page Body End-->
    </div>
    <!-- page-wrapper End-->
    <!-- Logout modal start -->
    <div class="modal fade theme-modal remove-profile" id="staticBackdrop" aria-hidden="true" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header d-block text-center">
                    <h5 class="modal-title w-100" id="exampleModalLabel22">Logging Out</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">
                        <i class="fas fa-times"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="remove-box">
                        <p>Are you sure you want to log out?</p>
                    </div>
                </div>
                <div class="modal-footer">
                    <form method="POST" action="{{ route('adminlogout') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">Yes</button>
                    </form>
                    <button type="button" class="btn btn-cancel" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

    <!-- latest js -->
    <script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('backend/assets/input-tags/js/tagsinput.js') }}"></script>
    <script src="{{ asset('backend/assets/bootstrap_toggle/bootstrap-toggle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/toastr/toastr.min.js') }}"></script>

    <!-- Bootstrap js -->
    <script src="{{ asset('backend/assets/js/bootstrap/bootstrap.bundle.min.js') }}"></script>

    <!-- feather icon js -->
    <script src="{{ asset('backend/assets/js/icons/feather-icon/feather.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/icons/feather-icon/feather-icon.js') }}"></script>

    <!-- scrollbar simplebar js -->
    <script src="{{ asset('backend/assets/js/scrollbar/simplebar.js') }}"></script>
    <script src="{{ asset('backend/assets/js/scrollbar/custom.js') }}"></script>

    <!-- Sidebar js -->
    <script src="{{ asset('backend/assets/js/config.js') }}"></script>

    <!-- tooltip init js -->
    <script src="{{ asset('backend/assets/js/tooltip-init.js') }}"></script>

    <!-- Plugins js -->
    <script src="{{ asset('backend/assets/js/sidebar-menu.js') }}"></script>
    {{-- <script src="{{ asset('backend/assets/js/notify/bootstrap-notify.min.js') }}"></script> --}}
    <script src="{{ asset('backend/assets/js/notify/index.js') }}"></script>

    <!-- Apexchar js -->
    <script src="{{ asset('backend/assets/js/chart/apex-chart/apex-chart1.js') }}"></script>
    <script src="{{ asset('backend/assets/js/chart/apex-chart/moment.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/chart/apex-chart/apex-chart.js') }}"></script>
    <script src="{{ asset('backend/assets/js/chart/apex-chart/stock-prices.js') }}"></script>
    <script src="{{ asset('backend/assets/js/chart/apex-chart/chart-custom.js') }}"></script>

    <!-- ratio js -->
    <script src="{{ asset('backend/assets/js/ratio.js') }}"></script>

    <!-- sidebar effect -->
    <script src="{{ asset('backend/assets/js/sidebareffect.js') }}"></script>

    <!-- Theme js -->
    <script src="{{ asset('backend/assets/js/script.js') }}"></script>
    <script>
        // Assuming you have some JavaScript code to handle deletion
        document.querySelector('.delete-icon').addEventListener('click', function() {
            // Code to delete the store goes here
            // For demonstration, let's just remove the entire store element
            document.getElementById('store').remove();
        });
    </script>
    <script>
        $(document).ready(function() {
            $('a.notification-link').on('click', function(e) {
                e.preventDefault();
                var link = $(this);
                var notificationId = link.data('id');

                $.ajax({
                    url: '/notifications/' + notificationId + '/seen',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.success) {
                            link.find('.notification-circle').css('color',
                                'white'); // Optionally change color to indicate it was seen
                            window.location.href = link.attr(
                                'href'); // Redirect to the link's target
                        } else {
                            alert('Error marking notification as seen.');
                        }
                    },
                    error: function() {
                        alert('Error marking notification as seen.');
                    }
                });
            });
        });
    </script>
</body>

</html>