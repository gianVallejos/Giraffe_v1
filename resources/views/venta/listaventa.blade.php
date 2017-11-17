@extends('layouts.app')

@section('content')

<div class="container-fluid">
  <div class="row">
    <div class="col-lg-8 col-lg-offset-2">
      <div class="btn-group btn-group-justified">
        <a href="{{ route('ventaindex') }}" class="btn btn-md btn-default">Nueva Venta</a>
        <!-- <a href="{{ route('listaventaindex') }}" class="btn btn-md btn-default">Lista de Ventas</a> -->
        <a href="{{ route('clienteindex') }}" class="btn btn-md btn-default">Gestión de Clientes</a>
        <a href="{{ route('cuadrarcajaventa') }}" class="btn btn-md btn-default">Cerrar Caja</a>
      </div>
    </div>
  </div>
  <div class="row"  style="padding-top: 30px;">
    <div class="col-lg-8 col-lg-offset-2 col-md-12 col-xs-12 text-center">
        <div class="panel panel-default">
            <div class="panel-heading text-center title"><b>LISTAS DE VENTA (CAJA ABIERTA)</b></div>
            <div class="panel-body" style="padding-top: 45px; padding-bottom: 50px;">
              <h1>EN MANTENIMIENTO</h1>
              <!-- <div id="table-wrapper">
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

                          </tbody>
                      </table>
                  </div>
              </div> -->

            </div>
        </div>
    </div>
  </div>
</div>

@endsection
