<?php

namespace App\Livewire\Component\Button;

use Livewire\Attributes\Lazy;
use Livewire\Component;

class DefaultButton extends Component
{

    public $id = null;
    public $type = 'button';
    public $text = 'Button';
    public $class = 'btn btn-primary';
    public $disabled = false;
    public $action = null;

    public function mount($attributes = [])
    {
        $this->type = $attributes['type'] ?? 'button';
        $this->class = $attributes['class'] ?? '';
        $this->text = $attributes['text'] ?? '';
        $this->action = $attributes['action'] ?? '';
    }

    public function handleClick()
    {
        if ($this->action) {
            $this->dispatch($this->action);
        }
    }

    public function render()
    {
        return view('livewire.component.button.default-button');
    }
}
