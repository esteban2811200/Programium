@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <h2 class="mt-4">Materias</h2>
            <div align="right">
                <a href="{{route('materias.index')}}" class="btn btn-primary btn-sm">Regresar</a>
              </div>
              <br>
                @if ($message = Session::get('success'))
                <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item active">Materias:  {{ $message }}</li>
                </ol>
                @endif
            <div class="row">
                  <div class="col-md-12">
                  <ul class="list-group">
                      <li class="list-group-item"><b>Nombre: </b> {{$materias->nombre}}</li>
                      <li class="list-group-item"><b>Descripción:  </b> {{$materias->descripcion}}</li>
                      <li class="list-group-item"><b>Titulo:  </b> {{$materias->estado}}</li>
                    </ul>

                  </div>
            </div>
        </div>
    </main>
@endsection
