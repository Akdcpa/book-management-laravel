<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BookModel extends Model
{
    protected $with = ['user'];

    /**
     * Get the user create the post.
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }

}
