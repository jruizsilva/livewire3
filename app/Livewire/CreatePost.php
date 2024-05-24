<?php

namespace App\Livewire;

use App\Models\User;
use Livewire\Component;

use function Laravel\Prompts\alert;

class CreatePost extends Component
{
    public $title;
    // public $user;
    public $name;
    public $email;

    public function mount(User $user)
    {
        // $this->user = User::find($user);
        // $this->user = $user;
        // $this->name = $user->name;
        // $this->email = $user->email;
        $this->fill($user->only(['name', 'email']));
    }

    public function render()
    {
        return view('livewire.create-post');
    }

    public function save()
    {
        // dd($this->name);
    }
}
