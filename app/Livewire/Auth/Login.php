<?php

namespace App\Livewire\Auth;

use Livewire\Component;
use Auth;
use Mary\Traits\Toast;

class Login extends Component
{
    use Toast;
    public $email;
    public $password;

    protected $rules = [
        'email' => 'required|email',
        'password' => 'required|min:6',
    ];
    public function render()
    {
        return view('livewire.auth.login')->layout('components.layouts.guest');
    }
    public function login()
    {
        //dd($this->email, $this->password);
        $this->validate();

        if (Auth::attempt(['email' => $this->email, 'password' => $this->password])) {
            //dd($this->email, $this->password);
            // Authentication passed...
            return redirect()->route('superadmin');
        }else{
            $this->error('Email atau password salah', position: 'toast-top toast-center');
        }
    }
}
