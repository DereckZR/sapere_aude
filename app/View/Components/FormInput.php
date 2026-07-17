<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class FormInput extends Component
{
    public string $name;
    public string $label;
    public string $type;
    public string $value;
    public string $placeholder;
    public bool $required;


    public function __construct(
        string $name,
        string $label,
        string $type = 'text',
        string $value = '',
        string $placeholder = '',
        bool $required = true
    ) {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->required = $required;
    }

    public function render(): View|Closure|string
    {
        return view('components.form-input');
    }
}
