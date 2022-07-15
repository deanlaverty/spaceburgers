<?php

declare(strict_types=1);

namespace App\DTOs;

final class OrderData
{
    public function __construct(
        private array $fillings,
        private int $bun
    )
    {
    }

    public function getFillings(): array
    {
        return $this->fillings;
    }

    public function getBun(): int
    {
        return $this->bun;
    }
}