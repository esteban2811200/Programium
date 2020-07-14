<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Cursos;
use App\Alumnos;
use App\CursosAlumnos;
use DB;

class CursosController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::check()) {
            if (Auth::user()->role == 'administrador') {
                $cursos = Cursos::all();
                return view('Cursos.cursos', compact('cursos'));
        }else if(Auth::user()->role == 'profesor'){
               $cursos = DB::table('cursos')->join('profesores_cursos', 'profesores_cursos.curso_id', '=', 'cursos.id_curso')->where('profesores_cursos.profesor_id', '=',
                   Auth::user()->profesor_id)->get();
                return view('Cursos.cursos', compact('cursos'));
        }else if(Auth::user()->role == 'alumno'){
               $cursos = DB::table('cursos')->join('cursos_alumnos', 'cursos_alumnos.curso_id', '=', 'cursos.id_curso')->where('cursos_alumnos.alumno_id', '=',
                   Auth::user()->alumno_id)->get();

                return view('Cursos.cursos', compact('cursos'));
        }
    }

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('Cursos.crear');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre'       =>  'required',
            'descripcion'  =>  'required',
            'nivel'        =>  'required',
            'estado'       =>  'required'
        ]);

        $form_data = array(
            'nombre'        =>   $request->nombre,
            'descripcion'   =>   $request->descripcion,
            'nivel'         =>   $request->nivel,
            'estado'        =>   $request->estado
        );

        Cursos::create($form_data);
        return redirect('cursos')->with('success', 'Curso guardado correctamente . '. $request->nombre);

    }

    public function CursosAlumnos(){
        $alumnos = Alumnos::all();
        $cursos = Cursos::all();
        return view('Cursos.asignar_alumnos', compact('alumnos', 'cursos'));
        }

        public function RelacionarAlumnos(Request $request){
            $request->validate([
            'curso_id'          =>  'required',
            'alumno_id'          =>  'required'
        ]);
           $check = DB::table('cursos_alumnos')->where('cursos_alumnos.curso_id', '=', $request->curso_id)->where('cursos_alumnos.alumno_id', '=', $request->alumno_id)->count();
           $respuesta = '';
           if ($check > 0) {
                $respuesta = 'Este alumno ya pertenece al curso seleccionado ):';
           }else{
                $form_data = array(
                    'curso_id'        =>   $request->curso_id,
                    'alumno_id'       =>   $request->alumno_id
                );
                CursosAlumnos::create($form_data);
                $c = Cursos::findOrFail($request->curso_id);
                $a = Alumnos::whereid_user($request->alumno_id)->first();
                $respuesta = 'Dato insertado correctamente: '. $a->nombre." Curso => ". $c->nombre;

           }

         return redirect('cursos-alumnos')->with('respuesta', $respuesta);
        // return view('Profesores.asignar_cursos');
        }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $curso = Cursos::findOrfail($id);
        return view('Cursos.ver', compact('curso'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $curso = Cursos::findOrfail($id);
        return view('Cursos.editar', compact('curso'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre'       =>  'required',
            'descripcion'  =>  'required',
            'nivel'        =>  'required',
            'estado'       =>  'required'
        ]);

        $form_data = array(
            'nombre'        =>   $request->nombre,
            'descripcion'   =>   $request->descripcion,
            'nivel'         =>   $request->nivel,
            'estado'        =>   $request->estado
        );

        Cursos::whereid_curso($id)->update($form_data);
        return redirect('cursos')->with('success', 'Editado correctamente .' . $request->nombre);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $curso = Cursos::findOrFail($id);
        $curso->delete();
        return redirect('cursos')->with('success', 'Se eliminó el Curso: '. $curso->nombre);
    }
}
