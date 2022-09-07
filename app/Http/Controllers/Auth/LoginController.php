<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Login;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class LoginController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Login $request)
    {
        $email = Worker::where('email', $request->email)->first();
        $password = Hash::check($request->password, $email->password);
        if(!$password){
            throw ValidationException::withMessages([
                'password' => ['Parol notog\'ri kiritilgan!'],
            ]);
        }
        Auth::attempt(['email' => $request->email, 'password' => $request->password]);
        return response()->redirectToRoute('statistic.index');
    }

    public function logout()
    {
        Auth::logout();
        return response()->redirectToRoute('login_form');
    }
}
