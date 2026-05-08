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
    public string $placeholder;


    public function __construct(string $name, string $label, string $type = 'text', string $placeholder = '')
    {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
        $this->placeholder = $placeholder;
    }

    public function render(): View|Closure|string
    {
        return view('components.form-input');
    }
}
