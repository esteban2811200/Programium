@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <h2 class="mt-4">Listado de Profesores</h2>
            <div align="right">
                <a href="{{route('profesores.create')}}" class="btn btn-primary btn-sm">Agregar profesor</a>
              </div>
              <br>
                @if ($message = Session::get('success'))
                <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item active">Profesores:  {{ $message }}</li>
                </ol>
                @endif
            <div class="row">
                <div class="table-responsive">
                  <table class="table table-bordered table-bordered dataTable"  width="100%" cellspacing="0">
                      <thead class="thead-dark">
                      <tr>
                      <th>Nombre</th>
                      <th>Titulo</th>
                      <th>Correo/Usuario</th>
                      <th>Opciones</th>
                      </tr>
                      </thead>
                      <tbody>
                    @foreach($profesores as $row)
                    <tr>
                    <td>{{$row->nombre}}</td>
                    <td>{{$row->titulo}}</td>
                    <td>{{ !empty($row->user) ? $row->user->email:'?' }}</td>
                    <td>
                    <form action="{{ route('profesores.destroy', $row->id_profe) }}" method="post">
                    <a href="{{ route('profesores.show', $row->id_profe) }}" class="btn btn-primary btn-sm">Ver</a>
                    <a href="{{ route('profesores.edit', $row->id_profe) }}" class="btn btn-warning btn-sm">Editar</a>
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
