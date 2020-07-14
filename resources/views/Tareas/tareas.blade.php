@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <h2 class="mt-4">@auth @if (auth()->user()->role != 'administrador') Tus Tareas @else Listado de materias @endif @endauth</h2>
            <div align="right">
              @auth
              @if (auth()->user()->role == 'profesor')
                <a href="{{route('tareas.create')}}" class="btn btn-primary btn-sm">Agregar Tarea</a>
                @endif
                @endauth
              </div>
              <br>
                @if ($message = Session::get('success'))
                <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item active">Tareas:  {{ $message }}</li>
                </ol>
                @endif
            <div class="row">
                <div class="table-responsive">
                  <table class="table table-bordered table-bordered dataTable"  width="100%" cellspacing="0">
                      <thead class="thead-dark">
                      <tr>
                      <th>Nombre</th>
                      <th>Descripcion</th>
                      <th>Fecha</th>
                      <th>Curso</th>
                      <th></th>
                      </tr>
                      </thead>
                      <tbody>
                    @foreach($tareas as $row)
                    <tr>
                    <td>{{$row->nombre_tarea}}</td>
                    <td>{{$row->descripcion_tarea}}</td>
                    <td>{{$row->fecha_plazo}}</td>
                    <th>{{ !empty($row->curso) ? $row->curso->nombre:'?' }}</th>
                    <td>
                    @auth
                    @if (auth()->user()->role == 'profesor')
                    <form action="{{ route('tareas.destroy', $row->id_tarea) }}" method="post">
                    <a href="{{ route('tareas.show', $row->id_tarea) }}" class="btn btn-primary btn-sm">Ver</a>
                    <a href="{{ route('tareas.edit', $row->id_tarea) }}" class="btn btn-warning btn-sm">Editar</a>
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
