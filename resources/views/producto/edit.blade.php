@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">

        <div class="col-md-6 col-md-offset-3">

          <!-- <div class="alert alert-success text-center">
              Nuevo paciente agregado correctamente.
          </div> -->

            <div class="panel panel-default">
                <div class="panel-heading text-center title"><b>AGREGAR PRODUCTO</b></div>
                <div class="panel-body" style="padding-top: 29px;">

                    <form class="form-horizontal" action="/giraffe/public/productos/{{ $producto->id }}" method="POST">
                        <input type="hidden" name="_method" value="PUT">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label for="nombre" class="col-md-2 col-md-offset-1 col-xs-2 col-xs-offset-1 control-label">Nombres</label>
                            <div class="col-md-8 col-xs-8">
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ $producto->nombre }}" placeholder="Nombres" required autofocus>

                                @if ($errors->has('nombre'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('nombre')}}</strong>
                                  </span>
                                @endif

                            </div>
                        </div>

                        <div class="form-group">
                            <label for="descripcion" class="col-md-2 col-md-offset-1 col-xs-2 col-xs-offset-1 control-label">Descripción</label>
                            <div class="col-md-8 col-xs-8">
                                <input id="descripcion" type="text" class="form-control" name="descripcion" value="{{ $producto->descripcion }}" placeholder="Descripción" autofocus>

                                @if ($errors->has('descripcion'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('descripcion')}}</strong>
                                  </span>
                                @endif

                            </div>
                      </div>

                      <div class="form-group">
                            <label for="precio" class="col-md-2 col-md-offset-1 col-xs-2 col-xs-offset-1 control-label">Precio</label>
                            <div class="col-md-8 col-xs-8">
                                <input id="precio" type="number" class="form-control" name="precio" value="{{ $producto->precio }}" placeholder="Precio" min="0" step=".1" required autofocus>

                                @if ($errors->has('precio'))
                                  <span class="help-block">
                                      <strong>{{ $errors->first('precio')}}</strong>
                                  </span>
                                @endif

                            </div>

                      </div>

                        <div class="form-group">
                            <div class="col-md-12 text-center">
                                <button type="submit" class="btn-giraffe">
                                    <span>Editar</span>
                                </button>
                                <a href="{{ route('productoindex') }}">
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
