@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <h2 class="mt-4">Editar Curso</h2>
            <div align="right">
                <a href="{{route('cursos.index')}}" class="btn btn-default btn-sm">Regresar</a>
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
            <form method="post" action="{{ route('cursos.update', $curso->id_curso) }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-row">
                        <div class="form-group col-md-3">
                            <label for="nombre ">Nombre</label>
                            <input type="text" class="form-control" id="nombre " name="nombre" required value="{{$curso->nombre}}">
                        </div>
                        <div class="form-group col-md-5">
                            <label for="descripcion">Descripción</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion"  value="{{$curso->descripcion}}"required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="nivel">Nivel</label>
                            <select class="form-control" id="nivel" name="nivel">
                                <option value="{{$curso->nivel}}">{{$curso->nivel}}</option>
                                <option value="Principiante">Principiante</option>
                                <option value="Intermedio">Intermedio</option>
                                <option value="Avanzado">Avanzado</option>
                            </select>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="estado">Estado</label>
                            <select class="form-control" id="estado" name="estado">
                                <option value="{{$curso->estado}}">@if($curso->estado == 0)Inactivo @else Activo @endif</option>
                                <option value="1">Activo</option>
                                <option value="0">Inactivo</option>
                            </select>
                        </div>

                    </div>
                   <button type="submit" name="add" value="Add" class="btn btn-primary">Actualizar</button>
                </form>
              </div>
            </div>
        </div>
    </main>
@endsection
