<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
namespace App\Http\Controllers;  
use App\Mail\SendEmail;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use App\BookModel; 

class MailController extends Controller
{
    public function basicmail() {
        $data = array('name'=>"Aanand");
     
        $msg = Mail::send(['text'=>'mail'], $data, function($message) {
           $message->to('akgit2000@gmail.com', 'Tutorials Point')->subject
              ('Laravel Basic Testing Mail');
           $message->from('aanandakrishnan.d@gmail.com','Aanand');
        });

        return ResponseController::Response("Mail Sent", [
            "access_token" => $msg, 
        ]) ;
     }

     public function html_email() {
        $data = array('name'=>"Virat Gandhi");
        Mail::send('mail', $data, function($message) {
           $message->to('abc@gmail.com', 'Tutorials Point')->subject
              ('Laravel HTML Testing Mail');
           $message->from('xyz@gmail.com','Virat Gandhi');
        });
        echo "HTML Email Sent. Check your inbox.";
     }

     public function attachment_email() {
        $data = array('name'=>"Virat Gandhi");
        Mail::send('mail', $data, function($message) {
           $message->to('abc@gmail.com', 'Tutorials Point')->subject
              ('Laravel Testing Mail with Attachment');
           $message->attach('C:\laravel-master\laravel\public\uploads\image.png');
           $message->attach('C:\laravel-master\laravel\public\uploads\test.txt');
           $message->from('xyz@gmail.com','Virat Gandhi');
        });
        echo "Email Sent with attachment. Check your inbox.";
     }

     public function ship()
     {
         // $order = Order::findOrFail($);
 
         // Ship order...

         $book = new BookModel();

         
 
         $msg = Mail::to('akgit2000@gmail.com')->queue(new SendEmail());

         return ResponseController::Response("Mail Sent", [
            "access_token" => $msg, 
        ]) ;
     }
}

