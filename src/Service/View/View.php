<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-06
 * Time: 17:29
 */

namespace Camagru\Services\View;

class View
{
    protected $data;

    /**
     * @param $view
     * @param array $args
     * @throws \Exception
     */
    public static function render($view, $args = [])
    {
        extract($args, EXTR_SKIP);
        $file = dirname(__DIR__) . "/../View/$view";
        if (is_readable($file)) {
            require $file;
        } else {
            throw new \Exception("$file not found");
        }
    }

    public function assign($key, $val)
    {
        $this->data[$key] = $val;
    }
}