<?php

namespace App\Http\Controllers;

use App\Insumo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Alert;

class InsumoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $path = 'insumo';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $insumos = DB::table('insumos')->get();

            $cantInsumos = Insumo::get()
                ->count();

            return view($this->path . '.index', compact('insumos', 'cantInsumos'));
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
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $insumo = new Insumo();
            $insumo->nombre = $request->nombre;
            $insumo->descripcion = $request->descripcion;
            $insumo->precio = $request->precio;
            $insumo->medida = $request->medida;
            $insumo->save();

            alert()->success('Insumo agregado correctamente', 'Agregado');

            return redirect()->route('insumoindex');
        } catch (Exception $e) {
            return "Fatal error - " . $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Insumo $insumo
     * @return \Illuminate\Http\Response
     */
    public function show(Insumo $insumo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Insumo $insumo
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $insumo = Insumo::findOrFail($id);

        return view($this->path . '.edit', compact('insumo'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Insumo $insumo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $insumo = Insumo::findOrFail($id);
        $insumo->nombre = $request->nombre;
        $insumo->descripcion = $request->descripcion;
        $insumo->precio = $request->precio;
        $insumo->stock = $request->stock;
        $insumo->medida = $request->medida;

        $insumo->save();

        alert()->success('Insumo modificado correctamente', 'Modificado');

        return redirect()->route('insumoindex');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Insumo $insumo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Insumo $insumo)
    {
        //
    }
}
