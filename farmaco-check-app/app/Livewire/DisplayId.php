<?php

namespace App\Livewire;

use Livewire\Component;

class DisplayId extends Component
{
    public $id;

    public $label;

    public function render()
    {
        return view('components.display-id');
    }
}
