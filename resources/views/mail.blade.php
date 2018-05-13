<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Confirmation Email</title>
</head>
<body>
    <p>Thanks for registering for our service.Please confirm your email</p>
    <a href="{{ URL::to('register/verify/' . $code) }}">Click here to validate</a>
</body>
</html>