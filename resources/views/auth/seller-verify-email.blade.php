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

        .mb-3 {
            margin-bottom: 30px;
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

        .header-menu ul li+li {
            margin-left: 20px;
        }

        .header-menu ul li a {
            font-size: 14px;
            color: #252525;
            font-weight: 500;
        }

        .password-button {
            background-color: #417394;
            border: none;
            color: #fff;
            padding: 14px 26px;
            font-size: 18px;
            border-radius: 6px;
            font-weight: 700;
            font-family: 'Nunito Sans', sans-serif;
        }

        .footer-table {
            position: relative;
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

        .theme-color {
            color: #417394;
        }
    </style>
</head>

<body style="margin: 20px auto;">
    <table align="center" border="0" cellpadding="0" cellspacing="0"
        style="background-color: white; width: 100%; box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);-webkit-box-shadow: 0px 0px 14px -4px rgba(0, 0, 0, 0.2705882353);">
        <tbody>
            <tr>
                <td>
                    <table class="header-table" align="center" border="0" cellpadding="0" cellspacing="0"
                        width="100%">
                        <tr class="header"
                            style="background-color: #f7f7f7;display: flex;align-items: center;justify-content: space-between;width: 100%;">
                            <td class="header-logo" style="padding: 10px 32px;">
                                <a href="{{ url('/') }}" style="display: block; text-align: left;">
                                    <img src="{{ asset('backend/assets/images/logo/nsl-logo.png') }}" class="main-logo"
                                        alt="logo" style="width: 200px; height:80px;">
                                </a>
                            </td>
                            <td class="header-menu" style="display: block; padding: 10px 32px;text-align: right;">
                                <ul>
                                    <li>
                                        <a href="{{ url('/') }}">{{ __('messages.home') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ url('/products') }}">{{ __('messages.products') }}</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('shoplist') }}">{{ __('messages.shop') }}</a>
                                    </li>
                                </ul>
                            </td>
                        </tr>
                    </table>

                    <table class="content-table" style="margin-bottom: -6px;" align="center" border="0"
                        cellpadding="0" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <td>
                                    <img src="{{ asset('images/order-success-poster.png') }}" alt="">
                                </td>
                            </tr>
                        </thead>
                    </table>

                    <table class="content-table" style="margin-top: 40px;" align="center" border="0" cellpadding="0"
                        cellspacing="0" width="100%">
                        <thead>
                            <tr style="display: block;">
                                <td style="display: block;">
                                    <h3
                                        style="font-weight: 700; font-size: 20px; margin: 0; text-transform: uppercase;">
                                        {{ __('messages.welcome_message', ['name' => $user->name]) }}
                                    </h3>
                                </td>

                                <td>
                                    <p
                                        style="font-size: 14px;font-weight: 600;width: 82%;margin: 8px auto 0;line-height: 1.5;color: #939393;font-family: 'Nunito Sans', sans-serif;">
                                        {{ __('messages.seller_intro') }}
                                        {{ __('messages.seller_support') }}
                                        {{ __('messages.seller_verification') }}
                                        <br>
                                        <span style="color: red">
                                            {{ __('messages.check_spam_folder_message') }}
                                        </span>
                                    </p>
                                </td>
                            </tr>
                        </thead>
                    </table>

                    <table class="button-table" style="margin: 34px 0;" align="center" border="0" cellpadding="0"
                        cellspacing="0" width="100%">
                        <thead>
                            <tr style="display: block;">
                                <td style="display: block;">
                                    <form method="POST" action="{{ route('verification.send') }}">
                                        @csrf
                                        <input type="hidden" name="email" value="{{ $user->email ?? '' }}">
                                        <button class="password-button" type="submit">
                                            {{ __('messages.btn_resend_email') }}
                                        </button>
                                    </form>
                                    {{-- <button class="password-button">Verify Email</button> --}}
                                </td>
                            </tr>
                        </thead>
                    </table>

                    <table class="content-table" align="center" border="0" cellpadding="0" cellspacing="0"
                        width="100%">
                        <thead>
                            <tr style="display: block;">
                                <td style="display: block;">
                                    <p
                                        style="font-size: 14px; font-weight: 600; width: 82%; margin: 0 auto; line-height: 1.5; color: #939393; font-family: 'Nunito Sans', sans-serif;">
                                        {{ _('messages.contact_us_message') }} <span
                                            class="theme-color">info@new-style.life</span>, 
                                            {{ _('messages.call') }} <span
                                            class="theme-color">(+81) 03-3981-5090</span> 
                                            {{ _('messages.or_visit') }} <span
                                            class="theme-color"><a class="nav-link"
                                                href="{{ url('/faq') }}">
                                                {{ _('messages.faq') }}</a></span>
                                            {{ __('messages.chat_support_message') }}
                                    </p>
                                </td>
                            </tr>
                        </thead>
                    </table>

                    <table class="text-center footer-table" align="center" border="0" cellpadding="0"
                        cellspacing="0" width="100%"
                        style="background-color: #282834; color: white; padding: 24px; overflow: hidden; z-index: 0; margin-top: 30px;">
                        <tr>
                            <td>
                                <table border="0" cellpadding="0" cellspacing="0"
                                    class="footer-social-icon text-center" align="center"
                                    style="margin: 8px auto 11px;">
                                    <tr>
                                        <td>
                                            <h4 style="font-size: 19px; font-weight: 700; margin: 0;">{{ _('messages.shop_for') }} <span
                                                    class="theme-color">{{ _('messages.new_style_life') }}</span></h4>
                                        </td>
                                    </tr>
                                </table>
                                <table border="0" cellpadding="0" cellspacing="0"
                                    class="footer-social-icon text-center" align="center"
                                    style="margin: 8px auto 20px;">
                                    <tr>
                                        <td>
                                            <a href="{{ url('/contact') }}"
                                                style="font-size: 14px; font-weight: 600; color: #fff; text-decoration: underline; text-transform: capitalize;">
                                                {{ _('messages.contact_us') }}
                                            </a>
                                        </td>
                                        <td>
                                            <a href="{{ url('/privacy-policy') }}"
                                                style="font-size: 14px; font-weight: 600; color: #fff; text-decoration: underline; text-transform: capitalize; margin-left: 20px;">
                                                {{ _('messages.privacy_policy') }}
                                            </a>
                                        </td>
                                    </tr>
                                </table>
                                <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td>
                                            <h5
                                                style="font-size: 13px; text-transform: uppercase; margin: 0; color:#ddd;
                                letter-spacing:1px; font-weight: 500;">
                                                {{ _('messages.specializing_in_asian_cuisine') }}
                                            </h5>
                                            <h5
                                                style="font-size: 13px; text-transform: uppercase; margin: 10px 0 0; color:#ddd;
                                letter-spacing:1px; font-weight: 500;">
                                                ©2024 Asia Human Development, Inc. All rights reserved</h5>
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