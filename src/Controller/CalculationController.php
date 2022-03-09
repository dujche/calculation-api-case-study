<?php

namespace App\Controller;

use App\DependencyInjection\OperationInterface;
use Psr\Log\LoggerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class CalculationController extends AbstractController
{
    use ResponseTrait;

    private LoggerInterface $logger;

    public function __construct(LoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    #[Route(
        path: '/api/v2/calculations/{firstArgument}/{secondArgument}/add',
        name: 'add_route',
        requirements: [
            'firstArgument' => '[+-]?(\d*\.)?\d+',
            'secondArgument' => '[+-]?(\d*\.)?\d+'
        ],
        methods: ['GET'],
    )]
    public function add(float $firstArgument, float $secondArgument, OperationInterface $addService): Response
    {
        return $this->json($this->getFormattedResult($addService, $firstArgument, $secondArgument));
    }

    #[Route(
        path: '/api/v2/calculations/{firstArgument}/{secondArgument}/subtract',
        name: 'subtract_route',
        requirements: [
            'firstArgument' => '[+-]?(\d*\.)?\d+',
            'secondArgument' => '[+-]?(\d*\.)?\d+'
        ],
        methods: ['GET'],
    )]
    public function subtract(float $firstArgument, float $secondArgument, OperationInterface $subtractService): Response
    {
        return $this->json($this->getFormattedResult($subtractService, $firstArgument, $secondArgument));
    }
    #[Route(
        path: '/api/v2/calculations/{firstArgument}/{secondArgument}/multiply',
        name: 'multiply_route',
        requirements: [
            'firstArgument' => '[+-]?(\d*\.)?\d+',
            'secondArgument' => '[+-]?(\d*\.)?\d+'
        ],
        methods: ['GET'],
    )]
    public function multiply(float $firstArgument, float $secondArgument, OperationInterface $multiplyService): Response
    {
        return $this->json($this->getFormattedResult($multiplyService, $firstArgument, $secondArgument));
    }
    #[Route(
        path: '/api/v2/calculations/{firstArgument}/{secondArgument}/divide',
        name: 'divide_route',
        requirements: [
            'firstArgument' => '[+-]?(\d*\.)?\d+',
            'secondArgument' => '[+-]?(\d*\.)?\d+'
        ],
        methods: ['GET'],
    )]
    public function divide(float $firstArgument, float $secondArgument, OperationInterface $divideService): Response
    {
        return $this->json($this->getFormattedResult($divideService, $firstArgument, $secondArgument));
    }
}
