<?php

namespace Ansuir\EasyWebSocket;

use Ansuir\EasyWebSocket\Events\ConnectEvent;
use Ansuir\EasyWebSocket\Events\ConnectionClosedEvent;
use Ansuir\EasyWebSocket\Events\MessageArrivedEvent;
use Ansuir\EasyWebSocket\Interfaces\OnCloseEventInterface;
use Ansuir\EasyWebSocket\Interfaces\OnMessageEventInterface;
use Ansuir\EasyWebSocket\Interfaces\OnOpenEventInterface;
use Ansuir\EasyWebSocket\Listener\OnCloseEventListener;
use Ansuir\EasyWebSocket\Listener\OnMessageEventListener;
use Ansuir\EasyWebSocket\Listener\OnOpenEventListener;
use Swoole\Http\Request;
use Swoole\WebSocket\Frame;
use Swoole\WebSocket\Server;

class WebSocket
{
    /**
     * @var \Swoole\WebSocket\Server
     */
    protected $server;

    /**
     * @var string 绑定IP
     */
    protected $ip;

    /**
     * @var int 监听端口
     */
    protected $port;

    /**
     * @var OnOpenEventInterface WebSocket服务开启监听器
     */
    protected $onOpenEventListener;

    /**
     * @var OnCloseEventInterface WebSocket服务器关闭监听器
     */
    protected $onCloseEventListener;

    /**
     * @var OnMessageEventInterface WebSocket服务器消息监听器
     */
    protected $onMessageEventListener;

    /**
     * WebSocket constructor.
     *
     * @param int $port
     */
    protected function __construct(string $ip, int $port)
    {
        $this->ip = $ip;
        $this->port = $port;
    }

    /**
     * @param int $port
     *
     * @return WebSocket
     */
    public static function listen(string $ip, int $port)
    {
        $webSocket = new self($ip, $port);
        return $webSocket;
    }

    /**
     * 设置 WebSocket 服务器开启监听器
     *
     * @param OnOpenEventInterface $onOpenEventListener
     *
     * @return $this
     */
    public function onOpen(OnOpenEventInterface $onOpenEventListener)
    {
        $this->onOpenEventListener = $onOpenEventListener;
        return $this;
    }

    /**
     * 设置 WebSocket 服务器关闭监听器
     *
     * @param OnCloseEventInterface $onCloseEventListener
     *
     * @return $this
     */
    public function onClose(OnCloseEventInterface $onCloseEventListener)
    {
        $this->onCloseEventListener = $onCloseEventListener;
        return $this;
    }

    /**
     * 设置 WebSocket 服务器消息监听器
     *
     * @param OnMessageEventInterface $onMessageEventListener
     *
     * @return $this
     */
    public function onMessage(OnMessageEventInterface $onMessageEventListener)
    {
        $this->onMessageEventListener = $onMessageEventListener;
        return $this;
    }

    /**
     * 启动 WebSocket 服务器
     *
     * @param $ip
     *
     * @return bool
     */
    public function start()
    {
        $this->server = new Server($this->ip, $this->port);
        $this->setOnOpen()->setOnMessage()->setOnClose();

        return $this->server->start();
    }

    /**
     * @return $this
     */
    protected function setOnOpen()
    {
        if ($this->server instanceof Server) {

            $this->server->on('open', function (Server $server, Request $request) {

                // 系统事件处理程序
                OnOpenEventListener::instance()->handle(ConnectEvent::create($server, $request));

                // 分发用户自定义事件处理程序
                if ($this->onOpenEventListener instanceof OnOpenEventInterface) {
                    $this->onOpenEventListener->handle(ConnectEvent::create($server, $request));
                }

            });
        }

        return $this;
    }

    /**
     * @return $this
     */
    protected function setOnClose()
    {
        if ($this->server instanceof Server) {

            $this->server->on('close', function (Server $server, $fd) {

                // 系统事件处理程序
                OnCloseEventListener::instance()->handle(ConnectionClosedEvent::create($server, $fd));

                // 分发用户自定义事件处理程序
                if ($this->onCloseEventListener instanceof OnCloseEventInterface) {
                    $this->onCloseEventListener->handle(ConnectionClosedEvent::create($server, $fd));
                }

            });
        }

        return $this;
    }

    /**
     * @return $this
     */
    protected function setOnMessage()
    {
        if ($this->server instanceof Server) {

            if (!$this->onMessageEventListener instanceof OnMessageEventInterface) {
                throw new \Exception("Unexpected Message Listener", 500);
            }

            $this->server->on('message', function (Server $server, Frame $frame) {

                // 系统事件处理程序
                OnMessageEventListener::instance()->handle(MessageArrivedEvent::create($server, $frame));

                // 分发用户自定义事件处理程序
                $this->onMessageEventListener->handle(MessageArrivedEvent::create($server, $frame));

            });
        }

        return $this;
    }
}