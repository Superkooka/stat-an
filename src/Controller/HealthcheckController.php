<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HealthcheckController
{
    #[Route('/', name: 'healthcheck')]
    public function healthcheck(): Response
    {
        return new Response("ok");
    }
}