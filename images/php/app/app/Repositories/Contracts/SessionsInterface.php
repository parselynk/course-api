<?php

namespace App\Repositories\Contracts;

interface SessionsInterface
{
    public function getProgressHistory(int $id): array;
}
