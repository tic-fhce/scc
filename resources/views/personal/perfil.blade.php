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
                        </div>
                    @endif
                    <div class="row">
                        <div class="col-md-4 alert alert-success">Datos Personales :</div><div class="col-md-8">{{$persona->nombre}} {{$persona->paterno}} {{$persona->materno}} <br> {{$persona->ci}}</div>
                        <div class="col-md-4 alert alert-success">Contacto :</div><div class="col-md-8">Celular: {{$persona->celular}}<br>Correo : {{$persona->correo}}</div>
                        <div class="col-md-4 alert alert-success">Unidad :</div><div class="col-md-8">@if(isset($unidad)){{$unidad->unidad}}@endif</div>
                        <hr>
                    </div>
                    @if(isset($unidad))
                    <button type="button" class="btn btn-warning botn-block" data-bs-toggle="modal" data-bs-target="#actualizarDatos">
                        Actualizar Datos
                    </button>
                    @else
                    <button type="button" class="btn btn-primary botn-block" data-bs-toggle="modal" data-bs-target="#crearUsuario">
                        Crear Usuario
                    </button>
                    @endif
                </div>
            </div>
        </div><!--Datos personales del usuario-->
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Detalles del Perfil</h5>
                </div> 

                <div class="card-body">
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="datos-marcados-tab" data-bs-toggle="tab" data-bs-target="#datosmarcados" type="button" role="tab" aria-controls="datosMarcado" aria-selected="true">Datos de Marcado</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="reporte-tab" data-bs-toggle="tab" data-bs-target="#reporte" type="button" role="tab" aria-controls="reporte" aria-selected="false">Reportes</button>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="datosmarcados" role="tabpanel" aria-labelledby="datos-marcados-tab">
                            <br>
                            @if(isset($horario))
                            <div class="container">
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
                            @endif
                        </div><!--Tab para datos de marcado-->

                        <div class="tab-pane fade" id="reporte" role="tabpanel" aria-labelledby="reporte-tab">
                            <div class="container">
                                <div class="row">
                                    <form action="{{route('reporte')}}" method="post">
                                    @csrf
                                        <br>
                                        <input type="text" name="id_persona" value="{{$persona->id}}">
                                        <div class="mb-3 row">
                                            <label class="col-sm-4 col-form-label">Gestion</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="gestion">
                                                    <option value="">Seleccionar Gestion</option>
                                                    <option value="2021">2021</option>
                                                    <option value="2022">2022</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="mb-3 row">
                                            <label class="col-sm-4 col-form-label">Mes</label>
                                            <div class="col-sm-8">
                                                <select class="form-control" name="mes">
                                                    <option value="">Seleccionar Mes</option>
                                                    <option value="1">ENERO</option>
                                                    <option value="2">FEBRERO</option>
                                                    <option value="3">MARZO</option>
                                                    <option value="4">ABRIL</option>
                                                    <option value="5">MAYO</option>
                                                    <option value="6">JUNIO</option>
                                                    <option value="7">JULIO</option>
                                                    <option value="8">AGOSTO</option>
                                                    <option value="9">SEPTIEMBRE</option>
                                                    <option value="10">OCTUBRE</option>
                                                    <option value="11">NOVIEMBRE</option>
                                                    <option value="12">DICIEMBRE</option>
                                                </select>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="mb-3 row">
                                            <button type="submit" class="btn btn-success botn-block">
                                                <i class="fa fa-floppy-o"></i> Generar PDF
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

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
        <form action="{{route('updateDatosPersonal')}}" method="post">
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
                        @if(isset($unidad))
                        <option value="{{$unidad->id}}">{{$unidad->unidad}}</option>
                        @else
                        <option value="0">Selecionar Unidad</option>
                        @endif
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

<!--Modal Usuario-->

<div class="modal fade" id="crearUsuario" tabindex="-1" aria-labelledby="Crear Usuario" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Crear Usuario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form action="{{route('addUsuario')}}" method="post">
            @csrf 
            <input type="hidden" name="id_persona" value="{{$persona->id}}">
            
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-4 col-form-label">Nombre de Usuario</label>
                <div class="col-sm-8">
                    <input type="text" class="form-control"  name="usuario" required="true">
                </div>
            </div>

            <div class="mb-3 row">
                <label  class="col-sm-4 col-form-label">Tipo</label>
                <div class="col-sm-8">
                    <select name="id_tipo" class="form-control">
                        <option value="0">Selecionar Tipo de Administracion</option>
                        @foreach($tipos as $tipo)
                        <option value="{{$tipo->id}}">{{$tipo->detalle}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            
            
            
            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-4 col-form-label">Unidad</label>
                <div class="col-sm-8">
                    <select name="id_unidad" class="form-control">
                        <option value="0">Selecionar Unidad</option>
                        @foreach($unidades as $unidad)
                        <option value="{{$unidad->id}}">{{$unidad->unidad}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <label for="staticEmail" class="col-sm-4 col-form-label">Unidad</label>
                <div class="col-sm-8">
                    <select name="id_horario" class="form-control">
                        <option value="0">Selecionar Horario</option>
                        @foreach($horarios as $horario)
                        <option value="{{$horario->id}}">{{$horario->tipo}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="mb-3 row">
                <input type="submit" class="btn btn-success botn-block" value="Crear Usuario">
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