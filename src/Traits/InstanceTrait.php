<?php

namespace Ansuir\EasyWebSocket\Traits;

trait InstanceTrait
{
    /**
     * @var static
     */
    protected static $instance;

    /**
     * 获取单例
     *
     * @return static
     */
    public static function instance()
    {
        return self::$instance ?: (self::$instance = new static);
    }

    protected function __clone()
    {

    }

    protected function __sleep()
    {

    }

    protected function __wakeup()
    {

    }
}