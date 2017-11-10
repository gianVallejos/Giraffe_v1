@extends('layouts.app')

@section('content')

    @if( $cantPersonals != 0 )
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel panel-default">
                        <div class="panel-heading text-center title">PERSONAL</div>
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
                                            <th class="text-center">E-mail</th>
                                            <th></th>
                                            <th></th>
                                            <th></th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php $i = 0; ?>
                                        @foreach( $personals as $personal )
                                            <tr>
                                                <th scope="row" class="text-center">{{ $personal->id }}</th>
                                                <td class="text-center">{{ $personal->nombres }}</td>
                                                <td class="text-center">{{ $personal->apellidos }}</td>
                                                <td class="text-center">{{ $personal->dni }}</td>
                                                <td class="text-center"></td>
                                                <td class="text-center">
                                                    <button class="btn btn-xs btn-success"
                                                            onclick="mostrarDetallePersonal('{{ json_encode($personal) }}')"
                                                            data-toggle="modal" data-target="#myModal">Detalle
                                                    </button>
                                                </td>
                                                <td class="text-center"><a
                                                            href="{{ route('personals.edit', $personal->id) }}"
                                                            class="btn btn-xs btn-warning">Editar</a></td>
                                                <td class="text-center">
                                                    <form action="{{ route('personals.destroy', $personal->id) }}"
                                                          method="post">
                                                        <input type="hidden" name="_method" value="DELETE">
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                                        <button type="submit" class="btn btn-xs btn-danger">Eliminar
                                                        </button>
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
                            <div id="dni-txt" class="col-md-4"></div>
                        </div>
                        <div class="row">
                            <label for="mail" class="col-md-2 col-md-offset-1 control-label">E-mail:</label>
                            <div id="email-txt" class="col-md-4"></div>
                        </div>

                        <div class="row">
                            <label for="fechanacimiento"
                                   class="col-md-2 col-md-offset-1 control-label">Nacimiento:</label>
                            <div id="fechanacimiento-txt" class="col-md-3"></div>
                        </div>

                        <div class="row">
                            <label for="telefono" class="col-md-2 col-md-offset-1 control-label">Celular:</label>
                            <div id="telefono-txt" class="col-md-2"></div>
                        </div>

                        <div class="row">
                            <label for="genero" class="col-md-2 col-md-offset-1 control-label">Género:</label>
                            <div id="genero-txt" class="col-md-2"></div>
                        </div>

                        <div class="row">
                            <label for="direccion" class="col-md-2 col-md-offset-1 control-label">Dirección:</label>
                            <div id="direccion-txt" class="col-md-4"></div>
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