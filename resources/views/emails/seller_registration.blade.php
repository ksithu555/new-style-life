<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Successful</title>
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
                Your <strong>registration</strong> process has been <strong>successfully completed</strong>!
            </p>
            <p style="text-align: right;">{{ \Carbon\Carbon::now()->format('F j, Y') }}</p>
            <p>Dear {{ $user->name }},</h2>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Welcome to our New Style Life.</p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Your registration is now confirmed, and you are officially a part of our valued partner. We are look forward to start together.</p>
            <p>Here are the key details regarding your registration:</p>
            <ul>
                <li><p>Name: {{ $user->name }}</p></li>
                <li><p>Email: {{ $user->email }}</p></li>
            </ul>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Please take a moment to review the information provided above. If there are any discrepancies or if you have
                any questions, don't hesitate to reach out to us at <strong>info@new-style.life</strong>.</p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;As a registered member, you now have access to our services/benefits. We encourage you to take full
                advantage of these offerings to enhance your experience with us.</p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;We will be in touch with further details regarding the commencement of the New Style Life and any
                additional requirements. In the meantime, if you require any assistance or support, feel free to contact
                our team.</p>
            <p>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Once again, congratulations on completing your registration!</p>
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