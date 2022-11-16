<?php

declare(strict_types=1);

namespace App\Service\Json;

abstract class ContentSource
{
    protected string $filePath = __DIR__ . "/../../.." . '/data/messages.json';
}