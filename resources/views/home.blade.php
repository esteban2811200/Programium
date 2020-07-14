@extends('layouts.app')

@section('content')
    <main>
        <div class="container-fluid">
            <h2 class="mt-4">Hola! @auth {{ auth()->user()->name }} @else Invitado @endauth</h2>
            <ol class="breadcrumb mb-4">
                <li class="breadcrumb-item active">{{ config('app.local', 'Programium') }}</li>
            </ol>
            <div class="row">

            </div>
        </div>
    </main>
@endsection
@section('scripts')
<script type="text/javascript">
$(document).ready(function(){


});

</script>
@endsection('scripts')