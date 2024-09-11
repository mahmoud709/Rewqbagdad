<!doctype html>
<html lang="ar" dir="rtl">
    <head>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.rtl.min.css" integrity="sha384-T5m5WERuXcjgzF8DAb7tRkByEZQGcpraRTinjpywg37AO96WoYN9+hrhDVoM6CaT" crossorigin="anonymous">
        <title>Email Activation</title>
    </head>
    <body>
        <br /><br /><br />
        <h1 style="text-align:center">
            يمكنك تفعيل النشرة الاخبارية عن طريق الضغط علي هذا الرابط
        </h1>
        <br />
        <h3 style="text-align:center">
            <a href="{{url('/active/subscription?token='.$token)}}" target="_blank">
                {{url('/active/subscription?token='.$token)}}
            </a>
        </h3>

    </body>
</html>
