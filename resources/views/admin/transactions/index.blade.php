@extends('adminlte::page')

@section('title', 'Transacciones')

@section('content_header')
    <h1>Transacciones</h1>
@stop

@section('body_data')
    data-module="transactions"
@endsection

@section('content')
    <button type="button" class="btn btn-primary mb-3" id="btnCreate" data-members-url="{{ route('members.getAllForSelect') }}"
        data-transaction-categories-url="{{ route('transaction-categories.getAllForSelect') }}"
        data-cycles-url="{{ route('cycles.getAllForSelect') }}">
        <i class="fas fa-plus"></i> Registrar transacción
    </button>

    <div class="custom-control custom-switch mb-3">
        <input type="checkbox" class="custom-control-input" id="showDeleted"
            data-url="{{ route('transactions.getAllTrashed') }}">
        <label class="custom-control-label" for="showDeleted">Mostrar registros eliminados</label>
    </div>

    <table id="mainTable" class="table table-bordered table-striped table-hover"
        data-url="{{ route('transactions.getAll') }}" data-trashed-url="{{ route('transactions.getAllTrashed') }}"
        data-find-by-id-url="{{ route('transactions.findById', ['id' => ':id']) }}"
        data-restore-url="{{ route('transactions.restore', ['id' => ':id']) }}"
        data-delete-url="{{ route('transactions.delete', ['id' => ':id']) }}">
    </table>

    @include('admin.transactions.partials.transactionModal')
@stop
