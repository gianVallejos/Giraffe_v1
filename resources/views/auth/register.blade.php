@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading text-center">REGISTRO</div>

                <div class="panel-body">
                    <form class="form-horizontal" method="POST" action="{{ route('register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('name') ? ' has-error' : '' }}">
                            <label for="name" class="col-md-2 col-md-offset-2 col-xs-2 col-xs-offset-2 control-label">Nombres</label>

                            <div class="col-md-6 col-xs-6">
                                <input id="name" type="name" class="form-control" name="name" value="{{ old('name') }}" required>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('name') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-2 col-md-offset-2 col-xs-2 col-xs-offset-2 control-label">E-Mail</label>

                            <div class="col-md-6 col-xs-6">
                                <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-2 col-md-offset-2 col-xs-2 col-xs-offset-2 control-label">Password</label>

                            <div class="col-md-6 col-xs-6">
                                <input id="password" type="password" class="form-control" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-3 col-md-offset-1 col-xs-3 col-xs-offset-1 control-label">Confirmar Password</label>

                            <div class="col-md-6 col-xs-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="rol-user" class="col-md-2 col-md-offset-2 col-xs-2 col-xs-offset-2 control-label">Rol</label>

                            <div class="col-md-6 col-xs-6">
                                <select id="rol_usuario" class="form-control" name="rol_usuario">
                                  <option value="1">Master</option>
                                  <option value="2">Admin</option>
                                  <option value="3" selected>Cajero</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="col-md-12 col-xs-12 text-center">
                                <button type="submit" class="btn btn-warning">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
