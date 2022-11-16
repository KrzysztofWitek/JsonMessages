<?php

namespace App\Controller\Page;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ShowIndexPageAction extends AbstractController
{
    public function __invoke(): JsonResponse
    {
        return new JsonResponse([], 200);
    }
}
