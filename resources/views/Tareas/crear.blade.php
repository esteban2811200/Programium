@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <h2 class="mt-4">Asignar una tarea al curso: <b>{{$curso->nombre}}</b></h2>
            <div align="right">
                <a href="{{url()->previous()}}" class="btn btn-default btn-sm">Regresar</a>
              </div>
                  @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
              <br>
            <div class="row">
              <div class="col">
            <form method="post" action="{{ route('tareas.index') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="nombre_tarea">Nombre</label>
                            <input type="text" class="form-control" id="nombre_tarea" name="nombre_tarea" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="descripcion_tarea">Descripción</label>
                            <textarea class="form-control" id="descripcion_tarea" name="descripcion_tarea" required></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="materia_id">Listado de las materias</label>
                            <select class="form-control" id="materia_id" name="materia_id" required>
                                @foreach($materias as $m)
                                <option value="{{$m->id_mater}}">{{$m->nombre}}{{$m->descripcion}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="fecha_plazo">Plazo / Hasta cuando habrá plazo de entrega</label>
                            <input type="date" name="fecha_plazo" class="form-control">
                        </div>
                    </div>
                    <input type="hidden" name="curso" value="{{$curso->id_curso}}">
                    <input type="hidden" name="url" value="{{url()->previous()}}">
                   <button type="submit" name="add" value="Add" class="btn btn-primary">Agregar</button>
                </form>
              </div>
            </div>
        </div>
    </main>
@endsection
