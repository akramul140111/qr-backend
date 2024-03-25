<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\LoginRequest;
use App\Http\Requests\SignupRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    //
    public function user()
    {
        $user = Auth::user();
        return response()->json(['user' => $user],200);
    }
    public function signup(SignupRequest $request)
    {
        $newUser = $request->only([
            'name',
            'email',
            'role'
        ]);
        $newUser['password'] = bcrypt($request->input('password'));
        $user = User::create($newUser);

        $token = $user->createToken('qrApp')->plainTextToken;

        return response(compact('user','token'));
    }


    public function login(LoginRequest $request)
    {
        $credentails = $request->validated();
        if(!Auth::attempt($credentails)){
            return response([
                'message' => 'Credentials are wrong...!!!'
            ], 422);
        }
        /** @var User $user */
        $user = Auth::user();
        $token = $user->createToken('qrApp')->plainTextToken;

        return response(compact('user','token'));
    }

    public function logout(Request $request){
        $user = $request->user();
        $user->currentAccessToken()->delete();

        return response('',204);
    }
}
