<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-02-09
 * Time: 16:11
 */

namespace Camagru\Service\Form;


interface FormValidator
{
    public function validate($form);

    public function setErrors(array $error);

    public function getErrors();
}