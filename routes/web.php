<?php

use App\Http\Controllers\ControllerLogin;
use App\Http\Controllers\ControllerUsuario;
use App\Http\Controllers\ControllerPersonal;
use App\Http\Controllers\ControllerReporte;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
##################### MODULO LOGIN #############################
Route::get('/',[ControllerLogin::class,'index'])->name('index');
Route::post('/login',[ControllerLogin::class,'login'])->name('login');
Route::get('/escritorio',[ControllerLogin::class,'escritorio'])->name('escritorio');
Route::get('/exit',[ControllerLogin::class,'exit'])->name('exit');


##################### MODULO USUARIO #############################
Route::get('/perfil',[ControllerUsuario::class,'perfil'])->name('perfil');
Route::get('/password',[ControllerUsuario::class,'password'])->name('password');
Route::put('/updateDatos',[ControllerUsuario::class,'updateDatos'])->name('updateDatos');
Route::put('/updatePass',[ControllerUsuario::class,'updatePass'])->name('updatePass');
Route::post('/addUsuario',[ControllerUsuario::class,'addUsuario'])->name('addUsuario');

##################### MODULO PERSONAL #############################
Route::get('/listaPersonal',[ControllerPersonal::class,'listaPersonal'])->name('listaPersonal');
Route::get('/perfilPersonal/{id_personal}',[ControllerPersonal::class,'perfilPersonal'])->name('perfilPersonal');
Route::put('/updateDatosPersonal',[ControllerPersonal::class,'updateDatosPersonal'])->name('updateDatosPersonal');


##################### MODULO REPORTE #############################
Route::post('/reporte',[ControllerReporte::class,'reporte'])->name('reporte');




