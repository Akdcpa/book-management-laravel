<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Jobs\SendEmailJob;
use App\Jobs\SendDeleteJob;

use App\BookModel;
use App\BookController;

class JobController extends Controller
{
    public static function send($det)
        {
            $data = AuthController::getUser();
            $details = ['user' => $data ,'data'=>$det];
            $msg = SendEmailJob::dispatchNow($details);
            return ResponseController::Response("Sended", [
                "access_token" => $msg, 
            ]) ;
        }
    public static function sendDeleted($det)
        { 
            $details = ['data'=>$det];
            $msg = SendDeleteJob::dispatchNow($details);
            return ResponseController::Response("Sended", [
                "access_token" => $msg, 
            ]) ;
        }
}
