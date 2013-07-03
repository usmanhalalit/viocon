<?php namespace Viocon;

/**
 * This class gives the ability to access non-static methods statically
 *
 * Class AliasFacade
 *
 * @package Viocon
 */
class AliasFacade {

    protected static $vioconInstance;

    /**
     * @param $method
     * @param $args
     *
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        if(!static::$vioconInstance) {
            static::$vioconInstance = new Container();
        }

        return call_user_func_array(array(static::$vioconInstance, $method), $args);
    }

    public static function setVioconInstance($instance)
    {
        static::$vioconInstance = $instance;
    }
}