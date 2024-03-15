<?php

declare(strict_types = 1);

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

class HomeController
{
    // If you're not using $args, you can remove it from the method signature
    public function index(Request $request, Response $response)
    {
        // Fetch the Twig instance from the request's attributes
        $twig = Twig::fromRequest($request);
        return $twig->render($response, 'index.twig');
    }
}