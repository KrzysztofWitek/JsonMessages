<?php

declare(strict_types=1);

namespace App\factory;

use App\Service\Json\CreateNewMessage;
use Symfony\Component\HttpFoundation\Request;

class MessageCreatorFactory
{
    private CreateNewMessage $createNewMessage;

    public function __construct(
        CreateNewMessage $createNewMessage
    ){
        $this->createNewMessage = $createNewMessage;
    }

    public function createFromRequestBody(Request $request): array
    {
        $messageContent = json_decode($request->getContent(), true)['message'] ?? $request->request->get('message');

        if(empty($messageContent)) {
            return ['data' => ['message' => 'missing message'], 'code' => 400];
        }

        return $this->createNewMessage->createNewMessage($messageContent);
    }
}