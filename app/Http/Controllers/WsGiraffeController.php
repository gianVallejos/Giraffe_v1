<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WsGiraffeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    public function saveVenta(Request $request){
          $cartShopping = $request->input('cartShopping');
          print_r($cartShopping); die();
      try{
          // Get id Venta
          $idVenta = DB::select('call getLastVenta()');

          if( !empty($idVenta) ){
              $idVenta = $idVenta[0]->NRO_PRESUPUESTO + 1;
          }else{
              $idVenta = 1;
          }

          $evg = DB::select('call agregarVentaGeneral(1, 1)');

          foreach( $cartShopping as $cs ){
              $evd = DB::select('call agregarVentaDetalle('. $cs['0'] .', '. $idVenta .')');
          }

          return response()->json(['idVenta' => $idVenta]);
      }catch(Exception $e){
          print('error');
      }
    }

}
