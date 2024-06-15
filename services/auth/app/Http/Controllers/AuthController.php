<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    /**
     * Create a new user.
     *
     * @param Request $request
     * @return void
     */
    public function register(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string|unique:users',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ]);

        try {
            $model = new User;
            $model->username = $request->input('username');
            $model->email = $request->input('email');
            $model->password = app('hash')->make($request->input('password'));
            $model->save();

            return response()->json(['message' => 'Registration successful'], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Registration failed'], 400);
        }
    }

    /**
     * Authenticate a user.
     *
     * @param Request $request
     * @return void
     */
    public function login(Request $request)
    {
        $this->validate($request, [
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $credentials = $request->only(['username', 'password']);
        
        if (!$token = Auth::setTTL(7200)->attempt($credentials)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return response()->json([
            'userid' => Auth::user()->id,
            'username' => Auth::user()->username,
            'email' => Auth::user()->email,
            'token' => $token,
            'expires_in' => Auth::factory()->getTTL() * 60,
        ], 200);
    }
}