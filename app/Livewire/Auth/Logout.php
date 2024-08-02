<?php

namespace App\Livewire\Auth;

use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Attributes\On;
use Livewire\Component;

class Logout extends Component
{
    use LivewireAlert;

    public function confirmLogout()
    {
        $this->alert('warning', 'Are you sure?', [
            'showConfirmButton' => true,
            'confirmButtonText' => 'Logout',
            'showCancelButton' => true,
            'onConfirmed' => 'confirmed:logout',
        ]);
    }

    #[On('confirmed:logout')]
    public function logout()
    {
        $this->alert('success', 'You have been logged out.');
        Auth::logout();
        return redirect()->route('login');
    }

    public function render()
    {
        return view('livewire.auth.logout');
    }
}
