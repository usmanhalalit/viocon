<?php namespace Viocon;

/**
 * This class gives the ability to access non-static methods statically
 *
 * Class AliasFacade
 *
 * @package Viocon
 */
class AliasFacade {

    protected static $instance;

    /**
     * @param $method
     * @param $args
     *
     * @return mixed
     */
    public static function __callStatic($method, $args)
    {
        if(!static::$instance) {
            static::$instance = new Container();
        }

        return call_user_func_array(array(static::$instance, $method), $args);
    }

    public static function setInstance($instance)
    {
        static::$instance = $instance;
    }
}