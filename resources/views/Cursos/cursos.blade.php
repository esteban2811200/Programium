@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <h2 class="mt-4">@auth @if (auth()->user()->role != 'administrador') Cursos a los que perteneces @else Listado de cursos @endif @endauth</h2>
            <div align="right">
                @auth
                 @if (auth()->user()->role == 'administrador')
                <a href="{{route('cursos.create')}}" class="btn btn-primary btn-sm">Agregar Nuevo Curso</a><br><br>
                <a href="{{route('cursos.add_alumnos')}}" class="btn btn-warning btn-sm">Asignar Cursos Alumno</a>
                <a href="{{ route('profesores.add_cursos') }}" class="btn btn-success btn-sm">Asignar Cursos Profesor</a>
                @endif
                @endauth
              </div>
              <br>
                @if ($message = Session::get('success'))
                <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item active">Cursos:  {{ $message }}</li>
                </ol>
                @endif
            <div class="row">
                <div class="table-responsive">
                  <table class="table table-bordered table-bordered dataTable"  width="100%" cellspacing="0">
                      <thead class="thead-dark">
                      <tr>
                      <th>nombre</th>
                      <th>descripcion</th>
                      <th>nivel</th>
                      <th>Estado</th>
                      <th>Tareas</th>
                      <th>Foro</th>
                      <th></th>
                      </tr>
                      </thead>
                      <tbody>
                    @foreach($cursos as $row)
                    <tr>
                    <td>{{$row->nombre}}</td>
                    <td>{{$row->descripcion}}</td>
                    <td>{{$row->nivel}}</td>
                    <td>@if($row->estado == 0)Inactivo @else Activo @endif</td>
                    <td><a href="{{ route('tareas.show', $row->id_curso) }}" class="btn btn-primary btn-sm">Tareas</a></td>
                    <td><a href="{{ route('foro.listar', $row->id_curso) }}" class="btn btn-primary btn-sm">Foro</a></td>
                    <td>
                    @auth
                    @if (auth()->user()->role != 'alumno')
                    <form action="{{ route('cursos.destroy', $row->id_curso) }}" method="post">
                    <a href="{{ route('cursos.show', $row->id_curso) }}" class="btn btn-primary btn-sm">Ver</a>
                    <a href="{{ route('cursos.edit', $row->id_curso) }}" class="btn btn-warning btn-sm">Editar</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                    </form>
                    @endif
                    @endauth
                    </td>
                    </tr>
                    @endforeach
                      </tbody>
                  </table>
              </div>
            </div>
        </div>
    </main>
@endsection
