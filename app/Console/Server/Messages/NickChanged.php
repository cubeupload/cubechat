<?php namespace App\Console\Server\Messages;

class NickChanged extends Message
{
    protected $type = 3;
    
    public function __construct( $client, $newname )
    {
        $this->text = trans('messages.nick_changed',['client' => $client, 'newname' => $newname]);
        $this->from = 'SERVER';
    }
}