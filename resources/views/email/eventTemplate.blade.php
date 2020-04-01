<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Event</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" media="screen" href="main.css" />
    <script src="main.js"></script>
</head>
<body>
    What: {{$details['name']}},
    <br>
    When:
    <br>
    @foreach ($details['schedules'] as $schedule)
        {{ $schedule['date'] }} {{ $schedule['start_time'] }} - {{ $schedule['end_time'] }}
        <br>
    @endforeach
    Where: {{$details['location']}}
    <br>
    Organizer: {{$details['organizer']}}
<br>
</body>
</html>
