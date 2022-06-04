<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class AuthController extends Controller
{
    public function register(RegisterRequest $request)
    {
        $password = Hash::make($request->password);
        $user = User::create(['email' => $request->email, 'password' => $password, 'name' => $request->name]);
        return response()->json($user);
    }

    public function login(LoginRequest $request)
    {

        if (Auth::attempt($request->all())) {
            return Auth::user()->createToken('Personal Access Token')->accessToken;
        } else {
            abort(401);
        }
    }

    public function profile(Request $request) {
        return $request->user();
    }

    public function logout(Request $request) {
        $request->user()->token()->revoke();
        return 'logout';
    }
}
