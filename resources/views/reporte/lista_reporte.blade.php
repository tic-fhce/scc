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
                                <th scope="col">UID</th>
                                <th scope="col">USER ID</th>
                                <th scope="col">FECHA</th>
                                <th scope="col">HORA</th>
                                <th scope="col">LUGAR</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i=1;?>
                            @foreach($bruto as $b)
                            <tr>
                                <th scope="row">{{$i}} -> {{$b->id}}</th>
                                <td>{{$b->uid}}</td>
                                <td>{{$b->user_id}}</td>
                                <td>{{$b->fecha}}</td>
                                <td>{{$b->hora}}</td>
                                <td>{{$b->lugar}}</td>
                            </tr>
                            <?php $i=$i+1;?>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection