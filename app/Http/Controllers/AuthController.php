<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $email = $request->email;
        $password = $request->password;

        $user = User::where('email', $email)->first();

        // dd($user);

        if (!$user || !Hash::check($password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }
        $data =  $user->createToken($user->name)->plainTextToken;
        $response = ["mesage" => "Login Berhasil", "data" => $data];

        return response()->json($response, Response::HTTP_ACCEPTED);
    }

    public function logout(Request $request)
    {
        // $user = User::where('email', $request['email'])->first();
        $request->user()->currentAccessToken()->delete();
        return response()->json(["message" => "anda sudah logout"], Response::HTTP_OK);
    }
}
