@php
    $createUrl = route('cycles.store');
    $updateUrl = route('cycles.update', ['id' => ':id']);
@endphp

<x-form-modal :createUrl="$createUrl" :updateUrl="$updateUrl" title="Ciclo">
    <x-form-input name="start_date" label="Fecha de inicio" type="date" />
    <x-form-input name="end_date" label="Fecha de cierre" type="date" />
</x-form-modal>
