<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CheckYourEmailController extends AbstractController
{
    /**
     * @Route("/check_your_email", name="app_check_your_email")
     */
    public function index(): Response
    {
        return $this->render('check_your_email/index.html.twig', [
            'controller_name' => 'CheckYourEmailController',
        ]);
    }
}
