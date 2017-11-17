<?php

namespace App\Http\Controllers;

use App\Venta;
use Illuminate\Http\Request;
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

          if( !empty($idVenta) ){
            $idVenta = $idVenta[0]->NRO_PRESUPUESTO + 1;
          }else{
            $idVenta = 1;
          }

          $data = DB::table('productos')
                      ->orderBy('id')
                      ->get();

          return view($this->path . '.index', compact('data', 'idVenta'));
    }

    public function caja(){

      // Get id Venta
      $idVenta = DB::select('call getLastVenta()');

      if( !empty($idVenta) ){
        $idVenta = $idVenta[0]->NRO_PRESUPUESTO + 1;
      }else{
        $idVenta = 1;
      }

      $data = DB::table('productos')
                  ->orderBy('id')
                  ->get();

        return view($this->path . '.caja', compact('data', 'idVenta'));
    }

    public function cuadrarcaja(){

        return view($this->path . '.cuadrarcaja');
    }

    public function listaVenta(){
        return view($this->path . '.listaventa');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function show(Venta $venta)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function edit(Venta $venta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Venta $venta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Venta  $venta
     * @return \Illuminate\Http\Response
     */
    public function destroy(Venta $venta)
    {
        //
    }
}
