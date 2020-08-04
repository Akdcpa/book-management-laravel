<?php

namespace App\Mail;
use App\User;
use App\BookModel;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user , $book)
    { 
        $this->book = $book;
        $this->user = $user;

    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() 
    {
        return $this->view('emails.create')
                            ->with([
                                'name' => $this->user->name,
                                'email' => $this->user->email,
                                'book_name'=>$this->book->book_name,
                                'author' => $this->book->author,
                                'price' => $this->book->price,
                                'description' => $this->book->description,
                            
                            ]);
    }
}
