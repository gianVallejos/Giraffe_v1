@extends('layouts.app')

@section('content')

    @if (Auth::guest())
        <div class="text-center" style="min-height: 50vh; padding-top: 10vh;">
          <h2><strong>Bienvenido a Giraffe</strong></h2>
          <span>para acceder al sistema puedes iniciar sesión <a href="{{ route('login') }}">aquí</a></span>
        </div>
    @else
    <div class="container">
      <div class="row">
        <div class="col-md-4 col-xs-4">
          <div class="panel panel-default">
              <div class="panel-heading text-center title"><b>LISTA DE VENTAS</b></div>
              <div class="panel-body" style="padding-top: 29px;">
                  <div class="row">
                    <div class="col-md-12 col-xs-12 montos-bottom">
                        <div class="row">

                          <label for="" class="col-md-5 col-md-offset-1 col-xs-6">Subtotal:</label>
                          <div id="subtotal" class="col-md-5 col-xs-6 text-center">
                            S/ 0
                          </div>
                        </div>
                        <div class="row">

                        <label for="" class="col-md-5 col-md-offset-1 col-xs-6">IGV:</label>
                        <div id="igv" class="col-md-5 col-xs-6 text-center">
                          S/ 0
                        </div>
                      </div>

                      <div class="row" style="font-weight: bold; font-size: 18px;">
                        <label for="" class="col-md-5 col-md-offset-1 col-xs-6">Total:</label>
                        <div id="total" class="col-md-5 col-xs-6 text-center">
                          S/ 0
                        </div>
                      </div>

                    </div>

                    <div class="col-md-12 col-xs-12">
                          <div id="cart-shopping" class="cart-shopping" >
                            <table id="CartShoppingTable" class="table">
                                <thead>
                                    <tr>
                                        <!-- <th class="col-md-2 col-xs-1 text-center">#</th> -->
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
        <div class="col-md-8 col-xs-8 text-center">
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
                                            <a href="#" onclick="addProductToCart('{{ json_encode($row) }}')" class="btn-giraffe-icon flaticon-plus-sign-in-a-black-circle"></a>
                                        </td>
                                      </tr>
                                      <?php $i++; ?>
                                    @endforeach
                                </tbody>
                            </table>
                          </div>
                      </div>

                      <div class="row" style="margin-top: 26px; margin-bottom: 16px;">
                        <div class="col-md-7 col-lg-7 col-xs-8 col-md-offset-1">
                          <button id="btn-pagar" type="button" class="btn-lg-giraffe btn-success-gf" >
                              <b>PAGAR ORDEN</b>
                          </button>
                        </div>
                        <div class="col-md-3 col-lg-3 col-xs-4">
                          <button id="btn-nuevo" type="button" class="btn-lg-giraffe btn-error-gf">
                              <b>NUEVO</b>
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
      <span>Guardando</span>
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
                  <button id="btn-print-voucher" type="button" class="btn-giraffe btn-print" name="button">
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
            <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
          </div>
        </div>

      </div>
    </div>
    @endif

@endsection
<!-- <script type="text/javascript">


</script> -->
