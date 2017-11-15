<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $path = 'cliente';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $clientes =Cliente::all();

            $cantClientes = Cliente::get()->count();

            return view($this->path . '.index', compact('clientes','cantClientes'));
        } catch (Exception $e) {
            alert()->error('Ha ocurrido un error: ' . $e->getMessage(), 'Error');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try{
            $cliente = new Cliente();
            $cliente->nombres = $request->nombres;
            $cliente->apellidos = $request->apellidos;
            $cliente->dni = $request->dni;
            $cliente->email = $request->email;
            $cliente->direccion = $request->direccion;
            $cliente->fechanacimiento = $request->fechanacimiento;
            $cliente->genero = $request->genero;
            $cliente->telefono = $request->telefono;
            $cliente->celular = $request->celular;
            $cliente->save();

            alert()->success('Cliente agregado correctamente', 'Agregado' );
            return redirect()->route('clienteindex');
        }catch(Exception $e){
            return "Fatal error - " . $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function show(Cliente $cliente)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);

        return view($this->path . '.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $cliente = Cliente::findOrFail($id);
        $cliente->nombres = $request->nombres;
        $cliente->apellidos = $request->apellidos;
        $cliente->dni = $request->dni;
        $cliente->fechanacimiento = $request->fechanacimiento;
        $cliente->telefono = $request->telefono;
        $cliente->genero = $request->genero;
        $cliente->direccion = $request->direccion;

        $cliente->save();

        alert()->success('Cliente modificado correctamente', 'Modificado');

        return redirect()->route('clienteindex');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Cliente  $cliente
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try{
            $cliente = Cliente::findOrFail($id);
            $cliente->delete();

            alert()->error('Cliente eliminado correctamente', 'Eliminado' );

            return redirect()->route('clienteindex');
        }catch(Exception $e){
            return "Fatal error - ". $e->getMessage();
        }
    }
}
