<!doctype html>
<html lang="ar" dir="rtl">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.rtl.min.css" integrity="sha384-T5m5WERuXcjgzF8DAb7tRkByEZQGcpraRTinjpywg37AO96WoYN9+hrhDVoM6CaT" crossorigin="anonymous">
        <title>Request Training</title>
    </head>
    <body>

        @foreach($data as $key => $val):
            <h3 style="text-align:center">{{__('front.'.$key)}}</h3>
            <p style="text-align: center">{{ $val }}</p>
            <hr />
        @endforeach

    </body>
</html>