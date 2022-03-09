<?php

declare(strict_types=1);

namespace App\Controller;

use App\Service\AddService;
use App\Service\DivideService;
use App\Service\MultiplyService;
use App\Service\SubtractService;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CalculationControllerWithSingleRoute extends AbstractController
{
    use ResponseTrait;

    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger, ContainerInterface $container)
    {
        $this->setContainer($container);
        $this->logger = $logger;
    }

    /**
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    #[Route(
        path: '/api/v1/calculations/{firstArgument}/{secondArgument}/{action}',
        name: 'calculate_route',
        requirements: [
            'firstArgument' => '[+-]?(\d*\.)?\d+',
            'secondArgument' => '[+-]?(\d*\.)?\d+',
            'action' => 'add|subtract|multiply|divide',
        ],
        methods: ['GET'],
    )]
    public function calculate(float $firstArgument, float $secondArgument, string $action): Response
    {
        return $this->json(
            $this->getFormattedResult(
                $this->container->get($action),
                $firstArgument,
                $secondArgument
            )
        );
    }

    /**
     * @codeCoverageIgnore
     */
    public static function getSubscribedServices(): array
    {
        return array_merge(
            parent::getSubscribedServices(),
            [
                'add' => AddService::class,
                'subtract' => SubtractService::class,
                'multiply' => MultiplyService::class,
                'divide' => DivideService::class,
            ]
        );
    }
}
