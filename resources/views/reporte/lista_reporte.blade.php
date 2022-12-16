@extends('plantilla.escritorio')

@section('label1')
<?php  
    $dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
    $doble=0;
?>
<div class="container">
    <div class="row align-items-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                    <div class="col-md-6"><h5 class="card-title">Lista de Personal</h5></div>
                    <div class="col-md-6"><a href="{{route('reportepdf',$uri)}}" class="btn btn-success botn-block">PDF</a></div>
                    </div>
                </div>
                <div class="card-body table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">ID</th>
                                <th scope="col">UID</th>
                                <th scope="col">USER ID</th>
                                <th scope="col">LUGAR</th>
                                <th scope="col">FECHA</th>
                                <th scope="col">DIA</th>
                                <th scope="col">HORA</th>
                                <th scope="col">Retraso</th>
                            </tr>
                        </thead>
                       @if($horario->id==1 or $horario->id==2 or $horario->id==5) 
                        <tbody>
                            <?php $i=1;
                            $retraso=0;
                            $retrasoT=0;
                            $h=(int)substr($horario->ingreso, 0, 2)*100;
                            $m=(int)substr($horario->ingreso, 3, 5);
                            $h=$h+$m+5;
                            ?>
                            @foreach($bruto as $b)
                            <?php 
                            $retraso=(($b->h)*100+($b->m))-$h;
                            if($retraso > 0 and ($i % 2)==1 and $b->hora!='')
                                $retrasoT= $retrasoT+$retraso;
                            ?>
                            <tr>
                                <td scope="row">{{$i}}</th>
                                <td>{{$b->id}}</th>
                                <td>{{$b->uid}}</td>
                                <td>{{$b->user_id}}</td>
                                <td>{{$b->lugar}}</td>
                                <td>{{$b->fecha}}</td>
                                <td>{{$dias[date('w', strtotime($b->fecha))]}} {{$b->dia}}</td>
                                <td>{{$b->hora}}</td>
                                <td>
                                    @if($retraso > 0 and ($i % 2)==1 and $b->hora!='')
                                        {{$retraso}} 
                                    @endif
                                </td>
                            </tr>
                            <?php $i=$i+1;?>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Total Retraso</td>
                                <td><h3>{{$retrasoT}} min</h3></td>
                            </tr>
                        </tbody>
                        
                            
                        @else
                        <tbody>
                            <?php $i=1;?>
                            @foreach($bruto as $b)
                            <tr>
                                <td scope="row">{{$i}}</th>
                                <td>{{$b->id}}</th>
                                <td>{{$b->uid}}</td>
                                <td>{{$b->user_id}}</td>
                                <td>{{$b->lugar}}</td>
                                <td>{{$b->fecha}}</td>
                                <td>{{$dias[date('w', strtotime($b->fecha))]}} {{$b->dia}}</td>
                                <td>{{$b->hora}}</td>
                                <td>
                                </td>
                            </tr>
                            <?php $i=$i+1;?>
                            @endforeach
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>Total Retraso</td>
                                <td><h3></h3></td>
                            </tr>
                        </tbody>    
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection