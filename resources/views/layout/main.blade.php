<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Gerenciamento de Estoque | @yield('subtitle') </title>
	 @livewireStyles
</head>
<body>
	@if(session('msg'))
	   <p>{{session('msg')}}</p>
	@endif

	@yield('content')

    @livewireScripts
    @stack('scripts')
</body>
</html>