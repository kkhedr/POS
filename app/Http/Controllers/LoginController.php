<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LoginController extends Controller
{  
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    
    public function show_login_form()
    {
        return view('admin/login');
    }
    public function process_login(Request $request)
    {
        $request->validate([
            'email' => ['required', 'string', 'email', 'max:255'],
            'password' => ['required', 'string', 'min:2'],
        ]);

        $credentials = $request->except(['_token']);

        $user = User::where('email',$request->email)->first();

        if (auth()->attempt($credentials)) {

            return redirect()->route('main');

        }else{
            session()->flash('message', 'فشل عملية الدخول');
            return redirect()->back();
        }
    }
    
    
    public function logout()
    {
        \Auth::logout();

        return redirect()->route('/');
    }
}
