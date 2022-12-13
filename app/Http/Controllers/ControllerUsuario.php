<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models;

class ControllerUsuario extends Controller
{
    //
    public function perfil(){
        session_start();
    	if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $menu=DB::table('viewmenu')->where('id_usuario',$usuario->id)->get();
            $sub=Models\Submenu::get();

            $persona=Models\Persona::where('id',$usuario->id_persona)->first();
            $datos=Models\Datos::where('id_persona',$usuario->id_persona)->get();
            $unidad=Models\Unidad::where('id',$usuario->id_unidad)->first();
            $unidades=Models\Unidad::all();
            $horario=Models\Horario::where('id',$usuario->id_horario)->first();
            $titulo="SCC/Mi Perfil";
            //$titulo2=$datos->usser;
            return view('usuario.perfil',compact('titulo','usuario','menu','sub','persona','datos','unidad','horario','unidades'));
        }
    	else
        	return redirect('/');
    }
    public function password(){
        session_start();
    	if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $menu=DB::table('viewmenu')->where('id_usuario',$usuario->id)->get();
            $sub=Models\Submenu::get();
            $titulo="SCC/Cambiar Contraseña ";
            //$titulo2=$datos->usser;
            return view('usuario.password',compact('titulo','usuario','menu','sub'));
        }
    	else
        	return redirect('/');
    }
    public function updateDatos(Request $request){
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

            $usuario=Models\Usuario::findOrfail($usuario->id);
            $usuario->id_unidad=$request->unidad;
            $usuario->save();

            return redirect()->back()->with('mensaje','Datos Personales Actualizados Correctamente, para verificar los datos inicie sesión nuevamente');
        }
        else
            return redirect('/');
    }
    public function updatePass(Request $request){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $pass= hash('ripemd160',$request->pass);
            if($request->pass1==$request->pass2){
                if($usuario->pass==$pass){
                    $usuario=Models\Usuario::findOrfail($usuario->id);
                    $usuario->pass=hash('ripemd160',$request->pass1);
                    $usuario->save();
                    return redirect()->back()->with('mensaje','Contraseña Actualizada Correctamente, para verificar los datos inicie sesión nuevamente');
                }
                else
                    return redirect()->back()->with('mensaje_error','La contraseña Actual No es la correcta, verifique e intente nuevamente');
            }
            else
            return redirect()->back()->with('mensaje_error','Las contraseñas no coinciden, verifique e intente nuevamente');
        }
        else
            return redirect('/');
    }

    public function addUsuario(Request $request){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];

            $user=new Models\Usuario;
            $user->usuario=$request->usuario;
            $user->cif='0';
            $user->pass=hash('ripemd160',$request->usuario);
            $user->id_tipo=$request->id_tipo;
            $user->id_persona=$request->id_persona;
            $user->id_unidad=$request->id_unidad;
            $user->id_horario=$request->id_horario;
            $user->save();
            return redirect('listaPersonal');
        }
        else
            return redirect('/');
    }
}
