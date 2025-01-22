<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>New Order Received</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            color: #333;
        }
        .container {
            width: 80%;
            margin: 0 auto;
            padding: 20px;
            background-color: #f4f4f4;
            border: 1px solid #ddd;
        }
        .header {
            text-align: center;
            padding: 10px 0;
        }
        .header img {
            max-width: 100%;
            height: auto;
        }
        .content {
            margin: 20px 0;
        }
        .content p {
            font-size: 15px;
            line-height: 1.6;
        }
        .content h2 {
            font-size: 24px;
            margin-top: 0;
        }
        strong {
            font-size: 16px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }

        th {
            background-color: #f2f2f2;
        }
        .subtotal {
            font-weight: bold;
        }
        .footer {
            text-align: right;
            margin-top: 40px;
        }
        .footer p {
            font-size: 14px;
            color: #777;
            margin: 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <img src="{{ $message->embed(public_path('images/logos/MailHeader_NSL.jpg')) }}" alt="New Style Life Logo">
        </div>
        <div class="content">
            <p style="text-align: center;">
                <strong>Received</strong> an order from a customer with Order code
                <strong>{{ $orderDetails->first()->order->order_code }}</strong>!
            </p>
            <p style="text-align: right;">{{ \Carbon\Carbon::now()->format('F j, Y') }}</p>
            <p>Dear {{ $seller->name }},</h2>
            <p>Here are the key details regarding order:</p>
            <table>
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Quantity</th>
                        <th>Price(tax inc)</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $amount = 0;
                        $delivery_price = 0;
                        $coupon_discount = 0;
                    @endphp
                    @foreach($orderDetails as $detail)
                    <tr>
                        <td>{{ $detail->product->product_name }}</td>
                        <td>{{ $detail->qty }}</td>
                        <td>¥{{ number_format($detail->price, 0, '', ',') }}</td>
                    </tr>
                    @php
                        $amount += $detail->amount;
                        if ($detail->used_delivery_price == 1) {
                            $delivery_price = $detail->delivery_price;
                        }
                        if ($detail->used_shop_coupon_status == 1 || $detail->used_product_coupon_status == 1 ) {
                            $coupon_discount = $detail->order->coupon_discount_amount;
                        }
                    @endphp
                    @endforeach
                </tbody>
            </table>
            <table>
                <tbody>
                    <tr>
                        <td class="subtotal">Amount :</td>
                        <td>¥{{ number_format($amount , 0, '.', ',') }}</td>
                    </tr>
                    <tr>
                        <td class="subtotal">Shipping Fee :</td>
                        <td>¥{{ number_format($delivery_price , 0, '.', ',') }}</td>
                    </tr>
                    <tr>
                        <td class="subtotal">Coupon Discounted :</td>
                        <td>¥{{ number_format($coupon_discount , 0, '.', ',') }}</td>
                    </tr>
                    <tr>
                        <td class="subtotal">Total Price :</td>
                        <td>¥{{ number_format((($amount + $delivery_price) - $coupon_discount) , 0, '.', ',') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="footer">
            <p>Thank You,</p>
            <p>New Style Life</p>
            <p>Email: info@new-style.life</p>
            <p>Phone: (+81) 03-3981-5090</p>
            <p><a href="https://new-style.life/">https://new-style.life/</a></p>
            <p>〒171-0014<br>
                Room 502, Wada Building<br>
               4-27-5 Ikebukuro, Toshima-ku<br>
               Tokyo, Japan.
            </p>
        </div>
    </div>
</body>
</html>