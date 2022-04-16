@extends('layout.main')
@section('subtitle', 'Show Product')
@section('content')

<a href="/">voltar</a>

<h1>Exibir Produto</h1>
<h2>Nome: {{$product->name}}</h2>

<h3>Descrição</h3>
<p>{{$product->description}}</p>

<h3>Preço: R$ {{$product->price}}</h3>
<h4>Quantidade disponível: {{$product->quantity}}</h4>
<h4>Categoria: {{$product->categories()->first()->name}}</h4>

<img src="/img/products/{{$product->image}}" alt="{{$product->name}}" width="200px">

<hr>
<a href="/products/edit/{{$product->id}}">Editar</a>

<form action="/products/delete/{{$product->id}}" method="POST">
	@csrf
	@method('DELETE')

	<a href="/products/delete/{{$product->id}}"  
       onclick="event.preventDefault();
               this.closest('form').submit();"
    > 
    Deletar
     </a>
</form>
@endsection