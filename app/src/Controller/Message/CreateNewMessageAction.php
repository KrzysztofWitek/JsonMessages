<?php

declare(strict_types=1);

namespace App\Controller\Message;

use App\Service\Json\CreateNewMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CreateNewMessageAction extends AbstractController
{
    private CreateNewMessage $createNewMessage;

    public function __construct(CreateNewMessage $createNewMessage)
    {
        $this->createNewMessage = $createNewMessage;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $params = json_decode($request->getContent(), true);

        // handle post
        $message = $params['message'] ?? $request->request->get('message');

        if(empty($message)) {
            return new JsonResponse(['message' => 'missing message'], 400);
        }

        $result = $this->createNewMessage->createNewMessage($message);

        if(!$result) {
            return new JsonResponse(['message' => 'failed'], 500);
        }

        return new JsonResponse($result, 201);
    }
}