<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-23
 * Time: 15:07
 */


require_once 'ValidationErrors.php';
require_once 'FormValidator.php';
require_once 'FormValidatorInterface.php';


class ForgotPasswordForm extends FormValidator implements FormValidatorInterface
{

    public function validate(array $form)
    {
        if (!isset($form['email']) || !filter_var($form['email'], FILTER_VALIDATE_EMAIL)) {
            $this->setValid(false);
            $this->setErrors(['email' => ValidationErrors::INVALID_EMAIL]);
        }
        return $this->isValid();
    }
}