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

                    <form class="form-horizontal" action="{{ route('productoindex') }}" method="POST">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">

                        <div class="form-group">
                            <label for="nombre" class="col-md-2 col-md-offset-1 col-xs-2 col-xs-offset-1 control-label">Nombres</label>
                            <div class="col-md-8 col-xs-8">
                                <input id="nombre" type="text" class="form-control" name="nombre" value="{{ old('nombre')}}" placeholder="Nombres" required autofocus>

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
                                <input id="descripcion" type="text" class="form-control" name="descripcion" value="{{ old('descripcion')}}" placeholder="Descripción" autofocus>

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
                                <input id="precio" type="number" class="form-control" name="precio" value="{{ old('precio')}}" placeholder="Precio" min="0" step=".1" required autofocus>

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
                                    <span>Agregar</span>
                                </button>
                                <button type="reset" class="btn-giraffe">
                                    <span>Limpiar</span>
                                </button>
                            </div>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@if( $numProductos != 0 )
<div class="container">
    <div class="row">
        <div class="col-md-10 col-xs-10 col-md-offset-1 col-xs-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading text-center title"><b>PRODUCTOS</b></div>
                <div class="panel-body" style="padding-bottom: 13px;">

                  <div class="row">
                      <div class="col-md-1 col-xs-1 col-md-offset-1" style="margin-top: 5px;">
                        <b>Buscar:</b>
                      </div>
                      <div class="col-md-9 col-xs-9">
                        <input type="text" class="form-control" id="myInput2" onkeyup="buscarClte()" placeholder=" Buscar por Nombre de Producto">
                      </div>
                  </div>

                  <div id="table-wrapper">
                      <div id="table-scroll" style="max-height: 50vh; margin-top: 19px; padding-left: 13px; padding-right: 13px;">
                        <table id="tablaClte" class="table table-responsive table-hover">
                            <thead>
                                <tr>
                                    <th class="text-center">#</th>
                                    <th class="text-center">Producto</th>
                                    <th class="text-center">Descripción</th>
                                    <th class="col-md-2 text-center">Precio</th>
                                    <th class="col-md-1 text-center"></th>
                                    <th class="col-md-1 text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 0; ?>
                                @foreach( $data as $row )
                                  <tr>
                                    <td scope="row" class="text-center">{{ $row->id }}</td>
                                    <td class="text-center">{{ $row->nombre }}</td>
                                    <td class="text-center">{{ $row->descripcion }}</td>
                                    <td class="text-center">{{ $row->precio }}</td>
                                    <td class="text-center"><a href="{{ route('productos.edit', $row->id) }}" class="btn btn-xs btn-warning">Editar</a></td>
                                    <td class="text-center">
                                      <form action="{{ route('productos.destroy', $row->id) }}" method="post">
                                          <input type="hidden" name="_method" value="DELETE">
                                          <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                          <button type="submit" class="btn btn-xs btn-danger">Eliminar</button>
                                      </form>
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
@endif

@endsection
