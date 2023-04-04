<?php

namespace App\Controller;

use App\Entity\Service;
use App\Entity\Reservation;
use App\Form\ReservationType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormFactoryInterface;

class ReservationController extends AbstractController
{
    private $formFactory;

    public function __construct(FormFactoryInterface $formFactory)
    {
        $this->formFactory = $formFactory;
    }

    public function create(Request $request): Response
    {
        $reservation = new Reservation();
        $form = $this->formFactory->create(ReservationType::class, $reservation);
        $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($reservation);
        $entityManager->flush();

        return $this->redirectToRoute('app_reservation_success');
    }

    return $this->render('reservation/create.html.twig', [
        'form' => $form->createView(),
    ]);
}


    /**
     * @Route("/reservation/success", name="reservation_success")
     */
    public function success(): Response
    {
        return $this->render('reservation/success.html.twig');
    }
}
