<?php

use App\User;
use Illuminate\Mail\Message;
use App\Mail\Welcome as WelcomeMail;
use Illuminate\Support\Facades\Mail;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

DB::listen(function ($query) {
    Log::info($query->sql);
});

Route::get('admin', function () {
    return User::getAdmin();
});

Route::get('/', function () {
    // return view('welcome');
    return View::make('welcome');
});

Route::get('posts', function () {
    $users = User::all();

    return view('posts', compact('users'));
});

// Route::get('welcome', function () {
//     Mail::send('emails.welcome', ['name' => 'David García'], function (Message $message) {
//         $message->to('david@example.com', 'David García')
//             ->from('admin@styde.net', 'Styde')
//             ->subject('Bienvenido a Styde');
//     });
// });

Route::get('welcome', function () {
    $user = User::create([
        'email' => 'david@example.com',
        'name' => 'David García',
        'password' => bcrypt('secret')
    ]);
    Mail::to($user->email, $user->name)
        ->send(new WelcomeMail($user));
});
Auth::routes();

Route::get('/home', 'HomeController@index');

Route::get('points', function () {
    $users = User::find(1);

    // dd(get_class($users->posts()));

    $popular = $users->posts->where('points', '>', 50);

    $others = $users->posts->where('points', '<=', 50);

    dd($popular, $others);
});
