@extends('layouts.app')

@section('content')

    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="btn-group btn-group-justified">
            <a href="{{ route('ventaindex') }}" class="btn btn-md btn-default">Ventas</a>
            <a href="#" class="btn btn-md btn-default">Gestión de Clientes</a>
            <a href="{{ route('cuadrarcajaventa') }}" class="btn btn-md btn-default">Cerrar Caja</a>
          </div>
        </div>
      </div>
      <div class="row"  style="padding-top: 30px;">
        <div class="col-lg-8 col-lg-offset-2 col-md-12 col-xs-12 text-center">
            <div class="panel panel-default">
                <div class="panel-heading text-center title"><b>CERRAR CAJA</b></div>
                <div class="panel-body" style="padding-top: 45px; padding-bottom: 50px;">

                  <form class="form-horizontal" id="formCuadreCaja" method="post">

                    <div class="form-group">
                      <label for="montoInicial" class="col-md-2 col-md-offset-2 control-label">Monto de inicio de día: </label>
                      <div class="col-md-6">
                        <input id="montoInicial" name="montoInicial" class="form-control" type="number" min="0" step=".1" placeholder="Monto Inicial">
                      </div>
                    </div>



                  <div class="col-md-10 col-xs-12 col-md-offset-1" style="padding-top: 25px; padding-bottom: 20px;">
                    <div id="table-wrapper">

                          <table id="tablaPrecio" class="table table-responsive table-hover">
                              <thead>
                                  <tr>
                                      <th class="text-center">#</th>
                                      <th class="text-center col-md-2">Moneda/Billete (S/)</th>
                                      <th class="text-center">Valor</th>
                                      <th class="text-center">Cantidad</th>
                                      <th class="text-center">Monto</th>
                                  </tr>
                              </thead>
                              <tbody>

                                    <tr>
                                       <td class="text-center">1</td>
                                      <td>
                                        <img src="{{ asset('images/monedas/diez_centimos.png') }}" alt="diez centimos">
                                      </td>
                                       <td class="text-center">
                                           0.10
                                       </td>
                                       <td class="text-center">
                                           <input class="form-control form-control-monto text-center" type="number" min="0" name="1" step="1" id="cnt-1" value="0">
                                       </td>
                                       <td class="text-center">
                                           <input class=" text-center form-control form-control-monto" type="number" min="0" name="monto-1" id="monto-1" value="0" disabled>
                                       </td>
                                    </tr>

                                    <tr>
                                       <td class="text-center col-md-1 col-xs-1">2</td>
                                       <td class="text-center col-md-5 col-xs-3">
                                         <img src="{{ asset('images/monedas/veinte_centimos.png') }}" alt="Veinte centimos">
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           0.20
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           <input class="form-control form-control-monto text-center" type="number" min="0" name="2" step="1" id="cnt-2" value="0">
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           <input class=" text-center form-control form-control-monto" type="number" min="0" name="monto-2" id="monto-2" value="0" disabled>
                                       </td>
                                    </tr>

                                    <tr>
                                       <td class="text-center col-md-1 col-xs-1">3</th>
                                         <td class="text-center col-m5-2 col-x3-2">
                                           <img src="{{ asset('images/monedas/cincuenta_centimos.png') }}" alt="Cincuenta centimos">
                                         </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           0.50
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           <input class="form-control form-control-monto text-center" type="number" min="0" name="3" step="1" id="cnt-3" value="0">
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           <input class=" text-center form-control form-control-monto" type="number" min="0" name="monto-3" id="monto-3" value="0" disabled>
                                       </td>
                                    </tr>

                                    <tr>
                                       <td class="text-center col-md-1 col-xs-1">4</th>
                                       <td class="text-center col-md-5 col-xs-3">
                                         <img src="{{ asset('images/monedas/un_sol.png') }}" alt="Un sol">
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           1.00
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           <input class="form-control form-control-monto text-center" type="number" min="0" name="4" step="1" id="cnt-4" value="0">
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           <input class=" text-center form-control form-control-monto" type="number" min="0" name="monto-4" id="monto-4" value="0" disabled>
                                       </td>
                                    </tr>

                                    <tr>
                                       <td class="text-center col-md-1 col-xs-1">5</td>
                                       <td class="text-center col-md-5 col-xs-3">
                                         <img src="{{ asset('images/monedas/dos_soles.png') }}" alt="Dos soles">
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           2.00
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           <input class="form-control form-control-monto text-center" type="number" min="0" name="5" step="1" id="cnt-5" value="0">
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           <input class=" text-center form-control form-control-monto" type="number" min="0" name="monto-5" id="monto-5" value="0" disabled>
                                       </td>
                                    </tr>

                                    <tr>
                                       <td class="text-center col-md-1 col-xs-1">6</td>
                                       <td class="text-center col-md-5 col-xs-3">
                                         <img src="{{ asset('images/monedas/cinco_soles.png') }}" alt="Cinco soles">
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           5.00
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           <input class="form-control form-control-monto text-center" type="number" min="0" name="6" step="1" id="cnt-6" value="0">
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           <input class=" text-center form-control form-control-monto" type="number" min="0" name="monto-6" id="monto-6" value="0" disabled>
                                       </td>
                                    </tr>

                                    <tr>
                                       <td class="text-center col-md-1 col-xs-1">7</td>
                                         <td class="text-center col-m5-2 col-x3-2">
                                           <img src="{{ asset('images/monedas/diez_soles.png') }}" alt="Diez Soles">
                                         </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           10.00
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           <input class="form-control form-control-monto text-center" type="number" min="0" name="7" step="1" id="cnt-7" value="0">
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           <input class=" text-center form-control form-control-monto" type="number" min="0" name="monto-7" id="monto-7" value="0" disabled>
                                       </td>
                                    </tr>

                                    <tr>
                                       <td class="text-center col-md-1 col-xs-1">8</td>
                                       <td class="text-center col-md-5 col-xs-3">
                                         <img src="{{ asset('images/monedas/veinte_soles.png') }}" alt="veinte soles">
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           20.00
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           <input class="form-control form-control-monto text-center" type="number" min="0" name="8" step="1" id="cnt-8" value="0">
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           <input class=" text-center form-control form-control-monto" type="number" min="0" name="monto-8" id="monto-8" value="0" disabled>
                                       </td>
                                    </tr>

                                    <tr>
                                       <td class="text-center col-md-1 col-xs-1">9</td>
                                       <td class="text-center col-md-5 col-xs-3">
                                         <img src="{{ asset('images/monedas/cincuenta_soles.png') }}" alt="cincuenta soles">
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           50.00
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           <input class="form-control form-control-monto text-center" type="number" min="0" name="9" step="1" id="cnt-9" value="0">
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           <input class="form-control text-center form-control-monto" type="number" min="0" name="monto-9" id="monto-9" value="0" disabled>
                                       </td>
                                    </tr>

                                    <tr>
                                       <td class="text-center col-md-1 col-xs-1">10</td>
                                       <td class="text-center col-md-5 col-xs-3">
                                         <img src="{{ asset('images/monedas/cien_soles.png') }}" alt="cien_soles">
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           100.00
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           <input class="form-control form-control-monto text-center" type="number" min="0" name="10" step="1" id="cnt-10" value="0">
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           <input class="form-control text-center form-control-monto" type="number" min="0" name="monto-10" id="monto-10" value="0" disabled>
                                       </td>
                                    </tr>

                                    <tr>
                                       <td class="text-center col-md-1 col-xs-1">11</td>
                                       <td class="text-center col-md-5 col-xs-3">
                                         <img src="{{ asset('images/monedas/doscientos_soles.png') }}" alt="doscientos_soles">
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           200.00
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           <input class="form-control form-control-monto text-center" type="number" min="0" name="11" step="1" id="cnt-11" value="0">
                                       </td>
                                       <td class="text-center col-md-2 col-xs-2">
                                           <input class="form-control text-center form-control-monto" type="number" min="0" name="monto-11" id="monto-11" value="0" disabled>
                                       </td>
                                    </tr>

                              </tbody>
                              <tfoot style="font-size: 16px; font-weight: bold;">
                                <tr>
                                  <td></td>
                                  <td></td>
                                  <td></td>
                                  <td class="text-right">Monto (S/):</td>
                                  <td id="monto-general">0</td>
                                </tr>
                                <tr>
                                  <td style="border-top: none;"></td>
                                  <td style="border-top: none;"></td>
                                  <td style="border-top: none;"></td>
                                  <td style="border-top: none;" class="text-right">Inicio Día (S/):</td>
                                  <td style="border-top: none;"></td>
                                </tr>
                                <tr>
                                  <td style="border-top: none;"></td>
                                  <td style="border-top: none;"></td>
                                  <td style="border-top: none;"></td>
                                  <td style="border-top: none;" class="text-right">Total (S/):</td>
                                  <td style="border-top: none;">0</td>
                                </tr>
                              </tfoot>
                            </table>

                        </div>
                      </div>

                      <div class="col-md-12 text-center">
                        <button type="submit" class="btn-giraffe" name="button"><span>Cerrar Caja</span></button>
                      </div>

                      </form>

                </div>
            </div>
        </div>
      </div>
    </div>

@endsection
