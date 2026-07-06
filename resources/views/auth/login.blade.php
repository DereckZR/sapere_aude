@extends('adminlte::auth.auth-page')

@section('title', 'Inicio de sesión')

@section('auth_body')
    <form action="{{ route('login.verify') }}" method="post" autocomplete="off" class="container mx-auto">
        @csrf
        @method('POST')

        <x-form-input type="text" name="username" label="Nombre de usuario" :required="true"
            placeholder="Ingrese su nombre de usuario" />
        <x-form-input-password name="password" label="Contraseña" :required="true" placeholder="Ingrese su contraseña" />

        <button type="submit" class="btn btn-primary w-100">Iniciar sesión</button>
    </form>
@stop
