<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use App\Models\Merchant;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithFileUploads;

class RegisterMerchant extends Component
{
    use LivewireAlert, WithFileUploads;
    public $username, $email, $password, $password_confirmation, $company_name, $contact_person, $phone_number, $address, $city, $province, $country, $postal_code, $logo;

    protected $rules = [
        'username' => 'required|unique:users,username',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|confirmed',
        'company_name' => 'required',
        'contact_person' => 'required',
        'phone_number' => 'required',
        'address' => 'required',
        'city' => 'required',
        'province' => 'required',
        'country' => 'required',
        'postal_code' => 'required',
        'logo' => 'image|max:2048',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function register()
    {
        $this->validate();

        try {

            $this->logo->storeAs('public/merchant', Str::uuid() . '.' . $this->logo->extension());

            $user = User::create([
                'username' => $this->username,
                'name' => $this->company_name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
            ]);

            $user->assignRole('Merchant');

            $merchant = Merchant::create([
                'uid' => Str::uuid(),
                'user_id' => $user->id,
                'email' => $this->email,
                'company_name' => $this->company_name,
                'contact_person' => $this->contact_person,
                'phone_number' => $this->phone_number,
                'address' => $this->address,
                'city' => $this->city,
                'province' => $this->province,
                'country' => $this->country,
                'postal_code' => $this->postal_code,
                'logo' => $this->logo->hashName(),
                'is_active' => true,
            ]);

            $this->alert('success', 'Akun anda telah terdaftar, silahkan login!');
            $this->reset('username', 'email', 'password', 'password_confirmation', 'company_name', 'contact_person', 'phone_number', 'address', 'city', 'province', 'country', 'postal_code');

            return redirect()->route('login');
        } catch (\Exception $exception) {
            $this->alert('error', $exception->getMessage());
        }
    }

    public function render()
    {
        return view('livewire.auth.register-merchant')->layout('layouts.default', ['title' => 'Register']);
    }
}
