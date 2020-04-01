<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Account Verification</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    Hi {{$details['name']}},
    <br>
    <br>
    <br>
    Your account has been created.
    <br>
    To complete your registration, 
    <a class="btn btn-primary" href="{{ env('FE_URL') }}/password-reset-finish/{{$details['token']}}">
        click here.
    </a>
    <br>
    <br>
    If this wasn't you, please ignore this message.
    <br>
    <br>
    <br>
    Yours truly,
    <br>
    Administrator
</body>
</html>
