<?php

use App\User;
use App\Post;
use Illuminate\Mail\Message;
use App\DatabaseNotification;
use App\Notifications\Follower;
use App\Notifications\PostCommented;
use App\Mail\Welcome as WelcomeMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

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

Route::group(['middleware' => 'auth'], function () {
    Route::get('profile', 'ProfileController@edit');
    Route::put('profile', 'ProfileController@update');

    Route::get('profile/avatar', 'ProfileController@avatar');

    Route::get('notifications', function () {
        $notifications = auth()->user()->notifications;

        return view('notifications', compact('notifications'));
    });

    Route::get('notifications/read-all', function () {
        auth()->user()->unreadNotifications->markAsRead();

        return back();
    });

    Route::get('notifications/{notification}/', function (DatabaseNotification $notification) {
        abort_unless($notification->associatedTo(auth()->user()), 404);
        
        $notification->markAsRead();

        return redirect($notification->redirect_url);
    });

    Route::get('notifications/{user}', function (User $user) {
        dd($user);
    });
});

Route::get('posts/{post}', function (Post $post) {
    dd($post);
});

Route::get('profile/{user}', function (User $user) {
    dd($user);
});

Route::get('admin', function () {
    return User::getAdmin();
});

Route::get('/', function () {
    // return view('welcome');
    return View::make('welcome');
});

Route::get('posts', function () {
    $posts = Post::paginate();

    return view('posts', compact('posts'));
});

Route::get('follow/{follower}/{followed}', function (User $follower, User $followed) {
    // Create the follower.

    Notification::send($followed, new Follower($follower));
});

Route::get('comment/{post}', function (Post $post) {
    // Write comment...

    Notification::send($post->subscribers, new PostCommented($post));
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
