@extends('layout.main')
@section('subtitle', 'Edit Product')
@section('content')

<a href="/products/show/{{$product->id}}">voltar</a>

<h1>Editar Produto</h1>
<form action="/products/update/{{$product->id}}" method="POST" enctype="multipart/form-data">
	@csrf
	@method('PUT')
	<label for="name">Nome:</label>
	<input type="text" name="name" id="name" placeholder="nome do produto" value="{{$product->name}}">
	@error('name')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
	<br>
	<label for="price">Preço:</label>
	<input type="text" name="price" id="price" placeholder="preço do produto" value="{{$product->price}}">
	@error('price')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
	<br>
	<label for="description">Descrição:</label>
	<textarea id="description" name="description">{{$product->description}}</textarea>
	@error('description')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
	<br>
	<label for="quantity">Quantidade:</label>
	<input type="number" name="quantity" id="quantity" minlength="1" value="{{$product->quantity}}">
	@error('quantity')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
	<br>
	<label for="image">Imagem</label>
	<input type="file" name="image" id="image" value="{{$product->image}}">
	<img src="/img/products/{{$product->image}}" width="150px">
	@error('image')
    <div class="alert alert-danger">{{ $message }}</div>
    @enderror
    <br>
    <label for="categories">Categorias</label>
    <select name="categories" id="categories">
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
	<input type="submit" value="Salvar">
</form>

@endsection

@push('scripts')
@if($product)
<script>
	function setSelectedIndex(s, valsearch){
		for (i = 0; i< s.options.length; i++){ 
			if (s.options[i].value == valsearch){
				s.options[i].selected = true;
				break;
			}
		}
		return;
	}
	setSelectedIndex(document.getElementById("categories"), '{{$product->categories()->first()->id}}');

</script>
@endif
@endpush