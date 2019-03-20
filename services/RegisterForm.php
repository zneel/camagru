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
    public function validate(array $form)
    {

        if (!isset($form['cpassword']) || !isset($form['password']) || strcmp($form['password'], $form['cpassword']) != 0) {
            $this->setValid(false);
            $this->setErrors(['password' => ValidationErrors::PASSWORD_DIFFERENT]);
        }
        if (!isset($form['email']) || !isset($form['cemail']) || strcmp($form['email'], $form['cemail']) != 0) {
            $this->setValid(false);
            $this->setErrors(['email' => ValidationErrors::EMAIL_DIFFERENT]);
        }
        if (!isset($form['username']) || !preg_match('/^[a-zA-Z0-9]{2,13}$/', $form['username'])) {
            $this->setValid(false);
            $this->setErrors(['username' => ValidationErrors::INVALID_USERNAME]);
        }
        if (!isset($form['password']) || !preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{4,16}$/', $form['password'])) {
            $this->setValid(false);
            $this->setErrors(['password' => ValidationErrors::INVALID_PASSWORD]);
        }
        if (!isset($form['email']) || !filter_var($form['email'], FILTER_VALIDATE_EMAIL)) {
            $this->setValid(false);
            $this->setErrors(['email' => ValidationErrors::INVALID_EMAIL]);
        }
        return $this->isValid();
    }
}