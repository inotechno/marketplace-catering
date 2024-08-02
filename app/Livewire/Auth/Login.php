<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class Login extends Component
{
    use LivewireAlert;

    public $year;
    public $username, $password, $remember = false;

    public function mount()
    {
        $this->year = date('Y');
    }

    public function login()
    {
        $this->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        try {
            $fieldType = filter_var($this->username, FILTER_VALIDATE_EMAIL) ? 'email' : 'username';

            if (Auth::attempt(array($fieldType => $this->username, 'password' => $this->password), $this->remember)) {
                $user = Auth::user();
                // Mencatat aktivitas login
                $this->alert('success', 'Selamat datang di dashboard Employee Management System');
                return redirect()->route('dashboard.index');
            }

            $this->alert('error', 'Email atau password yang anda gunakan salah, silahkan periksa kembali!');
            return back();
        } catch (\Throwable $th) {
            $this->alert('error', 'Terjadi kesalahan, silahkan coba lagi!');
            return back();
        }

    }
    public function render()
    {
        return view('livewire.auth.login')->layout('layouts.default', ['title' => 'Login']);
    }
}
