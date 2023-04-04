<?php

namespace App\Controller;

use App\Entity\Service;
use App\Form\ServiceType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ServiceController extends AbstractController
{
    public function index(): Response
    {
        $services = $this->getDoctrine()->getRepository(Service::class)->findAll();

        return $this->render('service/index.html.twig', [
            'services' => $services,
        ]);
    }
    
}
