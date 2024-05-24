<?php

namespace App\Livewire;

use Livewire\Component;

class Paises extends Component
{
    public $pais;
    public $count = 0;
    public $active;
    public $paises = [
        'Argentina', 'Brasil', 'Chile', 'Uruguay',
    ];
    public $open = true;

    public function render()
    {
        return view('livewire.paises');
    }

    public function save()
    {
        // $this->paises[] = $this->pais;
        // $this->pais = '';
        array_push($this->paises, $this->pais);
        $this->reset('pais');
    }

    public function delete($index)
    {
        unset($this->paises[$index]);
    }

    public function changeActive($pais)
    {
        $this->active = $pais;
    }

    public function increment()
    {
        $this->count++;
    }
}
