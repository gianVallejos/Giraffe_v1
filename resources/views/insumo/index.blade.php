@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-6 col-lg-offset-3">
              <div class="alert alert-warning text-center">
                Para continuar gestionando <strong>kardex</strong> haz click <a href="{{ route('kardexindex') }}">aquí</a>.
              </div>
            </div>
            <div class="col-lg-4 col-lg-offset-4 col-md-10 col-md-2 text-center">

                        <div class="panel panel-default">
                            <div class="panel-heading text-center title"><b>AGREGAR INSUMO</b></div>
                            <div class="panel-body" style="padding-top: 25px;">

                                        <form class="form-horizontal" action="/Giraffe_v1/insumos"
                                              method="POST">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                            <div class="form-group">
                                                <label for="nombre"
                                                       class="col-md-2 col-md-offset-1 col-xs-2 col-xs-offset-1 control-label">Nombre</label>
                                                <div class="col-md-8 col-xs-8">
                                                    <input id="nombre" type="text" class="form-control"
                                                           name="nombre"
                                                           value="{{ old('nombre')}}" placeholder="Nombre"
                                                           required
                                                           autofocus>

                                                    @if ($errors->has('nombre'))
                                                        <span class="help-block">
                                      <strong>{{ $errors->first('nombre')}}</strong>
                                  </span>
                                                    @endif

                                                </div>
                                            </div>
                                            <div class="form-group">

                                              <label for="descripcion"
                                              class="col-md-2 col-md-offset-1 col-xs-2 col-xs-offset-1 control-label">Descripción</label>
                                              <div class="col-md-8 col-xs-8">
                                                <input id="descripcion" type="text" class="form-control"
                                                name="descripcion"
                                                value="{{ old('descripcion')}}" placeholder="Descripción"
                                                autofocus>

                                                @if ($errors->has('descripcion'))
                                                <span class="help-block">
                                                  <strong>{{ $errors->first('descripcion')}}</strong>
                                                </span>
                                                @endif

                                              </div>
                                            </div>

                                            <div class="form-group">

                                              <label for="precio" class="col-md-2 col-md-offset-1 col-xs-2 col-xs-offset-1 control-label">Precio Unitario</label>
                                              <div class="col-md-8 col-xs-8">
                                                <input id="precio" type="number" class="form-control"
                                                name="precio"
                                                value="{{ old('precio')}}"
                                                placeholder="Precio"
                                                min="0"
                                                step=".1" required>

                                                @if ($errors->has('precio'))
                                                <span class="help-block">
                                                  <strong>{{ $errors->first('precio')}}</strong>
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
                                            </div>


                                        </form>

                            </div>
                        </div>
                </div>

              <div class="col-lg-8 col-lg-offset-2 col-md-12 col-xs-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center title"><b>INSUMO</b></div>
                    <div class="panel-body">
                        <div id="table-wrapper">
                            <div id="table-scroll" style="height: 30vh;">
                                <table class="table table-responsive table-hover">
                                    <thead>
                                    <tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">Nombre</th>
                                        <th class="text-center">Descripción</th>
                                        <th class="text-center">Stock</th>
                                        <th class="text-center">Precio</th>
                                        <th></th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach( $insumos as $insumo )
                                        <tr>
                                            <th scope="row" class="text-center">{{ $insumo->id }}</th>
                                            <td class="text-center">{{ $insumo->nombre }}</td>
                                            <td class="text-center">{{ $insumo->descripcion }}</td>
                                            <td class="text-center">{{ $insumo->stock }}</td>
                                            <td class="text-center">{{ $insumo->precio }}</td>
                                            <td class="text-center"><a
                                                        href="{{ route('insumos.edit', $insumo->id) }}"
                                                        class="btn btn-xs btn-warning">Editar</a>
                                            </td>

                                            @if(Auth::user()->rol_usuario == 1)
                                                <td class="text-center">
                                                    <form action="{{ route('insumos.destroy', $insumo->id) }}"
                                                          method="post">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token"
                                                               value="{{ csrf_token() }}">
                                                        <button type="submit" class="btn btn-xs btn-danger">Eliminar
                                                        </button>
                                                    </form>
                                                </td>
                                            @endif
                                        </tr>
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
                        <label for="descripcion" class="col-md-2 col-md-offset-1 control-label">Descripción:</label>
                        <div id="descripcion-txt" class="col-md-9"></div>
                    </div>
                    <div class="row">
                        <label for="stock" class="col-md-2 col-md-offset-1 control-label">Stock:</label>
                        <div id="stock-txt" class="col-md-4"></div>
                    </div>
                    <div class="row">
                        <label for="precio" class="col-md-2 col-md-offset-1 control-label">Precio:</label>
                        <div id="precio-txt" class="col-md-9"></div>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>

        </div>
    </div>

@endsection
