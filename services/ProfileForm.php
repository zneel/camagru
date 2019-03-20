<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-24
 * Time: 14:53
 */
require_once 'ValidationErrors.php';
require_once 'FormValidator.php';
require_once 'FormValidatorInterface.php';


class ProfileForm extends FormValidator implements FormValidatorInterface
{
    public function validate(array $form)
    {
        if (!isset($form['username']) || !preg_match('/^[a-zA-Z0-9]{2,13}$/', $form['username'])) {
            $this->setValid(false);
            $this->setErrors(['username' => ValidationErrors::INVALID_USERNAME]);
        }
        if (!isset($form['receive_emails']) || !preg_match('/^(0|1)$/', (int)$form['receive_emails'])) {
            $this->setValid(false);
        }
        if (!isset($form['email']) || !filter_var($form['email'], FILTER_VALIDATE_EMAIL)) {
            $this->setValid(false);
            $this->setErrors(['email' => ValidationErrors::INVALID_EMAIL]);
        }
        if (!isset($form['password']) || !$this->validatePassword($form['password'])) {
            $this->setValid(false);
            $this->setErrors(['password' => ValidationErrors::INVALID_PASSWORD]);
        }
        return $this->isValid();
    }

    private function validatePassword(string $password)
    {
        if (preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{4,16}$/', $password) ||
            empty($password)) {
            return true;
        }
        return false;
    }
}