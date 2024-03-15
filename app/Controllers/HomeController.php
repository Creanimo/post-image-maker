<?php

declare(strict_types = 1);

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;
use Slim\Views\TwigMiddleware;

class HomeController
{
    public function index(Request $request, Response $response)
    {
        // Fetch the Twig instance from the request's attributes
        $twig = $request->getAttribute(Twig::class);
        return $twig->render($response, 'index.twig');
    }
}