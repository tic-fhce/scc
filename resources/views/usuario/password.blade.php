@extends('plantilla.escritorio')

@section('label1')
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-2"></div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Cambiar Contraseña</h5>
                </div>
                <div class="card-body">    
                    @if(\Session::has('mensaje'))
                        <div class="alert alert-success" role="alert">
                            {{\Session::get('mensaje')}}
                            <a href="{{route('exit')}}" class="btn btn-primary botn-block">
                                OK
                            </a>
                        </div>
                    @endif
                    @if(\Session::has('mensaje_error'))
                        <div class="alert alert-danger" role="alert">
                            {{\Session::get('mensaje_error')}}
                        </div>
                    @endif
                    <form action="{{route('updatePass')}}" method="post">
                        @method('PUT')
                        @csrf 
                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Contraseña Actula</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control"  name="pass" required="true">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Nueva Contraseña</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control"  name="pass1" required="true">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <label class="col-sm-4 col-form-label">Repita Contraseña</label>
                            <div class="col-sm-8">
                                <input type="password" class="form-control"  name="pass2" required="true">
                            </div>
                        </div>

                        <div class="mb-3 row">
                            <input type="submit" class="btn btn-success botn-block" value="Actualizar">
                        </div>
                    </form>
                </div>
            </div>
        </div><!--Cambio de Contraseña-->
        <div class="col-md-2"></div>

    </div>
</div>

    
@endsection