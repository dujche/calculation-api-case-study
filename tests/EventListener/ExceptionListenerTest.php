<?php

declare(strict_types=1);

namespace App\Tests\EventListener;

use App\EventListener\ExceptionListener;
use Psr\Log\LoggerInterface;
use RuntimeException;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

class ExceptionListenerTest extends KernelTestCase
{
    public function testOnKernelExceptionWithBadRequestExceptionCaught()
    {
        self::bootKernel();

        $loggerMock = $this->createMock(LoggerInterface::class);
        $loggerMock->expects($this->once())->method('error')
            ->with('Caught following Symfony\Component\HttpKernel\Exception\BadRequestHttpException exception: foo');

        $eventMock = $this->createMock(ExceptionEvent::class);
        $eventMock->expects($this->once())->method('getThrowable')->willReturn(new BadRequestHttpException('foo'));
        $eventMock->expects($this->once())->method('setResponse')
            ->with($this->callback(function (Response $response) {
                return $response->getStatusCode() === 400;
            }));

        $listener = new ExceptionListener($loggerMock);

        $listener->onKernelException($eventMock);
    }

    public function testOnKernelExceptionWithGeneralExceptionCaught()
    {
        self::bootKernel();

        $loggerMock = $this->createMock(LoggerInterface::class);
        $loggerMock->expects($this->once())->method('error')
            ->with('Caught following RuntimeException exception: foo');

        $eventMock = $this->createMock(ExceptionEvent::class);
        $eventMock->expects($this->once())->method('getThrowable')->willReturn(new RuntimeException('foo'));
        $eventMock->expects($this->once())->method('setResponse')
            ->with($this->callback(function (Response $response) {
                return $response->getStatusCode() === 500;
            }));

        $listener = new ExceptionListener($loggerMock);

        $listener->onKernelException($eventMock);
    }
}
