<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class CreateAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'create:admin {u} {p}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return void
     */
    public function handle()
    {
        $username = $this->argument('u');
        $password = bcrypt($this->argument('p'));

        User::create([
            'name' => $username,
            'email' => $username . '@admin.com',
            'password' => $password,
            'role' => 'admin',
        ]);
    }
}
