<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * Get the posts for user.
     */
    public function posts()
    {
        return $this->hasMany(Post::class);
    }

    /**
     * Get application admin.
     */
    public static function getAdmin()
    {
        return static::firstOrCreate([
            'email' => 'admin@styde.net'
        ], [
            'name' => 'Silence ',
            'password' => bcrypt('secret')
        ]);

        // $admin = static::where('email', 'admin@styde.net')
        //     ->first();

        // if ($admin == null) {
        //     $admin = User::create([
        //         'name' => 'Admin',
        //         'email' => 'admin@styde.net',
        //         'password' => bcrypt('secret')
        //     ]);
        // }

        // return $admin;
    }
}
