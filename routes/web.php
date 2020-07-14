<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->middleware('auth');
// rutas profesores
Route::resource('profesores','ProfesoresController')->names('profesores');
Route::get('profesores-cursos', 'ProfesoresController@ProfesoresCursos')
	->name('profesores.add_cursos');
Route::post('profesores-relacionar-cursos', 'ProfesoresController@RelacionarCursos')->name('profesores.relacionar_cursos');
//rutas cursos
Route::resource('cursos','CursosController')->names('cursos');
Route::get('cursos-alumnos', 'CursosController@CursosAlumnos')
	->name('cursos.add_alumnos');
Route::post('cursos-relacionar-alumnos', 'CursosController@RelacionarAlumnos')->name('cursos.relacionar_alumnos');

//rutas alumnos
Route::resource('alumnos','AlumnosController')->names('alumnos');
Route::get('alumnos-materias', 'AlumnosController@AlumnosMaterias')
	->name('alumnos.add_materias');
Route::post('alumnos-relacionar-materias', 'AlumnosController@RelacionarMaterias')->name('alumnos.relacionar_materias');
//rutas materias
Route::resource('materias','MateriasController')-> names('materias');

//rutas Tareas
Route::resource('tareas','TareasController')-> names('tareas');
Route::get('tareas/crear/{curso}','TareasController@create')-> name('tareas.create');
Route::get('tareas-detalles/{tarea}','TareasController@DetallesTarea')-> name('tareas.detalles');
Route::post('tareas-enviar','TareasController@SubirEvidencia')-> name('tareas.enviar');
Route::patch('tareas-actualizar/{id}','TareasController@ActualizarEvidencia')-> name('tareas.actualizar');
Route::get('tareas-detalles-evidencias/{tarea}','TareasController@DetallesTareaEvidencias')-> name('tareas.alumnos_completada');

//rutas foro
Route::resource('foro', 'ForoController')-> names('foro');
Route::get('foro-discucion/{curso}','ForoController@listar')-> name('foro.listar');
Route::post('foro-responder/','ForoController@respuestasInsert')-> name('foro.responder');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
