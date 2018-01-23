<?php

namespace Ansuir\EasyWebSocket\Listener;

use Ansuir\EasyWebSocket\Events\ConnectEvent;
use Ansuir\EasyWebSocket\Interfaces\OnOpenEventInterface;
use Ansuir\EasyWebSocket\Traits\InstanceTrait;

class OnOpenEventListener implements OnOpenEventInterface
{
    use InstanceTrait;

    public function handle(ConnectEvent $event)
    {

    }
}