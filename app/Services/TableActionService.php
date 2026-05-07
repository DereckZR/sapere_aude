<?php

namespace App\Services;

use App\Enums\TableButtonAction;

class TableActionService
{
    public function button(
        string $type,
        TableButtonAction $action,
        int $id,
        string $url,
        string $label
    ): string {
        return view('components.table-button', [
            'type' => $type,
            'action' => $action,
            'id' => $id,
            'url' => $url,
            'label' => $label,
        ])->render();
    }

    public function show(int $id, string $url): string
    {
        return $this->button(
            'secondary',
            TableButtonAction::SHOW,
            $id,
            $url,
            'Detalles'
        );
    }

    public function edit(int $id, string $url): string
    {
        return $this->button(
            'primary',
            TableButtonAction::EDIT,
            $id,
            $url,
            'Editar'
        );
    }

    public function delete(int $id, string $url): string
    {
        return $this->button(
            'danger',
            TableButtonAction::DELETE,
            $id,
            $url,
            'Eliminar'
        );
    }

    public function restore(int $id, string $url): string
    {
        return $this->button(
            'success',
            TableButtonAction::RESTORE,
            $id,
            $url,
            'Restaurar'
        );
    }
}
