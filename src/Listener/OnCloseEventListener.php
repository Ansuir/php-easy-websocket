<?php

namespace Ansuir\EasyWebSocket\Listener;

use Ansuir\EasyWebSocket\Events\ConnectionClosedEvent;
use Ansuir\EasyWebSocket\Interfaces\OnCloseEventInterface;
use Ansuir\EasyWebSocket\Traits\InstanceTrait;

class OnCloseEventListener implements OnCloseEventInterface
{
    use InstanceTrait;

    public function handle(ConnectionClosedEvent $event)
    {

    }
}