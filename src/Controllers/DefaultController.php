<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-05
 * Time: 20:02
 */

namespace Camagru\Controllers;


class DefaultController extends BaseController
{
    public function indexAction()
    {
        require __DIR__ . '/../Views/layout.php';
        return;
    }
}