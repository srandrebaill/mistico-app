<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>@yield('title')</title>

    <meta name="grecaptcha-key" content="{{config('recaptcha.v3.public_key')}}">
    <script src="https://www.google.com/recaptcha/api.js?render={{config('recaptcha.v3.public_key')}}"></script>

    @include('partials.styles')
</head>

<body>

    <div class="container-scroller">


        @if(Auth::check())
        @include('partials.header')
        @endif

        @if(!Auth::check())
        <div class="content-wrapper">
            @yield('content')
        </div>
        @endif
    </div>

    @include('partials.scripts')
    @include('partials.flash-messages')
</body>

</html>