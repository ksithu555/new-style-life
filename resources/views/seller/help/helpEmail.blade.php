<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Help Inquiry</title>
</head>
<body>
    <p>E commerce 公式サイトから、以下の問い合わせがありました。</p>
    <hr>
    <p><strong>名前：</strong> {{ $name }}</p>
    <p><strong>メールアドレス：</strong> {{ $email }}</p>
    <hr>
    <p><strong>お問い合わせ内容：</strong></p>
    <p><strong>タイトル：</strong> {{ $title }}</p>
    <p><strong>理由：</strong> {{ $reason }}</p>
    <hr>
</body>
</html>