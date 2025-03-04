<?php

namespace App\Http\Controllers;

use App\Helper\JWTToken;
use App\Mail\OTPMail;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class UserController extends Controller
{
    // User Registration
    function UserRegistration(Request $request)
    {
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

    // User Login
    function UserLogin(Request $request)
    {
        $count = User::where('email', '=', $request->input('email'))
            ->where('password', '=', $request->input('password'))
            ->count();

        if ($count == 1) {
            // User login -> JWT
            $token = JWTToken::CreateToken($request->input('email'));
            return response()->json([
                'status' => 'Success',
                'message' => 'User Login Successful',
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Unauthorized'
            ], 200);
        }
    }

    // Send OTP Code
    function SendOtpCode(Request $request)
    {
        $email = $request->input('email');
        $otp = rand(1000, 9999);

        $count = User::where('email', '=', $email)->count();

        if ($count == 1) {
            // Send OTP email
            Mail::to($email)->send(new OTPMail($otp));

            // Update OTP in database
            User::where('email', '=',$email)->update(['otp' => $otp]);

            return response()->json([
                'status' => 'Success',
                'message' => 'Sent OTP to Mail'
            ], 200);
        } else {
            return response()->json([
                'status' => 'failed',
                'message' => 'Unauthorized'
            ], 401);
        }
    }


    //   verifytoken

 function VerifyOtp(Request $request){

    $email = $request->input('email');
    $otp = $request->input('otp');
    $count = User::where('email','=',$request->input('email'))
    ->where('otp','=',$otp)->count();

    if($count ==1){

       //  database otp update

       User::where('email', '=',$email)->update(['otp' => 0]);


       //  password Reset token isssue

       $token=JWTToken::CreateTokenForSetPassword($request->input('email'));


       return response()->json([
           'status' => 'Success',
           'message' => 'Otp Verification Successfully',
           'token'=>$token
       ], 200);



    } else {

       return response()->json([
           'status' => 'Verify failed',
           'message' => 'Unauthorized'
       ], 401);

    }
}

}



