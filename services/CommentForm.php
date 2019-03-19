<?php
/**
 * Created by PhpStorm.
 * User: ebouvier
 * Date: 2019-03-18
 * Time: 14:49
 */

require_once 'ValidationErrors.php';
require_once 'FormValidator.php';
require_once 'FormValidatorInterface.php';

class CommentForm extends FormValidator implements FormValidatorInterface
{

    public function validate(array $form)
    {
        if (!preg_match('/\w\s*/', $form['comment'])) {
            $this->setValid(false);
            $this->setErrors(['comment' => ValidationErrors::COMMENT_ERROR]);
        }
        if (strlen($form['comment']) <= 0 || strlen($form['comment']) > 1000) {
            $this->setValid(false);
            $this->setErrors(['comment' => ValidationErrors::COMMENT_ERROR]);
        }
        return $this->isValid();
    }
}