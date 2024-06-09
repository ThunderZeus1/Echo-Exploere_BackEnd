<?php

namespace App\Http\Controllers\Authentication;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class Authcontroller extends Controller
{
    public function CreateUser(Request $request )
    {
        return rescue(function () use ($request){
            $request->validate([
                'name'=>'String|required',
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
    public function LoginUser()
    {
        return rescue(function (){
            return response([
               'status'=>'true',
               'payload'=> auth()->user(),
            ],200);
        },function (\Exception $exception){
            return response()->json([
                'status'=>'false',
                'payload'=>[
                    'message'=>$exception->getMessage(),
                ]
            ]);
        }
        );
    }
}
