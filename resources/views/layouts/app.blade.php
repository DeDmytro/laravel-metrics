<!doctype html>
<html lang="en">
<head>
    <!-- META Tags -->
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>{{ config('app.name') }}</title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- SEO -->
    {{--    @TODO--}}

    <!-- Favicon -->
    {{--    @TODO--}}

    @include('metrics::layouts.shared.styles')
</head>
<body class="text-gray-900 leading-normal font-sans bg-gray-100">
@include('metrics::layouts.shared.header')
<div id="app">

    @yield('content')
</div>
@include('metrics::layouts.shared.footer')
<!-- Google Analytics -->
{{--@TODO--}}
<!-- /Google Analytics -->

@include('metrics::layouts.shared.scripts')

</body>
</html>
