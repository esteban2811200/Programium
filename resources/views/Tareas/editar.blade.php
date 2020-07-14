@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <h2 class="mt-4">Editar tarea</h2>
            <div align="right">
                <a href="{{ url()->previous()}}" class="btn btn-default btn-sm">Regresar</a>
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
            <form method="post" action="{{ route('tareas.update', $tarea->id_tarea) }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="nombre_tarea">Nombre</label>
                            <input type="text" class="form-control" id="nombre_tarea" name="nombre_tarea" required value="{{$tarea->nombre_tarea}}">
                        </div>
                        <div class="form-group col-md-12">
                            <label for="descripcion_tarea">Descripción</label>
                            <textarea class="form-control" id="descripcion_tarea" name="descripcion_tarea" required>{{$tarea->descripcion_tarea}}</textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="fecha_plazo">Plazo / Hasta cuando habrá plazo de entrega</label>
                            <input type="date" name="fecha_plazo" class="form-control" value="{{$tarea->fecha_plazo}}">
                        </div>
                    </div>
                    <input type="hidden" name="url" value="{{url()->previous()}}">
                   <button type="submit" name="add" value="Add" class="btn btn-primary">Actualizar</button>
                </form>
              </div>
            </div>
        </div>
    </main>
@endsection
