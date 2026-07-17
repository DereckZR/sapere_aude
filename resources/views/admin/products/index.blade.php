@extends('adminlte::page')

@section('title', 'Productos')

@section('content_header')
    <h1>Productos</h1>
@stop

@section('body_data')
    data-module="products"
@endsection

@section('content')
    <button type="button" class="btn btn-primary mb-3" id="btnCreate" data-cycles-url="{{ route('members.getAllForSelect') }}">
        <i class="fas fa-plus"></i> Registrar producto
    </button>

    <div class="custom-control custom-switch mb-3">
        <input type="checkbox" class="custom-control-input" id="showDeleted" data-url="{{ route('products.getAllTrashed') }}">
        <label class="custom-control-label" for="showDeleted">Mostrar registros eliminados</label>
    </div>

    <table id="mainTable" class="table table-bordered table-striped table-hover" data-url="{{ route('products.getAll') }}"
        data-trashed-url="{{ route('products.getAllTrashed') }}"
        data-find-by-id-url="{{ route('products.findById', ['id' => ':id']) }}"
        data-restore-url="{{ route('products.restore', ['id' => ':id']) }}"
        data-delete-url="{{ route('products.delete', ['id' => ':id']) }}">
    </table>

    @include('admin.products.partials.productModal')
@stop
