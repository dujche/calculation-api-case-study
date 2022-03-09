<?php

namespace App\Service;

use App\DependencyInjection\OperationInterface;
use App\Entity\ArgumentsValueObject;

class SubtractService implements OperationInterface
{
    public function calculate(ArgumentsValueObject $argumentsValueObject): float
    {
        return $argumentsValueObject->getFirstNumber() - $argumentsValueObject->getSecondNumber();
    }
}
