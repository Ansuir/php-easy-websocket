<?php

namespace Ansuir\EasyWebSocket\Interfaces;

use Ansuir\EasyWebSocket\Events\ConnectEvent;

/**
 * 服务器连接消息处理器接口
 * Interface OnOpenEventInterface
 * @package Ansuir\EasyWebSocket\Interfaces
 */
interface OnOpenEventInterface
{
    /**
     * WebSocket 服务器连接消息处理器
     *
     * @param \Swoole\WebSocket\Server $server
     * @param \Swoole\Http\Request     $request
     *
     * @return mixed
     */
    public function handle(ConnectEvent $event);
}