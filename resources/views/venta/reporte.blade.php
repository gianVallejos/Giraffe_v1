@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">

                <div class="panel panel-default">
                    <div class="panel-heading text-center title">DELALLE DE VENTAS</div>
                    <div class="panel-body">

                        <div class="row" style="margin-top: 12px; margin-bottom: 14px;">
                            <div class="col-md-12">
                                <p>BUSCAR:</p>
                            </div>
                            <form id="form-buscarVentas" class="form-horizontal">
                                <div class="col-md-12">
                                    <div class="form-group form-horizontal">
                                        <div class="col-md-1 col-md-offset-1 col-xs-1 control-label">
                                            <label for="fechainicial">Inicial</label></div>
                                        <div class="col-md-2 col-xs-2">
                                            <input id="fechainicial" type="date" class="form-control"
                                                   name="fechainicial"
                                                   value="{{ old('fechainicial')}}"
                                                   autofocus>

                                            @if ($errors->has('fechainicial'))
                                                <span class="help-block">
                                    <strong>{{ $errors->first('fechainicial')}}</strong>
                                </span>
                                            @endif
                                        </div>

                                        <div class="col-md-1 col-xs-1 control-label">
                                            <label for="fechafinal">Final</label></div>
                                        <div class="col-md-2 col-xs-2">
                                            <input id="fechafinal" type="date" class="form-control"
                                                   name="fechafinal"
                                                   value="{{ old('fechafinal')}}"
                                                   autofocus>

                                            @if ($errors->has('fechafinal'))
                                                <span class="help-block">
                                    <strong>{{ $errors->first('fechafinal')}}</strong>
                                </span>
                                            @endif
                                        </div>

                                        <div class="col-md-1 col-xs-1 control-label">
                                            <label for="personal">Personal</label>
                                        </div>
                                        <div class="col-md-2 col-xs-2">
                                            <select name="personal" id="personalId" class="form-control">
                                                <option value="-1">Todos los Empleados</option>
                                                <?php foreach($personals as $personal){                          ?>
                                                <option value="{{ $personal->id }}"
                                                        @if(old('personal') == '{{ personal }}')selected @endif>{{ $personal->name }}</option>
                                                <?php           }                                                 ?>
                                            </select>
                                        </div>

                                        <div class="col-md-1 col-xs-4">
                                            <button type="submit" name="button"
                                                    class="btn-giraffe">
                                                Buscar
                                            </button>
                                        </div>

                                    </div>
                                </div>
                            </form>
                        </div>

                        <div id="table-wrapper">
                            <div id="table-scroll" style="height: 100vh;">

                                <table class="table table-responsive table-hover" id="tablaVentas">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Fecha</th>
                                        <th class="text-center">Cajero</th>
                                        <th class="text-center">Monto</th>
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
                                            <td class="text-center">
                                                <button id="btnDetalleVenta" class="btn btn-xs btn-success"
                                                        onclick="mostrarDetalleVentaList('{{ $venta->id }}')"
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

                        <button id="btn-print-reporte" type="button" class="btn-giraffe" name="button" data-toggle="tooltip" title="Teclado: Control+i">
                            IMPRIMIR
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div id="myModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header text-center">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Venta Nro
                        <div id="nro-venta" style="display: inline-block;"></div>
                    </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <label for="fecha-txt" class="col-md-2 col-md-offset-2 control-label">Fecha/Hora Venta:</label>
                        <div id="fecha-txt" class="col-md-3">17-09-2016</div>

                        <label for="cajero-txt" class="col-md-1 control-label">Cajero:</label>
                        <div id="cajero-txt" class="col-md-3">Gian Piere Vallejos Bardales</div>
                    </div>

                    <div class="row">
                        <label for="monto-venta-txt" class="col-md-2 col-md-offset-2 control-label">Monto de
                            Venta:</label>
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
