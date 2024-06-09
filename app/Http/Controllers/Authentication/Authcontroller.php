<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class Authcontroller extends Controller
{
    public function CreateUser(Request $request )
    {
        return rescue(function () use ($request){
            $request->validate([
                'name'=>'String|required|unique:users',
                'email'=>'email|required|unique:users',
                'password'=>'String|required|min:8',
            ]);
            return response()->json([
                'status'=>'true',
                'payload'=>tap(\App\Models\User::Create($request->all()),
                //create a user token
                fn($user)=>$user->createToken('userToken')->plainTextToken
                )
            ],200);
        },function(\Exception $exception){
            return response()->json([
                'status'=>'false',
                'payload'=>[
                    'message'=>$exception->getMessage()
                ]
            ],500);
        }
        );
    }
    public function LoginUser(Request $request)
    {
        $name = $request->input('name');
        $password = $request->input('password');

        $user = User::where('name',$name)->first();

        if ($user && Hash::check($password, $user->password)){
            return response()->json([
                'message' => 'Login successful', 'user' => $user
            ], 200);
        }else
        {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 500);
        }
    }
    public function UserCount(){
        //get the user count
        $userCount = User::count();
        return view('dashboard', compact('userCount'));
    }
}
