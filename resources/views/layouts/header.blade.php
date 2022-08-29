<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @hasSection('page_title')
            Blog - @yield('page_title')
        @else
            Blog
        @endif
    </title>
    
    @include('layouts.styles')

</head>