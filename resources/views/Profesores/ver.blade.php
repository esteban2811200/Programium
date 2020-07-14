@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <h2 class="mt-4">Profesor</h2>
            <div align="right">
                <a href="{{route('profesores.index')}}" class="btn btn-primary btn-sm">Regresar</a>
              </div>
              <br>
                @if ($message = Session::get('success'))
                <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item active">Equipo:  {{ $message }}</li>
                </ol>
                @endif
            <div class="row">
                  <div class="col-md-12">
                  <ul class="list-group">
                      <li class="list-group-item"><b>Nombre: </b> {{$profesor->nombre}}</li>
                      <li class="list-group-item"><b>Titulo:  </b> {{$profesor->titulo}}</li>
                      <li class="list-group-item"><b>Correo:  </b> {{ !empty($profesor->user) ? $profesor->user->email:'?' }}</li>
                    </ul>

                  </div>
            </div>
        </div>
    </main>
@endsection
