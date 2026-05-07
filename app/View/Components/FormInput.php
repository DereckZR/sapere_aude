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

    public function __construct(string $name, string $label, string $type = 'text')
    {
        $this->name = $name;
        $this->label = $label;
        $this->type = $type;
    }

    public function render(): View|Closure|string
    {
        return view('components.form-input');
    }
}
