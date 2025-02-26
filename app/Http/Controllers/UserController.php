<?php

namespace App\Http\Controllers;

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
}
