<?php

namespace App\Entity;

use Symfony\Component\Validator\Constraints as Assert;

class ArgumentsValueObject
{
    /**
     * @Assert\Type("float")
     */
    private float $firstNumber;

    /**
     * @Assert\Type("float")
     */
    private float $secondNumber;

    public function __construct(float $firstNumber, float $secondNumber)
    {
        $this->firstNumber = $firstNumber;
        $this->secondNumber = $secondNumber;
    }

    /**
     * @return float
     */
    public function getFirstNumber(): float
    {
        return $this->firstNumber;
    }

    /**
     * @return float
     */
    public function getSecondNumber(): float
    {
        return $this->secondNumber;
    }
}