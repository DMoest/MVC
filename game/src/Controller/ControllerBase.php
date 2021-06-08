<?php

declare(strict_types=1);

namespace Mos\Controller;

use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;


/**
 * Base controller with utilities for controller.
 */
class ControllerBase
{
    protected function response(
        string $body,
        int $status=200
    ): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        return $psr17Factory
            ->createResponse($status)
            ->withBody($psr17Factory->createStream($body));
    }

    protected function redirect(
        string $url,
        int $status=301
    ): ResponseInterface
    {
        $psr17Factory = new Psr17Factory();

        return $psr17Factory
            ->createResponse($status)
            ->withHeader("Location", $url);
    }
}
