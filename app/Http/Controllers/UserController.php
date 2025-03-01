<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class UserController extends Controller
{
    //

    function UserRegistration(Request $request)
    {

        // return User::create([

        //     'name' => $request->input('name'),
        //     'email' => $request->input('email'),
        //     'mobile' => $request->input('mobile'),
        //     'password' => $request->input('password')

        // ]);

        try {

            User::create([

                'name' => $request->input('name'),
                'email' => $request->input('email'),
                'mobile' => $request->input('mobile'),
                'password' => $request->input('password')

            ]);



            return response()->json([
                'status' => 'success',
                'message' => 'User Registration Successfully',

            ], 200);
        } catch (Exception $e) {

            return response()->json([
                'status' => 'failed',
                'message' => $e->getMessage()

            ], 200);
        }
    }

    function UserLogin(Request $request){
       $count=User::where('email','',$request->input('email'))
        ->where('password','',$request->input('password'))
        ->count();

        if($count==1){
            // user login -> JWT

            $token = JWTToken::CreateToken($request->input('email'));


        }
       else{
         return response()->json([
            'status'=>'failed',
             'message'=>'Unauthoe'
         ], 200);
       }
    }
}
