@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <h2 class="mt-4">Foro | {{$curso->nombre}}</h2>

              <br>
                @if ($message = Session::get('success'))
                <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item active">{{ $message }}</li>
                </ol>
                @endif
            <div class="row">
              <div class="col-md-12">
                <div class="card">
                <h5 class="card-header">{{$curso->nombre}}</h5>
                <div class="card-body">
                  <h5 class="card-title">{{$foro->contenido}}</h5>
                  <p class="card-text">Publicado: <a href="">{{date('d-m-Y H:m', strtotime($foro->created_at))}} Por: <a href="#">{{$profesor->nombre}}</a> </p>
                  @if ($foro->archivo != '')
                  <a class="btn btn-primary" download="descarga" href="{{ URL::to('/') }}/ForoFiles/{{ $foro->archivo }}">Descargar</a>
                  @endif
                  <div align="right">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#responder">
                  Responder
                </button>
                  </div>
                </div>
              </div>
                @include('Foro.ModalResponder')
              </div>
                <div class="col-md-12">
                {{-- respuestas --}}
                @if ($respuestas != '')
                @foreach($respuestas as $r)
                  <div class="card">
                  <div class="card-header">
                    {{$r->user->name}}
                  </div>
                  <div class="card-body">
                    <blockquote class="blockquote mb-0">
                      <p>{{$r->contenido_r}}</p>
                      <footer class="blockquote-footer">Publicado <cite title="Source Title">{{date('d-m-Y H:m', strtotime($foro->created_at))}}</cite></footer>
                    </blockquote>
                  </div>
                </div>
                @endforeach
                @endif
                </div>
            </div>
        </div>
    </main>
@endsection
