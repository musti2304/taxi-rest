<?php

namespace App\Controller;

use App\Service\HalteplatzService;
use App\Service\UserService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HalteplatzController extends AbstractController
{

    /**
     * GET /halteplaetze
     * @param Request $request
     * @return Response
     */
    public function getHalteplaetze(Request $request): Response
    {
        $service = new HalteplatzService();

        return $this->json($service->getData());
    }

    /**
     * GET /users
     * @param Request $request
     * @return Response
     */
    public function getUsers(Request $request): Response
    {
        $service = new UserService();

        return $this->json($service->getData());
    }
}
