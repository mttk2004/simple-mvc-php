<?php

namespace Http\Validators;

use Respect\Validation\Validator as v;

class Form
{
    public static function validateLoginForm(array $data): array
    {
        $emailValidator = v::email()->noWhitespace()->notEmpty();
        $passwordValidator = v::stringType()->length(8, 32)->notEmpty();

        $errors = [];

        if (!$emailValidator->validate($data['email'])) {
            $errors['email'] = 'Invalid email address';
        }

        if (!$passwordValidator->validate($data['password'])) {
            $errors['password'] = 'Invalid password';
        }

        return $errors;
    }
}
