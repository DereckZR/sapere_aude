<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;

class FormModal extends Component
{
    public string $createUrl;
    public string $updateUrl;
    public string $title;


    public function __construct(
        string $createUrl,
        string $updateUrl,
        string $title = 'Form Modal',
    ) {
        $this->createUrl = $createUrl;
        $this->updateUrl = $updateUrl;
        $this->title = $title;
    }

    public function render(): View|Closure|string
    {
        return view('components.form-modal');
    }
}
