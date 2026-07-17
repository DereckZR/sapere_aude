@php
    $createUrl = route('products.store');
    $updateUrl = route('products.update', ['id' => ':id']);
@endphp

<x-form-modal :createUrl="$createUrl" :updateUrl="$updateUrl" title="Producto">
    <x-form-input name="name" label="Nombre" type="text" placeholder="Ingrese el nombre" />
    <x-form-input-area-text name="description" label="Descripción" placeholder="Ingrese la descripción" />
    <x-form-input-number name="price" label="Precio (Bs)" :isDecimal="true" placeholder="Ingrese el precio" />
    <x-form-input-number name="stock_quantity" label="Stock actual" value="0"
        placeholder="Ingrese el stock actual del producto" />
    <x-form-input-number name="author_comission_percentage" label="Comisión del autor (%)" :isDecimal="true"
        placeholder="Ingrese la comisión del autor" />
</x-form-modal>
