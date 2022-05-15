<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ComissionsController extends AbstractController
{
    /**
     * @Route("/comissions", name="app_comissions")
     */
    public function index(): Response
    {
        return $this->render('comissions/index.html.twig', [
            'controller_name' => 'ComissionsController',
        ]);
    }
}
