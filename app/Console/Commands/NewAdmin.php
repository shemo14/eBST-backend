<?php

namespace App\Console\Commands;

use App\User;
use Illuminate\Console\Command;

class NewAdmin extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admin';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'New Admin';

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
        $name = $this->ask('What is admin name?');

        $phone = $this->ask('What is admin phone?');

        $email = $this->ask('What is admin email?');

        $password = $this->secret('What is the password?');

        if ($this->confirm('Is '.$email.' correct, do you wish to continue? [y|N]')) {
            User::create([
                'name'      => $name,
                'phone'     => convert2english($phone),
                'email'     => $email,
                'password'  => bcrypt($password),
                'checked'   => 1,
                'role'      => '1',
            ]);
        }
    }
}
