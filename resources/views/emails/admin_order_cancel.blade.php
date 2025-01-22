<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Cancelled</title>
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
                Order code <strong>{{ $order->order->order_code }}</strong> has been <strong>cancelled</strong>
                by <strong>{{ $order->seller->shop_name }}</strong>!
            </p>
            <p style="text-align: right;">{{ \Carbon\Carbon::now()->format('F j, Y') }}</p>
            <p>Dear {{ $admin->name }},</h2>
            <p>Cancelled Reason : {{ $order->cancelled_reason }}</p>
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
                    <tr>
                        <td>{{ $order->product->product_name }}</td>
                        <td>{{ $order->qty }}</td>
                        <td>¥{{ number_format($order->price, 0, '', ',') }}</td>
                    </tr>
                </tbody>
            </table>
            <table>
                <tbody>
                    <tr>
                        <td class="subtotal">Amount :</td>
                        <td>¥{{ number_format($order->amount , 0, '.', ',') }}</td>
                    </tr>
                </tbody>
            </table>
            <p>Prepare to notify the refund process soon.</p>
        </div>
        <div class="footer">
            <p>Admin Team,</p>
            <p>New Style Life</p>
            <p><a href="https://new-style.life/">https://new-style.life/</a></p>
        </div>
    </div>
</body>
</html>