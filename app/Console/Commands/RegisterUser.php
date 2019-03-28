<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class RegisterUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'styde:register';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Register a user to our application';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->ask('Por favor coloca tu nombre');
        $email = $this->ask('Por favor coloca tu correo');
        $password = $this->secret('Por favor coloca tu contraseña');

        User::create(compact('name', 'email', 'password'));

        $this->info("El usuario {$name} <$email> fue creado con éxito");
    }
}
