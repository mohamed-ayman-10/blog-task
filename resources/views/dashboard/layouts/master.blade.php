<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @include('dashboard.layouts.head')
    <title>Blog</title>
</head>
<body>
@include('dashboard.layouts.header')
<div class="container">
    <div class="card mt-5">
        @if($errors->any())
            <div class="alert alert-danger w-100">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="card-header">
            <h2 class="float-start">@yield('title')</h2>
            <!-- Button trigger modal -->
            @yield('btn')
        </div>
        <div class="card-body">

            @yield('content')
        </div>
    </div>
</div>

@include('dashboard.layouts.scripts')
</body>
</html>
