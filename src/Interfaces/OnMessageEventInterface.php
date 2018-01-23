<?php

namespace Ansuir\EasyWebSocket\Interfaces;

use Ansuir\EasyWebSocket\Events\MessageArrivedEvent;

/**
 * 消息到达处理器接口
 * Interface OnMessageEventInterface
 * @package Ansuir\EasyWebSocket\Interfaces
 */
interface OnMessageEventInterface
{
    /**
     * WebSocket 消息接收处理器
     *
     * @param \Swoole\Server          $server
     * @param \Swoole\WebSocket\Frame $frame
     *
     * @return mixed
     */
    public function handle(MessageArrivedEvent $messageEvent);
}