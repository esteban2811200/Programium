@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <h2 class="mt-4">Iniciar un foro</h2>
            <div align="right">
                <a href="{{route('foro.index')}}" class="btn btn-default btn-sm">Regresar</a>
              </div>
                  @if($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
              <br>
            <div class="row">
              <div class="col">
            <form method="post" action="{{ route('foro.index') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="contenido">Iniciar el foro</label>
                            <textarea class="form-control" name="contenido" id="contenido" placeholder="Escribe un mensaje para el curso."></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="archivo">Subir un archivo</label>
                            <input type="file" name="archivo" id="archivo">
                        </div>
                    </div>
                    <input type="hidden" name="curso" id="curso" value="{{$curso->id_curso}}">
                    <input type="hidden" name="url" value="{{Request::url()}}">
                   <button type="submit" name="add" value="Add" class="btn btn-primary">Enviar</button>
                </form>
              </div>
            </div>
        </div>
    </main>
@endsection
