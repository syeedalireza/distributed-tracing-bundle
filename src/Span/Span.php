<?php

declare(strict_types=1);

namespace Syeedalireza\TracingBundle\Span;

final class Span
{
    private float $startTime;
    private ?float $endTime = null;
    private array $attributes = [];

    public function __construct(
        private readonly string $id,
        private readonly string $name,
        private readonly ?string $parentId = null,
    ) {
        $this->startTime = microtime(true);
    }

    public function end(): void
    {
        $this->endTime = microtime(true);
    }

    public function setAttribute(string $key, mixed $value): void
    {
        $this->attributes[$key] = $value;
    }

    public function getDuration(): float
    {
        return ($this->endTime ?? microtime(true)) - $this->startTime;
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'parent_id' => $this->parentId,
            'start_time' => $this->startTime,
            'end_time' => $this->endTime,
            'duration' => $this->getDuration(),
            'attributes' => $this->attributes,
        ];
    }
}
