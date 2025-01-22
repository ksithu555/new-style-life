<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FAQ Contact</title>
    <style>
        body {
            font-family: 'Times New Roman', Times, serif; /* Change font family to Times New Roman */
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
        .footer {
            text-align: right;
            margin-top: 40px;
        }
        .footer h3 {
            font-size: 15px;
            color: #333;
        }
        .footer p {
            font-size: 14px;
            color: #777;
            margin: 0;
        }
        .content h3.greet {
            font-size: 15px;
            margin-top: 20px;
            margin-left: 0; /* Remove left margin */
            text-align: left; /* Center-align the heading */
            font-weight: normal; /* Make the Dear Admin not bold */
        }
        .content p.date {
            text-align: right; /* Align date to the right */
        }

        .content p.detail {
            font-size: 16px;
            line-height: 1.6;
            margin-left: 40px;
            font-weight: 100px;
        }
        .bold-text {
            font-weight: bold;
            font-size: 15px;
        }
        .normal-text {
            font-weight: normal;
            font-size: 15px;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header">
            <img src="{{ $message->embed(public_path('images/logos/MailHeader_NSL.jpg')) }}" alt="New Style Life Logo">
        </div>
        <div class="content">
            <p class="date">{{ \Carbon\Carbon::now()->format('F j, Y') }}</p>
            <h3 style="text-align: center"><span class="bold-text">Received</span> <span class="normal-text">a Message!</span></h3>
            <h3 class="greet">Dear Admin,</h3>
            <p class="detail"><strong>Email:</strong> {{ $data['email'] }}</p>
            <p class="detail"><strong>Phone:</strong> {{ $data['phone'] }}</p>
            <p class="detail"><strong>Message Details:</strong><br> {{ $data['content'] }}</p>
        </div>
        <div class="footer">
            <p style="text-align: right;font-weight:120px"><strong>Best regards,</strong></p>
            <p>{{ $data['email'] }}</p>
        </div>
    </div>
</body>
</html>