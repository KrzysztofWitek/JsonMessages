<?php

declare(strict_types=1);

namespace App\Controller\Message;

use App\Service\Json\GetMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class GetMessageAction extends AbstractController
{
    private GetMessage $getMessage;

    public function __construct(GetMessage $getMessage)
    {
        $this->getMessage = $getMessage;
    }

    public function __invoke(string $uuid): JsonResponse {
        $message = $this->getMessage->getMessageByUuid($uuid);

        if(!$message) {
            return new JsonResponse(['code' => 'unknown_message'], 404);
        }

        return new JsonResponse($message, 200);
    }
}