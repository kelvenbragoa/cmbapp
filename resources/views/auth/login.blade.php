
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="Inogest MassMeters, sistema de gest���o">
	<meta name="author" content="M+D">
	<meta name="keywords" content="M+D">

	<link rel="shortcut icon" href="/files/img/sys/logoinogesticon.png" />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

	<title>Inogest</title>

	<link href="{{asset('template/css/app.css')}}" rel="stylesheet">
</head>

{{-- <body style="background-image: url('/files/img/sys/background1.jpg'); height: 100%; 
background-position: center;
background-repeat: no-repeat;
background-size: cover;"> --}}
<body>
	 <div id="app">
        <router-view>
            <Login/>
        </router-view>
    </div>

	<script src="{{asset('template/js/app.js')}}"></script>

</body>

</html>


