<?php

declare(strict_types=1);

namespace App\Controller;

use App\DependencyInjection\OperationInterface;
use App\Entity\ArgumentsValueObject;

trait ResponseTrait
{
    /**
     * @param OperationInterface $addService
     * @param float $firstArgument
     * @param float $secondArgument
     * @return array
     */
    private function getFormattedResult(
        OperationInterface $addService,
        float $firstArgument,
        float $secondArgument
    ): array {
        $result = [
            'firstArgument' => $firstArgument,
            'secondArgument' => $secondArgument,
            'result' =>
                (float) number_format(
                    $addService->calculate(new ArgumentsValueObject($firstArgument, $secondArgument)),
                    2
                )
        ];

        $this->logger->debug(sprintf("Giving back the following output: %s", json_encode($result)));

        return $result;
    }
}
