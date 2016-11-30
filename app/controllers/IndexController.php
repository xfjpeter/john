<?php

namespace app\controllers;
use core\libs\Controller;
use app\models\UserModel;

class IndexController extends Controller
{
    public function index($id = '', $name = '', $age = '')
    {
        // return 'abcd';
        //
        // return 'IndexController - index - '.$id . $name . $age;
    /*    $user = new UserModel;
        return $user->test();*/
        // echo 'abcd';
        //

        // return $this->render('index', ['title'=>'website']);

        /*$httpRequest = \Ws\Http\Request::create();
        $headers  = [];
        $query    = [];
        $i = 0;
        while($i<10) {
            $response = $httpRequest->get('http://web.app.net/index.php/article/show/aid/1', $headers, $query);
            $i++;
            return $i;
        }*/
        return 'a';

    }
}
