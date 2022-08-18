<?php

namespace App\Rules\Moving;

use App\Rules\Rule as BaseRule;

class Rule extends BaseRule
{
    public function getMovingMap(): array
    {
        $this->ruleMap = [
            'N' => [
                'coordinate' => 'y',
                'alteration' => 1,
            ],
            'S' => [
                'coordinate' => 'y',
                'alteration' => -1,
            ],
            'E' => [
                'coordinate' => 'x',
                'alteration' => 1,
            ],
            'W' => [
                'coordinate' => 'x',
                'alteration' => -1,
            ],
        ];
        return $this->ruleMap;
    }

}
