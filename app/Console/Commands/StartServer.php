<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;

use Ratchet\Server\IoServer;
use App\Console\Server\ChatServer;

class StartServer extends Command
{
    private $server;
    
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start:server';

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
        
        $this->server = IoServer::factory( new ChatServer(), 8080 );
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->server->run();
    }
}
