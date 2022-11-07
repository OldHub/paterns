<?php

namespace Modules\Parser\Handlers\Core;

interface HandlerInterface
{
    public function setNext(HandlerInterface $handler): HandlerInterface;

    public function handle(bool $next, string $site, string $metro): ?string;
}
