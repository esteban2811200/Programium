@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <h2 class="mt-4">Crear nuevo alumno</h2>
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
            <form method="post" action="{{ route('alumnos.index') }}">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="nombre ">Nombre</label>
                            <input type="text" class="form-control" id="nombre " name="nombre" required>
                        </div>
                        <div class="form-group col-md-10">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" name="apellidos" required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="edad">Edad</label>
                            <input type="number" class="form-control" id="edad" name="edad" required>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="correo">Correo</label>
                            <input type="email" class="form-control" id="correo" name="correo" required>
                        </div>

                    </div>
                   <button type="submit" name="add" value="Add" class="btn btn-primary">Agregar</button>
                </form>
              </div>
            </div>
        </div>
    </main>
@endsection
