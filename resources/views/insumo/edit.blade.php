@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">

            <div class="panel panel-default">
                <div class="panel-heading text-center title">MODIFICAR INSUMO</div>
                <div class="panel-body">

                    <form class="form-horizontal" action="/Giraffe_v1/public/insumos/{{ $insumo->id }}"
                          method="POST">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label for="nombre" class="col-md-1 col-xs-1 control-label">Nombre</label>
                            <div class="col-md-5 col-xs-5">
                                <input id="nombre" type="text" class="form-control" name="nombre"
                                       value="{{ $insumo->nombre }}" placeholder="Nombre" required autofocus>

                                @if ($errors->has('nombre'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('nombre')}}</strong>
                                  </span>
                                @endif

                            </div>

                            <label for="descripcion" class="col-md-1 col-xs-1 control-label">Descripción</label>
                            <div class="col-md-5 col-xs-5">
                                <input id="descripcion" type="text" class="form-control" name="descripcion"
                                       value="{{ $insumo->descripcion }}" placeholder="Descripcion" autofocus>

                                @if ($errors->has('descripcion'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('descripcion')}}</strong>
                                  </span>
                                @endif

                            </div>

                        </div>

                        <div class="form-group">

                            <label for="precio"
                                   class="col-md-1 col-xs-1 control-label">Precio
                                Unitario</label>
                            <div class="col-md-3 col-xs-3">
                                <input id="precio" type="number" class="form-control"
                                       name="precio"
                                       value="{{ $insumo->precio}}"
                                       placeholder="Precio"
                                       min="0"
                                       step=".1" autofocus>

                                @if ($errors->has('precio'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('precio')}}</strong>
                                  </span>
                                @endif
                            </div>

                            <label for="stock" class="col-md-1 col-xs-1 control-label">Stock</label>
                            <div class="col-md-2 col-xs-2">
                                <input id="stock" type="text" class="form-control" name="stock"
                                       value="{{ $insumo->stock }}" placeholder="Stock" minlength="8" maxlength="8"
                                       autofocus disabled="disabled">

                                @if ($errors->has('stock'))
                                    <span class="help-block">
                                      <strong>{{ $errors->first('stock')}}</strong>
                                  </span>
                                @endif

                            </div>

                        </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn-giraffe">
                                    <span>Editar</span>
                                </button>
                                <a href="{{ route('insumoindex') }}">
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

@endsection
