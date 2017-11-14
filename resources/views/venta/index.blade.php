@extends('layouts.app')

@section('content')

    @if (Auth::guest())
        <div class="text-center" style="min-height: 50vh; padding-top: 10vh;">
          <h2><strong>Bienvenido a Giraffe</strong></h2>
          <span>para acceder al sistema puedes iniciar sesión <a href="{{ route('login') }}">aquí</a></span>
        </div>
    @else
        <div class="container">
          <button type="button" class="btn btn-success" data-toggle="modal" data-target="#fsModal">Success</button>
          <button type="button" name="button" class="btn-giraffe-home">Ventas</button>
          <button type="button" name="button" class="btn-giraffe-home">Personal</button>
          <button type="button" name="button" class="btn-giraffe-home">Productos</button>
          <button type="button" name="button" class="btn-giraffe-home">Clientes</button>
        </div>

      <!-- modal -->
      <div id="fsModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <div class="container-fluid">
                  <div class="row">
                    <div class="col-md-6 col-xs-6">
                      <h4 class="modal-title" id="myModalLabel">Giraffe: Sales Point</h4>
                    </div>
                    <div class="col-md-6 col-xs-6">
                      <button type="button" class="close" data-toggle="tooltip" title="Cerrar ventana" data-dismiss="modal" style="color: #000;" aria-label="Close">&times;</button>
                    </div>
                  </div>
                </div>
              </div>
              <div class="modal-body">
                  <iframe id="ventas-frame" src="http://localhost/Giraffe_v1/public/venta/cajas" name="frame-content" frameborder="0" width="100%" height="100%"></iframe>
              </div>
              <div class="modal-footer">
                  <div class="container-fluid">
                      <div class="row">
                        <div class="col-md-6 col-xs-6 text-left" style="padding-top: 7px;">
                            Usuario:
                        </div>
                        <div class="col-md-6 col-xs-6">
                          <button type="button" class="btn-giraffe"  data-toggle="tooltip" title="Cuadrar Caja"><span>Cuadrar Caja</span></button>
                          <button type="button" class="btn btn-default" data-dismiss="modal"  data-toggle="tooltip" title="Cerrar ventana">Cerrar</button>
                        </div>
                      </div>
                  </div>
              </div>
            </div>
        </div>
      </div>
      <!-- modal -->

    @endif

@endsection
