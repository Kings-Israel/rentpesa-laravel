<?php

namespace App\Http\Controllers\Auth;

use \App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
  public function index()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.auth.register', ['pageConfigs' => $pageConfigs]);
  }

  public function register(Request $request)
  {
    $userData = $request->validate([
      'name' => 'required',
      'email' => 'required|email|unique:users',
      'password' => 'required|confirmed'
    ]);

    $user = User::create($userData);

    Auth::login($user);

    return redirect()->route('dashboard');
  }

  public function verifyEmail(User $user)
  {
    return view('auth.verify-email', ['email' => $user->email]);
  }

  public function showRegistrationForm()
  {
    $pageConfigs = ['myLayout' => 'blank'];
    return view('content.auth.register', ['pageConfigs' => $pageConfigs]);
  }
}
