<?php

namespace App\Livewire\Auth;

use App\Models\User;
use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Str;
use Jantinnerezo\LivewireAlert\LivewireAlert;

class RegisterCustomer extends Component
{
    use LivewireAlert;
    public $username, $email, $password, $password_confirmation, $company_name, $contact_person, $phone_number, $address, $city, $province, $country, $postal_code;

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
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function register()
    {
        $this->validate();

        try {

            $user = User::create([
                'username' => $this->username,
                'name' => $this->company_name,
                'email' => $this->email,
                'password' => bcrypt($this->password),
            ]);

            $user->assignRole('Customer');

            $customer = Customer::create([
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
        return view('livewire.auth.register-customer')->layout('layouts.default', ['title' => 'Register']);
    }
}
