<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;

class PopulateToken extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'populate:token';
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $user = User::find(1);

         $user->createToken('authToken')->plainTextToken;



    }
}
