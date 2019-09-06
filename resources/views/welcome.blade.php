<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="robots" content="noindex,nofollow" />
        <meta name="base-url" content="{{url('api')}}" />
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{config('app.name')}}</title>
        <!-- Main styles for this application-->
        <link rel="stylesheet" href="{{asset('css/app.css')}}">
    </head>
    <body class="layout-fixed">
        <div class="wrapper" id="app">
            <app-component></app-component>
        </div>
        <script type="text/javascript" src="{{asset('static/ckeditor/ckeditor.js')}}"></script>
        <script type="text/javascript" src="{{asset('js/app.js')}}"></script>
        <script type="text/javascript" src="{{asset('static/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js')}}"></script>
        <script type="text/javascript" src="{{asset('static/dist/js/adminlte.js')}}"></script>
    </body>
</html>