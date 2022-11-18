<?php

declare(strict_types=1);

namespace App\Controller\Message;

use App\factory\MessageCreatorFactory;
use App\Service\Json\CreateNewMessage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class CreateNewMessageAction extends AbstractController
{
    private CreateNewMessage $createNewMessage;
    private MessageCreatorFactory $messageCreatorFactory;

    public function __construct(
        CreateNewMessage $createNewMessage,
        MessageCreatorFactory $messageCreatorFactory
    )
    {
        $this->createNewMessage = $createNewMessage;
        $this->messageCreatorFactory = $messageCreatorFactory;
    }

    public function __invoke(Request $request): JsonResponse
    {
        $result = $this->messageCreatorFactory->createFromRequestBody($request);

        return new JsonResponse($result['data'], $result['code']);
    }
}