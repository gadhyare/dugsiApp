<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use Livewire\Attributes\Rule;
use Livewire\Attributes\Layout;

#[Layout('admin.layouts.for-livewire-for-login')]
class AdminLogin extends Component
{



    #[ Rule('required|email') ]
    public $email ;

    #[Rule('required')]
    public $password ;


    public $message = '';
    public function render()
    {
        return view('livewire.admin.admin-login');
    }




    public function login( )
    {

        $this->validate( );
        if (!auth()->guard('admin')->attempt(['email' => $this->email, 'password' => $this->password])) {
             $this->message = "خطأ في اسم المستخدم أو كلمة المرور";
            return redirect(route('admin.login'));
        } else {
            return redirect(route('admin.dashboard'));
        }

    }

}
