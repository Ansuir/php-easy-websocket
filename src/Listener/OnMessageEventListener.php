<?php

namespace Ansuir\EasyWebSocket\Listener;

use Ansuir\EasyWebSocket\Events\MessageArrivedEvent;
use Ansuir\EasyWebSocket\Interfaces\OnMessageEventInterface;
use Ansuir\EasyWebSocket\Traits\InstanceTrait;

class OnMessageEventListener implements OnMessageEventInterface
{
    use InstanceTrait;

    public function handle(MessageArrivedEvent $messageEvent)
    {

    }
}