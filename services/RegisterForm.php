<?php
/**
 * Created by PhpStorm.
 * UserManager: ebouvier
 * Date: 2019-02-09
 * Time: 16:13
 */

require_once 'ValidationErrors.php';
require_once 'FormValidator.php';
require_once 'FormValidatorInterface.php';

class RegisterForm extends FormValidator implements FormValidatorInterface
{
    /**
     * @param $form
     * @return bool
     */
    public function validate($form)
    {

        if (strcmp($form['password'], $form['cpassword']) != 0) {
            $this->setValid(false);
            $this->setErrors(['password' => ValidationErrors::PASSWORD_DIFFERENT]);
        }
        if (strcmp($form['email'], $form['cemail']) != 0) {
            $this->setValid(false);
            $this->setErrors(['email' => ValidationErrors::EMAIL_DIFFERENT]);
        }
        if (!preg_match('/^[a-zA-Z0-9]{2,13}$/', $form['username'])) {
            $this->setValid(false);
            $this->setErrors(['username' => ValidationErrors::INVALID_USERNAME]);
        }
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{4,12}$/', $form['password'])) {
            $this->setValid(false);
            $this->setErrors(['password' => ValidationErrors::INVALID_PASSWORD]);
        }
        if (!filter_var($form['email'], FILTER_VALIDATE_EMAIL)) {
            $this->setValid(false);
            $this->setErrors(['email' => ValidationErrors::INVALID_EMAIL]);
        }
        return $this->isValid();
    }
}