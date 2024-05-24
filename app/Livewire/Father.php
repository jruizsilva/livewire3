<?php

namespace App\Livewire;

use Livewire\Component;

class Father extends Component
{
    public $name = "Jonathan Ruiz";

    public function render()
    {
        return view('livewire.father');
    }

    public function redirectTo($route)
    {
        return $this->redirect($route, navigate: true);
    }
}
