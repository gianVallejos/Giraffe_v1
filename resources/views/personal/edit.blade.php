@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12">

                <!-- <div class="alert alert-success text-center">
                    Nuevo paciente agregado correctamente.
                </div> -->

                <div class="panel panel-default">
                    <div class="panel-heading text-center title">MODIFICAR PERSONAL</div>
                    <div class="panel-body">

                        <form class="form-horizontal" action="/Giraffe_v1/public/personals/{{ $personal->id }}" method="POST">
                            <input type="hidden" name="_method" value="PUT">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">


                            <div class="form-group">
                                <label for="nombres" class="col-md-1 col-xs-1 control-label">Nombres</label>
                                <div class="col-md-5 col-xs-5">
                                    <input id="nombres" type="text" class="form-control" name="nombres"
                                           value="{{ $personal->nombres }}" placeholder="Nombres" required autofocus>

                                    @if ($errors->has('nombres'))
                                        <span class="help-block">
                                      <strong>{{ $errors->first('nombres')}}</strong>
                                  </span>
                                    @endif

                                </div>

                                <label for="apellidos" class="col-md-1 col-xs-1 control-label">Apellidos</label>
                                <div class="col-md-5 col-xs-5">
                                    <input id="apellidos" type="text" class="form-control" name="apellidos"
                                           value="{{ $personal->apellidos }}" placeholder="Apellidos" required
                                           autofocus>

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
                                           value="{{ $personal->dni }}" placeholder="DNI" minlength="8" maxlength="8"
                                           required autofocus>

                                    @if ($errors->has('dni'))
                                        <span class="help-block">
                                      <strong>{{ $errors->first('dni')}}</strong>
                                  </span>
                                    @endif

                                </div>

                                <label for="email" class="col-md-1 col-xs-1 control-label">Email</label>
                                <div class="col-md-4 col-xs-3">
                                    <input id="email" type="text" class="form-control" name="email"
                                           value="{{ $personal->email }}" placeholder="E-mail">

                                    @if ($errors->has('email'))
                                        <span class="help-block">
                                      <strong>{{ $errors->first('email')}}</strong>
                                  </span>
                                    @endif

                                </div>

                                <label for="direccion" class="col-md-1 col-xs-2 control-label">Dirección</label>
                                <div class="col-md-3 col-xs-3">
                                    <input id="direccion" type="text" class="form-control" name="direccion"
                                           value="{{ $personal->direccion }}" placeholder="Dirección" required
                                           autofocus>

                                    @if ($errors->has('direccion'))
                                        <span class="help-block">
                                      <strong>{{ $errors->first('direccion')}}</strong>
                                  </span>
                                    @endif

                                </div>

                            </div>

                            <div class="form-group">

                                <label for="genero" class="col-md-1 col-xs-1 control-label">Género</label>
                                <div class="col-md-3 col-xs-2">
                                    <?php
                                    $genero = array('Masculino', 'Femenino');
                                    ?>
                                    <select name="genero" id="genero" class="form-control">
                                        <?php           foreach($genero as $gr){                          ?>
                                        <option value="{{ $gr }}" {{ $personal->genero == $gr ? 'selected="selected"' : '' }} > {{ $gr }}</option>
                                        <?php           }                                                 ?>
                                    </select>

                                </div>

                                <label for="fechanacimiento" class="col-md-1 col-xs-1 control-label">Nacimiento</label>
                                <div class="col-md-2 col-xs-2">
                                    <input id="fechanacimiento" type="date" class="form-control" name="fechanacimiento"
                                           value="{{ $personal->fechanacimiento }}" required autofocus>

                                    @if ($errors->has('fechanacimiento'))
                                        <span class="help-block">
                                    <strong>{{ $errors->first('fechanacimiento')}}</strong>
                                </span>
                                    @endif

                                </div>

                                <label for="celular" class="col-md-1 col-xs-1 control-label">Celular</label>
                                <div class="col-md-2 col-xs-2">
                                    <input id="telefono" type="text" class="form-control" name="telefono"
                                           value="{{ $personal->telefono }}" placeholder="Número de Celular">

                                    @if ($errors->has('telefono'))
                                        <span class="help-block">
                                      <strong>{{ $errors->first('telefono')}}</strong>
                                  </span>
                                    @endif

                                </div>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12 text-center">
                                    <button type="submit" class="btn-giraffe">
                                        <span>Editar</span>
                                    </button>
                                    <a href="{{ route('personalindex') }}">
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
