<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\ArgumentsValueObject;
use App\Service\MultiplyService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

class MultiplyServiceTest extends KernelTestCase
{
    /**
     * @dataProvider  getTestData
     */
    public function testCalculate(float $firstArgument, float $secondArgument, float $result): void
    {
        self::bootKernel();

        $service = new MultiplyService();

        $this->assertEquals($result, $service->calculate(new ArgumentsValueObject($firstArgument, $secondArgument)));
    }

    public function getTestData(): array
    {
        return [
            'dataset #1' => [
                1.53,
                2,
                3.06
            ]
        ];
    }
}
