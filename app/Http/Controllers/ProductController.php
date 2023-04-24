<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index(Producto $model)
    {
        $productos = Producto::all();
        return view('productos.producto', compact('productos'));
    }


    public function save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'stock' => 'required|int',
            'price' => 'required|numeric',
            'marca' => 'required|string|max:255',

        ]);

        $data = $request->all();
        $product = new Producto();
        $product->name = $data['name'];
        $product->description = $data['description'];
        $product->stock = $data['stock'];
        $product->price = $data['price'];
        $product->marca = $data['marca'];
        $product->save();
        return redirect('productos');
    }

    public function editProduct($id)
    {
        $product = Producto::findOrFail($id);
        return view('product.editProduct', compact('products'));
    }

    public function delete($id)
    {
        $product = Producto::findOrFail($id);
        $product->delete();
        return redirect('productos');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:255',
            'stock' => 'required|int',
            'price' => 'required|numeric',
            'marca' => 'required|string|max:255',
        ]);
        //Actualizar datos
        $product = Producto::findOrFail($id);
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->stock = $request->input('stock');
        $product->price = $request->input('price');
        $product->marca = $request->input('marca');
        $product->save();
        return redirect('productos');
    }

    public function edit($id)
    {
        $product = Producto::findOrFail($id);
        return view('productos.edit', compact('product'));
    }
}
