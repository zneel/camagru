<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-05
 * Time: 20:02
 */

namespace Camagru\Controller;


use Camagru\Services\View\View;

class DefaultController
{
    public function indexAction()
    {
        $output = [];
        $output['data'] = 'asd';
        return View::render('home.php', $output);
    }
}