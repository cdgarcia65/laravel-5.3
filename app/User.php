<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\RoutesNotifications;

class User extends Authenticatable
{
    use RoutesNotifications, HasDatabaseNotifications;

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
     * Get the user profile.
     */
    public function profile()
    {
        return $this->hasOne(UserProfile::class);
    }

    public function getProfileAttribute()
    {
        return $this->profile()->firstOrNew([]);
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

    public function getNotificationPreferences()
    {
        return ['mail', 'database'];
    }

    public function routeNotificationForNexmo()
    {
        return env('NEXMO_PHONE');
    }
}
