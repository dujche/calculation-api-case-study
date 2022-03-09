<?php

namespace App\Service;

use App\DependencyInjection\OperationInterface;
use App\Entity\ArgumentsValueObject;

class MultiplyService implements OperationInterface
{
    public function calculate(ArgumentsValueObject $argumentsValueObject): float
    {
        return $argumentsValueObject->getFirstNumber() * $argumentsValueObject->getSecondNumber();
    }
}
