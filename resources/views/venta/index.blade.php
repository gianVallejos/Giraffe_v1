@extends('layouts.app')

@section('content')

    <div class="container-fluid">
      <div class="row">
        <div class="col-lg-8 col-lg-offset-2">
          <div class="btn-group btn-group-justified">
            <a href="{{ route('ventaindex') }}" class="btn btn-md btn-default">Nueva Venta</a>
            <a href="{{ route('listaventaindex') }}" class="btn btn-md btn-default">Lista de Ventas</a>
            <a href="{{ route('clienteindex') }}" class="btn btn-md btn-default">Gestión de Clientes</a>
            <a href="{{ route('cuadrarcajaventa') }}" class="btn btn-md btn-default">Cerrar Caja</a>
          </div>
        </div>
      </div>
      <div class="row"  style="padding-top: 30px;">
        <div class="col-lg-3 col-lg-offset-2 col-md-4 col-xs-5">
          <div class="panel panel-default">
              <div class="panel-heading text-center title"><b>LISTA DE VENTAS</b></div>
              <div class="panel-body" style="padding-top: 16px;">
                  <div class="row">
                    <div class="col-md-12 col-xs-12 text-center">
                        <h4><strong>Venta Nro: <div id="idVenta">{{ $idVenta }}</div></strong></h4>
                    </div>
                  </div>
                  <div class="row">
                    <div class="col-md-12 col-xs-12 montos-bottom">
                        <div class="row">

                          <label for="" class="col-md-5 col-md-offset-1 col-xs-6">Subtotal:</label>
                          <div id="subtotal" class="col-md-5 col-xs-6 text-center">
                            S/ 0.00
                          </div>
                        </div>
                        <div class="row">

                        <label for="" class="col-md-5 col-md-offset-1 col-xs-6">IGV:</label>
                        <div id="igv" class="col-md-5 col-xs-6 text-center">
                          S/ 0.00
                        </div>
                      </div>

                      <div class="row" style="font-weight: bold; font-size: 18px;">
                        <label for="" class="col-md-5 col-md-offset-1 col-xs-6">Total:</label>
                        <div id="total" class="col-md-5 col-xs-6 text-center">
                          S/ 0.00
                        </div>
                      </div>

                    </div>

                    <div class="col-md-12 col-xs-12">
                          <div id="cart-shopping" class="cart-shopping" >
                            <table id="CartShoppingTable" class="table">
                                <thead>
                                    <tr>
                                        <!-- <th class="col-md-2 col-xs-1 text-center">#</th> -->
                                        <th class="text-center">Cant.</th>
                                        <th class="text-center">Producto</th>
                                        <th class="text-center">Precio</th>
                                        <th class="col-md-1 col-xs-1"></th>
                                    </tr>
                                </thead>
                                <tbody class="text-center">
                                    <tr>
                                    </tr>
                                </tbody>
                            </table>

                          </div>
                    </div>

                  </div>
              </div>
          </div>
        </div>
        <div class="col-lg-5 col-md-8 col-xs-7 text-center">
            <div class="panel panel-default">
                <div class="panel-heading text-center title"><b>PRODUCTOS</b></div>
                <div class="panel-body" style="padding-top: 29px;">
                      <div class="row">
                          <div class="col-md-2 col-xs-2 col-md-offset-1 col-xs-offset-1 text-right" style="margin-top: 5px;">
                            <b>Buscar:</b>
                          </div>
                          <div class="col-md-7 col-xs-8">
                            <input type="text" class="form-control" id="myInput" onkeyup="buscarProducto()" placeholder=" Buscar por Nombre de Producto">
                          </div>
                      </div>

                      <div id="table-wrapper">
                          <div id="table-scroll" style="max-height: 50vh; margin-top: 19px; padding-left: 13px; padding-right: 13px;">
                            <table id="tablaProductos" class="table table-responsive table-hover">
                                <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Producto</th>
                                        <th class="col-md-2 text-center">Precio</th>
                                        <th class="col-md-1 text-center"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php $i = 0; ?>
                                    @foreach( $data as $row )
                                      <tr>
                                        <td class="text-center">{{ $i+1 }}</td>
                                        <td class="text-center">{{ $row->nombre }} {{ $row->descripcion }}</td>
                                        <td class="text-center">{{ $row->precio }}</td>
                                        <td class="text-center">
                                            <button onclick="addProductToCart('{{ json_encode($row) }}')" class="btn-giraffe-icon flaticon-plus-sign-in-a-black-circle"></button>
                                        </td>
                                      </tr>
                                      <?php $i++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                          </div>
                      </div>

                      <div class="row" style="margin-top: 12px; margin-bottom: 14px;">
                        <div class="col-md-3 margin-null">
                          <label for="monto-pago">Pago Cliente</label>
                          <input id="monto-pago" type="number" min="0" step=".1" class="form-control" placeholder="S/ 00.00">
                        </div>
                        <div class="col-md-3 margin-null">
                          <label for="monto-vuelto">Vuelto</label>
                          <input id="monto-vuelto" type="text" min="0" step=".1" class="form-control" placeholder="S/ 00.00" disabled>
                        </div>
                        <div class="col-md-6 col-xs-8 p-t-25">
                          <button id="btn-pagar" type="button" class="btn-lg-giraffe btn-success-gf" >
                              <b>PAGAR ORDEN</b>
                          </button>
                        </div>
                      </div>
                </div>
            </div>
        </div>
      </div>
    </div>

    <div id="load-container" class="load-container">
      <div class="loader">
      </div>
      <span>Cargando</span>
    </div>

    <!-- MODAL -->
    <div id="modalPagar" class="modal fade" role="dialog">
      <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal">&times;</button>
            <h4 class="modal-title text-center"><b>TICKET DE VENTA</b></h4>
          </div>
          <div class="modal-body">
              <div class="row" style="margin: 19px 0px 24px 0px;">
                <div class="col-md-8 col-xs-8 col-md-offset-2 col-xs-offset-2">
                  <button id="btn-print-voucher" type="button" class="btn-giraffe btn-print" name="button" data-toggle="tooltip" title="Teclado: Control+i">
                    IMPRIMIR
                  </button>
                </div>
              </div>
              <div class="row text-center">
                <div class="vouchercontent-container">
                    <div id="vouchercontent" class="voucher-content" style="">

                    </div>
                </div>
              </div>
              <div class="row">
                <div class="col-md-8 col-xs-8 col-md-offset-2 col-xs-offset-2 text-center" style="padding-top: 24px;">
                  <div class="alert alert-success">
                    Orden Registrada <strong>Correctamente</strong>
                  </div>
                </div>
              </div>
          </div>
          <div class="modal-footer">
            <button id="cerrar-modal" type="button" class="btn btn-default" data-dismiss="modal" data-toggle="tooltip" title="Teclado: Doble Enter">Cerrar</button>
          </div>
        </div>

      </div>
    </div>

@endsection
<!-- <script type="text/javascript">


</script> -->
