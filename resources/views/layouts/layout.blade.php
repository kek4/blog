<!DOCTYPE html>
<html lang="{{ config('app.locale') }}" ng-app="app">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Blog cuisine') }}</title>

    <!-- Styles -->
    @section('css')
    <link href="{{ asset('components/bootstrap/dist/css/bootstrap.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('components/toastr/toastr.min.css') }}" rel="stylesheet">
    @show
    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode([
            'csrfToken' => csrf_token(),
        ]) !!};
    </script>
</head>

<body>
@include('layouts/_header')
<main class="container">
<div class="col-md-3">

@include('layouts/_sidebar')
</div>
<div class="col-md-9">

@yield('content')
</div>
</main>

    <!-- Scripts -->
@section('js')

    <script type="text/javascript" src="{{ asset('js/jquery.js') }}"></script>
    <script type="text/javascript" src="{{ asset('components/angular/angular.min.js') }}"></script>
    <!-- <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script> -->
     <script src="{{ asset('components/bootstrap/dist/js/bootstrap.min.js') }}"></script>
   <script src="{{asset ('components/toastr/toastr.min.js')}}"></script>
   <script src="{{ asset('js/app.js') }}"></script>
   <script src="{{ asset('js/AppController.js') }}"></script>
   <script src="{{ asset('js/ListIngController.js') }}"></script>
@show

@include('layouts/_footer')

</body>

</html>
