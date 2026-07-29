@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

{{-- @section('body_data')
    data-module="dashboard"
@endsection --}}

@section('content')
    <button type="button" class="btn btn-primary mb-3" id="btnCreate" data-members-url="{{ route('members.getAllForSelect') }}"
        data-transaction-categories-url="{{ route('transaction-categories.getAllForSelect') }}"
        data-cycles-url="{{ route('cycles.getAllForSelect') }}">
        <i class="fas fa-plus"></i> Registrar transacción
    </button>

    <div class="container">
        <div class="row">
            <div class="col">
                <h2 style="font-size: 24px;">Últimas transacciones</h2>

                <table id="tableTransactions" class="table table-bordered table-striped table-hover"
                    data-url="{{ route('transactions.getLatest') }}"></table>

                <div class="w-100 mt-2 d-flex justify-content-center">
                    <a href="{{ route('transactions.index') }}" class="btn btn-primary">
                        <i class="fas fa-eye"></i> Ver más transacciones
                    </a>
                </div>
            </div>
        </div>
    </div>

    @include('admin.transactions.partials.transactionModal')
@stop
