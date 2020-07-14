@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <h2 class="mt-4">Listado de Alumnos</h2>
            <div align="right">
                <a href="{{route('alumnos.create')}}" class="btn btn-primary btn-sm">Agregar alumno</a>
              {{--   <a href="{{route('alumnos.add_materias')}}" class="btn btn-warning btn-sm">Relacionar materias</a> --}}
              </div>
              <br>
                @if ($message = Session::get('success'))
                <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item active">{{ $message }}</li>
                </ol>
                @endif
            <div class="row">
                <div class="table-responsive">
                  <table class="table table-bordered table-bordered dataTable"  width="100%" cellspacing="0">
                      <thead class="thead-dark">
                      <tr>
                      <th>Nombre</th>
                      <th>Apellidos</th>
                      <th>Edad</th>
                      <th>Correo/Usuario</th>
                      <th>Opciones</th>
                      </tr>
                      </thead>
                      <tbody>
                    @foreach($alumnos as $row)
                    <tr>
                    <td>{{$row->nombre}}</td>
                    <td>{{$row->apellidos}}</td>
                    <td>{{$row->edad}}</td>
                    <td>{{ !empty($row->user) ? $row->user->email:'?' }}</td>
                    <td>
                    <form action="{{ route('alumnos.destroy', $row->id_alum) }}" method="post">
                    <a href="{{ route('alumnos.show', $row->id_alum) }}" class="btn btn-primary btn-sm">Ver</a>
                    <a href="{{ route('alumnos.edit', $row->id_alum) }}" class="btn btn-warning btn-sm">Editar</a>
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Borrar</button>
                    </form>
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
