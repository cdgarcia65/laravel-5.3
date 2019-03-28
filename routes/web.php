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

Route::get('/', function () {
    return view('welcome');
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