<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class FormInputSelect extends Component
{
    public string $name;
    public string $label;
    public bool $required;

    public function __construct(string $name, string $label, bool $required = true)
    {
        $this->name = $name;
        $this->label = $label;
        $this->required = $required;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form-input-select');
    }
}
