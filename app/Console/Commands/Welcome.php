<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Welcome extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'styde:welcome {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Welcome a user';

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
        $this->info("Welcome to Styde, {$this->argument('name')}");
    }
}
