<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    public function register(Request $request){
        $validacion = Validator::make(
            $request->all(),
            [
                'name' => 'required|string|max:255',
                'email' => 'required|string|email|max:255|unique:users',
                'password' => 'required|string|min:6'
            ]
            );

        if ($validacion->fails()) {
            return response()->json($validacion->errors());
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'data' => $user,
            'access_token' => $token,
            'token_type' => 'Bearer'
        ]);

    }

    public function login(Request $request){
        if (!Auth::attempt($request->only('email','password'))) {
            return response()->json([
                'message' => 'No autorizado'
            ],401);
        }

        $user = User::where('email',$request->email)->first();

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => $user->name,
            'access_token' => $token,
            'token_type' => 'Bearer',
            'data' => $user
        ]);
    }

    public function logout(){
        //auth()->user()->tokens()->delete();
        return response()->json([
            'message' => 'Se cerró la sesión'
        ]);
    }
}
