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

    <div class="custom-control custom-switch mb-3">
        <input type="checkbox" class="custom-control-input" id="showDeleted" data-url="{{ route('cycles.getAllTrashed') }}">
        <label class="custom-control-label" for="showDeleted">Mostrar registros eliminados</label>
    </div>

    <table id="mainTable" class="table table-bordered table-striped table-hover" data-url="{{ route('cycles.getAll') }}"
        data-deleted-url="{{ route('cycles.getAllTrashed') }}">
    </table>

    @include('admin.cycles.partials.cycleModal')
@stop
