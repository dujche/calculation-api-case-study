<?php

namespace App\Tests\Controller;

use ApiPlatform\Core\Bridge\Symfony\Bundle\Test\ApiTestCase;

class CalculationControllerTest extends ApiTestCase
{
    private const API_V1_URL = '/api/v1/calculations/1.8/4.44/';

    private const API_V2_URL = '/api/v2/calculations/1.8/4.44/';

    /**
     * @dataProvider getTestData
     */
    public function testRouteOnV1(string $action, float $result): void
    {
        static::createClient()->request('GET', static::API_V1_URL . $action);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(
            [
                'firstArgument' => 1.8,
                'secondArgument' => 4.44,
                'result' => $result,
            ]
        );
    }

    /**
     * @dataProvider getTestData
     */
    public function testRouteOnV2(string $action, float $result): void
    {
        static::createClient()->request('GET', static::API_V2_URL . $action);

        $this->assertResponseIsSuccessful();
        $this->assertJsonContains(
            [
                'firstArgument' => 1.8,
                'secondArgument' => 4.44,
                'result' => $result,
            ]
        );
    }

    public function getTestData()
    {
        return [
            'add_route' => [
                'add',
                6.24
            ],
            'subtract_route' => [
                'subtract',
                -2.64
            ],
            'multiply_route' => [
                'multiply',
                7.99
            ],
            'divide_route' => [
                'divide',
                0.41
            ]
        ];
    }
}
