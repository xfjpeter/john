<?php

namespace core\libs;

/**
 * controller model
 */
class Controller
{

    /**
     * [$params description]
     * @var [type]
     */
    public function render($file, $params = [])
    {
        $path = APP_PATH . 'views' . DS . $file . Conf::get('TEMP_EXT', 'router');

        if ( is_file($path) ) {
            \Twig_Autoloader::register();
            $loader = new \Twig_Loader_Filesystem(APP_PATH.'views/');
            $twig = new \Twig_Environment($loader, array(
                'cache' => RUNTIME_PATH.'cache/',
                'debug' => true
            ));
            $template = $twig -> loadTemplate($file . Conf::get('TEMP_EXT', 'router'));
            $template -> display($params);
        }
    }
}
