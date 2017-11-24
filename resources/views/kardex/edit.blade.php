@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <div class="panel panel-default">
                    <div class="panel-heading text-center title"><b>MODIFICAR KARDEX</b></div>
                    <div class="panel-body">

                        <form class="form-horizontal" action="/Giraffe_v1/kardexs/{{ $kardex->id }}"
                              method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                            <div class="form-group">
                                <label for="concepto"
                                       class="col-md-1 col-md-offset-1 col-xs-1 col-xs-offset-1 control-label">Concepto</label>
                                <div class="col-md-4 col-xs-4">
                                    <?php
                                    $conceptos = array('Entrada', 'Salida');
                                    ?>
                                    <select name="concepto" id="concepto" class="form-control" disabled>
                                        <?php           foreach($conceptos as $concepto){                          ?>
                                        <option value="{{ $concepto }}" {{$kardex->concepto == $concepto ? 'selected="selected"': ''}}>{{ $concepto }}</option>
                                        <?php           }                                                 ?>
                                    </select>
                                </div>

                                <label for="id"
                                       class="col-md-1 col-xs-1 control-label">Insumo</label>
                                <div class="col-md-4 col-xs-4">

                                    <select name="id" id="id" class="form-control" disabled>
                                        @foreach($insumos as $insumo)
                                            <option value="{{ $insumo->id }}"
                                                    {{$kardex->idInsumo == $insumo->id ? 'selected="selected"':''}}>{{ $insumo->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>

                            <div class="form-group">

                                <label for="factura"
                                       class="col-md-2 col-md-offset-1 col-xs-2 col-xs-offset-1 control-label">N° de Factura</label>
                                <div class="col-md-2 col-xs-2">
                                    <input id="factura" type="text" class="form-control"
                                           name="factura"
                                           value="{{ $kardex->factura}}" placeholder="Factura" min="0"
                                           step="1" autofocus>

                                    @if ($errors->has('factura'))
                                        <span class="help-block">
                                      <strong>{{ $errors->first('factura')}}</strong>
                                  </span>
                                    @endif

                                </div>

                                <label for="cantidad"
                                       class="col-md-1 col-xs-1 control-label">Cantidad</label>
                                <div class="col-md-2 col-xs-2">
                                    <input id="cantidad" type="number" class="form-control"
                                           name="cantidad"
                                           value="{{ $kardex->cantidad}}" placeholder="Cantidad"
                                           min="0"
                                           step="1" required
                                           autofocus>

                                    @if ($errors->has('cantidad'))
                                        <span class="help-block">
                                      <strong>{{ $errors->first('cantidad')}}</strong>
                                  </span>
                                    @endif
                                </div>

                                <label for="preciounitario"
                                       class="col-md-1 col-xs-1 control-label">Precio
                                    Unitario</label>
                                <div class="col-md-2 col-xs-2">
                                    <input id="preciounitario" type="number" class="form-control"
                                           name="preciounitario"
                                           value="{{ $kardex->preciounitario }}"
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
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn-giraffe">
                                        <span>Editar</span>
                                    </button>
                                    <a href="{{ route('kardexindex') }}">
                                        <button type="button" class="btn-giraffe">
                                            <span>Atrás</span>
                                        </button>
                                    </a>
                                </div>
                            </div>

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
