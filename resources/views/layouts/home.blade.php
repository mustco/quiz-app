<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="{{ asset('assets/images/logo.png')}}" type="image/x-icon">
    <title>Quizz Mencerdaskan Bangsa</title>
    @include('components.style')
</head>
<body class="bg-soft-blue">
    <div class="container py-0">
        <div class="row justify-content-center">
            <div class="col-md-5 pb-2">
                @yield('title')
            </div>
            <div class="col-md-7 pb-2">
                @yield('sidebar-content')
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12 pb-2">
                @yield('content')
            </div>
        </div>
    </div>
    @include('components.script')
</body>
</html>