<?php

namespace App\Controller;
use App\Repository\ComissionRepository;
use App\Repository\ArtWorkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfileController extends AbstractController
{
    /**
     * @Route("/profile", name="app_profile")
     */
    public function index(ArtWorkRepository $artWorkRepository , ComissionRepository $comissionRepository): Response
    {
        return $this->render('profile/index.html.twig', [
            'art_works' => $artWorkRepository->findAll(),
            'comissions' => $comissionRepository->findAll(),
        ]);
    }
}
