<?php

namespace App\Service;

use App\Requests\RequestHandler;
use Respect\Validation\Exceptions\NestedValidationException;

class ValidatorService
{
    public $errors = [];

    public function validate($request, array $rules)
    {
        foreach ($rules as $key => $rule) {
            try {
                $rule->setName($key)->assert(RequestHandler::getParam($request, $key));
            } catch (NestedValidationException $exception) {
                $this->errors[$key] = $exception->getMessages();
            }
        }
        return $this;
    }

    public function failed()
    {
        return !empty($this->errors);
    }
}