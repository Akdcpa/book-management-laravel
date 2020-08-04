<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
use Illuminate\Support\Str ;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config ;
use App\User ; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function login(Request $request) {
        $validation = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required|min:8'
        ]);

        if(!$validation->fails()) {
            $credentials = [
                'email' => $request->email,
                'password' => $request->password
            ] ;

            if(Auth::attempt($credentials)) { 
                $user = Auth::user(); 
                $token = $user->createToken("APP_TOKEN")->accessToken ;
                return ResponseController::Response("LOGIN_SUCCESS", [
                    "access_token" => $token,
                    "user" => Auth::user() 
                ]) ;
            } else {
                return ErrorController::Error(404, ["Email / Password wrong"]) ;
            }
        } else {
            return ErrorController::Error(422, $validation->errors()->all()) ;
        }
        
    } 

    public function store(Request $request)
    {
        $validation = VAlidator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:8'
        ]) ;

        $user = new User() ;

        if(!$validation->fails()) {
            $user->name = $request->name ;
            $user->email = $request->email ;
            $user->password = bcrypt($request->password) ;
            $user->remember_token = str::random(6) ;
            $user->save() ;

            $token = $user->createToken("APP_TOKEN")->accessToken ;
     
                return ResponseController::Response("Stored book details", [
                    "access_token" => $token,
                    "user" => $user 
                ]) ;
            
        } else {
            return ErrorController::Error(422, $validation->errors()->all()) ;
        }
    }
 
    public function logout() {
        $user = Auth::user()->token();
        $user->revoke();

        return ResponseController::Response("Logged Out") ;
    }

    public static function getUserId() {
        return Auth::user()->id;
    }

    public static function getUser() {
        return Auth::user();
    }

    public static function getAuthToken() {
        return Auth::user()->token();
    }
}
