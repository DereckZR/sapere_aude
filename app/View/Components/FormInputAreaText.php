<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class FormInputAreaText extends Component
{
    public string $name;
    public string $label;
    public string $placeholder;
    public int $rows;
    public bool $required;

    public function __construct(
        string $name,
        string $label,
        string $placeholder = '',
        int $rows = 3,
        bool $required = true
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->placeholder = $placeholder;
        $this->rows = $rows;
        $this->required = $required;
    }

    public function render(): View|Closure|string
    {
        return view('components.form-input-area-text');
    }
}
