<?php

namespace App\Http\Controllers;
use App\Alumnos;
use App\User;
use App\Materias;
use App\AlumnosMaterias;
use DB;
use Illuminate\Http\Request;

class AlumnosController extends Controller
{

    public function __construct()
    {
        //Protegiendo las rutas con middleawares

        $this->middleware('admin_profe');
        // $this->middleware('admin');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $alumnos = Alumnos::all();
        return view('Alumnos.alumnos', compact('alumnos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('Alumnos.crear');
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
            'nombre'          =>  'required',
            'apellidos'       =>  'required',
            'edad'            =>  'required'
        ]);
        $identificador = time() + (7 * 24 * 60 * 60);
        $form_data = array(
            'nombre'         =>   $request->nombre,
            'apellidos'      =>   $request->apellidos,
            'edad'           =>   $request->edad,
            'id_user'        =>   $identificador
        );


        Alumnos::create($form_data);
        $username =  strtok($request->nombre, " ");
        User::create([
            'name' => $username,
            'email' => $request->correo,
            'password' => bcrypt(12345678),
            'role' => 'alumno',
            'alumno_id' => $identificador
        ]);
        return redirect('alumnos')->with('success', 'Alumno guardado correctamente. '. $request->nombre . ' [ Contraseña:  "12345678" ]');

    }

  public function AlumnosMaterias(){
        $alumnos = Alumnos::all();
        $materias = Materias::all();
        return view('Alumnos.asignar_materias', compact('alumnos', 'materias'));
        }

        public function RelacionarMaterias(Request $request){
            $request->validate([
            'alumno_id'          =>  'required',
            'materia_id'          =>  'required'
        ]);
           $check = DB::table('alumnos_materias')->where('alumnos_materias.alumno_id', '=', $request->alumno_id)->where('alumnos_materias.materia_id', '=', $request->materia_id)->count();
           $respuesta = '';
           if ($check > 0) {
                $respuesta = 'Este alumno ya tiene relacionada la materia seleccionada';
           }else{
                $form_data = array(
                    'alumno_id'           =>   $request->alumno_id,
                    'materia_id'          =>   $request->materia_id
                );
                AlumnosMaterias::create($form_data);
                $m = Materias::findOrFail($request->materia_id);
                $a = Alumnos::findOrFail($request->alumno_id);
                $respuesta = 'Dato insertado correctamente: '. $a->nombre. " ". $a->apellidos. " Materia => ". $m->nombre;

           }

         return redirect('alumnos-materias')->with('respuesta', $respuesta);
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
        $alumno = Alumnos::findOrfail($id);
        return view('Alumnos.ver', compact('alumno'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $alumno = Alumnos::findOrfail($id);
        return view('Alumnos.editar', compact('alumno'));
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
            'nombre'            =>  'required',
            'apellidos'         =>  'required',
            'edad'              =>  'required'
        ]);
        $form_data = array(
            'nombre'          =>   $request->nombre,
            'apellidos'       =>   $request->apellidos,
            'edad'            =>   $request->edad
        );

        Alumnos::whereid_alum($id)->update($form_data);
        return redirect('alumnos')->with('success', 'Alumno editado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $alumno = Alumnos::findOrFail($id);
        $user = User::wherealumno_id($alumno->id_user);
        $user->delete();
        $alumno->delete();
        return redirect('alumnos')->with('success', 'Se eliminó el alumno: '. $alumno->nombre);
    }
}
