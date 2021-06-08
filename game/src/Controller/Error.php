<?php

declare(strict_types=1);

namespace Mos\Controller;

//use Nyholm\Psr7\Factory\Psr17Factory;
use Psr\Http\Message\ResponseInterface;

use function Mos\Functions\renderView;

/**
 * Controller for error routes.
 */
class Error extends ControllerBase
{
    public function do404(): ResponseInterface
    {
        $data = [
            "header" => "404",
            "message" => "The page you are requesting is not here. You may also checkout the HTTP response code, it should be 404.",
        ];

        $body = renderView("layout/page.php", $data);

        // Return the response through ControllerBase class
        return $this->response($body, 404);


//        $psr17Factory = new Psr17Factory();
//
//        return $psr17Factory
//            ->createResponse(404)
//            ->withBody($psr17Factory->createStream($body));
    }



    public function do405(array $allowed): ResponseInterface
    {
        $data = [
            "header" => "405",
            "message" => "Method is not allowed. Allowed methods are: "
                . implode(", ", $allowed),
        ];

        $body = renderView("layout/page.php", $data);

        // Return the response through parent class ControllerBase
        return $this->response($body, 405);



//        $psr17Factory = new Psr17Factory();
//
//        return $psr17Factory
//            ->createResponse(405)
//            ->withBody($psr17Factory->createStream($body));
    }
}
