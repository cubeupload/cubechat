<?php namespace App\Console\Server;

    
use Ratchet\MessageComponentInterface;
use Ratchet\ConnectionInterface;
    

class ChatServer implements MessageComponentInterface
{
    public function onOpen( ConnectionInterface $conn )
    {
        echo "New connection from {$conn->remoteAddress} ({$conn->resourceId})\n";
    }
    
    public function onMessage( ConnectionInterface $from, $msg )
    {
        
    }
    
    public function onClose( ConnectionInterface $conn )
    {
        
    }
    
    public function onError( ConnectionInterface $conn, \Exception $e )
    {
        
    }
    
}