<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-26
 * Time: 11:27
 */

require_once 'ValidationErrors.php';
require_once 'FormValidator.php';
require_once 'FormValidatorInterface.php';

class ResetPasswordForm extends FormValidator implements FormValidatorInterface
{

    public function validate(array $form)
    {
        if (strcmp($form['password'], $form['cpassword']) != 0) {
            $this->setValid(false);
            $this->setErrors(['password_not_same' => ValidationErrors::PASSWORD_DIFFERENT]);
        }
        if (!preg_match('/^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{4,16}$/', $form['password'])) {
            $this->setValid(false);
            $this->setErrors(['password_not_valid' => ValidationErrors::INVALID_PASSWORD]);
        }
        return $this->isValid();
    }
}