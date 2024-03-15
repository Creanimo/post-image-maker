<?php

declare(strict_types = 1);

namespace App\Controllers;

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Views\Twig;

namespace App\Controllers;

use Slim\Views\Twig;

class HomeController
{
    protected $view;

    public function __construct(Twig $view)
    {
        $this->view = $view;
    }

    public function index(Request $request, Response $response)
    {
        // Fetch the Twig instance from the request's attributes
        $twig = Twig::fromRequest($request);
        return $twig->render($response, 'index.twig');
    }
}