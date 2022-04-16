<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $search = $request->search;

        if($search){
            $products = Product::where('name', 'like','%'.$search.'%')->get();
        }else{
            $products = Product::all();
        }
        return view('welcome', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product;

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'quantity' => 'required|numeric|min:1',
            'categories' => 'required',
            'image' => 'required',
        ]);

        $product->name = $request->name;
        $product->price = $request->price;
        $product->description = $request->description;
        $product->quantity = $request->quantity;

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . 
                strtotime('now') . "." . $extension);
            $requestImage->move(public_path('img/products'), $imageName);
            $product->image = $imageName;
        }

        $product->save();

        $productId = Product::where('id', $product->id)->first();
        $productId->categories()->attach($request->categories);

        return redirect('/products/create')->with('msg', 'produto adicionado com sucesso!');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        return view('products.show', compact('product'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $categories = Category::all();
        return view('products.edit', compact('product', 'categories'));  
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $request->validate([
            'name' => 'required',
            'price' => 'required',
            'description' => 'required',
            'quantity' => 'required|numeric|min:1',
            'categories' => 'required',
            'image' => 'nullable',
        ]);

        $data = $request->all();

        if($request->hasFile('image') && $request->file('image')->isValid()){
            $requestImage = $request->image;
            $extension = $requestImage->extension();
            $imageName = md5($requestImage->getClientOriginalName() . 
                strtotime('now') . "." . $extension);
            $requestImage->move(public_path('img/products'), $imageName);
            $data['image'] = $imageName;
        }

        Product::findOrFail($request->id)->update($data);

        $product = Product::findOrFail($request->id);
        $product->categories()->sync($request->categories);
        return redirect('/')->with('msg', 'Produto editado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->categories()->detach();
        $product->delete();
        return redirect('/')->with('msg', 'Produto deletado com sucesso!');
    }
}
