<?php namespace App\Console\Server;

use Ratchet\MessageComponentInterface;  
use Ratchet\ConnectionInterface;
use Ratchet\Server\IoConnection;
use App\Console\Server\Messages;

class ChatServer implements MessageComponentInterface
{
    protected $clients;
    
    function __construct()
    {
        $this->clients = new \SplObjectStorage;
    }
    
    function messageAll( $msg )
    {
        foreach( $this->clients as $client )
        {
            $client->send( $msg );
        }
    }
    
    public function onOpen( ConnectionInterface $conn )
    {
        echo "Connection from {$conn->remoteAddress} ({$conn->resourceId})\n\r";
       
        $this->messageAll((new Messages\ClientConnected($conn))->toJson());
        $this->clients->attach( $conn, new ChatClient );
        $conn->send( (new Messages\ClientWelcome())->toJson() );
    }
    
    public function onMessage( ConnectionInterface $from, $msg )
    {
        $sendingClient = $this->clients[$from];
        
        if( $msg[0] == '/' )
        {
            $split = explode( " ", substr($msg, 1, strlen($msg)));
            $cmd = array_shift( $split );
            $args = implode( " ", $split );
            switch( $cmd )
            {
                case "nick":
                    
                    $this->messageAll( (new Messages\NickChanged( $sendingClient->getNick(), $args))->toJson());
                    $sendingClient->setNick($args);
                    break;
                case "clients":
                    $clist = [];
                    foreach( $this->clients as $conn )
                    {
                        $clist[] = $this->clients[$conn]->getNick();
                    }
                    $from->send(implode( ", ", $clist));
            }
        }
        else
        {
            foreach( $this->clients as $conn )
            {
                $msg = new Messages\Message($msg, $sendingClient->getNick());
                $conn->send( $msg->toJson() );                   
            }            
        }
    }
    
    public function onClose( ConnectionInterface $conn )
    {
        $this->messageAll("Connection closed ({$conn->resourceId})");
        $this->clients->detach( $conn );
    }
    
    public function onError( ConnectionInterface $conn, \Exception $e )
    {
        echo "Error: " . $e->getMessage() . "\r\n";
    }
    
}