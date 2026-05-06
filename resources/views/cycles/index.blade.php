@extends('adminlte::page')

@section('title', 'Ciclos')

@section('content_header')
    <h1>Ciclos</h1>
@stop

@section('body_data')
    data-module="cycles"
@endsection

@section('content')
    <button type="button" class="btn btn-primary mb-3" id="btnCreate">
        <i class="fas fa-plus"></i> Registrar ciclo
    </button>

    <table id="cyclesTable" class="table table-bordered table-striped" data-url="{{ route('cycles.getAll') }}">
        <thead>
            <tr>
                <th>#</th>
                <th>Fecha de inicio</th>
                <th>Fecha de cierre</th>
                <th>Acciones</th>
            </tr>
        </thead>
    </table>

    @include('cycles.partials.cycleModal')

@stop

@section('js')

@stop
