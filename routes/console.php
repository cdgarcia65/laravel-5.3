<?php

use App\User;
use Illuminate\Foundation\Inspiring;

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of your Closure based console
| commands. Each Closure is bound to a command instance allowing a
| simple approach to interacting with each command's IO methods.
|
*/

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->describe('Display an inspiring quote');

Artisan::command('styde:welcome2 {name=Invitado} {--back}', function ($name) {
    if ($this->option('back')) {
        $this->info("Welcome back, $name!");
    } else {
        $this->info("Welcome to styde, $name!");
    }
})->describe('Welcome a user to our project');

// Artisan::command('styde:register', function () {
//     $name = $this->ask('Por favor coloca tu nombre');
//     $email = $this->ask('Por favor coloca tu correo');
//     $password = $this->secret('Por favor coloca tu contraseña');

//     User::create(compact('name', 'email', 'password'));

//     $this->info("El usuario {$name} <$email> fue creado con éxito");
// });
