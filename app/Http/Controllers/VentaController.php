<?php

namespace App\Http\Controllers;

use App\Venta;
use Auth;
use Barryvdh\DomPDF\PDF;
use Barryvdh\DomPDF\Facade;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;

class VentaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $path = 'venta';

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Get id Venta
        $idVenta = DB::select('call getLastVenta()');

        if (!empty($idVenta)) {
            $idVenta = $idVenta[0]->NRO_PRESUPUESTO + 1;
        } else {
            $idVenta = 1;
        }

        $data = DB::table('productos')
            ->orderBy('id')
            ->get();

        return view($this->path . '.index', compact('data', 'idVenta'));
    }

    public function orderDetail()
    {
        $personals = DB::table('users')
            ->select('id', 'name')
            ->get();

        //Ventas con Detalle
        $ventas = DB::select('call getAllVentas()');

        return view($this->path . '.reporte', compact('ventas', 'personals'));
    }

    public function caja()
    {
        // Get id Venta
        $idVenta = DB::select('call getLastVenta()');

        if (!empty($idVenta)) {
            $idVenta = $idVenta[0]->NRO_PRESUPUESTO + 1;
        } else {
            $idVenta = 1;
        }

        $data = DB::table('productos')
            ->orderBy('id')
            ->get();

        return view($this->path . '.caja', compact('data', 'idVenta'));
    }

    public function cuadrarcaja()
    {

        return view($this->path . '.cuadrarcaja');
    }

    public function listaVenta()
    {
        $idUser = Auth::user()->id;
        $ventas = DB::select('call getAllVentasNoCerradasByIdVendedor(' . $idUser . ')');

        $ventas_user = DB::select('call getAllVentasByUserId(' . $idUser . ')');

        return view($this->path . '.listaventa', compact('ventas', 'ventas_user'));
    }

    public function listaTotalVenta()
    {
        $ventas = DB::select('call getAllVentas()');


        return view($this->path . '.listaventa', compact('ventas'));
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Venta $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Venta $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Venta $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Venta $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        //
    }
}
