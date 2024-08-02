<?php

namespace App\Livewire\Component\Text;

use Livewire\Component;

class DefaultText extends Component
{
    public $text;

    public function mount($text)
    {
        $this->text = $text;
    }

    public function render()
    {
        return view('livewire.component.text.default-text');
    }
}
