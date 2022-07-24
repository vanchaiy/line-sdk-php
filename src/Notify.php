<?php

namespace LineSDK;

use Illuminate\Http\Request;
use LineSDK\Notify\Send;
use LineSDK\Notify\Status;
use LineSDK\Notify\Revoke;

class Notify 
{
    
    public function __construct(string $accessToken = '')
    {
        $this->accessToken = $accessToken;
    }

    public  function token(string $accessToken)
    {
        return ($accessToken) ? $accessToken : $this->accessToken;
    }

    public  function send(string $accessToken = '')
    {
        return new Send($this->token($accessToken));
    }

    public  function status(string $accessToken = '')
    {
        $status = new Status($this->token($accessToken));
        return  $status->go();
    }
    
    public  function revoke(string $accessToken = '')
    {
        $revoke = new Revoke($this->token($accessToken));
        return  $revoke->go();
    }

}
