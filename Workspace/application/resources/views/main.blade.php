<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    @include('partials._head')
</head>

<body>

@include('partials._nav')

<div class="container">
    @include('partials._messages')

    @yield('content')

    @include('partials._footer')
    <svg id="background-svg" version="1.1"
         xmlns="http://www.w3.org/2000/svg"
         xmlns:xlink="http://www.w3.org/1999/xlink"
         viewBox="0 0 1000 700"
         preserveAspectRatio="xMidYMid meet"
         width="100%" height="100%">
        <image xlink:href="{{ asset('image/mock_07.png') }}" width="1300" y="0" height="600"></image>
        <image xlink:href="{{ asset('image/full-logo.png') }}" width="160" height="230" x="-150" y="330"
               transform="rotate(-35 80 120) skewX(27)"></image>
    </svg>
</div> <!-- end of .container -->

@include('partials._javascript')

@yield('scripts')

</body>
</html>