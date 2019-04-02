<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserProfile extends Model
{
    protected $fillable = ['description'];

    /**
     *
     */
    public function getAvatarFileAttribute()
    {
        return storage_path('app/' . $this->avatar);
    }
}
