<?php namespace App\Console\Server;

use Ratchet\ConnectionInterface;

class ChatClient
{   
    protected $nick = "Anonymous";
    
    public function getNick()
    {
        return $this->nick;
    }

    public function setNick( $nick )
    {
        $this->nick = $nick;
    }
}