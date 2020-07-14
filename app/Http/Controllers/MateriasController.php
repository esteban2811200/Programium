<?php

namespace App\Http\Controllers;
use App\Materias;
use Illuminate\Http\Request;

class MateriasController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $materias = Materias::all();
        return view('Materias.materias', compact('materias'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('Materias.crear');
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
            'estado'       =>  'required'
        ]);

        $form_data = array(
            'nombre'        =>   $request->nombre,
            'descripcion'   =>   $request->descripcion,
            'estado'        =>   $request->estado
        );

        Materias::create($form_data);
        return redirect('materias')->with('success', 'Materia guardada correctamente. '. $request->nombre);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $materias = Materias::findOrfail($id);
        return view('Materias.ver', compact('materias'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $materia = Materias::findOrfail($id);
        return view('Materias.editar', compact('materia'));
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
            'estado'       =>  'required'
        ]);

        $form_data = array(
            'nombre'        =>   $request->nombre,
            'descripcion'   =>   $request->descripcion,
            'estado'        =>   $request->estado
        );

        Materias::whereid_mater($id)->update($form_data);
        return redirect('materias')->with('success', 'Materia editada correctamente. ' . $request->nombre);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $materia = Materias::findOrFail($id);
        $materia->delete();
        return redirect('cursos')->with('success', 'Se eliminó la Materia: '. $materia->nombre);
    }
}
