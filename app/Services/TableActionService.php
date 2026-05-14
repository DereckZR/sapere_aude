<?php

namespace App\Services;

use App\Enums\TableButtonAction;

class TableActionService
{
    public function renderActions(int $id, string $prefix, bool $trashed = false, bool $show = false)
    {
        $actions = [];

        if ($show) {
            $actions[] = $this->show(
                $id,
                route($prefix . ".findById", ['id' => $id])
            );
        }

        if ($trashed) {
            $actions[] = $this->restore(
                $id,
                route($prefix . ".restore", ['id' => $id])
            );
        } else {
            $actions[] = $this->edit(
                $id,
                route($prefix . ".findById", ['id' => $id])
            );
            $actions[] = $this->delete(
                $id,
                route($prefix . ".delete", ['id' => $id])
            );
        }

        return $actions;
    }

    private function button(
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

    private function show(int $id, string $url): string
    {
        return $this->button(
            'secondary',
            TableButtonAction::SHOW,
            $id,
            $url,
            'Detalles'
        );
    }

    private function edit(int $id, string $url): string
    {
        return $this->button(
            'primary',
            TableButtonAction::EDIT,
            $id,
            $url,
            'Editar'
        );
    }

    private function delete(int $id, string $url): string
    {
        return $this->button(
            'danger',
            TableButtonAction::DELETE,
            $id,
            $url,
            'Eliminar'
        );
    }

    private function restore(int $id, string $url): string
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
