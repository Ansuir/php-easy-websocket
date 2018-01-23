<?php

namespace Ansuir\EasyWebSocket\Events;

use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;

/**
 * 客户端消息事件
 * Class MessageEvent
 * @package Ansuir\EasyWebSocket\Events
 */
class MessageArrivedEvent
{
    /**
     * @var \Swoole\WebSocket\Server
     */
    protected $server;

    /**
     * @var \Swoole\WebSocket\Frame
     */
    protected $frame;

    /**
     * MessageEvent constructor.
     *
     * @param \Swoole\WebSocket\Server $server
     * @param \Swoole\WebSocket\Frame  $frame
     */
    protected function __construct(Server $server, Frame $frame)
    {
        $this->server = $server;
        $this->frame = $frame;
    }

    /**
     * 创建一条消息事件
     *
     * @param \Swoole\WebSocket\Server $server
     * @param \Swoole\WebSocket\Frame  $frame
     *
     * @return static
     */
    public static function create(Server $server, Frame $frame)
    {
        return new static($server, $frame);
    }

    /**
     * 返回服务器对象
     *
     * @return \Swoole\WebSocket\Server
     */
    public function server()
    {
        return $this->server;
    }

    /**
     * 答复客户端消息
     *
     * @param      $data
     * @param bool $isBinary
     * @param bool $finish
     *
     * @return bool
     */
    public function answer($data, $isBinary = false, $finish = true)
    {
        return $this->server->push($this->frame->fd, $data, $isBinary, $finish);
    }

    /**
     * 获取消息
     *
     * @return string
     */
    public function message()
    {
        return $this->frame->data;
    }
}