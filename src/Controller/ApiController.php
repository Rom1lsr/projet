<?php
// src/Controller/ApiController.php

namespace App\Controller;

use App\Entity\Service;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;

class ApiController extends AbstractController
{
    public function getServices(): JsonResponse
    {
        $services = $this->getDoctrine()->getRepository(Service::class)->findBy(['isPublic' => true]);

        $data = [];
        foreach ($services as $service) {
            $data[] = [
                'id' => $service->getId(),
                'key' => $service->getKey(),
                'name' => $service->getName(),
            ];
        }

        return $this->json($data);
    }
}
