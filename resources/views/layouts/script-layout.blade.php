<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
   <head>
      <!-- Required meta tags -->
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
      <meta name="csrf-token" content="{{ csrf_token() }}">
      <title>AL Computer - @yield('title')</title>
      <link rel="shortcut icon" href="{{ asset('public/images/logo.jpg') }}">
      <link rel="stylesheet" href="{{ asset('public/bootstrap-5.0/css/bootstrap.css') }}">
   </head>
   <body class="sidebar-dark">
   @yield('content')
   <script type="text/javascript" src="{{ asset('public/bootstrap-5.0/js/bootstrap.js') }}"></script>
   </body>
</html>