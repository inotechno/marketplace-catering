<?php

namespace App\Livewire\Catering;

use App\Models\Merchant;
use Livewire\Component;

class CateringIndex extends Component
{
    public function render()
    {
        $merchants = Merchant::paginate(10);

        return view('livewire.catering.catering-index', compact('merchants'))->layout('layouts.app', ['title' => 'Catering']);
    }
}
