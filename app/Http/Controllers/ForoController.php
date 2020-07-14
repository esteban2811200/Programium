<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Foro;
use App\Cursos;
use App\Profesores;
use App\ForoRespuestas;
class ForoController extends Controller
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


        return view('Foro.foro');

    }

        public function listar($curso)
    {
        $foro = '';
        $curso = Cursos::findOrfail($curso);
        $foro = $curso->foro()->count();

        if (Auth::user()->role == 'profesor' && $foro == 0) {
            return view('Foro.crear', compact('curso'));
        }else{
            $foro = $curso->foro;
            $profesor = Profesores::whereid_user($foro->profesor_id)->first();
            $respuestas = $foro->respuestas;
            return view('Foro.foro', compact('curso', 'foro','profesor', 'respuestas'));
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $new_name = "";
        $file = $request->file('archivo');
        if(isset($file)){
            $request->validate([
                'archivo'               =>  'required|max:2048'
            ]);
        $new_name = rand() . '.' . $file->getClientOriginalExtension();
        $file->move(public_path('ForoFiles'), $new_name);
        }else{$new_name == "";}

        $request->validate([
            'contenido'          =>  'required',
            'curso'            =>  'required'
        ]);

        $form_data = array(
            'contenido'     =>    $request->contenido,
            'archivo'       =>    $new_name,
            'curso_id'      =>    $request->curso,
            'profesor_id'   =>    Auth::user()->profesor_id
        );
        Foro::create($form_data);
        return redirect('foro/'.$request->curso)->with('success', 'Foro iniciado correctamente');
    }
    public function respuestasInsert(Request $request){
        $request->validate([
            'contenido_r'          =>  'required',
            'foro'              =>  'required'
        ]);

        $form_data = array(
            'contenido_r'     =>    $request->contenido_r,
            'user_id'       =>      Auth::user()->id,
            'foro_id'      =>       $request->foro
        );
        ForoRespuestas::create($form_data);
        return redirect($request->url_response)->with('success', 'Respuesta guardada correctamente');

    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($curso)
    {
        $curso = Cursos::findOrFail($curso);
        $foro = $curso->foro;
        $profesor = Profesores::whereid_user($foro->profesor_id)->first();
        $respuestas = $foro->respuestas;
        return view('Foro.foro', compact('curso','foro','profesor', 'respuestas'));


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
