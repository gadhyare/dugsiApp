<!DOCTYPE html>
<html lang="en" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>

    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.rtl.min.css"
    integrity="sha384-T5m5WERuXcjgzF8DAb7tRkByEZQGcpraRTinjpywg37AO96WoYN9+hrhDVoM6CaT"
    crossorigin="anonymous"
  />

  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <style>
        body , td{
            font-family: 'Rubik', sans-serif !important;
}
    </style>
</head>
<body>

    <div class="container">
        <div class="h4 text-center"> قائمة الآباء </div>
        <hr>

        <table class="table">
            <thead>
                <tr>
                    <th>م</th>
                    <th>الاسم</th>
                    <th>الرقم العائلي</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($fathers as $father)
                <tr>
                    <th>{{$father->id}}</th>
                    <th>{{$father->name}}</th>
                    <th>{{$father->number}}</th>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>


</body>
</html>
