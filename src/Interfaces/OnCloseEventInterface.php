<?php

namespace Ansuir\EasyWebSocket\Interfaces;

use Ansuir\EasyWebSocket\Events\ConnectionClosedEvent;

/**
 * 连接关闭消息处理器接口
 * Interface OnCloseEventInterface
 * @package Ansuir\EasyWebSocket\Interfaces
 */
interface OnCloseEventInterface
{
    public function handle(ConnectionClosedEvent $event);
}
