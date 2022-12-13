@extends('plantilla.login')

@section('label1')
<div class="row">
    <div class="col-3"></div>
    <div class="col-6">
        <div class="card">
            <div class="card-header text-center">
                <h1>SCC - ADMIN</h1>
            </div>
            <div class="card-body">
                @if(\Session::has('mensaje_error'))
                    <div class="alert alert-danger" role="alert">
                        {{\Session::get('mensaje_error')}}
                    </div>
                @endif
                <form action="{{route('login')}}" method="post">
                    @csrf
                    <div class="mb-3 row">
                        <label for="usuario" class="col-4 form-control-label">Usuario</label>
                        <div class="col-8">
                            <input class="form-control" type="text" name="correo" placeholder="Usuario">
                        </div>
                    </div>

                    <div class="mb-3 row">
                        <label for="password" class="col-4 form-control-label">Password</label>
                        <div class="col-8">
                            <input class="form-control" type="password" name="pass" placeholder="Password">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <hr>
                    </div>
                    <div class="mb-3 row">
                        <button class="btn btn-success botn-block" type="submit">Ingresar</button>
                    </div>
                </form>

            </div>
        </div>
    </div>
    <div class="col-3"></div>
</div>