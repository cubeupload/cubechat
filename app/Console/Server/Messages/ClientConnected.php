<?php namespace App\Console\Server\Messages;

class ClientConnected extends Message
{
    protected $type = 0;
    
    public function __construct( $from )
    {
        $this->text = trans('messages.client_connected',
            ['address' => $from->remoteAddress, 'resource' => $from->resourceId ]
        );
        $this->from = 'SERVER';
    }
}
