<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models;

class ControllerLogin extends Controller
{
    //
    public function index(){
        return view('login.login');
    }
    public function login(Request $request){

    	$admin="";
        $pass= hash('ripemd160',$request->pass);
        $admin = Models\Usuario::where('usuario', $request->correo)->where('pass',$pass)->first();

        if($admin==""){
        	session_start();	
        	session_destroy();
            return redirect()->back()->with('mensaje_error','Error usuario no identificado');
        }
        else
        {
        	session_start();
        	$_SESSION['usuario']=$admin;
            return redirect('escritorio');// redirecciona a secion
        }
    }// funcion que permite verificar el inicioo de sesion
    public function escritorio(){
    	session_start();
    	if(isset($_SESSION['usuario']))
        {
            $usuario=$_SESSION['usuario'];
            $menu=DB::table('viewmenu')->where('id_usuario',$usuario->id)->get();
            $sub=Models\Submenu::get();
            $titulo="Sistema CC";
            //$titulo2=$datos->usser;
            return view('escritorio.escritorio',compact('titulo','usuario','menu','sub'));
        }
    	else
        	return redirect('/');
    }// funcion que permite verificar y aceder al panel de inicio 
    public function exit(){
        session_start();
        if(isset($_SESSION['usuario']))
        {
            $datos=$_SESSION['usuario'];
            session_destroy();
        }
        return redirect('/');
    }// funcion que cierra el inicio de secion 
}
