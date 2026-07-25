@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-3">
                <a href="{{ route('transactions.index') }}" class="btn btn-primary mb-3">
                    <i class="fas fa-plus"></i> Añadir Transacción
                </a>
            </div>
        </div>
    </div>
@stop
