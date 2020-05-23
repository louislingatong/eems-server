<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Password Reset Request</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    Greetings,
    <br>
    <br>
    <br>
    To reset your password, 
    <a class="btn btn-primary" href="{{ env('FE_URL') }}/reset-password/{{ $token }}">
        click here.
    </a>
    <br>
    <br>
    If you did not request a password reset, please ignore this message.
    <br>
    <br>
    <br>
    Yours truly,
    <br>
    Administrator
</body>
</html>
