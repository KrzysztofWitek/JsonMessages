<?php

declare(strict_types=1);

namespace App\Service\Json;

class JsonReader extends ContentSource
{
    public function getFileContent()
    {
        if (!file_exists($this->filePath)) {
            // create file if not exist
            touch($this->filePath, strtotime('-1 days'));
        }

        return json_decode(file_get_contents($this->filePath), true);
    }
}