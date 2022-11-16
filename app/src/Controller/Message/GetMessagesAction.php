<?php

declare(strict_types=1);

namespace App\Controller\Message;

use App\Service\Json\GetMessage;
use App\Service\Json\JsonReader;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class GetMessagesAction extends AbstractController
{
    private GetMessage $getMessage;
    private JsonReader $jsonReader;

    public function __construct(
        GetMessage $getMessage,
        JsonReader $jsonReader
    )
    {
        $this->getMessage = $getMessage;
        $this->jsonReader = $jsonReader;
    }

    public function __invoke(Request $request): JsonResponse
    {
        // get param
        $time = $request->query->get('time');

        if(!$time) {
            // all messages
            $content = $this->jsonReader->getFileContent();
            return new JsonResponse($content, 200);
        }

        // get messages by time
        $messages = $this->getMessage->getMessagesByTime($time);

        return new JsonResponse($messages, 200);
    }
}