<?php namespace App\Console\Server\Messages;

class ClientWelcome extends Message
{
    protected $type = 3;
    
    public function __construct()
    {
        $this->text = trans('messages.client_welcome');
        $this->from = 'SERVER';
    }
}