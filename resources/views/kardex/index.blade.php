@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3 col-md-12 col-xs-12 text-center">

              <div class="alert alert-warning text-center">
                Para gestionar <strong>insumos</strong> del kardex puedes hacer click <a href="{{ route('insumoindex') }}">aquí</a>.
              </div>

                        <div class="panel panel-default">
                            <div class="panel-heading text-center title"><b>AGREGAR NUEVO KARDEX</b></div>
                            <div class="panel-body">

                                    <div class="panel-body">

                                        <form class="form-horizontal" action="/Giraffe_v1/kardexs"
                                              method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                            <div class="form-group">

                                                <label for="concepto" class="col-md-1 col-md-offset-1 col-xs-1 col-xs-offset-1 control-label">Concepto</label>
                                                <div class="col-md-3 col-xs-3">
                                                    <?php
                                                    $conceptos = array('Entrada', 'Salida');
                                                    ?>
                                                    <select name="concepto" id="concepto" class="form-control">
                                                        <?php
                                                              foreach($conceptos as $concepto){                          ?>
                                                        <option value="{{ $concepto }}" @if(old('concepto') == '{{ $concepto }}')selected @endif>{{ $concepto }}</option>
                                               <?php          }                                                 ?>
                                                    </select>
                                                </div>

                                                <label for="id" class="col-md-1 col-xs-1 control-label">Insumo</label>
                                                <div class="col-md-3 col-xs-3">

                                                    <select name="id" id="id" class="form-control">
                                                        @foreach($insumos as $insumo)
                                                            <option value="{{ $insumo->id }}"
                                                                    @if(old('id') == '{{ $insumo->nombre }}')selected @endif>{{ $insumo->nombre }}</option>
                                                        @endforeach
                                                    </select>

                                                </div>
                                                <div class="col-md-1 col-xs-1">
                                                  <a href="{{route('insumoindex')}}"
                                                     class="btn btn-success btn-md" role="button"
                                                     aria-pressed="true">
                                                      Agregar Insumo</a>
                                                </div>

                                            </div>

                                            <div class="form-group">
                                              <label for="factura" class="col-md-1 col-md-offset-1 col-xs-1 col-xs-offset-1 control-label">N° de Factura</label>
                                              <div class="col-md-3 col-xs-3">
                                                  <input id="factura" type="text" class="form-control"
                                                         name="factura"
                                                         value="{{ old('factura')}}" placeholder="Factura" min="0"
                                                         step="1" autofocus>

                                                  @if ($errors->has('factura'))
                                                      <span class="help-block"><strong>{{ $errors->first('factura')}}</strong></span>
                                                  @endif

                                              </div>


                                                <label for="cantidad" class="col-md-1 col-xs-1 control-label">Cantidad</label>
                                                <div class="col-md-2 col-xs-2">
                                                    <input id="cantidad" type="number" class="form-control" name="cantidad"
                                                           value="{{ old('cantidad')}}" placeholder="Cantidad"
                                                           min="0"
                                                           step="1" required
                                                           autofocus>

                                                    @if ($errors->has('cantidad'))
                                                        <span class="help-block"><strong>{{ $errors->first('cantidad')}}</strong></span>
                                                    @endif
                                                </div>

                                                <label for="preciounitario"
                                                       class="col-md-1 col-xs-1 control-label">Precio
                                                    Unitario</label>
                                                <div class="col-md-2 col-xs-2">
                                                    <input id="preciounitario" type="number" class="form-control"
                                                           name="preciounitario"
                                                           value="{{ old('preciounitario')}}"
                                                           placeholder="Precio Unitario"
                                                           min="0"
                                                           step=".1" required
                                                           autofocus>

                                                    @if ($errors->has('preciounitario'))
                                                        <span class="help-block">
                                      <strong>{{ $errors->first('preciounitario')}}</strong>
                                  </span>
                                                    @endif

                                                </div>

                                            </div>

                                            <div class="form-group">
                                                <div class="col-md-12 text-center" style="padding-top: 25px;">
                                                    <button type="submit" class="btn-giraffe">
                                                        Agregar
                                                    </button>
                                                    <button type="reset" class="btn-giraffe">
                                                        Limpiar
                                                    </button>
                                                </div>
                                            </div>

                                        </form>
                                    </div>

                            </div>
                        </div>

                </div>
                <div class="col-lg-10 col-lg-offset-1 col-md-12 col-xs-12 text-center">

                @if( $cantKardexs != 0 )
                    <div class="panel panel-default">
                        <div class="panel-heading text-center title"><b>LISTADO KARDEX</b></div>
                        <div class="panel-body">
                            <div id="table-wrapper">
                                <div id="table-scroll" style="max-height: 100vh;">
                                    <table class="table table-responsive table-hover table-bordered">
                                        <thead class="thead-dark">
                                        <tr>
                                            <th class="text-center" rowspan="2">#</th>
                                            <th class="text-center" rowspan="2">FECHA</th>
                                            <th class="text-center" rowspan="2">INSUMO</th>
                                            <th class="text-center" colspan="2">DETALLE</th>
                                            <th class="text-center" colspan="3">ENTRADAS</th>
                                            <th class="text-center" colspan="3">SALIDAS</th>
                                            <th class="text-center" colspan="1">EXISTENCIAS</th>

                                        </tr>

                                        <tr>
                                            <th class="text-center">Concepto</th>
                                            <th class="text-center">Factura</th>
                                            <th class="text-center">Cantidad</th>
                                            <th class="text-center">Precio Unitario</th>
                                            <th class="text-center">Precio Total</th>
                                            <th class="text-center">Cantidad</th>
                                            <th class="text-center">Precio Unitario</th>
                                            <th class="text-center">Precio Total</th>
                                            <th class="text-center">Cantidad</th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0; ?>

                                        @foreach( $kardexs as $kardex )
                                            <tr>
                                                <td scope="row" class="text-center">{{ $i+1 }}</td>
                                                <td class="text-center">{{ $kardex->fecha }}</td>
                                                <td class="text-center">{{ $kardex->insumo_nombre }}</td>
                                                <td class="text-center">{{ $kardex->concepto }}</td>
                                                <td class="text-center">{{ $kardex->factura }}</td>
                                                @if($kardex->concepto == 'Entrada')
                                                    <td class="text-center">{{$kardex->cantidad}}</td>
                                                    <td class="text-center">{{$kardex->preciounitario}}</td>
                                                    <td class="text-center">{{$kardex->cantidad * $kardex->preciounitario}}</td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                @else
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center"></td>
                                                    <td class="text-center">{{$kardex->cantidad}}</td>
                                                    <td class="text-center">{{$kardex->preciounitario}}</td>
                                                    <td class="text-center">{{$kardex->cantidad * $kardex->preciounitario}}</td>
                                                @endif
                                                <td class="text-center">{{$kardex->cantidadexistencia}}</td>

                                                <td class="text-center"><a
                                                            href="{{ route('kardexs.edit', $kardex->id) }}"
                                                            class="btn btn-xs btn-warning">Editar</a>
                                                </td>

                                            </tr>
                                            <?php $i++; ?>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                    </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" role="dialog">
        <div class="modal-dialog">

            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title text-center">
                        <strong>
                            <div id="nombre-txt"></div>
                        </strong>
                    </h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <label for="concepto" class="col-md-2 col-md-offset-1 control-label">Concepto:</label>
                        <div id="concepto-txt" class="col-md-9"></div>
                    </div>
                    <div class="row">
                        <label for="fecha" class="col-md-2 col-md-offset-1 control-label">Fecha:</label>
                        <div id="fecha-txt" class="col-md-9"></div>
                    </div>

                    <div class="row">
                        <label for="factura" class="col-md-2 col-md-offset-1 control-label">Factura:</label>
                        <div id="factura-txt" class="col-md-9"></div>
                    </div>

                    <div class="row">
                        <label for="cantidad"
                               class="col-md-2 col-md-offset-1 control-label">Cantidad:</label>
                        <div id="cantidad-txt" class="col-md-9"></div>
                    </div>

                    <div class="row">
                        <label for="preciounitario" class="col-md-2 col-md-offset-1 control-label">Precio
                            Unitario:</label>
                        <div id="preciounitario-txt" class="col-md-9"></div>
                    </div>

                    <div class="row">
                        <label for="cantidadexistencia" class="col-md-2 col-md-offset-1 control-label">Cantidad
                            Existencia:</label>
                        <div id="cantidadexistencia-txt" class="col-md-9"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>
    @endif

@endsection
