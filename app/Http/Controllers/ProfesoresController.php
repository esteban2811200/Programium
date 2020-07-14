<?php

namespace App\Http\Controllers;
use App\Profesores;
use App\Cursos;
use App\User;
use App\ProfesoresCursos;
use Illuminate\Http\Request;
use DB;
class ProfesoresController extends Controller
{

        public function __construct()
    {
        //Protegiendo las rutas con middleawares

        $this->middleware('admin');

    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $profesores = Profesores::all();
        return view('Profesores.profesores', compact('profesores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('Profesores.crear');
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
            'titulo'          =>  'required'
        ]);
        $identificador = time() + (7 * 24 * 60 * 60);
        $form_data = array(
            'nombre'          =>   $request->nombre,
            'titulo'          =>   $request->titulo,
            'id_user'        =>    $identificador
        );


        Profesores::create($form_data);
        $username =  strtok($request->nombre, " ");
        User::create([
            'name' => $username,
            'email' => $request->correo,
            'password' => bcrypt(12345678),
            'role' => 'profesor',
            'profesor_id' => $identificador
        ]);
        return redirect('profesores')->with('success', 'Profesor guardado correctamente. '. $request->nombre . ' [ Contraseña:  "12345678" ]');

    }
    public function ProfesoresCursos(){
        $profesores = Profesores::all();
        $cursos = Cursos::all();
        return view('Profesores.asignar_cursos', compact('profesores', 'cursos'));
        }

        public function RelacionarCursos(Request $request){
            $request->validate([
            'profesor_id'          =>  'required',
            'curso_id'          =>  'required'
        ]);
           $check = DB::table('profesores_cursos')->where('profesores_cursos.profesor_id', '=', $request->profesor_id)->where('profesores_cursos.curso_id', '=', $request->curso_id)->count();
           $respuesta = '';
           if ($check > 0) {
                $respuesta = 'Este profesor ya tiene relacionado el curso seleccionado';
           }else{
                $form_data = array(
                    'profesor_id'       =>   $request->profesor_id,
                    'curso_id'          =>   $request->curso_id
                );
                ProfesoresCursos::create($form_data);
                $c = Cursos::findOrFail($request->curso_id);
                $p = Profesores::whereid_user($request->profesor_id)->first();
                $respuesta = 'Dato insertado correctamente para el profesor: '. $p->nombre." |  Curso => ". $c->nombre;

           }

         return redirect('profesores-cursos')->with('respuesta', $respuesta);
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
        $profesor = Profesores::findOrfail($id);
        return view('Profesores.ver', compact('profesor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $profesor = Profesores::findOrfail($id);
        $usuario = $profesor->user;
        return view('Profesores.editar', compact('profesor', 'usuario'));
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
            'nombre'          =>  'required',
            'titulo'          =>  'required'
        ]);
        $form_data = array(
            'nombre'          =>   $request->nombre,
            'titulo'          =>   $request->titulo
        );

        Profesores::whereid_profe($id)->update($form_data);
        return redirect('profesores')->with('success', 'Datos editados correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $profesor = Profesores::findOrFail($id);
        $user = User::whereprofesor_id($profesor->id_user);
        $user->delete();
        $profesor->delete();
        return redirect('profesores')->with('success', 'Se eliminó el registro: '. $profesor->nombre);
    }
}
