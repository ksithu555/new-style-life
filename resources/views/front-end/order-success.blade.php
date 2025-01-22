<!DOCTYPE html>
<html lang="en">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="{{ asset('frontend/assets/logos/newstyle_slogo.png') }}" type="image/x-icon">
    <title>New Style Life</title>

    <!-- Google Font css -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Public+Sans:wght@100;200;300;400;500;600;700;800;900&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:wght@200;300;400;600;700;800;900&display=swap"
        rel="stylesheet">

    <style type="text/css">
        body {
            text-align: center;
            margin: 0 auto;
            width: 650px;
            font-family: 'Public Sans', sans-serif;
            background-color: #e2e2e2;
            display: block;
        }

        ul {
            margin: 0;
            padding: 0;
        }

        li {
            display: inline-block;
            text-decoration: unset;
        }

        a {
            text-decoration: none;
        }

        h5 {
            margin: 10px;
            color: #777;
        }

        .text-center {
            text-align: center
        }

        .main-bg-light {
            background-color: #fafafa;
        }

        .header-menu ul li a {
            font-size: 14px;
            color: #252525;
            font-weight: 500;
        }

        .product-table tbody tr td img {
            /* width: 86%; */
            margin-right: 26px;
        }

        .product-table tbody tr td .product-detail {
            text-align: left;
            display: flex;
            flex-wrap: wrap;
            gap: 7px;
        }

        .product-table tbody tr td .product-detail li {
            display: block;
            width: 100%;
            font-size: 16px;
            font-weight: 600;
            white-space: nowrap;
        }

        .product-table tbody tr td .product-detail li span {
            color: #939393;
        }

        .order-table {
            background-image: url(images/order-poster.jpg);
            background-position: center;
            background-repeat: no-repeat;
            border-radius: 5px;
            overflow: hidden;
            padding: 18px 27px;
            margin-top: 40px;
        }

        .footer-table {
            position: relative;
            margin-top: 34px;
        }

        .footer-table::before {
            position: absolute;
            content: "";
            background-image: url(images/footer-left.svg);
            background-position: top right;
            top: 0;
            left: -71%;
            width: 100%;
            height: 100%;
            background-repeat: no-repeat;
            z-index: -1;
            background-size: contain;
            opacity: 0.3;
        }

        .footer-table::after {
            position: absolute;
            content: "";
            background-image: url(images/footer-right.svg);
            background-position: top right;
            top: 0;
            right: 0;
            width: 100%;
            height: 100%;
            background-repeat: no-repeat;
            z-index: -1;
            background-size: contain;
            opacity: 0.3;
        }
    </style>
</head>

<body style="margin: 20px auto;">
    <table align="center" border="0" cellpadding="0" cellspacing="0"
        style="background-color: #fff; box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);-webkit-box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);">
        <tbody>
            <tr>
                <td>
                    <table class="header-table" align="center" border="0" cellpadding="0" cellspacing="0" width="100%">
                        <tr class="header"
                            style="background-color: #f7f7f7;display: flex;align-items: center;justify-content: center;width: 100%;">
                            <td class="header-logo" style="padding: 10px 32px;">
                                <a href="/" style="display: block; text-align: left;">
                                    <img src="{{ asset('backend/assets/images/logo/nsl-logo.png') }}" class="main-logo" alt="logo">
                                </a>
                            </td>
                        </tr>
                    </table>

                    <table style="padding: 27px;" align="center" border="0" cellpadding="0" cellspacing="0"
                        width="100%">
                        <tr>
                            <td>
                                <img src="{{ asset('images/order-success-poster.png') }}" alt="" style="width: 100%; height: 100%;">
                            </td>
                        </tr>
                    </table>

                    <table align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
                        style="padding: 0 27px;">
                        <tbody>
                            <tr>
                                <td>
                                    <div class="title title-2 text-center">
                                        {{-- <h2 style="font-size: 20px;font-weight: 700;margin: 24px 0 0;">Thanks For your
                                            Order
                                        </h2> --}}
                                        {{-- <p
                                            style="font-size: 14px;margin: 5px auto 0;line-height: 1.5;color: #939393;font-weight: 500;width: 70%;">
                                            You'll receive an email when your items are shipped. if you have any
                                            questions, Call Us (+81) 03-3981-5090.</p> --}}
                                            <div class="container-fluid-lg">
                                                <ul class="navbar-nav">
                                                    <li class="nav-item dropdown">
                                                        <a class="nav-link " href="{{ url('/') }}" style="font-size: 14px; 
                                                        font-weight: 600; color: #2a2424; text-decoration: underline; 
                                                        text-transform: capitalize; margin-left: 20px;">Home
                                                        </a>
                                                    </li>
                                                    <li class="nav-item dropdown">
                                                        <a class="nav-link" href="{{ url('/user') }}" style="font-size: 14px; 
                                                        font-weight: 600; color: #2a2424; text-decoration: underline; 
                                                        text-transform: capitalize; margin-left: 20px;">My Menu
                                                        </a>
        
                                                    </li>
        
                                                     <li class="nav-item dropdown">
                                                        <a class="nav-link " href="{{ url('/products') }}" style="font-size: 14px; 
                                                        font-weight: 600; color: #2a2424; text-decoration: underline; 
                                                        text-transform: capitalize; margin-left: 20px;">Product
                                                        </a>
                                                    </li>
        
        
                                                    <li class="nav-item dropdown">
                                                        <a class="nav-link " href="{{ route('shoplist') }}" style="font-size: 14px; 
                                                        font-weight: 600; color: #2a2424; text-decoration: underline; 
                                                        text-transform: capitalize; margin-left: 20px;">Shop
                                                        </a>
                                                    </li>
                                                </ul>
                                            </div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    @php
                        function formatZipCode($zipCode) {
                            if (preg_match('/^\d{3}-\d{4}$/', $zipCode)) {
                                return $zipCode;
                            }
                            if (preg_match('/^\d{7}$/', $zipCode)) {
                                return substr($zipCode, 0, 3) . '-' . substr($zipCode, 3, 4);
                            }
                            return $zipCode; // return as-is if not a standard 7 digit zip code
                        }
                    @endphp
                    <table class="dilivery-table" align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
                        style="margin: 25px 27px;padding: 20px 32px;width: fit-content; background-color:
                        #f7f7f7;">
                        <tbody>
                            <tr>
                                <td style="text-align: left;padding-right: 28px;border-right: 2px solid rgba(217, 217, 217, 0.5);width: 50%;">
                                    <div class="title title-2" style="text-align: left;">
                                        <h2 style="font-size: 16px;font-weight: 700;margin: 0 0 12px;">We will deliver your order</h2>
                                        <p
                                            style="font-size: 14px;margin: 0;line-height: 1.5;color: #939393;font-weight: 500;">
                                            〒{{ formatZipCode($order->orderDetail->first()->post_code) }} <br>
                                            {{ $order->orderDetail->first()->prefecture->name }} {{ $order->orderDetail->first()->city }} 
                                            {{ $order->orderDetail->first()->chome }} <br>
                                            {{ $order->orderDetail->first()->building }} {{ $order->orderDetail->first()->room_no }} <br>    
                                        </p>
                                    </div>
                                </td>

                                <td style="text-align: left;padding-left: 32px;width: 50%;">
                                    <div class="title title-2" style="text-align: left;">
                                        <h2 style="font-size: 16px;font-weight: 700;margin: 0 0 12px;">
                                            Thanks for your order</h2>
                                        <p
                                            style="font-size: 14px;margin: 0;line-height: 1.5;color:#939393;font-weight: 500;">
                                            If you have any questions, 
                                            Call Us (+81) 03-3981-5090 or Contact Us (info@new-style.life).</p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @if ($order->payment_approved == 0)
                    <table class="dilivery-table" align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
                        style="margin: 25px 27px;padding: 20px 32px;width: fit-content; background-color:
                        #f7f7f7;">
                        <tbody>
                            <tr>
                                <td style="text-align: left;padding-left: 32px;width: 100%;">
                                    <div class="title title-2" style="text-align: left;">
                                        <h2 style="font-size: 16px;font-weight: 700;margin: 0 0 12px;">For your reminder!</h2>
                                        <p
                                            style="font-size: 14px;margin: 0;line-height: 1.5;color:#939393;font-weight: 500;">
                                            We have send the email to you with detail order and bank informations. <br>
                                            Please check your email!<br>
                                            <span style="color: red">If you don't receive the email, please check your spam or junk folder.</span>
                                        </p>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    @endif
                    <table class="shipping-table" align="center" border="0" cellpadding="0" cellspacing="0" width="100%"
                        style="padding: 0 27px;">
                        <thead>
                            <tr>
                                <th
                                    style="font-size: 17px;font-weight: 700;padding-bottom: 8px;border-bottom: 1px solid rgba(217, 217, 217, 0.5);text-align: left;">
                                    Ordered Items</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                style="column-count: 2;column-rule-style: dashed;column-rule-color: rgba(82, 82, 108, 0.7);column-gap: 22px;column-rule-width: 1px;display: flex;align-items: center;">
                                <td style="width: 100%;">
                                    <table class="product-table" align="center" border="0" cellpadding="0"
                                        cellspacing="0" width="100%">
                                        <tbody>
                                            @foreach ($order->orderDetail as $orderDetail)
                                            <tr>
                                                <td
                                                    style="padding: 28px 0;border-bottom: 1px solid rgba(217, 217, 217, 0.5);">
                                                    <img src="{{ asset('images/'.$orderDetail->product-> product_thambnail) }}" alt=""  style="width: 50px; height: 50px;">
                                                </td>
                                                <td
                                                    style="padding: 28px 0;border-bottom: 1px solid rgba(217, 217, 217, 0.5);">
                                                    <ul class="product-detail">
                                                        <li>
                                                            @if(mb_strlen($orderDetail->product->product_name) > 30)
                                                                {!! mb_substr($orderDetail->product->product_name, 0, 30) . '<br>' . mb_substr($orderDetail->product->product_name, 30, 30) . '...' !!}
                                                            @else
                                                                {!! nl2br(e($orderDetail->product->product_name)) !!}
                                                            @endif
                                                        </li>
                                                        <li>Quantity: <span>{{ $orderDetail->qty }}</span></li>
                                                        <li>Price: <span>¥{{ number_format($orderDetail->price, 0, '', ',') }}</span></li>
                                                    </ul>
                                                </td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </td>

                                <td style="width: 70%;">
                                    <table class="dilivery-table" align="center" border="0" cellpadding="0"
                                        style="background-color: #F7F7F7;padding: 14px;" cellspacing="0" width="100%">
                                        <tbody>
                                            <tr>
                                                <td style="font-weight: 700;font-size: 17px;padding-bottom: 15px;border-bottom: 1px solid rgba(217, 217, 217, 0.5);"
                                                    colspan="2">Order summary</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="text-align: left;font-size: 15px;font-weight: 400;padding: 15px 0;border-bottom: 1px solid rgba(217, 217, 217, 0.5);">
                                                    Subtotal</td>
                                                <td
                                                    style="text-align: right;font-size: 15px;font-weight: 400;padding: 15px 0;border-bottom: 1px solid rgba(217, 217, 217, 0.5);">
                                                    ¥{{ number_format($order->sub_total_amount, 0, '', ',') }}</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="text-align: left;font-size: 15px;font-weight: 400;padding: 15px 0;border-bottom: 1px solid rgba(217, 217, 217, 0.5);">
                                                    Discount</td>
                                                <td
                                                    style="text-align: right;font-size: 15px;font-weight: 400;padding: 15px 0;border-bottom: 1px solid rgba(217, 217, 217, 0.5);">
                                                    -¥{{ number_format($order->coupon_discount_amount, 0, '', ',') }}</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="text-align: left;font-size: 15px;font-weight: 400;padding: 15px 0;border-bottom: 1px solid rgba(217, 217, 217, 0.5);">
                                                    Shipping Fee</td>
                                                <td
                                                    style="text-align: right;font-size: 15px;font-weight: 400;padding: 15px 0;border-bottom: 1px solid rgba(217, 217, 217, 0.5);">
                                                    ¥{{ number_format($order->shipping_fee, 0, '', ',') }}</td>
                                            </tr>
                                            <tr>
                                                <td
                                                    style="text-align: left;font-size: 15px;font-weight: 600;padding-top: 15px;">
                                                    Total</td>
                                                <td
                                                    style="text-align: right;font-size: 15px;font-weight: 600;padding-top: 15px;">
                                                    ¥{{ number_format($order->total_amount, 0, '', ',') }}</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </td>
                            </tr>
                        </tbody>
                    </table>

                    <table class="text-center footer-table" align="center" border="0" cellpadding="0" cellspacing="0"
                        width="100%"
                        style="background-color: #282834; color: white; padding: 24px; overflow: hidden; z-index: 0;">
                        <tr>
                            <td>
                                <table border="0" cellpadding="0" cellspacing="0" class="footer-social-icon text-center"
                                    align="center" style="margin: 8px auto 20px;">
                                    <tr>
                                        <td style="font-size: 19px; font-weight: 700;">Shop For <span
                                                class="theme-color">New Style Life</span></td>
                                    </tr>
                                </table>
                                <table border="0" cellpadding="0" cellspacing="0" class="footer-social-icon text-center"
                                    align="center" style="margin: 8px auto 20px;">
                                    <tr>
                                        <td>
                                            <a href="{{ url('/contact') }}"
                                                style="font-size: 14px; font-weight: 600; color: #fff; text-decoration: underline; text-transform: capitalize;">Contact
                                                Us</a>
                                        </td>
                                        <td>
                                            <a href="{{ url('/privacy-policy') }}"
                                                style="font-size: 14px; font-weight: 600; color: #fff; text-decoration: underline; text-transform: capitalize; margin-left: 20px;">privacy
                                                Policy</a>
                                        </td>
                                    </tr>
                                </table>
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td>
                                            <h5 style="font-size: 13px; text-transform: uppercase; margin: 0; color:#ddd;
                                letter-spacing:1px; font-weight: 500;">Specializing in New Style, we're dedicated to providing new,
                                 top-quality product to Japan daily.
                                            </h5>
                                            <h5 style="font-size: 13px; text-transform: uppercase; margin: 10px 0 0; color:#ddd;
                                letter-spacing:1px; font-weight: 500;">©2024 Asia Human Development, Inc. All rights reserved</h5>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
        </tbody>
    </table>
</body>

</html>