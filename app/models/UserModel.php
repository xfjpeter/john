<?php

namespace app\models;
use core\libs\model;

class UserModel extends model
{
    public function test()
    {
        return $this->get('order', '*');
    }
}
