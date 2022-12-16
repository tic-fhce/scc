<?php  
$dias = array('Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado');
$doble=0;
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Lista de Marcados</title>
<link href="{{asset('style.css')}}" rel="stylesheet" media="all">
</head>
<body>
    <table width="100%">
        <thead>
            <tr>
                <td><img src="{{asset('images/logou.jpg')}}" width="70px" height="130px"></td>
                <td>Universidad Mayor de San Andrés<br>Facutlad de Humanidades y Ciencias de la Educación<br>Unidad TIC - 2022</td>
                <td></td>
                <td></td>
            </tr>
            <tr><td colspan="4"><center><h3>REPORTE DE ASISTENCIAS</h3></center><center><h4>{{$mes}} - {{$gestion}}</h4></center></td></tr>
        </thead>
    </table>
        
        
        ID: {{$persona->id}}<br>
        Nombre : {{$persona->nombre}} {{$persona->paterno}} {{$persona->materno}}<br>
        Hora de Ingreso - Salida : {{$horario->ingreso}} - {{$horario->salida}}<br>
        Tipo de Horario : {{$horario->tipo}}
        <br><br>
        <table border="1" width="100%" class="table">
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
           @if($horario->id==1 or $horario->id==2) 
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
        <br><br><br><br><br><br><br><br><br>

        <table width="100%">
            <tbody>
                <tr>
                    <td width="50%"><center>Lic. Jaime Montecinos Marquez</center></td>
                    <td width="50%"><center>Sonia Subirana Farfan</center></td>
                </tr>
                <tr>
                    <td width="50%"><center>U-TIC</center></td>
                    <td width="50%"><center>Administracion</center></td>
                </tr>
                
                    
            </tbody>
        </table>
        <br><br><br>
        Facultad de Humanidades y Ciencias de la Educación - UMSA <br>
        Unidad de Tecnologías de la información y la Comunicación 
</body>
</html>

