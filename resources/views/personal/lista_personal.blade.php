@extends('plantilla.escritorio')

@section('label1')
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">Lista de Personal</h5>
                </div>
                <div class="card-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Nombre</th>
                                <th scope="col">CI</th>
                                <th scope="col">Celular</th>
                                <th scope="col">Correo</th>
                                <th scope="col"></th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($personas as $persona)
                            <tr>
                                <th scope="row">{{$persona->id}}</th>
                                <td>{{$persona->nombre}} {{$persona->paterno}} {{$persona->materno}}</td>
                                <td>{{$persona->ci}}</td>
                                <td>{{$persona->celular}}</td>
                                <td>{{$persona->correo}}</td>
                                <td>
                                <a href="{{route('perfilPersonal',$persona->id)}}" class="btn btn-success botn-block">
                                    Ver Perfil
                                </a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection