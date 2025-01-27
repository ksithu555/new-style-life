<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
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
        <h2>{{ __('messages.order_confirmation') }}</h2>
        <p>{{ __('messages.dear') }} {{ $orderDetails->first()->buyer->name }},</p>
        <p>{{ __('messages.order_successfully_placed') }}</p>
        <table>
            <thead>
                <tr>
                    <th>{{ __('messages.product') }}</th>
                    <th>{{ __('messages.shop') }}</th>
                    <th>{{ __('messages.quantity') }}</th>
                    <th>{{ __('messages.price_tax_included') }}</th>
                </tr>
            </thead>
            <tbody>
                @foreach($orderDetails as $detail)
                <tr>
                    <td>{{ $detail->product->product_name }}</td>
                    <td>{{ $detail->seller->shop_name }}</td>
                    <td>{{ $detail->qty }}</td>
                    <td>¥{{ number_format($detail->price, 0, '', ',') }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <table>
            <tbody>
                <tr>
                    <td class="subtotal">{{ __('messages.sub_total') }} :</td>
                    <td>¥{{ number_format($orderDetails->first()->order->sub_total_amount , 0, '.', ',') }}</td>
                </tr>
                <tr>
                    <td class="subtotal">{{ __('messages.shipping_fee') }} :</td>
                    <td>¥{{ number_format($orderDetails->first()->order->shipping_fee , 0, '.', ',') }}</td>
                </tr>
                <tr>
                    <td class="subtotal">{{ __('messages.coupon_discounted') }} :</td>
                    <td>¥{{ number_format($orderDetails->first()->order->coupon_discount_amount , 0, '.', ',') }}</td>
                </tr>
                <tr>
                    <td class="subtotal">{{ __('messages.total_price') }} :</td>
                    <td>¥{{ number_format($orderDetails->first()->order->total_amount , 0, '.', ',') }}</td>
                </tr>
            </tbody>
        </table>
        <p>{{ __('messages.please_transfer_total_amount') }} ¥{{ number_format($totalAmount, 0, '', ',') }} {{ __('messages.to_following_bank_account') }}:</p>
        <p>{{ __('messages.bank_name') }}: {{ $bankInfo->bank_name }}</p>
        <p>{{ __('messages.branch_name') }}: {{ $bankInfo->branch_name }}</p>
        <p>{{ __('messages.account_type') }}: {{ $bankInfo->account_type }}</p>
        <p>{{ __('messages.account_number') }}: {{ $bankInfo->account_number }}</p>
        <p>{{ __('messages.account_name') }}: {{ $bankInfo->account_name }}</p>
        <p>{{ __('messages.transfer_within_date', ['date' => $transferDate]) }}</p>
        <p>{{ __('messages.please_make_sure_transfer_person_name') }}:</p>
        <p>{{ __('messages.transfer_person_name') }}: {{ $transferPersonName }}</p>
        <p>{{ __('messages.thank_you_for_shopping') }}</p>
        <div class="footer">
            <p>{{ __('messages.contact_us_at') }} info@asian-food.site.</p>
        </div>
    </div>
</body>
</html>