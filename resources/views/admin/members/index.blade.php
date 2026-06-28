@extends('adminlte::page')

@section('title', 'Miembros')

@section('content_header')
    <h1>Miembros</h1>
@stop

@section('body_data')
    data-module="members"
@endsection

@section('content')
    <button type="button" class="btn btn-primary mb-3" id="btnCreate" data-cycles-url="{{ route('cycles.getAllForSelect') }}">
        <i class="fas fa-plus"></i> Registrar miembro
    </button>

    <div class="custom-control custom-switch mb-3">
        <input type="checkbox" class="custom-control-input" id="showDeleted" data-url="{{ route('members.getAllTrashed') }}">
        <label class="custom-control-label" for="showDeleted">Mostrar registros eliminados</label>
    </div>

    <table id="mainTable" class="table table-bordered table-striped table-hover" data-url="{{ route('members.getAll') }}"
        data-trashed-url="{{ route('members.getAllTrashed') }}">
    </table>

    @include('admin.members.partials.memberModal')
@stop
