@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <h2 class="mt-4">Entrega de la tarea: <b>{{$tarea->nombre_tarea}}</b></h2>
            <div align="right">
                <a href="{{url()->previous()}}" class="btn btn-primary btn-sm">Regresar</a>
              </div>
              <br>


            <div class="row">
                  <div class="col-md-12">
                  <table class="table table-hover">
                      <thead>
                      <tr>
                      <th>Alumno</th>
                      <th>Estado de entrega</th>
                      <th>Evidencia</th>
                      </tr>
                      </thead>
                      <tbody>
                      @foreach($entrega as $q)
                      <tr>
                        <td>{{$q->nombre}} {{$q->apellidos}}</td>
                        <td>Entregado</td>
                        <td><a download="Evidencia{{ $q->evidencia }}" href="{{ URL::to('/') }}/EvidenciasTareas/{{ $q->evidencia }}" class="btn btn-default">Descargar</a></td>
                      </tr>
                      @endforeach
                      </tbody>
                  </table>

                  </div>
            </div>
        </div>
    </main>
@endsection
