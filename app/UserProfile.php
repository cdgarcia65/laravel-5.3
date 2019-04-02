<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = ['nickname', 'featured_post_id', 'description'];

    /**
     *
     */
    public function getAvatarFileAttribute()
    {
        return storage_path('app/' . $this->avatar);
    }
}
