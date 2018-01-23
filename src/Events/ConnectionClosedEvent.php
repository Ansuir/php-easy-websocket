<?php

namespace Ansuir\EasyWebSocket\Events;

use Swoole\WebSocket\Server;

/**
 * 连接关闭事件
 * Class ConnectionClosedEvent
 * @package Ansuir\EasyWebSocket\Events
 */
class ConnectionClosedEvent
{
    /**
     * @var Server
     */
    protected $server;

    /**
     * @var int
     */
    protected $fd;

    /**
     * ConnectionClosedEvent constructor.
     *
     * @param \Swoole\WebSocket\Server $server
     * @param int                      $fd
     */
    protected function __construct(Server $server, int $fd)
    {
        $this->server = $server;
        $this->fd = $fd;
    }

    /**
     * 创建一个连接关闭事件
     *
     * @param \Swoole\WebSocket\Server $server
     * @param int                      $fd
     *
     * @return \Ansuir\EasyWebSocket\Events\ConnectionClosedEvent
     */
    public static function create(Server $server, int $fd)
    {
        return new self($server, $fd);
    }

    /**
     * @return \Swoole\WebSocket\Server
     */
    public function server()
    {
        return $this->server;
    }

    /**
     * @return int
     */
    public function fd()
    {
        return $this->fd;
    }
}