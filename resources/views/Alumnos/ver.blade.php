@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <h2 class="mt-4">Alumno</h2>
            <div align="right">
                <a href="{{route('alumnos.index')}}" class="btn btn-primary btn-sm">Regresar</a>
              </div>
              <br>
                @if ($message = Session::get('success'))
                <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item active">{{ $message }}</li>
                </ol>
                @endif
            <div class="row">
                  <div class="col-md-12">
                  <ul class="list-group">
                      <li class="list-group-item"><b>Nombre: </b> {{$alumno->nombre}}</li>
                      <li class="list-group-item"><b>Apellidos:  </b> {{$alumno->apellidos}}</li>
                      <li class="list-group-item"><b>Edad:  </b> {{$alumno->edad}}</li>
                    </ul>

                  </div>
            </div>
        </div>
    </main>
@endsection
