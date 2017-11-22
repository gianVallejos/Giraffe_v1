@extends('layouts.app')

@section('content')

    <div class="container">
        <div class="row">
            <div class="col-md-12 text-center">

                <div class="panel panel-default">
                    <div class="panel-heading text-center title">DELALLE DE VENTAS</div>
                    <div class="panel-body">
                        <div id="table-wrapper">
                            <div id="table-scroll" style="height: 30vh;">
                                @foreach($ventasOrdenadas as $venta)
                                    <a tabindex="0" class="btn btn-lg btn-danger" role="button" data-toggle="popover"
                                       data-trigger="focus" title="{{$venta[0]->idVenta}}"
                                       data-content="{{$venta[0]->name}}">Orden: {{$venta[0]->idVenta}}</a>

                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
<!-- <script type="text/javascript">


</script> -->
