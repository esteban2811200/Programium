@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <h2 class="mt-4">Asignar Materia a un Alumno</h2>
            <div align="right">
                <a href="{{route('alumnos.index')}}" class="btn btn-default btn-sm">Regresar</a>
              </div>
                @if ($message = Session::get('respuesta'))
                <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item active">{{ $message }}</li>
                </ol>
                @endif
              <br>
            <div class="row">
              <div class="col">
            <form method="post" action="{{ route('alumnos.relacionar_materias') }}">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="profesor_id">Listado de Alumnos</label>
                            <select class="form-control" id="alumno_id" name="alumno_id">
                                @foreach($alumnos as $a)
                                <option value="{{$a->id}}">{{$a->nombre}} {{$a->apellidos}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="materia_id">Listado de Materias</label>
                            <select class="form-control" id="materia_id" name="materia_id">
                                @foreach($materias as $m)
                                <option value="{{$m->id}}">{{$m->nombre}} {{$m->descripcion}}</option>
                                @endforeach
                            </select>
                        </div>

                    </div>
                   <button type="submit" name="add" value="Add" class="btn btn-primary">Agregar</button>
                </form>
              </div>
            </div>
        </div>
    </main>
@endsection
