<?php

declare(strict_types=1);

namespace App\Tests\Service;

use App\Entity\ArgumentsValueObject;
use App\Service\DivideService;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class DivideServiceTest extends KernelTestCase
{
    public function testDivideByZeroThrowsException(): void
    {
        $this->expectException(BadRequestHttpException::class);

        self::bootKernel();

        $service = new DivideService();

        $service->calculate(new ArgumentsValueObject(0, 0));
    }

    /**
     * @dataProvider  getTestData
     */
    public function testCalculate(float $firstArgument, float $secondArgument, float $result): void
    {
        self::bootKernel();

        $service = new DivideService();

        $this->assertEquals($result, $service->calculate(new ArgumentsValueObject($firstArgument, $secondArgument)));
    }

    public function getTestData(): array
    {
        return [
            'dataset #1' => [
                1.53,
                2,
                0.765
            ]
        ];
    }
}
