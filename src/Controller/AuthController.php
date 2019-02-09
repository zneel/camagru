<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-06
 * Time: 17:27
 */

namespace Camagru\Controller;

use Camagru\Services\View\View;
use Camagru\Service\Form\RegisterForm;

class AuthController
{
    public function getRegisterPageAction()
    {
        View::render('register.php');
    }

    public function getLoginPageAction()
    {
        View::render('login.php');
    }

    public function postRegisterAction()
    {
        if (isset($_POST)) {
            $registerForm = new RegisterForm();
            $registerForm->validate($_POST);
        }
    }

    public function postLoginAction()
    {
        var_dump($_POST);
        var_dump($_GET);
        die();
    }

    public function forgotPasswordAction()
    {
        return;
    }
}