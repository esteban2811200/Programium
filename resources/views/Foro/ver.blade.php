@extends('layouts.app')
@section('content')
    <main>
        <div class="container-fluid">
            <h2 class="mt-4">Foro de discución</h2>
            <div align="right">
                <a href="{{route('foro.index')}}" class="btn btn-primary btn-sm">Regresar</a>
              </div>
              <br>
                @if ($message = Session::get('success'))
                <ol class="breadcrumb mb-4">
                  <li class="breadcrumb-item active">Cursos:  {{ $message }}</li>
                </ol>
                @endif
            <div class="row">
                  <div class="col-md-12">


                  </div>
            </div>
        </div>
    </main>
@endsection
