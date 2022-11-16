<?php

declare(strict_types=1);

namespace App\Service\Json;

class JsonWriter extends ContentSource
{
    public function putContentToFile(string $data): bool
    {
        // put content
        $result = file_put_contents($this->filePath, $data);

        if(!$result) {
            return false;
        }

        return true;
    }
}