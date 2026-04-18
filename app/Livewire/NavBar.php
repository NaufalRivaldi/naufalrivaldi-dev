<?php

namespace App\Livewire;

use Livewire\Component;

class NavBar extends Component
{
    public function render(): \Illuminate\View\View
    {
        return view('livewire.nav-bar');
    }
}
