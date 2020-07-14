<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Tareas;
use App\EvidenciasTareas;
use App\Cursos;
use App\Materias;
use DB;
class TareasController extends Controller
{
            public function __construct()
    {
        //Protegiendo las rutas con middleawares

        $this->middleware('auth');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {


        $tareas = Tareas::all();
        return view('Tareas.tareas', compact('tareas'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($curso)
    {
        $curso =Cursos::findOrFail($curso);
        $materias = Materias::all();
        return view('Tareas.crear', compact('curso', 'materias'));
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
            'nombre_tarea'       =>  'required',
            'descripcion_tarea'  =>  'required',
            'fecha_plazo'       =>  'required',
            'curso'             =>  'required',
            'materia_id'       =>  'required'
        ]);

        $form_data = array(
            'nombre_tarea'        =>   $request->nombre_tarea,
            'descripcion_tarea'   =>   $request->descripcion_tarea,
            'fecha_plazo'         =>   $request->fecha_plazo,
            'curso_id'            =>   $request->curso,
            'materia_id'          =>   $request->materia_id,
            'profesor_id'         =>   Auth::user()->profesor_id
        );

        Tareas::create($form_data);
        return redirect($request->url)->with('success', 'Tarea guardada correctamente. '. $request->nombre_tarea);

    }

    public function DetallesTarea ($id_tarea){
        // este método carga las tareas relacionadas a su curso
        $tarea = Tareas::findOrfail($id_tarea);
        // verificar si ya existe un registro del alumno para comprobar si subió la tarea anteriormente
        $check = DB::table('evidencias_tareas')->where('evidencias_tareas.tarea_id', '=', $id_tarea)->where('evidencias_tareas.alumno_id', '=', Auth::user()->alumno_id)->first();
        return view('Tareas.detalles_subir', compact('tarea', 'check'));
    }
    public function SubirEvidencia (Request $request){
        $new_name = "";
        $file = $request->file('evidencia');
        if(isset($file)){
            $request->validate([
                'evidencia'               =>  'required|max:2048',
                'tarea_id'                =>  'required',
                'alumno_id'                => 'required'
            ]);
        $new_name = rand() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('EvidenciasTareas'), $new_name);
        }else{$new_name == "";}

           $check = DB::table('evidencias_tareas')->where('evidencias_tareas.tarea_id', '=', $request->tarea_id)->where('evidencias_tareas.alumno_id', '=', $request->alumno_id)->count();
           $respuesta = '';
           if ($check > 0) {
                $respuesta = 'La evidencia ya se ha subió anteriormente';
           }else{
            $form_data = array(
            'evidencia'          =>   $new_name,
            'tarea_id'         =>     $request->tarea_id,
            'alumno_id'         =>    $request->alumno_id
            );
            EvidenciasTareas::create($form_data);
            $respuesta = 'Evidencia subida correctamente';
           }


        return redirect($request->url)->with('success', $respuesta);
    }

    function ActualizarEvidencia(Request $request, $id){
         $file_name = $request->hidden_file;
            $file = $request->file('evidencia');
            if(isset($file))
            {
                $request->validate([
                    'evidencia'     =>  'required|max:2048',
                ]);

                $file_name = rand() . '.' . $file->getClientOriginalExtension();
                $file->move(public_path('EvidenciasTareas'), $file_name);
                $data = EvidenciasTareas::findOrFail($id);
                if($data->evidencia != ''){
                $path = public_path()."/EvidenciasTareas/".$data->evidencia;
                if (file_exists($path)) {
                    unlink($path);
                }
                }
            }

            $form_data = array(
                'evidencia'         =>    $file_name
            );
        EvidenciasTareas::whereid($id)->update($form_data);
        return redirect($request->url)->with('success', 'Evidencia actualizada correctamente.');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //el parametro de este metodo no es el id de la tarea, es del curso
        $curso = Cursos::findOrfail($id);
        $tareas = $curso->tareas;
        return view('Tareas.ver', compact('tareas', 'curso'));
    }
       public function DetallesTareaEvidencias($id)
    {
        // Ver quienes han completado la tarea
        $tarea = Tareas::findOrfail($id);
        $entrega = DB::table('alumnos')->join('evidencias_tareas','evidencias_tareas.alumno_id', '=', 'alumnos.id_user')->where('evidencias_tareas.tarea_id', '=', $id)->get();
        return view('Tareas.ver_completados_tarea', compact('tarea', 'entrega'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tarea = Tareas::findOrfail($id);
        return view('Tareas.editar', compact('tarea'));
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
            'nombre_tarea'       =>  'required',
            'descripcion_tarea'  =>  'required',
            'fecha_plazo'       =>  'required'
        ]);

        $form_data = array(
            'nombre_tarea'        =>   $request->nombre_tarea,
            'descripcion_tarea'   =>   $request->descripcion_tarea,
            'fecha_plazo'         =>   $request->fecha_plazo
        );

        Tareas::whereid_tarea($id)->update($form_data);
        return redirect($request->url)->with('success', 'Editada correctamente. ' . $request->nombre_tarea);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        $tarea = Tareas::findOrFail($id);
        $tarea->delete();
        return redirect($request->url)->with('success', 'Se eliminó la Tarea: '. $tarea->nombre_tarea);
    }
}
