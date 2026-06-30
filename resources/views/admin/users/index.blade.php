@extends('adminlte::page')

@section('title', 'Usuarios')

@section('content_header')
    <h1>Usuarios</h1>
@stop

@section('body_data')
    data-module="users"
@endsection

@section('content')
    <button type="button" class="btn btn-primary mb-3" id="btnCreate" data-members-url="{{ route('members.getAllForSelect') }}" data-roles-url="{{ route('roles.getAllForSelect') }}">
        <i class="fas fa-plus"></i> Registrar usuario
    </button>

    <div class="custom-control custom-switch mb-3">
        <input type="checkbox" class="custom-control-input" id="showDeleted" data-url="{{ route('users.getAllTrashed') }}">
        <label class="custom-control-label" for="showDeleted">Mostrar registros eliminados</label>
    </div>

    <table id="mainTable" class="table table-bordered table-striped table-hover" data-url="{{ route('users.getAll') }}"
        data-trashed-url="{{ route('users.getAllTrashed') }}">
    </table>
@stop
