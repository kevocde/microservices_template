<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
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
}