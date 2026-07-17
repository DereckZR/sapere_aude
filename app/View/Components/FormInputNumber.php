<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class FormInputNumber extends Component
{

    public string $name;
    public string $label;
    public bool $isDecimal;
    public string $placeholder;

    public function __construct(string $name, string $label, bool $isDecimal = false, string $placeholder = '')
    {
        $this->name = $name;
        $this->label = $label;
        $this->isDecimal = $isDecimal;
        $this->placeholder = $placeholder;
    }


    public function render(): View|Closure|string
    {
        return view('components.form-input-number');
    }
}
