<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;

class ResponseController extends Controller
{
    public static function Response($msg, $res=[]) {

        return response()->json([
            "status" => "success",
            "message" => $msg,
            "data" => $res
        ], 200);
    }
}
