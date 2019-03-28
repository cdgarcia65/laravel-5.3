<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     *¨The post that owns to user.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
