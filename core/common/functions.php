<?php

/**
 * print array or object or string or null
 * @param  mixed $var need print data
 * @return [type]      [description]
 */
function p($var) {
    if (is_bool($var)) {
        var_dump($var);
    }
    if (is_null($var)) {
        var_dump(NULL);
    }
    echo '<pre style="font-family: Microsoft YaHei;font-size: 12px;padding :15px; margin: 15px; border-radius: 3px; border: 1px solid #ddd; background-color: #f5f5f5;">'.print_r($var, true).'</pre>';

}
