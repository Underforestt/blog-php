<?php

declare(strict_types=1);

namespace Blog\Slim;


use Blog\Twig\AssetExtension;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\MiddlewareInterface;
use Psr\Http\Server\RequestHandlerInterface;
use Twig\Environment;

class TwigMiddleware implements MiddlewareInterface
{
    private Environment $environment;

    public function __construct(Environment $environment){
        $this->environment = $environment;
    }


    public function process(ServerRequestInterface $request, RequestHandlerInterface $handler): ResponseInterface
    {
        $this->environment->addExtension(new AssetExtension($request));
        return $handler->handle($request);
    }
}