<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <link
    rel="stylesheet"
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.rtl.min.css"
    integrity="sha384-T5m5WERuXcjgzF8DAb7tRkByEZQGcpraRTinjpywg37AO96WoYN9+hrhDVoM6CaT"
    crossorigin="anonymous"
  />

  <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <link rel="stylesheet" href="{{asset('css/style.css')}}">
  <!-- Scripts -->

</head>
<body>

    <div class="container my-2 py-2">
        <div class="container ">

            <div class="row  justify-content-between">
                <div class="col-xs-12 col-md-4 ">
                    <div class="card p-0 rounded-0 border  z-depth-0">

                        <div class="card-header bg-white p-1">
                            <i class="fa-solid fa-list"></i>
                            معلومات السند
                        </div>
                        <div class="card-body">

                            <div class="form-group">
                                <span> اسم الطالب </span>
                                <span class="px-2">
                                    {{ $info->studentInfo->name }} {{ $info->studentInfo->father->name }}
                                </span>
                            </div>
                            <div class="form-group">
                                <span> المرحلة الدراسية </span>
                                <span class="px-2">
                                    {{ $info->levels->name }}
                                </span>
                            </div>

                            <div class="form-group">
                                <span> الصف </span>
                                <span class="px-2">
                                    {{ $info->classes->name }}
                                </span>
                            </div>
                            <div class="form-group">
                                <span> الفترة </span>
                                <span class="px-2">
                                    {{ $info->shifts->name }}
                                </span>
                            </div>



                            <div class="form-group">
                                <span> القسم </span>
                                <span class="px-2">
                                    {{ $info->sections->name }}
                                </span>
                            </div>
                            <div class="form-group">
                                <span> المجموعة </span>
                                <span class="px-2">
                                    {{ $info->groups->name }}
                                </span>
                            </div>

                            <div class="form-group">
                                <span> جهة الدفع </span>
                                <span class="px-2">
                                    {{ $info->feestypes->name }}
                                </span>
                            </div>
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-6">
                                        <span> الرسوم المقررة </span>
                                        <span class="px-2">
                                            {{ $info->want }}$
                                        </span>
                                    </div>
                                    <div class="col-6">
                                        <span> متبقي سابق </span>
                                        <span class="px-2">

                                        </span>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                </div>

            </div>


            <div class="container px-0 my-2 shadow rounded">



            </div>
        </div>



    </div>

</body>
</html>
