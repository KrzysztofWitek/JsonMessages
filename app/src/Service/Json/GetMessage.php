<?php

declare(strict_types=1);

namespace App\Service\Json;

class GetMessage
{
    private JsonReader $jsonReader;

    public function __construct(JsonReader $jsonReader)
    {
        $this->jsonReader = $jsonReader;
    }

    public function getMessageByUuid(string $uuid): bool|array
    {
        $data = $this->jsonReader->getFileContent();

        // check if uuid is equal
        foreach ($data['messages'] as $message) {
            if($message['uuid'] === $uuid) {
                return $message;
            }
        }

        return false;
    }

    public function getMessagesByTime(string $time): array
    {
        $data = $this->jsonReader->getFileContent();

        // get length string to trim timestamps for compare purposes
        $length = strlen($time);

        $selected = [];

        // check by condition, add to prepared array if ok
        foreach ($data['messages'] as $message) {
            if(substr($message['timestamp'], 0, $length) === $time) {
                $selected[] = $message;
            }
        }

        return $selected;
    }
}