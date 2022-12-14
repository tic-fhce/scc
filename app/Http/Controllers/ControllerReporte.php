<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models;

class ControllerReporte extends Controller
{
    //
    public function reporte2(Request $resquest){
        session_start();
    	if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $menu=DB::table('viewmenu')->where('id_usuario',$usuario->id)->get();
            $sub=Models\Submenu::get();
            $dato=Models\Datos::where('id_persona',$resquest->id_persona)->first();
            
            $bto=Models\Bruto::where('user_id',$dato->user_id)->where('gestion',$resquest->gestion)->where('mes',$resquest->mes)->where('lugar','MQ')->get();
            $bruto=[];
            $bruto2=[];
            $pares=[];
            $aux='';
            foreach($bto as $b)
                array_push($bruto2,$b);    
            array_push($bruto2,$bruto2[0]);
            foreach($bruto2 as $b){
                echo($aux.'<br>');
                if($aux==''){
                    $aux=$b->fecha;
                    array_push($pares,$b);        
                }
                else{
                    if($aux==$b->fecha)
                        array_push($pares,$b);
                    else{
                        $aux=$b->fecha;
                        if(count($pares)==2){
                            foreach($pares as $p)
                                array_push($bruto,$p);
                        }
                        else{
                            if(count($pares)==1){
                                array_push($bruto,$pares[0]);
                                array_push($bruto,$pares[0]);
                            }
                            else{
                                $entrada=[];
                                $salida=[];
                                foreach($pares as $n){
                                    $e=$n->h*100+$n->m;
                                    if($e<1629)
                                        array_push($entrada,$n);
                                    else
                                        array_push($salida,$n);
                                }
                                if(count($entrada)>0)
                                    array_push($bruto,$entrada[count($entrada)-1]);
                                else 
                                    array_push($bruto,$salida[count($salida)-1]);    
                                if(count($salida)>0)
                                    array_push($bruto,$salida[0]);
                                else
                                    array_push($bruto,$entrada[count($entrada)-1]);

                            }
                        }
                        
                        $pares=[];
                        array_push($pares,$b);
                    }
                }

                
                
            }
            
            $titulo="SCC/Lista de Personal";
            //$titulo2=$datos->usser;
            return view('reporte.lista_reporte',compact('titulo','usuario','menu','sub','bruto'));
        }
    	else
        	return redirect('/');
    }
    public function reporte(Request $resquest){
        session_start();
    	if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $menu=DB::table('viewmenu')->where('id_usuario',$usuario->id)->get();
            $sub=Models\Submenu::get();
            $datos=Models\Datos::where('id_persona',$resquest->id_persona)->get();
            $datas=[];
            
            foreach($datos as $dato){
                $bto=Models\Bruto::where('user_id',$dato->user_id)->where('gestion',$resquest->gestion)->where('mes',$resquest->mes)->where('lugar',$dato->lugar)->get();
                foreach($bto as $bt){
                    array_push($datas,$bt);
                }
            }
            for($i=0;$i<count($datas)-1;$i++ ){
                for($j=$i+1;$j<count($datas);$j++){
                    $menor=$datas[$i]->gestion+$datas[$i]->mes+$datas[$i]->dia;
                    $mayor=$datas[$j]->gestion+$datas[$j]->mes+$datas[$j]->dia;
                    if($menor>$mayor){
                        $auxmenor=$datas[$i];
                        $datas[$i]=$datas[$j];
                        $datas[$j]=$auxmenor;
                    }
                }
            }

            $bruto=[];
            $bruto2=[];
            $pares=[];
            $aux='';    
            array_push($datas,$datas[0]);
            if($resquest->tipoh=='Continuo'){
                foreach($datas as $b){
                    if($aux==''){
                        $aux=$b->fecha;
                        array_push($pares,$b);        
                    }
                    else{
                        if($aux==$b->fecha)
                            array_push($pares,$b);
                        else{
                            $aux=$b->fecha;
                            $entrada=[];
                            $salida=[];
                            foreach($pares as $n){
                                $e=(int)$n->h*100+$n->m;
                                echo($n->fecha.' '.$e);
                                if($e<1030){
                                    array_push($entrada,$n);
                                    echo('Entrada <br>');
                                }
                                    
                                else{
                                    array_push($salida,$n);
                                    echo('Salida <br>');
                                }
                                    
                            }
                            if(count($entrada)>0) 
                                array_push($bruto,$entrada[count($entrada)-1]);                            
                            else {
                                $a= clone ($salida[0]);
                                $a->hora='';
                                array_push($bruto,$a);    
                            }
                            if(count($salida)>0)
                                array_push($bruto,$salida[0]);
                            else{
                                $c= clone ($entrada[count($entrada)-1]);
                                $c->hora='';
                                array_push($bruto,$c);
                            }
                            $pares=[];
                            array_push($pares,$b);
                        }
                    }
                }
            }
            else {
                foreach($datas as $b){
                    if($aux==''){
                        $aux=$b->fecha;
                        array_push($pares,$b);        
                    }
                    else{
                        if($aux==$b->fecha)
                            array_push($pares,$b);
                        else{
                            $aux=$b->fecha;
                            $entradaM=[];
                            $salidaM=[];
                            $entradaT=[];
                            $salidaT=[];
                            foreach($pares as $n){
                                $e=(int)$n->h*100+$n->m;
                                echo($n->fecha.' '.$e);
                                if($e<945){
                                    array_push($entradaM,$n);
                                    echo('Entrada Mañana <br>');
                                }
                                if($e>1420 and $e<1530){
                                    array_push($entradaT,$n);
                                    echo('Entrada Tarde <br>');
                                }
                                if($e>1220 and $e<1400){
                                    array_push($salidaM,$n);
                                    echo('Salida Mañana <br>');
                                }
                                if($e>1845){
                                    array_push($salidaT,$n);
                                    echo('Salida Tarde<br>');
                                }   
                            }
                            $sup=[];
                            if(count($entradaM)>0)
                                $sup=$entradaM;
                            if(count($entradaT)>0)
                                $sup=$entradaT;
                            if(count($salidaM)>0)
                                $sup=$salidaM;
                            if(count($salidaT)>0)
                                $sup=$salidaT;
                            
                            if(count($entradaM)>0)
                                array_push($bruto,$entradaM[count($entradaM)-1]);
                            else {
                                    $a= clone ($sup[0]);
                                    $a->hora='';
                                    array_push($bruto,$a);
                            }
                            
                            if(count($salidaM)>0)
                                array_push($bruto,$salidaM[0]);
                            else {
                                $a= clone ($sup[0]);
                                $a->hora='';
                                array_push($bruto,$a);
                            }
                            if(count($entradaT)>0)
                                array_push($bruto,$entradaT[count($entradaT)-1]);
                            else {
                                $a= clone ($sup[0]);
                                $a->hora='';
                                array_push($bruto,$a);
                            }
                            if(count($salidaT)>0)
                                array_push($bruto,$salidaT[0]);
                            else {
                                $a= clone ($sup[0]);
                                $a->hora='';
                                array_push($bruto,$a);
                            }
                            $pares=[];
                            array_push($pares,$b);
                        }
                    }
                }

            }
            
            
            $titulo="SCC/Lista de Personal";
            //$titulo2=$datos->usser;
            return view('reporte.lista_reporte',compact('titulo','usuario','menu','sub','bruto'));
        }
    	else
        	return redirect('/');
    }
}
