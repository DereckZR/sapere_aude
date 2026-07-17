@php
    $createUrl = route('transaction-categories.store');
    $updateUrl = route('transaction-categories.update', ['id' => ':id']);
@endphp

<x-form-modal :createUrl="$createUrl" :updateUrl="$updateUrl" title="Categoría de Transacción">
    <x-form-input name="name" label="Nombre" type="text" placeholder="Ingrese el nombre" />
    <x-form-input-area-text name="description" label="Descripción" placeholder="Ingrese la descripción" />
    <x-form-input-select name="type" label="Tipo de transacción" />
</x-form-modal>
