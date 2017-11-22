<?php

namespace App\Http\Controllers;

use App\Insumo;
use App\Kardex;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Alert;

class KardexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $path = 'kardex';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        try {
            $kardexs = DB::table('kardexes')
                ->join('insumos', 'kardexes.idInsumo', 'insumos.id')
                ->select('kardexes.*', 'insumos.nombre', 'insumos.medida', 'insumos.stock')
                ->get();

            $insumos = DB::table('insumos')
                ->select('id', 'nombre')
                ->get();

            $cantKardexs = Kardex::get()
                ->count();

            return view($this->path . '.index', compact('kardexs', 'cantKardexs', 'insumos'));
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
            date_default_timezone_set('America/Lima');

            $insumos = DB::table('insumos')
                ->select('id', 'stock')
                ->get();

            $kardex = new Kardex();
            $kardex->idInsumo = $request->id;
            $kardex->fecha = date("Y-m-d H:i:s");
            $kardex->concepto = $request->concepto;
            $kardex->factura = $request->factura;
            $kardex->cantidad = $request->cantidad;
            $kardex->preciounitario = $request->preciounitario;

            $cantidadexistencia = 0;
            foreach ($insumos as $insumo) {
                if ($insumo->id == $request->id) {
                    if ($request->concepto == "Entrada") {
                        $kardex->cantidadexistencia = $insumo->stock + $request->cantidad;
                        $cantidadexistencia = $insumo->stock + $request->cantidad;
                    } else {
                        $kardex->cantidadexistencia = $insumo->stock - $request->cantidad;
                        $cantidadexistencia = $insumo->stock - $request->cantidad;
                    }
                }
            }

            $updateInsumo = Insumo::findOrFail($request->id);
            $updateInsumo->stock = $cantidadexistencia;
            $updateInsumo->save();

            $kardex->save();

            alert()->success('Kardex agregado correctamente', 'Agregado');

            return redirect()->route('kardexindex');
        } catch (Exception $e) {
            return "Fatal error - " . $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Kardex $kardex
     * @return \Illuminate\Http\Response
     */
    public
    function show(Kardex $kardex)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Kardex $kardex
     * @return \Illuminate\Http\Response
     */
    public
    function edit($id)
    {
        $insumos = DB::table('insumos')
            ->select('id', 'nombre')
            ->get();

        $kardex = Kardex::findOrFail($id);

        return view($this->path . '.edit', compact('kardex', 'insumos'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Kardex $kardex
     * @return \Illuminate\Http\Response
     */
    public
    function update(Request $request, $id)
    {
        date_default_timezone_set('America/Lima');

        $kardex = Kardex::findOrFail($id);
        $kardex->idInsumo = $request->id;
        $kardex->fecha = date("Y-m-d H:i:s");
        $kardex->factura = $request->factura;
        $kardex->cantidad = $request->cantidad;
        $kardex->preciounitario = $request->preciounitario;

        $insumos = DB::table('insumos')
            ->select('id', 'stock')
            ->get();

        $cantidadexistencia = 0;
        foreach ($insumos as $insumo) {
            if ($insumo->id == $request->id) {
                if ($request->concepto == "Entrada") {
                    $kardex->cantidadexistencia = $insumo->stock + $request->cantidad - $request->cantidadold;
                    $cantidadexistencia = $insumo->stock + $request->cantidad - $request->cantidadold;
                } else {
                    $kardex->cantidadexistencia = $insumo->stock - $request->cantidad + $request->cantidadold;
                    $cantidadexistencia = $insumo->stock - $request->cantidad + $request->cantidadold;
                }
            }
        }

        $updateInsumo = Insumo::findOrFail($request->id);
        $updateInsumo->stock = $cantidadexistencia;
        $updateInsumo->save();

        $kardex->save();

        alert()->success('Kardex modificado correctamente', 'Modificado');

        return redirect()->route('kardexindex');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Kardex $kardex
     * @return \Illuminate\Http\Response
     */
    public
    function destroy(Kardex $kardex)
    {
        //
    }
}
