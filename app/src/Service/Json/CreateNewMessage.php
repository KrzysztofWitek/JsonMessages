<?php

declare(strict_types=1);

namespace App\Service\Json;

use App\Service\Generator\UuidGenerator;

class CreateNewMessage
{
    private UuidGenerator $uuidGenerator;
    private JsonReader $jsonReader;
    private JsonWriter $jsonWriter;

    public function __construct(
        UuidGenerator $uuidGenerator,
        JsonReader $jsonReader,
        JsonWriter $jsonWriter
    )
    {
        $this->uuidGenerator = $uuidGenerator;
        $this->jsonReader = $jsonReader;
        $this->jsonWriter = $jsonWriter;
    }

    public function createNewMessage(string $message): bool | array {

        $data = $this->jsonReader->getFileContent();

        $uuid = $this->uuidGenerator->generateUUID();

        $newMessage = [
            'uuid' => $uuid,
            'timestamp' => date('Y-d-m H:s:i'),
            'message' => $message
        ];

        $data['messages'][] = $newMessage;

        $done = $this->jsonWriter->putContentToFile(json_encode($data));

        if(!$done) {
            return false;
        }

        return [ 'message' => 'success', 'uuid' => $uuid ];
    }
}