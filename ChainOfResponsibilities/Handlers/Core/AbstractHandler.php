<?php

namespace Modules\Parser\Handlers\Core;

abstract class AbstractHandler implements HandlerInterface
{
    private $nextHandler;

    public function setNext(HandlerInterface $handler): HandlerInterface
    {
        $this->nextHandler = $handler;
        return $handler;
    }

    public function handle(bool $next, string $site, string $metro): ?string
    {
        if ($this->nextHandler) {
            return $this->nextHandler->handle($next, $site, $metro);
        }

        return null;
    }
}
