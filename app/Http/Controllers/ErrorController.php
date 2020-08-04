<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ErrorController extends Controller
{
    public static function Error($code, $msgs=null) {
        $msg = ErrorController::ErrorMsg($msgs) ;

        return response()->json([
            "status" => "fails",
            "message" => $msgs != null ? $msg : "Request fails",
        ], $code);
    }

    public static function ErrorMsg($messages) {
        $errorMsg = "" ;
        foreach($messages as $msg) {
            $errorMsg = $errorMsg . $msg . " " ; 
        }

        return $errorMsg ;
    }
}
