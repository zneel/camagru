<?php
/**
 * Created by PhpStorm.
 * UserManager: ebouvier
 * Date: 2019-02-09
 * Time: 16:11
 */

interface FormValidator
{
    public function validate($form);

    public function setErrors(array $error);

    public function getErrors();
}