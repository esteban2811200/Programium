@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <h2 class="mt-4">Editar Datos del profesor</h2>
            <div align="right">
                <a href="{{route('profesores.index')}}" class="btn btn-default btn-sm">Regresar</a>
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
            <form method="post" action="{{ route('profesores.update', $profesor->id_profe) }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="nombre ">Nombre </label>
                            <input type="text" class="form-control" id="nombre " name="nombre" value="{{$profesor->nombre}}" required>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="titulo">Título</label>
                            <input type="text" class="form-control" id="titulo" name="titulo"
                            value="{{$profesor->titulo}}" required>
                        </div>


                    </div>
                   <button type="submit" name="add" value="Add" class="btn btn-primary">Actualizar</button>
                </form>
              </div>
            </div>
        </div>
    </main>
@endsection
