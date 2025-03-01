<?php

namespace App\Helper;

use Exception;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JWTToken
{

    // public static function CreateToken($userEmail,$userID):string{
  public static function CreateToken($userEmail):string{ //if use static menthod whithout any ibject craete can acces this 
        $key =env('JWT_KEY');
        $payload=[
            'iss'=>'laravel-token',
            'iat'=>time(),
            'exp'=>time()+60*60*24*30,
            'userEmail'=>$userEmail,
            // 'userID'=>$userID
        ];
        return JWT::encode($payload,$key,'HS256');
    }



    public static function CreateTokenForSetPassword($userEmail):string{
        $key =env('JWT_KEY');
        $payload=[
            'iss'=>'laravel-token',
            'iat'=>time(),
            'exp'=>time()+60*20,
            'userEmail'=>$userEmail,
            'userID'=>'0'
        ];
        return JWT::encode($payload,$key,'HS256');
    }



    // public static function VerifyToken($token):string|object
   function VerifyToken($token):string
    {
        try {

            $key =env('JWT_KEY');
            $decode=JWT::decode($token,new Key($key,'HS256'));
            return $decode->userEmail;
            // if($token==null){
            //     return 'unauthorized';
            // }
            // else{
            //     $key =env('JWT_KEY');
            //     $decode=JWT::decode($token,new Key($key,'HS256'));
            //     return $decode;
            // }
        }
        catch (Exception $e){
            return 'unauthorized';
        }
    }


}
