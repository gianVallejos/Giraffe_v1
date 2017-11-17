@extends('layouts.app')

@section('content')

    <div class="container-fluid">
        <div class="row">
          <div class="col-lg-8 col-lg-offset-2">
            <div class="btn-group btn-group-justified">
              <a href="{{ route('ventaindex') }}" class="btn btn-md btn-default">Nueva Venta</a>              
              <a href="{{ route('clienteindex') }}" class="btn btn-md btn-default">Gestión de Clientes</a>
              <a href="{{ route('cuadrarcajaventa') }}" class="btn btn-md btn-default">Cerrar Caja</a>
            </div>
          </div>
        </div>
        <div class="row" style="padding-top: 30px;">
            <div class="col-lg-8 col-lg-offset-2 text-center">

                            <div class="panel panel-default">
                                <div class="panel-body" style="height: 280px;">
                                    <div id="table-wrapper">
                                        <div class="panel-body">

                                            <form class="form-horizontal" action="/Giraffe_v1/public/clientes"
                                                  method="POST">
                                                <input type="hidden" name="_token" value="{{ csrf_token() }}">

                                                <div class="form-group">
                                                    <label for="nombres"
                                                           class="col-md-1 col-xs-1 control-label">Nombres</label>
                                                    <div class="col-md-5 col-xs-5">
                                                        <input id="nombres" type="text" class="form-control"
                                                               name="nombres"
                                                               value="{{ old('nombres')}}" placeholder="Nombres"
                                                               required
                                                               autofocus>

                                                        @if ($errors->has('nombres'))
                                                            <span class="help-block">
                                      <strong>{{ $errors->first('nombres')}}</strong>
                                  </span>
                                                        @endif

                                                    </div>

                                                    <label for="apellidos"
                                                           class="col-md-1 col-xs-1 control-label">Apellidos</label>
                                                    <div class="col-md-5 col-xs-5">
                                                        <input id="apellidos" type="text" class="form-control"
                                                               name="apellidos"
                                                               value="{{ old('apellidos')}}" placeholder="Apellidos"
                                                               required autofocus>

                                                        @if ($errors->has('apellidos'))
                                                            <span class="help-block">
                                      <strong>{{ $errors->first('apellidos')}}</strong>
                                  </span>
                                                        @endif

                                                    </div>

                                                </div>

                                                <div class="form-group">

                                                    <label for="dni" class="col-md-1 col-xs-1 control-label">DNI</label>
                                                    <div class="col-md-2 col-xs-2">
                                                        <input id="dni" type="text" class="form-control" name="dni"
                                                               value="{{ old('dni')}}"
                                                               placeholder="DNI" minlength="8" maxlength="8" required
                                                               autofocus>

                                                        @if ($errors->has('dni'))
                                                            <span class="help-block">
                                      <strong>{{ $errors->first('dni')}}</strong>
                                  </span>
                                                        @endif

                                                    </div>

                                                    <label for="email"
                                                           class="col-md-1 col-xs-1 control-label">Email</label>
                                                    <div class="col-md-3 col-xs-3">
                                                        <input id="email" type="text" class="form-control" name="email"
                                                               value="{{ old('email')}}" placeholder="E-mail">

                                                        @if ($errors->has('email'))
                                                            <span class="help-block">
                                      <strong>{{ $errors->first('email')}}</strong>
                                  </span>
                                                        @endif

                                                    </div>

                                                    <label for="direccion"
                                                           class="col-md-1 col-xs-2 control-label">Dirección</label>
                                                    <div class="col-md-4 col-xs-3">
                                                        <input id="direccion" type="text" class="form-control"
                                                               name="direccion"
                                                               value="{{ old('direccion')}}" placeholder="Dirección"
                                                               required autofocus>

                                                        @if ($errors->has('direccion'))
                                                            <span class="help-block">
                                      <strong>{{ $errors->first('direccion')}}</strong>
                                  </span>
                                                        @endif

                                                    </div>

                                                </div>

                                                <div class="form-group">
                                                    <label for="fechanacimiento"
                                                           class="col-md-1 col-xs-1 control-label">Nacimiento</label>
                                                    <div class="col-md-2 col-xs-2">
                                                        <input id="fechanacimiento" type="date" class="form-control"
                                                               name="fechanacimiento"
                                                               value="{{ old('fechanacimiento')}}" required autofocus>

                                                        @if ($errors->has('fechanacimiento'))
                                                            <span class="help-block">
                                    <strong>{{ $errors->first('fechanacimiento')}}</strong>
                                </span>
                                                        @endif

                                                    </div>

                                                    <label for="genero"
                                                           class="col-md-1 col-xs-1 control-label">Género</label>
                                                    <div class="col-md-2 col-xs-2">
                                                        <?php
                                                        $genero = array('Masculino', 'Femenino');
                                                        ?>
                                                        <select name="genero" id="genero" class="form-control">
                                                            <?php           foreach($genero as $gr){                          ?>
                                                            <option value="{{ $gr }}"
                                                                    @if(old('genero') == '{{ $gr }}')selected @endif>{{ $gr }}</option>
                                                            <?php           }                                                 ?>
                                                        </select>

                                                    </div>

                                                    <label for="telefono"
                                                           class="col-md-1 col-xs-1 control-label">Teléfono</label>
                                                    <div class="col-md-2 col-xs-2">
                                                        <input id="telefono" type="text" class="form-control"
                                                               name="telefono"
                                                               value="{{ old('telefono')}}" placeholder="Teléfono">

                                                        @if ($errors->has('telefono'))
                                                            <span class="help-block">
                                      <strong>{{ $errors->first('telefono')}}</strong>
                                  </span>
                                                        @endif

                                                    </div>

                                                    <label for="celular"
                                                           class="col-md-1 col-xs-1 control-label">Celular</label>
                                                    <div class="col-md-2 col-xs-2">
                                                        <input id="celular" type="text" class="form-control"
                                                               name="celular"
                                                               value="{{ old('celular')}}"
                                                               placeholder="Número de Celular">

                                                        @if ($errors->has('celular'))
                                                            <span class="help-block">
                                      <strong>{{ $errors->first('celular')}}</strong>
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
                    <hr>

                @if( $cantClientes != 0 )
                    <div class="panel panel-default">
                        <div class="panel-heading text-center title">CLIENTE</div>
                        <div class="panel-body">
                            <div id="table-wrapper">
                                <div id="table-scroll" style="height: 30vh;">
                                    <table class="table table-responsive table-hover">
                                        <thead>
                                        <tr>
                                            <th class="text-center">#</th>
                                            <th class="text-center">Nombres</th>
                                            <th class="text-center">Apellidos</th>
                                            <th class="text-center">DNI</th>
                                            <th class="text-center">Celular</th>
                                            <th class="text-center">E-mail</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0; ?>
                                        @foreach( $clientes as $cliente )
                                            <tr>
                                                <th scope="row" class="text-center">{{ $i + 1 }}</th>
                                                <td class="text-center">{{ $cliente->nombres }}</td>
                                                <td class="text-center">{{ $cliente->apellidos }}</td>
                                                <td class="text-center">{{ $cliente->dni }}</td>
                                                <td class="text-center">{{ $cliente->celular }}</td>
                                                <td class="text-center">{{$cliente->email}}</td>
                                                <td class="text-center">
                                                    <button class="btn btn-xs btn-success"
                                                            onclick="mostrarDetalleCliente('{{ json_encode($cliente) }}')"
                                                            data-toggle="modal" data-target="#myModal">Detalle
                                                    </button>
                                                </td>
                                                <td class="text-center"><a
                                                            href="{{ route('clientes.edit', $cliente->id) }}"
                                                            class="btn btn-xs btn-warning">Editar</a>
                                                </td>

                                                @if(Auth::user()->rol_usuario != 3)
                                                    <td class="text-center">
                                                        <form action="{{ route('clientes.destroy', $cliente->id) }}"
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
                            <div id="nombres-txt"></div>
                        </strong>
                    </h4>
                </div>
                <div class="modal-body">

                    <div class="row">
                        <label for="dni" class="col-md-2 col-md-offset-1 control-label">DNI:</label>
                        <div id="dni-txt" class="col-md-9"></div>
                    </div>
                    <div class="row">
                        <label for="mail" class="col-md-2 col-md-offset-1 control-label">E-mail:</label>
                        <div id="email-txt" class="col-md-9"></div>
                    </div>

                    <div class="row">
                        <label for="direccion" class="col-md-2 col-md-offset-1 control-label">Dirección:</label>
                        <div id="direccion-txt" class="col-md-9"></div>
                    </div>

                    <div class="row">
                        <label for="fechanacimiento"
                               class="col-md-2 col-md-offset-1 control-label">Nacimiento:</label>
                        <div id="fechanacimiento-txt" class="col-md-9"></div>
                    </div>

                    <div class="row">
                        <label for="genero" class="col-md-2 col-md-offset-1 control-label">Género:</label>
                        <div id="genero-txt" class="col-md-9"></div>
                    </div>

                    <div class="row">
                        <label for="telefono" class="col-md-2 col-md-offset-1 control-label">Teléfono:</label>
                        <div id="telefono-txt" class="col-md-9"></div>
                    </div>

                    <div class="row">
                        <label for="celular" class="col-md-2 col-md-offset-1 control-label">Celular:</label>
                        <div id="celular-txt" class="col-md-9"></div>
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
