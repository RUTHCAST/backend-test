<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthenticationController extends Controller
{
    public function createAccount(Request $request)
    {
        $attr = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6|confirmed'
        ]);

        $user = User::create([
            'name' => $attr['name'],
            'password' => Hash::make($attr['password']),
            'email' => $attr['email']
        ]);

        return response()->json([
            'res'=> true,
            'msg'=>'Usuario regstrado exitosamente'
        ],200);
    }

    //use this method to signin users
    public function signin(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email|',
            'password' => 'required|string|min:6'
        ]);

        $user = User::where("email", "=", $request->email)->first();

        if(isset($user->id)){
            if(Hash::check($request->password, $user->password)){

                $token = $user->createToken('auth_token')->plainTextToken;
                return response()->json([
                    'res'=> true,
                    'msg'=>'Usuario logueado exitosamente',
                    'token'=> $token
                ],200);

            }else{
                return response()->json([
                    'res'=> false,
                    'msg'=>'Contraseña invalida'
                ],401);
            }
        }else{
            return response()->json([
                'res'=> false,
                'msg'=>'Usuario invalido'
            ],401);
        }

    }

    public function userProfile(){
        return response()->json([
            'res'=> true,
            'user'=> auth()->user()
        ],200);
    }

    // this method signs out users by removing tokens
    public function signout()
    {
        auth()->user()->tokens()->delete();

        return response()->json([
            'res'=> true,
            'msg'=>'Cierre de sesion exitoso'
        ],200);
    }
}
