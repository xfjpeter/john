<?php

namespace core\libs;
use core\libs\Conf;

/**
 * database model
 */
class Model extends \medoo
{
    public function __construct()
    {
        parent::__construct(Conf::get('meedo', 'database'));
    }
}
