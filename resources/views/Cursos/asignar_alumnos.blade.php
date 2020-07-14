@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <h2 class="mt-4">Asignar alumno a un curso</h2>
            <div align="right">
                <a href="{{route('cursos.index')}}" class="btn btn-default btn-sm">Regresar</a>
              </div>
                @if ($message = Session::get('respuesta'))
                <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item active">{{ $message }}</li>
                </ol>
                @endif
              <br>
            <div class="row">
              <div class="col">
            <form method="post" action="{{ route('cursos.relacionar_alumnos') }}">
                    @csrf

                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="profesor_id">Listado de alumnos</label>
                            <select class="form-control" id="alumno_id" name="alumno_id">
                                @foreach($alumnos as $a)
                                <option value="{{$a->id_user}}">{{$a->nombre}} {{$a->apellidos}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="curso_id">Listado de cursos</label>
                            <select class="form-control" id="curso_id" name="curso_id">
                                @foreach($cursos as $c)
                                <option value="{{$c->id_curso}}">{{$c->nombre}} {{$c->descripcion}}</option>
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
