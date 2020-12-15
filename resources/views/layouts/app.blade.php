<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>
        @yield('title') |
        {{ config('app.name', 'Laravel') }}
    </title>
    <link rel="icon" type="image/x-icon" href="{{asset('dashboard_assets/images/favicon.ico')}}"/>

    {{-- <link href="https://fonts.googleapis.com/css?family=Quicksand:400,500,600,700&amp;display=swap" rel="stylesheet"> --}}

    @include('layouts.partials.styles')
</head>
<body class="sidebar-noneoverflow">

    @include('layouts.partials.nav-bar')


    <div class="main-container" id="container">

        <div class="overlay"></div>
        <div class="search-overlay"></div>
        <!--  BEGIN SIDEBAR  -->

        @include('layouts.partials.side-bar')

          <!--  END SIDEBAR  -->

        <div id="content" class="main-content">

            <div class="layout-px-spacing">


               @yield('content')

            </div>

            @include('layouts.partials.footer')
        </div>
    </div>

    @include('layouts.partials.scripts')

</body>
</html>
