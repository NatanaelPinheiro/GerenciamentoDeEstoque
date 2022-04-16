@extends('layout.main')
@section('subtitle', 'Categories')
@section('content')

<a href="/">voltar</a>

<h1>Adicionar Categorias</h1>

<form action="/categories/store" method="POST">
	@csrf
	@method('POST')
	<label for="name">Nome:</label>
	<input type="text" name="name" id="name">
	@error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
	<input type="submit" value="Adicionar">
</form>

<h2>Todas as categorias</h2>
<ol>
	@foreach($categories as $category)
	<li>
		ID: {{$category->id}} || NOME: {{$category->name}} || 
		<a href="#">Editar</a>
	</li>
	@endforeach
</ol>

@endsection
