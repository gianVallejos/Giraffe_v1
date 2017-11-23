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
    <div class="col-lg-8 col-lg-offset-2 col-md-12 col-xs-12 text-center">
        <div class="panel panel-default">
            <div class="panel-heading text-center title"><b>VENTAS SIN CERRAR</b></div>
            <div class="panel-body" style="padding-top: 45px; padding-bottom: 50px;">

              <div id="table-wrapper">
                  <div id="table-scroll">
                      <table class="table table-responsive table-hover" style="font-size: 16px;">
                          <thead>
                          <tr>
                              <th class="text-center">#</th>
                              <th class="text-center">Fecha</th>
                              <th class="text-center">Cajero</th>
                              <th class="text-center">Monto Venta</th>
                              <th class="text-center">Pago Cliente</th>
                              <th class="text-center">Vuelto</th>
                              <th></th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php $i = 1; $cnt = 0; ?>
                            @foreach( $ventas as $venta )
                                <tr>
                                  <td class="text-center">{{ $i }}</td>
                                  <td class="text-center">{{ $venta->fecha }}</td>
                                  <td class="text-center">{{ $venta->cajero }}</td>
                                  <td class="text-center">{{ $venta->monto }}</td>
                                  <td class="text-center">{{ $venta->pago}}</td>
                                  <td class="text-center">{{ $venta->pago - $venta->monto }}</td>
                                  <td class="text-center">
                                      <button class="btn btn-xs btn-success"
                                              onclick="mostrarDetalleVenta('{{ json_encode($venta) }}')"
                                              data-toggle="modal" data-target="#myModal">Detalle de Venta
                                      </button>
                                  </td>
                                </tr>
                                <?php $i++; $cnt += (float)$venta->monto; ?>
                            @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>

              <div class="row text-left">
                  <div class="col-md-12 col-xs-12 text-center" style="font-size: 20px; font-weight: bold; padding-top: 40px;">
                    <b>Monto total actual </b> S/ {{ $cnt }}
                  </div>
              </div>

            </div>
        </div>
    </div>
  </div>


  <div class="row"  style="padding-top: 30px;">
    <div class="col-lg-8 col-lg-offset-2 col-md-12 col-xs-12 text-center">
        <div class="panel panel-default">
            <div class="panel-heading text-center title"><b>VENTAS TOTALES</b></div>
            <div class="panel-body" style="padding-top: 45px; padding-bottom: 50px;">

              <div id="table-wrapper">
                  <div id="table-scroll">
                      <table class="table table-responsive table-hover" style="font-size: 16px;">
                          <thead>
                          <tr>
                              <th class="text-center">#</th>
                              <th class="text-center">Fecha</th>
                              <th class="text-center">Cajero</th>
                              <th class="text-center">Monto Venta</th>
                              <th class="text-center">Pago Cliente</th>
                              <th class="text-center">Vuelto</th>
                              <th></th>
                          </tr>
                          </thead>
                          <tbody>
                            <?php $i = 1; $cnt = 0; ?>
                            @foreach( $ventas_user as $venta )
                                <tr>
                                  <td class="text-center">{{ $i }}</td>
                                  <td class="text-center">{{ $venta->fecha }}</td>
                                  <td class="text-center">{{ $venta->cajero }}</td>
                                  <td class="text-center">{{ $venta->monto }}</td>
                                  <td class="text-center">{{ $venta->pago}}</td>
                                  <td class="text-center">{{ $venta->pago - $venta->monto }}</td>
                                  <td class="text-center">
                                      <button class="btn btn-xs btn-success"
                                              onclick="mostrarDetalleVenta('{{ json_encode($venta) }}')"
                                              data-toggle="modal" data-target="#myModal">Detalle de Venta
                                      </button>
                                  </td>
                                </tr>
                                <?php $i++; $cnt += (float)$venta->monto; ?>
                            @endforeach
                          </tbody>
                      </table>
                  </div>
              </div>

              <div class="row text-left">
                  <div class="col-md-12 col-xs-12 text-center" style="font-size: 20px; font-weight: bold; padding-top: 40px;">
                    <b>Monto total actual </b> S/ {{ $cnt }}
                  </div>
              </div>

            </div>
        </div>
    </div>
  </div>

</div>

<div id="detalle-venta-modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header text-center">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Venta Nro <div id="nro-venta" style="display: inline-block;"></div></h4>
      </div>
      <div class="modal-body">
        <div class="row">
            <label for="fecha-txt" class="col-md-2 col-md-offset-2 control-label">Fecha/Hora Venta:</label>
            <div id="fecha-txt" class="col-md-3">17-09-2016</div>

            <label for="cajero-txt" class="col-md-1 control-label">Cajero:</label>
            <div id="cajero-txt" class="col-md-3">Gian Piere Vallejos Bardales</div>
        </div>

        <div class="row">
            <label for="monto-venta-txt" class="col-md-2 col-md-offset-2 control-label">Monto de Venta:</label>
            <div id="monto-venta-txt" class="col-md-2">S/ 0000.00</div>

            <label for="monto-cliente-txt" class="col-md-2 text-right control-label">Pago Cliente:</label>
            <div id="monto-cliente-txt" class="col-md-2">S/ 0000.00</div>

        </div>
        <hr>
        <div class="row">
          <div class="col-md-10 col-md-offset-1">
            <div id="table-wrapper">
              <div id="table-scroll">
                <table id="detalle-venta-table" class="table table-responsive table-hover">
                  <thead>
                    <tr>
                      <th class="text-center">#</th>
                      <th class="text-center col-md-2">Cantidad</th>
                      <th class="text-center">Producto</th>
                      <th class="text-center">Precio</th>
                      <th class="text-center">Total</th>
                    </tr>
                  </thead>
                  <tbody>

                  </tbody>
                  <tfoot>

                  </tfoot>
                </table>
              </div>
            </div>
          </div>
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

@endsection
<!-- <script src="{{ asset('js/app.js') }}"></script> -->
<script src="{{ asset('js/lista-venta.js?v=1.0.1') }}"></script>
