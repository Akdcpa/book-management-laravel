<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\BookModel;

class SendDeleteMail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($data)
    {
            $this->data  = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.delete')
        ->with([
            'name' => $this->data->user->name,
            'email' => $this->data->user->email,
            'book_name'=>$this->data->book_name,
            'author' => $this->data->author,
            'price' => $this->data->price,
            'description' => $this->data->description,
        
        ]);
    }
}
