<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ env('APP_NAME') }} - @yield('title')</title>
    <meta name="robots" content="noindex,nofollow"/>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    @include('backend.elements.head')

</head>

<body class="@yield('body_class')">

@include('backend.elements.page-loader')

<div id="page-container" class="page-container fade page-without-sidebar page-header-fixed page-with-top-menu">

    @include('backend.elements.header')

    @include('backend.elements.top-menu')

    <div id="content" class="content">
        @yield('content')
    </div>

    @include('backend.elements.footer')

    @include('backend.elements.scroll-top-btn')

</div>

@include('backend.elements.page-js')

</body>

</html>
