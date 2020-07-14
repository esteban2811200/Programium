@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <h2 class="mt-4">Tareas en el curso: <b>{{$curso->nombre}}</b></h2>
            <div align="right">
                <a href="{{route('cursos.index')}}" class="btn btn-primary btn-sm">Regresar</a>
              </div>
              <br>
              @if ($message = Session::get('success'))
                <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item active">Tareas:  {{ $message }}</li>
                </ol>
                @endif

            <div class="row">
                  <div class="col-md-12">
                  <div align="right">
                    @auth
                    @if (auth()->user()->role == 'profesor')
                  <a href="{{route('tareas.create', $curso->id_curso)}}" class="btn btn-success btn-sm">Agregar una tarea a este curso</a>
                  @endif
                  @endauth
                </div>
                <br>
                  <table class="table table-bordered table-bordered dataTable"  width="100%" cellspacing="0">
                      <thead class="thead-dark">
                      <tr>
                      <th>Nombre</th>
                      <th>Descripcion</th>
                      <th>Plazo</th>
                      <th>Curso</th>
                      <th>Materia</th>
                      <th>Profesor</th>
                      <th>Estado</th>
                      <th></th>
                      <th></th>
                      </tr>
                      </thead>
                      <tbody>
                    @foreach($tareas as $row)
                    @if (date('Y-m-d') <= $row->fecha_plazo)
                    <tr>
                    <td>{{$row->nombre_tarea}}</td>
                    <td>{{$row->descripcion_tarea}}</td>
                    <td>{{date('d-M-Y', strtotime($row->fecha_plazo))}}</td>
                    <th>{{ !empty($row->curso) ? $row->curso->nombre:'?' }}</th>
                    <th>{{ !empty($row->materia) ? $row->materia->nombre:'?' }}</th>
                    <th>{{ !empty($row->profesor) ? $row->profesor->nombre:'?' }}</th>
                    <td>@if (date('Y-m-d') > $row->fecha_plazo) Vencida @else Activa @endif</td>
                    @if (auth()->user()->role == 'alumno')
                    <td><a href="{{ route('tareas.detalles', $row->id_tarea) }}" class="btn btn-success btn-sm">Subir evidencia</a></td>
                    @else
                    <td><a href="{{ route('tareas.alumnos_completada', $row->id_tarea) }}" class="btn btn-success btn-sm">Detalles</a></td>
                    @endif
                    <td>
                    @auth
                    @if (auth()->user()->role == 'profesor')
                    <form action="{{ route('tareas.destroy', $row->id_tarea) }}" method="post">
                    <a href="{{ route('tareas.edit', $row->id_tarea) }}" class="btn btn-warning btn-sm">Editar</a>
                    @csrf
                    @method('DELETE')
                    <input type="hidden" name="url" value="{{url()->current()}}">
                    <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                    </form>
                    @endif
                    @endauth
                    </td>
                    </tr>
                    @endif
                    @endforeach
                      </tbody>
                  </table>

                  </div>
            </div>
        </div>
    </main>
@endsection
