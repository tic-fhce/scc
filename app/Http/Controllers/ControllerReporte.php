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
            $dato=Models\Datos::where('id_persona',$resquest->id_persona)->first();
            
            $bto=Models\Bruto::where('user_id',$dato->user_id)->where('gestion',$resquest->gestion)->where('mes',$resquest->mes)->where('lugar','MQ')->orderby('fecha','asc')->get();
            $bruto=[];
            $bruto2=[];
            $pares=[];
            $aux='';
            foreach($bto as $b)
                array_push($bruto2,$b);    
            array_push($bruto2,$bruto2[0]);
            foreach($bruto2 as $b){
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
            
            $titulo="SCC/Lista de Personal";
            //$titulo2=$datos->usser;
            return view('reporte.lista_reporte',compact('titulo','usuario','menu','sub','bruto'));
        }
    	else
        	return redirect('/');
    }
}
