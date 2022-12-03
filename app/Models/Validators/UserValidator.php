<?php

namespace Models\Validators;

use Models\Exceptions\FormException;
use Zephyrus\Application\Form;
use Zephyrus\Application\Rule;
use function PHPUnit\Framework\throwException;

class UserValidator
{
    public static function assert(array $params)
    {
        $form = new Form();
        $form->addFields($params);
        $form->field("username")->validate(Rule::notEmpty(localize("errors.not_empty")));
        $form->field("password")->validate(Rule::passwordCompliant(localize("errors.password")));
        if (!$form->verify()) {
            return false;
        }
        return true;
        //die();
    }
}