@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <h2 class="mt-4">Subir evidencia de la tarea</h2>
            <div align="right">
                <a href="{{url()->previous()}}" class="btn btn-primary btn-sm">Regresar</a>
              </div>
              <br>
                @if ($message = Session::get('success'))
                <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item"> {{ $message }}</li>
                </ol>
                @endif
            <div class="row">
                  <div class="col-md-12">
                  <ul class="list-group">
                    @if (date('Y-m-d') > $tarea->fecha_plazo)
                    <li class="list-group-item"><b>Lo sentimos mucho esta tarea ya cumplió su plazo de entrega.</b></li>
                    @else

                      <li class="list-group-item"><b>Nombre: </b> {{$tarea->nombre_tarea}}</li>
                      <li class="list-group-item"><b>Descripción:  </b> {{$tarea->descripcion_tarea}}</li>
                      <li class="list-group-item"><b>Vence:  </b> {{date('d-M-Y', strtotime($tarea->fecha_plazo))}}</li>
                        <li class="list-group-item"><b>Estado: </b> @if (date('Y-m-d') > $tarea->fecha_plazo) Vencida @else Activa @endif</li>
                        <li class="list-group-item"><b>Materia: </b> {{ !empty($tarea->materia) ? $tarea->materia->nombre:'?' }}</li>
                        <li class="list-group-item"><b>Profesor: </b> {{ !empty($tarea->profesor) ? $tarea->profesor->nombre:'?' }}</li>
                        @if ($check != '')
                        <li class="list-group-item"><b>Evidencia: </b> <a download="{{ $check->evidencia }}" href="{{ URL::to('/') }}/EvidenciasTareas/{{ $check->evidencia }}">Descargar</a><br>
                           <object data="{{ URL::to('/') }}/EvidenciasTareas/{{ $check->evidencia }}" width="100" height="100"></object>
                        </li>
                        @endif
                      <li class="list-group-item">
                        @if (date('Y-m-d') <= $tarea->fecha_plazo)
                        @if ($check != '')
                        <form method="post" enctype="multipart/form-data" action="{{route('tareas.actualizar', $check->id)}}">
                          @csrf
                          @method('PATCH')
                          <div class="form-row">
                            <div class="form-group col-md-6">
                            <label for="evidencia">Seleccione un archivo</label>
                            <br>
                            <input type="file" class="form-control" id="evidencia" name="evidencia" required value="{{ URL::to('/') }}/EvidenciasTareas/{{ $check->evidencia }}">
                            <input type="hidden" name="hidden_file" value="{{ $check->evidencia }}" />
                            <button type="submit" name="add" value="Add" class="btn btn-success">Actualizar evidencia</button><br>
                            <input type="hidden" name="url" value="{{ url()->current()}}">
                            </div>
                          </div>
                          @else

                        <form method="post" enctype="multipart/form-data" action="{{route('tareas.enviar')}}">
                            @csrf
                          <div class="form-row">
                            <div class="form-group col-md-6">
                         <input type="hidden" name="tarea_id" value="{{$tarea->id_tarea}}">
                         <input type="hidden" name="alumno_id" value="{{ auth()->user()->alumno_id }}">
                            <label for="evidencia">Seleccione un archivo</label>
                            <input type="file" class="form-control" id="evidencia" name="evidencia" required>
                            <button type="submit" name="add" value="Add" class="btn btn-success">Subir evidencia</button>
                            <input type="hidden" name="url" value="{{ url()->current()}}">
                            </div>
                          </div>
                          </form>
                          @endif
                        </form>
                      @endif
                      </li>
                      @endif
                    </ul>

                  </div>
            </div>
        </div>
    </main>
@endsection
