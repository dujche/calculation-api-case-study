<?php

namespace App\Service;

use App\DependencyInjection\OperationInterface;
use App\Entity\ArgumentsValueObject;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class DivideService implements OperationInterface
{
    public function calculate(ArgumentsValueObject $argumentsValueObject): float
    {
        if ($argumentsValueObject->getSecondNumber() === 0.0) {
            throw new BadRequestHttpException("Cannot divide by zero");
        }
        return $argumentsValueObject->getFirstNumber() / $argumentsValueObject->getSecondNumber();
    }
}
