<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
 
use Illuminate\Support\Str ;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Config ;
use App\User ; 
use App\BookModel; 
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class BookController extends Controller
{
    public function create(Request $request) {
        $validation = Validator::make($request->all(), [
            'book_name' => 'required|string',
            'author' => 'required|string',
            'price' => 'required',
            'description'=>'required'
        ]);

        if(!$validation->fails()) {
            $credentials = [
                'book_name' => $request->book_name,
                'author' => $request->author,
                'price' => $request->price,
                'description' => $request->description,
                'user'=>AuthController::getUser()
            ] ;  
            $book = new BookModel();
            $book->book_name = $request->book_name;
            $book->author = $request->author;
            $book->price = $request->price;
            $book->description = $request->description;
            $book->user_id = AuthController::getUserId();
            $book->save();

            $mail = JobController::send($book);

            return ResponseController::Response("book details added", [
                "details" => $book, 
            ]) ; 
        } else {
            return ErrorController::Error(422, $validation->errors()->all()) ;
        } 
    } 

    public function update(Request $request) {
        $validation = Validator::make($request->all(), [
            'id' => 'required', 
        ]);

        if(!$validation->fails()) {
            $credentials = [
                'book_name' => $request->book_name,
                'author' => $request->author,
                'price' => $request->price,
                'description' => $request->description,
                'user_id'=>AuthController::getUserId()
            ];  
            $id = $request->id;
            $book = new BookModel();
            $val = $book->where('id', $id)->get();

            if($val->count() == 0){ 
                return ResponseController::Response("book not found", [
                    "details" => "fails",

                ]) ; 
               }
            else{

                $book->where('id', $id)->update($credentials);
                
                return ResponseController::Response("updated success", [
                    "details" => $val, 
                ]) ; 
               }
        } else {
            return ErrorController::Error(422, $validation->errors()->all()) ;
        }
        
    } 

    public function softdelete(Request $request) {
        $validation = Validator::make($request->all(), [
            'id' => 'required', 
        ]);

        $credentials = [
            'delete_flag' => 1, 
        ];  

        if(!$validation->fails()) {
            
            $id = $request->id;
            $book = new BookModel();
            $val = $book->where('id', $id);

            if($val->count() == 0){ 
                return ResponseController::Response("book not found", [
                    "details" => "fails",
                ]) ; 
               }
            else{
                $data = $book->where('id', $id)->get();

                $val = $book->where('id', $id)->update($credentials);

                $mail = JobController::sendDeleted($data[0]);
                
                return ResponseController::Response("deleted success", [
                    "details" => $val, 
                ]) ; 
               }
        } else {
            return ErrorController::Error(422, $validation->errors()->all()) ;
        } 
    } 

    public function harddelete(Request $request) {
        $validation = Validator::make($request->all(), [
            'id' => 'required', 
        ]);

        if(!$validation->fails()) {
            
            $id = $request->id;
            $book = new BookModel();
            $val = $book->where('id', $id)->get();

            if($val->count() == 0){ 
                return ResponseController::Response("book not found", [
                    "details" => "fails",
                ]) ; 
               }
            else{
                $data = $book->where('id', $id)->get();
                
                $val = $book->where('id', $id)->delete();
                
                $mail = JobController::sendDeleted($data[0]);
                
                return ResponseController::Response("deleted success", [
                    "details" => $data[0], 
                ]) ; 
               }
        } else {
            return ErrorController::Error(422, $validation->errors()->all()) ;
        } 
    } 

    public function get(Request $request) {
         
            $book = new BookModel();
            $val = $book->where('delete_flag',0)->get();

            return ResponseController::Response("data retreived success", [
                "details" => $val, 
            ]) ;  
    } 


}
