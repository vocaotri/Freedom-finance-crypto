<?php

namespace App\Http\Controllers;

use App\Enums\Role;
use App\Models\User;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function __construct(
        private Request $request,
        private User $user,
        private string $page = 'front.pages.auth.'
    ) {
    }
    public function login()
    {
        if ($this->request->isMethod('post')) {
            $this->validate($this->request, [
                'email' => 'required|email',
                'password' => 'required'
            ]);
            if (auth()->attempt(['email' => $this->request->email, 'password' => $this->request->password, 'role' => Role::User->value], !!($this->request->remember))) {
                return redirect()->route('home');
            }
            return redirect()->back()->withErrors(['email' => 'These credentials do not match our records.']);
        }
        return view($this->page . 'login');
    }
    public function logout()
    {
        auth()->logout();
        return redirect()->route('login');
    }
    public function register()
    {
        if ($this->request->isMethod('post')) {
            $this->validate($this->request, [
                'name' => 'required',
                'email' => 'required|email|unique:users',
                'password' => 'required|min:6',
                'password_confirmation' => 'required|same:password',
                'code_activate' => 'required'
            ]);
            // check code activate
            if ($this->request->code_activate != "9551735") {
                return redirect()->back()->withErrors(['code_activate' => 'Code activate is not correct']);
            }
            $data = $this->request->all();
            $data['role'] = Role::User->value;
            $data['password'] = bcrypt($this->request->password);
            $this->user->create($data);
            return redirect()->route('login');
        }
        return view($this->page . 'register');
    }
}
