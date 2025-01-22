<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Invoice</title>
    <style type="text/css">
        @import url('https://fonts.googleapis.com/css2?family=Noto+Sans+JP:wght@400;700&display=swap');

        * {
            font-family: Verdana, Arial, sans-serif;
        }
        body {
            font-family: Verdana, Arial, sans-serif;
        }
        .jp-text {
            font-family: 'Noto Sans JP', Verdana, Arial, sans-serif;
        }
        table {
            font-size: x-small;
        }
        tfoot tr td {
            font-weight: bold;
            font-size: x-small;
        }
        .gray {
            background-color: lightgray;
        }
        .font {
            font-size: 10px;
        }
        .authority {
            float: right;
        }
        .authority h2 {
            margin-top: -10px;
            color: green;
            margin-left: 35px;
        }
        .thanks p {
            color: green;
            font-size: 16px;
            font-weight: normal;
            font-family: serif;
            margin-top: 20px;
        }
    </style>
</head>
<body>
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
    <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
        <tr>
            <td valign="top">
                <h2 style="color: green; font-size: 26px;"><strong>New Style Life</strong></h2>
                <img src="{{ asset('backend/assets/images/logo/nsl-logo.png') }}" class="web-logo nav-logo img-fluid blur-up lazyload" alt="">
            </td>
            <td align="right">
                <p class="font jp-text">
                  <strong>Seller:</strong> {{ $data->first()->seller->shop_name }} <br>
                  <strong>Email:</strong> {{ Auth::user()->email }} <br>
                  <strong>Phone:</strong> {{ $data->first()->seller->phone }} <br>
                  〒{{ formatZipCode($data->first()->seller->zip_code) }} <br>
                   {{ $data->first()->seller->prefecture }} {{ $data->first()->seller->city }} {{ $data->first()->seller->chome }} <br>
                   {{ $data->first()->seller->building }} {{ $data->first()->seller->room }} <br>
                </p>
            </td>
        </tr>
    </table>

    <table width="100%" style="background:white; padding:2px;"></table>

    <table width="100%" style="background: #F7F7F7; padding:0 20px 0 20px;">
        <tr>
            <td>
                <p class="font jp-text" style="margin-left: 20px;">
                   <strong>Name:</strong> {{ $data->first()->buyer->name}} <br>
                   <strong>Email:</strong> {{ $data->first()->buyer->email}} <br>
                   <strong>Phone:</strong> {{ $data->first()->buyer->phone}} <br>
                   〒{{ formatZipCode($data->first()->post_code) }} <br>
                   {{ $data->first()->prefecture->name }} {{ $data->first()->city }} {{ $data->first()->chome }} <br>
                   {{ $data->first()->building }} {{ $data->first()->room_no }} <br>
                </p>
            </td>
            <td align="right">
                <h3><span style="color: green;">Order Code:</span>{{ $data->first()->order->order_code }}</h3>
                Order Date: {{ date('Y/m/d', strtotime($data->first()->created_at)) }} <br>
                Payment Type : {{ $data->first()->order->payment_type }}
            </td>
        </tr>
    </table>
    <br/>
    <h3>Products</h3>
    <table width="100%">
        <thead style="background-color: green; color:#FFFFFF;">
            <tr class="font">
                <th>Product Code</th>
                <th>Product Name</th>
                <th>Size</th>
                <th>Color</th>
                <th>Quantity</th>
                <th>Unit Price</th>
                <th>Amount</th>
            </tr>
        </thead>
        <tbody>
            @php
              $subtotal = 0;
              $ship_fee = 0;
              $total = 0;
            @endphp
            @foreach ($data as $productData)
            <tr class="font">
                <td align="center">{{ $productData->product->product_code }}</td>
                <td align="center">{{ $productData->product->product_name }}</td>
                <td align="center">{{ $productData->size }}</td>
                <td align="center">{{ $productData->color }}</td>
                <td align="center">{{ $productData->qty }}</td>
                <td align="center">&yen;{{number_format($productData->price) }}</td>
                <td align="center">&yen;{{number_format($productData->amount) }}</td>
                @php
                  $subtotal += $productData->amount;
                @endphp
                @if ($productData->used_delivery_price == 1)
                  @php
                    $ship_fee = $productData->delivery_price;
                  @endphp
                @endif
            </tr>
            @endforeach
            @php
              $total = $subtotal + $ship_fee;
            @endphp
        </tbody>
    </table>
    <br>
    <table width="100%" style=" padding:0 10px 0 10px;">
        <tr>
            <td align="right">
                <h2><span style="color: green;">Subtotal:</span> &yen;{{number_format($subtotal) }}</h2>
            </td>
        </tr>
        <tr>
            <td align="right">
                <h2><span style="color: green;">Shipping Fee:</span> &yen;{{number_format($ship_fee) }}</h2>
            </td>
        </tr>
        <tr>
            <td align="right">
                <h2><span style="color: green;">Total:</span> &yen;{{number_format($total) }}</h2>
            </td>
        </tr>
    </table>
    <table width="100%" style=" padding:0 10px 0 10px;">
        <tr>
            <td align="left" class="thanks mt-3">
              <p>Thanks For Buying Products..!!</p>
            </td>
        </tr>
        <tr>
            <td align="right" class="authority thanks mt-5">
              <p class="jp-text" style="margin-right: 70px;">{{ $data->first()->seller->shop_name }}</p>
              <h2>Authority Signature:</h2>
            </td>
        </tr>
    </table>
</body>
</html>