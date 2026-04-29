<?php

namespace App\Livewire;

use Illuminate\View\View;
use Livewire\Component;

class NavBar extends Component
{
    public string $prefix = '';

    public function render(): View
    {
        return view('livewire.nav-bar');
    }
}
