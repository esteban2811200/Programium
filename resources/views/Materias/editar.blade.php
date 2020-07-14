@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <h2 class="mt-4">Editar materia</h2>
            <div align="right">
                <a href="{{route('materias.index')}}" class="btn btn-default btn-sm">Regresar</a>
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
            <form method="post" action="{{ route('materias.update', $materia->id_mater) }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="nombre ">Nombre</label>
                            <input type="text" class="form-control" id="nombre " name="nombre" required value="{{$materia->nombre}}">
                        </div>
                        <div class="form-group col-md-6">
                            <label for="descripcion">Descripción</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion"  value="{{$materia->descripcion}}"required>
                        </div>
                        <div class="form-group col-md-2">
                            <label for="estado">Estado</label>
                            <select class="form-control" id="estado" name="estado">
                                <option value="{{$materia->estado}}">@if($materia->estado == 0)Inactivo @else Activo @endif</option>
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
