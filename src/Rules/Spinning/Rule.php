<?php

namespace App\Rules\Spinning;

use App\Rules\Rule as BaseRule;

class Rule extends BaseRule
{
    public function getSpinningMap(): array
    {
        $this->ruleMap = [
            'L' => [
                'N' => 'W',
                'W' => 'S',
                'S' => 'E',
                'E' => 'N',
            ],
            'R' => [
                'N' => 'E',
                'E' => 'S',
                'S' => 'W',
                'W' => 'N',
            ],
        ];

        return $this->ruleMap;
    }

}
