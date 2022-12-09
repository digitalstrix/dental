<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="{{asset('favicon.ico')}}">
    <title>@yield('title')</title>
    <!-- Simple bar CSS -->
    <link rel="stylesheet" href="{{asset('css/simplebar.css')}}">
    <!-- Fonts CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Overpass:ital,wght@0,100;0,200;0,300;0,400;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">
    <!-- Icons CSS -->
    <link rel="stylesheet" href="{{asset('css/feather.css')}}">
    <link rel="stylesheet" href="{{asset('css/select2.css')}}">
    <link rel="stylesheet" href="{{asset('css/fullcalendar.css')}}">
    <link rel="stylesheet" href="{{asset('css/dropzone.css')}}">
    <link rel="stylesheet" href="{{asset('css/uppy.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.steps.css')}}">
    <link rel="stylesheet" href="{{asset('css/jquery.timepicker.css')}}">
    <link rel="stylesheet" href="{{asset('css/quill.snow.css')}}">
    <!-- Date Range Picker CSS -->
    <link rel="stylesheet" href="{{asset('css/daterangepicker.css')}}">
    <!-- App CSS -->
    <link rel="stylesheet" href="{{asset('css/app-light.css')}}" id="lightTheme">
    <link rel="stylesheet" href="{{asset('css/app-dark.css')}}" id="darkTheme" disabled>
    
  </head>
  <body>
    
    <body class="vertical  light  ">
        <div class="wrapper">
    @include('users.layouts.partials._nav');
    @include('users.layouts.partials._aside');
    @yield('content');
    @include('users.layouts.shortcuts');
    @include('users.layouts.partials._footer');
    
  </body>
  @yield('scripts');
  @include('sweetalert::alert')
  @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])
</html>