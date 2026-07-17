@extends('adminlte::page')

@section('title', 'Categorías de Transacción')

@section('content_header')
    <h1>Categorías de Transacción</h1>
@stop

@section('body_data')
    data-module="transaction-categories"
@endsection

@section('content')
    <button type="button" class="btn btn-primary mb-3" id="btnCreate" data-cycles-url="{{ route('members.getAllForSelect') }}">
        <i class="fas fa-plus"></i> Registrar categoría de transacción
    </button>

    <div class="custom-control custom-switch mb-3">
        <input type="checkbox" class="custom-control-input" id="showDeleted"
            data-url="{{ route('transaction-categories.getAllTrashed') }}">
        <label class="custom-control-label" for="showDeleted">Mostrar registros eliminados</label>
    </div>

    <table id="mainTable" class="table table-bordered table-striped table-hover"
        data-url="{{ route('transaction-categories.getAll') }}"
        data-trashed-url="{{ route('transaction-categories.getAllTrashed') }}"
        data-find-by-id-url="{{ route('transaction-categories.findById', ['id' => ':id']) }}"
        data-restore-url="{{ route('transaction-categories.restore', ['id' => ':id']) }}"
        data-delete-url="{{ route('transaction-categories.delete', ['id' => ':id']) }}">
    </table>

    @include('admin.transactionCategories.partials.transactionCategoryModal')
@stop
