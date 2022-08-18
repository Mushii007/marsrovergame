<?php

namespace App\Rules;

class RuleFactory
{
    public function createRule(string $rule = 'moving'): Rule
    {
        try {
            $ruleName = "App\\Rules\\" . ucwords($rule) . "\\Rule";
            if (!class_exists($ruleName)) {
                throw new \Exception("A class with the name of $ruleName  doesn't exists");
            }
            return new $ruleName();

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }
}
