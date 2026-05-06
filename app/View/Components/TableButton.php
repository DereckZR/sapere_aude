<?php

namespace App\View\Components;

use App\Enums\TableButtonAction;
use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class TableButton extends Component
{
    public string $label;
    public TableButtonAction $action;
    public int $id;
    public string $url;
    public string $type;

    public function __construct(
        string $label,
        TableButtonAction $action,
        int $id,
        string $url,
        string $type = 'primary',
    ) {
        $this->label = $label;
        $this->action = $action;
        $this->id = $id;
        $this->url = $url;
        $this->type = $type;
    }

    public function render(): View|Closure|string
    {
        return view('components.table-button');
    }
}
