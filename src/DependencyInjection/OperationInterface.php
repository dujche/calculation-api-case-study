<?php

declare(strict_types=1);

namespace App\DependencyInjection;

use App\Entity\ArgumentsValueObject;

interface OperationInterface
{
    public function calculate(ArgumentsValueObject $argumentsValueObject): float;
}
