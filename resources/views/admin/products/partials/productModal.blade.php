@php
    $createUrl = route('products.store');
    $updateUrl = route('products.update', ['id' => ':id']);
@endphp

<x-form-modal :createUrl="$createUrl" :updateUrl="$updateUrl" title="Producto">
    <x-form-input name="name" label="Nombre" type="text" placeholder="Ingrese el nombre" />
    <x-form-input-area-text name="description" label="Descripción" placeholder="Ingrese la descripción" />
    <x-form-input name="price" label="Precio (Bs)" type="number" placeholder="Ingrese el precio" />
    <x-form-input name="stock_quantity" label="Stock actual" type="number"
        placeholder="Ingrese el stock actual del producto" />
    <x-form-input name="author_comission_percentage" label="Comisión del autor (%)" type="number"
        placeholder="Ingrese la comisión del autor" />
</x-form-modal>
