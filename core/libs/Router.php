<?php

namespace core\libs;
use core\libs\Conf;

class Router
{

    public $instance; // controller
    public $method;   // method
    public $params;   // exists params

    public function __construct()
    {
        $this->router();
    }

    /**
     * dispatch router
     * @return [type] [description]
     */
    private function router()
    {
        // SCRIPT_FILENAME like D:/web/frame/index.php
        $script_file = isset( $_SERVER['SCRIPT_FILENAME'] ) ? $_SERVER['SCRIPT_FILENAME'] : '';

        // REQUEST_URI like /frame/index.php/index/index
        $request_uri = isset( $_SERVER['REQUEST_URI'] ) ? $_SERVER['REQUEST_URI'] : '';

        // from request_uri rmove script_file
        // script_file like \/frame\/index.php

        if ( PHP_OS == 'WINNT' ) { // Window
            if ( preg_match( '/^[\w]+\:\/[\w]+(.*)\/index\.php/i', $script_file, $res ) ) {
                $script_file = str_replace( '/', '\\/', preg_replace( '/^[\w]+\:\/[\w]+(.*)\/index\.php/i', '\1', $script_file ) );
            }
        } elseif (PHP_OS == 'Linux') { // Linux
        	 $document_root = str_replace( '/', '\\/', $_SERVER['DOCUMENT_ROOT'] );
            if ( preg_match( '/'.$document_root.'(.*)\/index\.php/i', $script_file, $res ) ) {

                $script_file = str_replace( '/', '\\/', preg_replace( '/'.$document_root.'(.*)\/index\.php/i', '\1', $script_file ) );
            }
        }

        // request_uri like /index/index or /
        if ( preg_match( '/'.$script_file.'/i', $request_uri, $res ) ) {
            $request_uri = preg_replace( '/'.$script_file.'/i', '', $request_uri );
        }

        // if index.php remove it
        if ( preg_match( '/\/index\.php/', $request_uri ) ) {echo '1';
            $request_uri = preg_replace( '/\/index\.php/', '', $request_uri );
        }

        // get controller and method
        if ( $request_uri != '' && $request_uri != '/' ) {
            // request_uri like /index/index
            $request_uri_arr = explode( '/', trim( $request_uri, '/' ) );
            // if exists controlelr
            if ( isset( $request_uri_arr[0] ) ) {
                $this->instance = ucfirst( $request_uri_arr[0] );
            } else {
                $this->instance = Conf::get( 'DEFAULT_CONTROLLER', 'router' );
            }
            // if exists method
            if ( isset( $request_uri_arr[1] ) ) {
                $this->method   = $request_uri_arr[1];
            } else {
                $this->method   = Conf::get( 'DEFAULT_ACTION', 'router' );
            }

            // if have more params
            $count = count( $request_uri_arr ) + 2;
            for ( $i = 2; $i < $count; $i += 2 ) {
                if ( isset($request_uri_arr[$i + 1]) ) {
                    // $_GET[$request_uri_arr[$i]] = $request_uri_arr[$i+1];
                    $this->params[$request_uri_arr[$i]] = urldecode( $request_uri_arr[$i + 1] );
                }
            }
        } else {
            // request_uri like /
            $this->instance = Conf::get( 'DEFAULT_CONTROLLER', 'router' );
            $this->method   = Conf::get( 'DEFAULT_ACTION', 'router' );
        }

    }
}
