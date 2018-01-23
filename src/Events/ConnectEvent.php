<?php

namespace Ansuir\EasyWebSocket\Events;

use Swoole\Http\Request;
use Swoole\WebSocket\Server;

class ConnectEvent
{

    /**
     * @var Server
     */
    protected $server;

    /**
     * @var Request
     */
    protected $request;

    /**
     * ConnectEvent constructor.
     *
     * @param \Swoole\WebSocket\Server $server
     * @param \Swoole\Http\Request     $request
     */
    protected function __construct(Server $server, Request $request)
    {
        $this->server = $server;
        $this->request = $request;
    }

    /**
     * @param \Swoole\WebSocket\Server $server
     * @param \Swoole\Http\Request     $request
     *
     * @return \Ansuir\EasyWebSocket\Events\ConnectEvent
     */
    public static function create(Server $server, Request $request)
    {
        return new self($server, $request);
    }

    /**
     * @return \Swoole\WebSocket\Server
     */
    public function server()
    {
        return $this->server;
    }

    /**
     * @return \Swoole\Http\Request
     */
    public function request()
    {
        return $this->request;
    }

    /**
     * @return int
     */
    public function fd()
    {
        return $this->request()->fd;
    }
}