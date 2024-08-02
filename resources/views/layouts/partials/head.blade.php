<head>

    <meta charset="utf-8" />
    <title>{{$title ?? ''}} | {{ config('app.name') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{asset('images/favicon.ico') }}">

    <!-- Bootstrap Css -->
    <link href="{{asset('css/bootstrap.min.css' ) }}" id="bootstrap-style" rel="stylesheet" type="text/css" />
    <!-- Icons Css -->
    <link href="{{asset('css/icons.min.css' ) }}" rel="stylesheet" type="text/css" />
    <!-- App Css-->
    <link href="{{asset('css/app.min.css' ) }}" id="app-style" rel="stylesheet" type="text/css" />

    @stack('styles')
    @livewireStyles
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
