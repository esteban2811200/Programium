@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <h2 class="mt-4">@auth @if (auth()->user()->role != 'administrador') Tus materias @else Listado de materias @endif @endauth</h2>
            <div align="right">
              @auth
              @if (auth()->user()->role == 'administrador')
                <a href="{{route('materias.create')}}" class="btn btn-primary btn-sm">Agregar Materia</a>
                @endif
                @endauth
              </div>
              <br>
                @if ($message = Session::get('success'))
                <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item active">Materias:  {{ $message }}</li>
                </ol>
                @endif
            <div class="row">
                <div class="table-responsive">
                  <table class="table table-bordered table-bordered dataTable"  width="100%" cellspacing="0">
                      <thead class="thead-dark">
                      <tr>
                      <th>nombre</th>
                      <th>descripcion</th>
                      <th>estado</th>
                      <th></th>
                      </tr>
                      </thead>
                      <tbody>
                    @foreach($materias as $row)
                    <tr>
                    <td>{{$row->nombre}}</td>
                    <td>{{$row->descripcion}}</td>
                    <td>@if($row->estado == 0)Inactivo @else Activo @endif</td>
                    <td>
                    @auth
                    @if (auth()->user()->role == 'administrador')
                    <form action="{{ route('materias.destroy', $row->id) }}" method="post">
                    <a href="{{ route('materias.show', $row->id) }}" class="btn btn-primary btn-sm">Ver</a>
                    <a href="{{ route('materias.edit', $row->id) }}" class="btn btn-warning btn-sm">Editar</a>
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
