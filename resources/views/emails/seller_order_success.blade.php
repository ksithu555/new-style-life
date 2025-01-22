<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Success</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            color: #555;
            border-bottom: 2px solid #ddd;
            padding-bottom: 10px;
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

        p {
            margin-bottom: 10px;
        }

        .footer {
            margin-top: 20px;
            border-top: 2px solid #ddd;
            padding-top: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Order Success</h2>
        <p>Dear {{ $seller->name }},</p>
        <p>Order code {{ $orderDetails->first()->order->order_code }} has been successfully ordered. Here are the details:</p>
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
                    <td>{{ $detail->price }}</td>
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

        <p>Check and prepare to confirm the order.</p>
        <div class="footer">
            <p>If you have any questions, please contact us at info@new-style.life.</p>
        </div>
    </div>
</body>
</html>