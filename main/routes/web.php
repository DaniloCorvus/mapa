<?php

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


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Route;

Auth::routes();

//Users
Route::resource('/users', 'UserController', ['except' => 'update']);
Route::get('/user/roles/{key}', 'UserController@show');
Route::patch('/users/update', 'UserController@update')->name('users.update');

//Rols
Route::resource('/rols', 'RoleController', ['except' => 'update']);
Route::patch('/rols/update', 'RoleController@update')->name('rols.update');
Route::post('/rols/asignar-rol', 'RoleController@asignarRole')->name('rols.asignarRole');
Route::get('/user/roles/eliminar-rol/{rolkey}/{userkey}', 'RoleController@eliminarRol');

Route::resource('/categorias', 'CategoriaController', ['except' => ['index', 'update', 'show']]);
Route::get('/administrativo/categorias/{categoria}', 'CategoriaController@show')->name('categorias.show');

Route::patch('/categorias/update', 'CategoriaController@update')->name('categorias.update');
Route::get('/categorias/details/{categoria}/{minicategoria}', 'CategoriaController@details')->name('categorias.details');

Route::get('/home', 'CategoriaController@index')->name('home');
Route::get('/', 'CategoriaController@index')->name('home');
Route::get('/categorias/{categoria}', 'CategoriaController@minis')->name('categorias.index');

Route::get('/administrativo/categorias', 'CategoriaController@get')->name('administrativo.index');
Route::get('/administrativo/procesos/{categoria}', 'ProcesoController@get')->name('administrativo.procesos.index');

Route::get('/administrativo/macroprocesos/{proceso}', 'MacroprocesoController@get');

Route::resource('/procesos', 'ProcesoController', ['except' => 'index', 'show', 'update']);
Route::get('/procesos/{categoria}/{proceso}', 'ProcesoController@index')->name('proceso.index');
Route::get('/procesos/{categoria}/{proceso}/{minicategoria}', 'ProcesoController@details')->name('proceso.details');
Route::patch('/procesos/update', 'ProcesoController@update')->name('procesos.update');

Route::resource('/subprocesos', 'SubprocesoController', ['except' => ['index', 'show']]);
Route::get('/subprocesos/{categoria}/{proceso}/{subproceso}', 'SubprocesoController@show')->name('subprocesos.show');
Route::get('/subprocesos/{categoria}/{proceso}/{subproceso}/{minicategoria}', 'SubprocesoController@details')->name('subproceso.details');
Route::get('/administrativo/subprocesos/{proceso}', 'SubprocesoController@get')->name('administrativo.subprocesos.index');
Route::patch('/subprocesos/update', 'SubprocesoController@update')->name('subprocesos.update');

Route::resource('/macroprocesos', 'MacroprocesoController', ['except' => ['index', 'show']]);
Route::get('/macroprocesos/{categoria}/{proceso}/{macroproceso}', 'MacroprocesoController@show')->name('macroprocesos.show');
Route::get('/macroprocesos/{categoria}/{proceso}/{macroproceso}/{minicategoria}', 'MacroprocesoController@details')->name('macroproceso.details');

Route::patch('/macroprocesos/update', 'SubprocesoController@update')->name('macroprocesos.update');

Route::resource('/minicategorias', 'MinicategoriaController', ['except' => ['index', 'show']]);
Route::patch('/minicategorias/update', 'MinicategoriaController@update')->name('minicategorias.update');
Route::post('minicategorias/procesos/store', 'MinicategoriaController@procesoStore')->name('minicategorias.procesos.store');
Route::post('minicategorias/subprocesos/store', 'MinicategoriaController@subprocesoStore')->name('minicategorias.subprocesos.store');

Route::get('/administrativo/detalles/categoria/{categoria}', 'DetallesController@verCategoria');
Route::get('/administrativo/detalles/proceso/{proceso}', 'DetallesController@verProceso');
Route::get('/administrativo/detalles/subproceso/{subproceso}', 'DetallesController@verSubProceso');
Route::get('/administrativo/detalles/macroproceso/{macroproceso}', 'DetallesController@verMacroproceso');


Route::resource('/archivos', 'ArchivoController');
Route::get('/archivos/update', 'ArchivoController@update')->name('archivos.update');

Route::resource('/empresa', 'EmpresaController');
Route::get('/empresa/update', 'EmpresaController@update')->name('empresa.update');

Route::view('/info', 'info.info')->name('info');

Route::resource('/video', 'VideoController');
Route::resource('/otros', 'OtroController');
Route::get('/otros/{otro}', 'OtroController@destroy', ['except' => 'delete'])->name('otros.delete');


Route::get('/file/eliminar/{id}', 'ArchivoController@destroy');

Route::get('/downloadfiles/{archivo}', function ($archivo) {
    try {
        if (File::exists(public_path('/pdfs/' . $archivo))) {
            return response()->download(public_path('/pdfs/' . $archivo));
        }
        abort(404);
    } catch (\Throwable $th) {
        return $th->getMessage();
    }
});

Route::get('/downloadotros/{archivo}', function ($archivo) {
    try {
        if (File::exists(public_path('/files/' . $archivo))) {
            return response()->download(public_path('/files/' . $archivo));
        }
        abort(404);
    } catch (\Throwable $th) {
        return $th->getMessage();
    }
});
