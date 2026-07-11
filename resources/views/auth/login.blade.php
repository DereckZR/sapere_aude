@extends('adminlte::auth.auth-page')

@section('title', 'Inicio de sesión')

@section('auth_body')
    <div id="form" class="container mx-auto">
        <div id="loader" class="d-none overlay loader">
            <div class="text-center">
                <div class="spinner-border text-primary"></div>
                <div class="mt-2">Procesando...</div>
            </div>
        </div>

        <form action="{{ route('login.verify') }}" method="post" autocomplete="off">
            @csrf
            @method('POST')

            <div class="form-group">
                <label for="username">Nombre de usuario</label>
                <input type="text" class="form-control" name="username" id="username"
                    placeholder="Ingrese su nombre de usuario" required>
                <span class="invalid-feedback d-block">
                    @error('username')
                        {{ $message }}
                    @enderror
                </span>
            </div>


            <div class="form-group" id="password__container">
                <label for="password">Contraseña</label>
                <div class="input-group input-password__container">
                    <input type="password" class="form-control input-password" name="password" id="password"
                        placeholder="Ingrese su contraseña" required>
                    <button class="btn btn-outline-secondary input-password__toggle-btn" type="button">
                        <i class="fas fa-eye fa-fw"></i>
                    </button>
                </div>
                <span class="invalid-feedback d-block">
                    @error('password')
                        {{ $message }}
                    @enderror
                </span>
            </div>

            @if ($errors->has('login'))
                <div class="alert alert-danger">
                    {{ $errors->first('login') }}
                </div>
            @endif

            <button type="submit" id="btnSubmit" class="btn btn-primary w-100">Iniciar sesión</button>
        </form>
    </div>
@stop

@push('js')
    @vite('resources/js/modules/auth/index.js')
@endpush
