@extends('plantilla.escritorio')

@section('label1')
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Perfil de Usuario</h5>
                </div>
                <div class="card-body">    
                    <h1>ID : {{$persona->id}}</h1>
                    @if(\Session::has('mensaje'))
                        <div class="alert alert-success" role="alert">
                            {{\Session::get('mensaje')}}
                            <a href="{{route('exit')}}" class="btn btn-primary botn-block">
                                OK
                            </a>
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-4 alert alert-success">Datos Personales :</div><div class="col-md-8">{{$persona->nombre}} {{$persona->paterno}} {{$persona->materno}} <br> {{$persona->ci}}</div>
                        <div class="col-md-4 alert alert-success">Contacto :</div><div class="col-md-8">Celular: {{$persona->celular}}<br>Correo : {{$persona->correo}}</div>
                        <div class="col-md-4 alert alert-success">Unidad :</div><div class="col-md-8">{{$unidad->unidad}}</div>
                        <hr>
                    </div>
                    <button type="button" class="btn btn-warning botn-block" data-bs-toggle="modal" data-bs-target="#actualizarDatos">
                        Actualizar Datos
                    </button>
                </div>
            </div>
        </div><!--Datos personales del usuario-->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Datos de Marcado</h5>
                </div> 

                <div class="card-body">
                    <div class="row">
                        <div class="col-md-4 alert alert-success">Horario :</div>
                        <div class="col-md-8">
                            {{$horario->tipo}}<br>{{$horario->ingreso}} - {{$horario->salida}}
                            <br>{{$horario->ingreso2}} - {{$horario->salida2}}
                        </div>
                        
                        <hr>
                    </div>
                    @foreach($datos as $value)
                    <div class="row">
                        <div class="col-md-4">User Id :</div><div class="col-md-8">{{$value->user_id}}</div>
                        <div class="col-md-4">Estado :</div><div class="col-md-8">@if($value->estado==1) <span class="badge bg-success">Activo</span>@else <span class="badge bg-retirado">Retirado</span>@endif</div>
                        <div class="col-md-4">Marcado :</div><div class="col-md-8"> {{$value->lugar}}</div>
                        <hr>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>

<!--Modales-->
<!--Modal Persona-->

<div class="modal fade" id="actualizarDatos" tabindex="-1" aria-labelledby="actualizar datos personales" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Actualizar Datos Personales</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('updateDatos')}}" method="post">
            @method('PUT')
            @csrf 
            <input type="hidden" name="id" value="{{$persona->id}}">
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-4 col-form-label">Nombre</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control"  name="nombre" value="{{$persona->nombre}}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-4 col-form-label">A. Paterno</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control"  name="paterno" value="{{$persona->paterno}}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-4 col-form-label">A. Materno</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control"  name="materno" value="{{$persona->materno}}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-4 col-form-label">Celular</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control"  name="celular" value="{{$persona->celular}}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-4 col-form-label">Correo</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control"  name="correo" value="{{$persona->correo}}">
                </div>
            </div>

            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-4 col-form-label">Unidad</label>
                <div class="col-sm-8">
                    <select name="unidad" class="form-control">
                        <option value="{{$unidad->id}}">{{$unidad->unidad}}</option>
                        @foreach($unidades as $v)
                        <option value="{{$v->id}}">{{$v->unidad}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <input type="submit" class="btn btn-success botn-block" value="Actualizar">
            </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
      </div>
    </div>
  </div>
</div>    
@endsection