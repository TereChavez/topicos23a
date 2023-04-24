<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ClientController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Cliente $model)
    {
        $clientes = Cliente::all();
        return view('clientes.cliente', compact('clientes'));
    }

    public function createClient()
    {
        return view('clientes.create_client');
    }


    public function save(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'telefono' => 'required|numeric',
            'direccion' => 'required|string|max:255',
        ]);

        $data = $request->all();
        $cliente = new Cliente();
        $cliente->name = $data['name'];
        $cliente->email = $data['email'];
        $cliente->telefono = $data['telefono'];
        $cliente->direccion = $data['direccion'];
        $cliente->save();
        return redirect('clientes');
    }


    public function delete($id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->delete();
        return redirect('clientes');
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'telefono' => 'required|numeric',
            'direccion' => 'required|string|max:255',
        ]);
        //Actualizar datos
        $cliente = Cliente::findOrFail($id);
        $cliente->name = $request->input('name');
        $cliente->email = $request->input('email');
        $cliente->telefono = $request->input('telefono');
        $cliente->direccion = $request->input('direccion');
        $cliente->save();
        return redirect('clientes');
    }

    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }
}