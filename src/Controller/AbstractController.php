<?php

declare(strict_types=1);

namespace HelloWorld\Controller;

abstract class AbstractController
{
    protected function redirect(string $location): void
    {
        header('Location: '.$location);

        exit;
    }
}