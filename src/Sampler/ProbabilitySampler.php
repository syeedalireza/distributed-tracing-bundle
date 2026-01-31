<?php

declare(strict_types=1);

namespace Syeedalireza\TracingBundle\Sampler;

final class ProbabilitySampler
{
    public function __construct(
        private readonly float $probability = 1.0,
    ) {
        if ($probability < 0.0 || $probability > 1.0) {
            throw new \InvalidArgumentException('Probability must be between 0 and 1');
        }
    }

    public function shouldSample(): bool
    {
        return (mt_rand() / mt_getrandmax()) < $this->probability;
    }

    public function getProbability(): float
    {
        return $this->probability;
    }
}
