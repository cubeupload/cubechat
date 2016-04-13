<?php namespace App\Console\Server\Messages;

class Message
{
    protected $type = -1;
    protected $from = null;
    protected $text = '';
    
    public function __construct( $text, $from = null )
    {
        $this->text = $text;
        $this->from = $from;
    }
    
    public function toJson()
    {
        $array = [
            'type' => $this->type,
            'from' => $this->from,
            'text' => $this->text,
            'timestamp' => date('H:i:s')
        ];
        return json_encode( $array );
    }
    
    public function setText( $text )
    {
        $this->text = $text;
    }
    
    public function getText()
    {
        return $this->text;
    }
    
    public function getType()
    {
        return $this->type;
    }
    
    public function getFrom()
    {
        return $this->from;
    }
    
    public function setFrom($from)
    {
        return $this->from = $from;
    }
}