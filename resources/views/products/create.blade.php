@extends('layout.main')
@section('subtitle', 'Add Product')
@section('content')

<a href="/">voltar</a>

<h1>Adicionar Produto</h1>
<form action="/products/store" method="POST" enctype="multipart/form-data">
	@csrf
	@method('POST')
	<label for="name">Nome:</label>
	<input type="text" name="name" id="name" placeholder="nome do produto">
	@error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
	<br>
	<label for="price">Preço:</label>
	<input type="text" name="price" id="price" placeholder="preço do produto">
	@error('price')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
	<br>
	<label for="description">Descrição:</label>
	<textarea id="description" name="description"></textarea>
	@error('description')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
	<br>
	<label for="quantity">Quantidade:</label>
	<input type="number" name="quantity" id="quantity" minlength="1">
	@error('quantity')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
	<br>
	<label for="image"></label>
	<input type="file" name="image" id="image">
	@error('image')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    <label for="categories">Categorias</label>
    <select name="categories" id="categories">
    	<option selected disabled>Selecionar</option>
    	@if($categories)
    	@foreach($categories as $category)
    	<option value="{{$category->id}}">{{$category->name}}</option>
    	@endforeach
    	@endif
    </select>
	@error('categories')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
	<input type="submit" value="Adicionar">
</form>

@endsection