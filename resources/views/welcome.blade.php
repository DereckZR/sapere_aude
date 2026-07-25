@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('body_data')
    data-module="dashboard"
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-sm-3">
                <a href="{{ route('transactions.index') }}" class="btn btn-primary mb-3">
                    <i class="fas fa-plus"></i> Añadir Transacción
                </a>
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-6">
                <h2 style="font-size: 24px;">Últimas transacciones</h2>

                <table id="tableTransactions" class="table table-bordered table-striped table-hover"
                data-url="{{ route('transactions.getLatest') }}"></table>
            </div>
        </div>
    </div>
@stop
