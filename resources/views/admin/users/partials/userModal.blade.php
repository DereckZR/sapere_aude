@php
    $createUrl = route('users.store');
    $updateUrl = route('users.update', ['id' => ':id']);
@endphp

<x-form-modal :createUrl="$createUrl" :updateUrl="$updateUrl" title="Usuario">
    <x-form-input-select name="member_id" label="Miembro" :required="true" />
    <p><span class="fw-bold">Usuario: </span></p>
    <x-form-input-select name="role_id" label="Rol" :required="true" />
    <x-form-input name="password" label="Contraseña" type="password" placeholder="Ingresa una contraseña" />
    <x-form-input name="password" label="Confirmar Contraseña" type="password" placeholder="Confirma la contraseña" />
</x-form-modal>
