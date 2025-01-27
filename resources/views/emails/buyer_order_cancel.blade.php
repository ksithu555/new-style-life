<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Cancelled</title>
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
        <h2>{{ __('messages.order_cancelled') }}</h2>
        <p>{{ __('messages.dear') }} {{ $order->buyer->name }},</p>
        <p>{{ __('messages.order_cancelled_by_seller', ['shop_name' => $order->seller->shop_name]) }}</p>
        <p>{{ __('messages.cancelled_reason') }} : {{ $order->cancelled_reason }}</p>
        <p>{{ __('messages.order_details') }}</p>
        <table>
            <thead>
                <tr>
                    <th>{{ __('messages.product') }}</th>
                    <th>{{ __('messages.quantity') }}</th>
                    <th>{{ __('messages.price_tax_included') }}</th>
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
                    <td class="subtotal">{{ __('messages.amount') }} :</td>
                    <td>¥{{ number_format($order->amount, 0, '.', ',') }}</td>
                </tr>
            </tbody>
        </table>
        <p>{{ __('messages.notify_refund_process') }}</p>
        <p>{{ __('messages.thank_you_for_shopping') }}</p>
        <div class="footer">
            <p>{{ __('messages.contact_us_at') }} info@new-style.life.</p>
        </div>
    </div>
</body>
</html>