@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <h2 class="mt-4">Profesor</h2>
            <div align="right">
                <a href="{{route('cursos.index')}}" class="btn btn-primary btn-sm">Regresar</a>
              </div>
              <br>
                @if ($message = Session::get('success'))
                <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item active">Cursos:  {{ $message }}</li>
                </ol>
                @endif
            <div class="row">
                  <div class="col-md-12">
                  <ul class="list-group">
                      <li class="list-group-item"><b>Nombre: </b> {{$curso->nombre}}</li>
                      <li class="list-group-item"><b>Descripción:  </b> {{$curso->descripcion}}</li>
                      <li class="list-group-item"><b>Nivel:  </b> {{$curso->nivel}}</li>
                      <li class="list-group-item"><b>Estado:  </b> @if($curso->estado == 0)Inactivo @else Activo @endif</li>
                    </ul>

                  </div>
            </div>
        </div>
    </main>
@endsection
