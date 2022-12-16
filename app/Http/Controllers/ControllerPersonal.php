<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models;

class ControllerPersonal extends Controller
{
    //
    public function listaPersonal(){
        session_start();
    	if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $menu=DB::table('viewmenu')->where('id_usuario',$usuario->id)->get();
            $sub=Models\Submenu::get();

            $personas=Models\Persona::all();
            $titulo="SCC/Lista de Personal";
            //$titulo2=$datos->usser;
            return view('personal.lista_personal',compact('titulo','usuario','menu','sub','personas'));
        }
    	else
        	return redirect('/');
    }

    public function perfilPersonal($id_personal){
        session_start();
    	if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $menu=DB::table('viewmenu')->where('id_usuario',$usuario->id)->get();
            $sub=Models\Submenu::get();

            $persona=Models\Persona::findOrFail($id_personal);
            $unidades=Models\Unidad::all();
            $tipos=Models\Tipo::all();
            $horarios=Models\Horario::all();
            $user=Models\Usuario::where('id_persona',$id_personal)->first();
            
            $datos=null;
            $unidad=null;
            $horario=null;
            if(isset($user)){
                $datos=Models\Datos::where('id_persona',$id_personal)->get();
                $unidad=Models\Unidad::where('id',$user->id_unidad)->first();
                $horario=Models\Horario::where('id',$user->id_horario)->first();
            }
            $titulo="SCC/Lista Personal/Perfil de ".$persona->nombre;
            //$titulo2=$datos->usser;
            

            return view('personal.perfil',compact('titulo','usuario','menu','sub','persona','unidades','datos','unidad','horario','tipos','horarios'));
        }
    	else
        	return redirect('/');
    }

    public function updateDatosPersonal(Request $request){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];

            $persona=Models\Persona::findOrFail($request->id);
            $persona->nombre=$request->nombre;
            $persona->paterno=$request->paterno;
            $persona->materno=$request->materno;
            $persona->correo=$request->correo;
            $persona->celular=$request->celular;
            $persona->save();

            $usuario=Models\Usuario::where('id_persona',$request->id)->first();
            $usuario->id_unidad=$request->unidad;
            $usuario->save();

            return redirect()->back()->with('mensaje','Datos Personales Actualizados Correctamente');
        }
        else
            return redirect('/');
    }
}
