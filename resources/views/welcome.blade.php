@extends('layout.main')
@section('subtitle', 'Home')
@section('content')

    <a href="/products/create">Adicionar Produto</a><br>
    <a href="/categories">Administrar Categorias</a><br>

    <h1>Todos os produtos</h1>

    <form action="/" method="GET">
        @csrf
        @method('GET')
        <input type="text" name="search">
        <input type="submit" name="search-btn">
    </form>

    @if(count($products) > 0)
    <ol>
    @foreach($products as $product)
        <li>
            ID: {{$product->id}} | NOME: {{$product->name}} | CATEGORY:

            @if($categories = $product->categories()->get())
                @foreach($categories as $category)
                   {{$category->name}}
                @endforeach
            @endif
            || <a href="/products/show/{{$product->id}}">Ver mais</a>
        </li><br>
    @endforeach
    </ol>
    @else
    <p>Não há produtos por aqui. <a href="/products/create">clique aqui</a> para adicionar</p>
    @endif

@endsection