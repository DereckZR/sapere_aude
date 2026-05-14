@php
    $createUrl = route('members.store');
    $updateUrl = route('members.update', ['id' => ':id']);
@endphp

<x-form-modal :createUrl="$createUrl" :updateUrl="$updateUrl" title="Miembro">
    <x-form-input name="first_name" label="Nombre" type="text" placeholder="Ingrese el nombre" />
    <x-form-input name="last_name" label="Apellido" type="text" placeholder="Ingrese el apellido" />
    <x-form-input name="career" label="Carrera" type="text" placeholder="Ingrese la carrera" />
    <x-form-input name="phone_number" label="Teléfono" type="text" placeholder="Ingrese el teléfono" />
    <x-form-input name="birth_date" label="Fecha de nacimiento" type="date" />
    <x-form-input-select name="admission_cycle_id" label="Ciclo de ingreso" />
    <x-form-input-select name="last_active_cycle_id" label="Último ciclo activo" />
</x-form-modal>
