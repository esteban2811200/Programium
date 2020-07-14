@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <h2 class="mt-4">Editar Datos del alumno</h2>
            <div align="right">
                <a href="{{route('alumnos.index')}}" class="btn btn-default btn-sm">Regresar</a>
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
            <form method="post" action="{{ route('alumnos.update', $alumno->id_alum) }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="nombre ">Nombre </label>
                            <input type="text" class="form-control" id="nombre " name="nombre" value="{{$alumno->nombre}}" required>
                        </div>
                        <div class="form-group col-md-10">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos"
                            value="{{$alumno->apellidos}}" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="edad">Edad</label>
                            <input type="text" class="form-control" id="edad" name="edad"
                            value="{{$alumno->edad}}" required>
                        </div>


                    </div>
                   <button type="submit" name="add" value="Add" class="btn btn-primary">Actualizar</button>
                </form>
              </div>
            </div>
        </div>
    </main>
@endsection
