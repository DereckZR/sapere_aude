@php
    $createUrl = route('transactions.store');
    $updateUrl = route('transactions.update', ['id' => ':id']);
@endphp

<x-form-modal :createUrl="$createUrl" :updateUrl="$updateUrl" title="Transacción">
    {{-- <x-form-input-select name="transaction_category_id" label="Categoría" />
    <x-form-input-number name="amount" label="Monto" value="1" :isDecimal="true"
        placeholder="Ingrese el monto de la transacción" />
    <x-form-input-select name="is_cash" label="Es efectivo" />
    <x-form-input name="transaction_date" label="Fecha" type="date" :value="now()->format('Y-m-d')" />
    <x-form-input-area-text name="description" label="Descripción (opcional)" :required="false"
        placeholder="Ingrese la descripción" />
    <x-form-input-select name="responsible_member_id" label="Miembro responsable" />
    <x-form-input-select name="cycle_id" label="Ciclo" /> --}}
</x-form-modal>
