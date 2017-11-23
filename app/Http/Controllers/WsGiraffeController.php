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
          $montoCliente = $request->input('montoCliente');
      try{
          // Get id Venta
          $idVenta = DB::select('call getLastVenta()');

          if( !empty($idVenta) ){
              $idVenta = $idVenta[0]->NRO_PRESUPUESTO + 1;
          }else{
              $idVenta = 1;
          }

          $currentUser = app('Illuminate\Contracts\Auth\Guard')->user();
          $user_id = $currentUser["id"];
          $evg = DB::select('call agregarVentaGeneral(1, '. $user_id .', '. $montoCliente .')');

          foreach( $cartShopping as $cs ){
              $evd = DB::select('call agregarVentaDetalle('. $cs['4']. ', '. $cs['0'] .', '. $idVenta .')');
          }

          return response()->json(['idVenta' => $idVenta]);
      }catch(Exception $e){
          print('error');
      }
    }

    public function saveCuadrarCaja(Request $request){
      $data = $request->input('data');
      $monto_inicial = $data[0]['value'];

      $m1 = $data[1]['value'];
      $m2 = $data[2]['value'];
      $m3 = $data[3]['value'];
      $m4 = $data[4]['value'];
      $m5 = $data[5]['value'];
      $m6 = $data[6]['value'];
      $m7 = $data[7]['value'];
      $m8 = $data[8]['value'];
      $m9 = $data[9]['value'];
      $m10 = $data[10]['value'];
      $m11 = $data[11]['value'];
      $monto_general = $request->input('monto_general');

      $currentUser = app('Illuminate\Contracts\Auth\Guard')->user();
      $user_id = $currentUser["id"];


      try{
          $sql = 'call agregarCierreDeCaja('. $m1 .', '. $m2 .', '. $m3 .', '. $m4 .', ' . $m5 .', '. $m6 .', '. $m7 .', '. $m8 .', '. $m9 .', ' . $m10 . ', ' .
                                              $m11 .','. $monto_general . ', ' . $monto_inicial . ', ' . $user_id .')';
          $res = DB::select($sql);
          print(json_encode($res));
      }catch(Exception $e){
          print('error');
      }
    }

    public function getDetalleVenta($idVenta){

        $sql = 'call getDetalleVentasByIdVenta('. $idVenta .')';
        $res = DB::select($sql);
        print(json_encode($res));
    }

}
