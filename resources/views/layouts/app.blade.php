<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Purple Admin</title>

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