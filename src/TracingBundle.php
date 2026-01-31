<?php

declare(strict_types=1);

namespace Syeedalireza\TracingBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

final class TracingBundle extends Bundle
{
    public function getPath(): string
    {
        return \dirname(__DIR__);
    }
}
