<?php

namespace App\Http\Controllers;

use App\Models\Proveedores;
use Illuminate\Http\Request;

class VendorController extends Controller
{
    public function index(Proveedores $model)
    {
        $proveedores = Proveedores::all();
        return view('proveedores.proveedor', compact('proveedores'));
    }


    public function save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'telefono' => 'required|numeric',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
        ]);

        $data = $request->all();
        $provider = new Proveedores();
        $provider->name = $data['name'];
        $provider->email = $data['email'];
        $provider->telefono = $data['telefono'];
        $provider->direccion = $data['direccion'];
        $provider->ciudad = $data['ciudad'];
        $provider->save();
        return redirect('proveedores');
    }

    public function delete($id)
    {
        $provider = Proveedores::findOrFail($id);
        $provider->delete();
        return redirect('proveedores');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'telefono' => 'required|numeric',
            'direccion' => 'required|string|max:255',
            'ciudad' => 'required|string|max:255',
        ]);
        //Actualizar datos
        $provider = Proveedores::findOrFail($id);
        $provider->name = $request->input('name');
        $provider->email = $request->input('email');
        $provider->telefono = $request->input('telefono');
        $provider->direccion = $request->input('direccion');
        $provider->ciudad = $request->input('ciudad');
        $provider->save();
        return redirect('proveedores');
    }

    public function edit($id)
    {
        $provider = Proveedores::findOrFail($id);
        return view('proveedores.edit', compact('provider'));
    }

}