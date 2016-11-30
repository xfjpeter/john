<?php

namespace core\libs;

class Conf
{
    // save all config file
    static private $configs = [];

    /**
     * get single config
     * @param  [type] $name     [description]
     * @param  [type] $filename [description]
     * @return [type]           [description]
     */
    static public function get( $name, $filename )
    {
        if ( strpos($name, '.') ) {
            $name = explode('.', $name);
        }
        if ( is_array($name) ) {
            // array read config
            if ( isset(self::$configs[$filename][$name[0]][$name[1]]) ) {
                return self::$configs[$filename][$name[0]][$name[1]];
            } else {
                $path = CONFIG_PATH . $filename . '.php';
                if ( is_file($path) ) {
                    $config = include $path;
                    if ( isset($config[$name[0]][$name[1]]) ) {
                        self::$configs[$filename][$name[0]][$name[1]] = $config[$name[0]][$name[1]];
                        return $config[$name[0]][$name[1]];
                    }
                }
            }
        } else {
            // $name = strtolower( $name );
            if ( isset(self::$configs[$filename][$name]) ) {
                return self::$configs[$filename][$name];
            }

            $path = CONFIG_PATH . $filename . '.php';
            if ( is_file($path) ) {
                $config = include $path;
                if ( isset($config[$name]) ) {
                    self::$configs[$filename][$name] = $config[$name];
                    return $config[$name];
                } else {
                    throw new \Exception( 'Not found this config name:' . $name );
                }
            } else {
                throw new \Exception( 'Not found config file:' . $filename );
            }
        }
    }

    /**
     * get all config
     * @param  [type] $file [description]
     * @return [type]       [description]
     */
    static public function all($file)
    {
        // 已经缓存直接返回
        if (isset(self::$configs[$file])) {
            return self::$configs[$file];
        }

        // 没有缓存进行下面的操作
        $path = CONF_PATH.$file.'.php';
        if (is_file($path)) {
            $config = include $path;
            // $config = array_change_key_case($conf, CASE_LOWER);
            self::$configs[$file] = $config;
            return $config;
        } else {
            throw new \Exception('Not found config file:' . $file);
        }
    }

}
