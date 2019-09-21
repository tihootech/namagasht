<!DOCTYPE html>
<html lang="fa">
<head>
	<meta charset="utf-8">
	<title>Namagasht</title>

	<link rel="stylesheet" href="{{asset('/css/app.css')}}">
	<link rel="stylesheet" href="{{asset('/css/font-awesome.min.css')}}">
	<link rel="stylesheet" href="{{asset('/css/namagasht.css')}}">
	<link rel="stylesheet" href="{{asset('/css/rtl.css')}}">
	@isset ($form)
		<link rel="stylesheet" href="{{asset('/css/form-themes.css')}}">
	@endisset
</head>
<body>

	@yield('main')

	@if (session('message'))
		<div class="flash-message">
			{{session('message')}}
			<i class="fa fa-times"></i>
		</div>
	@endif

	<script src="{{asset('/js/app.js')}}" charset="utf-8"></script>
	<script src="{{asset('/js/namagasht.js')}}" charset="utf-8"></script>
</body>
</html>
