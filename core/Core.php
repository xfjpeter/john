<?php

namespace core;
use core\libs\Router;
use core\libs\Conf;

class Core
{
    static private $classMap = [];
    /**
     * launch frame
     * @return [type] [description]
     */
    static public function run()
    {
        // dispatcher router
        self::dispatch();
    }

    /**
     * autoload class
     * @param  string $className class name
     * @return [type]            [description]
     */
    static public function autoload( $className )
    {
        if ( isset( self::$classMap[$className] ) ) {
            return true;
        } else {
            $className = str_replace( '\\', '/', $className );
            $path      = BASE_PATH . $className . '.php';
            include $path;
            self::$classMap[$className] = $className;
        }
    }

    /**
     * call router dispatch controller
     * @return [type] [description]
     */
    static private function dispatch()
    {
        $router = new \core\libs\Router;
        // dispatch controller
        $path  = APP_PATH . 'controllers' . DS . $router->instance . Conf::get('CONTROLLER_EXT', 'router') . Conf::get( 'DEFAULT_EXT', 'router' );
        $class = '\\' . APP_NAME . '\\' . 'controllers\\' . $router->instance . 'Controller';

        // instantiation controller
        if (is_file( $path )) {
            $instance = new $class;
            // call controller follow method
            if (method_exists( $instance, $router->method )) {
                // have method
                // if exists params
                if (!empty($router -> params)) {
                    $result = call_user_func_array( [$instance, $router->method], $router -> params );
                } else {
                    $result = call_user_func( [$instance, $router->method] );
                }
                if ( is_array($result) ) {
                    echo json_encode($result, JSON_UNESCAPED_UNICODE);
                } elseif ( is_object($result) ) {
                    dump($result);
                } else {
                    echo $result;
                }
            } else {
                throw new \ErrorException('not found method:' . $router -> method);
            }
        } else {
            throw new \ErrorException( 'not found controller:' . $path );
        }
    }
}
