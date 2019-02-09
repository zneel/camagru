<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-09
 * Time: 16:13
 */

namespace Camagru\Service\Form;


class RegisterForm implements FormValidator
{
    public $errors = [];
    public $valid = true;

    public function validate($form)
    {
        if (!strcmp($form['password'], $form['cpassword']) != 0) {
            $this->valid = false;
            $this->setErrors(['password' => ValidationErrors::PASSWORD_DIFFERENT]);
        }
        if (!strcmp($form['email'], $form['cemail']) != 0) {
            $this->valid = false;
            $this->setErrors(['email' => ValidationErrors::EMAIL_DIFFERENT]);
        }
        if (!preg_match('/^[a-zA-Z0-9]{2,13}$/', $form['username'])) {
            $this->valid = false;
            $this->setErrors(['username' => ValidationErrors::INVALID_USERNAME]);
        }
        if (!preg_match('/^[a-zA-Z0-9@$!?]{2,5}$/', $form['password'])) {
            $this->valid = false;
            $this->setErrors(['password' => ValidationErrors::INVALID_PASSWORD]);
        }
        if (!filter_var($form['email'], FILTER_VALIDATE_EMAIL)) {
            $this->valid = false;
            $this->setErrors(['email' => ValidationErrors::INVALID_EMAIL]);
        }
        echo '<pre>';
        var_dump($this->valid);
        var_dump($this->getErrors());
        echo '</pre>';
        die();
        return $this->valid;
    }

    public function setErrors(array $error)
    {
        array_push($this->errors, $error);
    }

    public function getErrors()
    {
        return $this->errors;
    }
}