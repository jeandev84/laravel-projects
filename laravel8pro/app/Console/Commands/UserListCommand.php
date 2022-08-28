<?php
namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;


/**
 *
*/
class UserListCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'users:list {id}'; // argument name "id"


    /**
     * The console command description.
     *
     * @var string
    */
    protected $description = 'List all users from users table';


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
     * @return int
     */
    public function handle()
    {
        $headers = ["ID", "Name", "Email"];

        $users = User::select('id', 'name', 'email')->where('id', $this->argument('id'))->get();

        $this->table($headers, $users);

    }
}
