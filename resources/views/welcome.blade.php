<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" dir="rtl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ SystemInfo::setting('name') }} | {{ SystemInfo::setting('phones') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
        integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- Scripts -->
    <style>
        *{
            font-family: "Dubai"
        }
    </style>


<link rel="stylesheet" href="{{ asset('css/app.css') }}">
<link rel="stylesheet" href="{{ asset('css/uploads.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">
<link rel="stylesheet" href="{{ asset('css/sweetalert2.css') }}">
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])


</head>

<body>
    <div class="container d-flex justify-content-center align-items-center vh-100 ">
        <div class="card    border-0 shadow-lg col-xs-12 col-sm-12 col-md-6">
            <div class="card-body p-5">
                <div class="row">
                    <div class="col-xs-12 col-sm-12 col-md-3 py-3 my-2">
                        <a href="{{route('admin.login')}}" class="text-dark text-decoration-none">
                        <p class="h1 text-center"> <i class="fa-solid fa-people-roof"></i></p>
                        <p class="h3 text-center "> الإدارة  </p>
                    </a>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3 py-3 my-2">
                        <p class="h1 text-center"><i class="fa-solid fa-chalkboard-user"></i></p>
                        <p class="h3 text-center "> المدرسين  </p>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3 py-3 my-2">
                        <p class="h1 text-center"><i class="fa-solid fa-people-group"></i> </p>
                        <p class="h3 text-center "> أولياء الأمور  </p>
                    </div>
                    <div class="col-xs-12 col-sm-12 col-md-3 py-3 my-2">
                        <p class="h1 text-center"><i class="fa-solid fa-children"></i></p>
                        <p class="h3 text-center "> الطلبة  </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
