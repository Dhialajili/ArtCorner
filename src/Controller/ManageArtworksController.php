<?php

namespace App\Controller;

use App\Repository\ArtWorkRepository;
use App\Repository\ComissionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ManageArtworksController extends AbstractController
{
    /**
     * @Route("/manage/artworks", name="app_manage_artworks")
     */
    public function index(ArtWorkRepository $artWorkRepository , ComissionRepository $comissionRepository): Response
    {
        return $this->render('manage_artworks/index.html.twig', [
            'art_works' => $artWorkRepository->findAll(),
            'comissions' => $comissionRepository->findAll(),
        ]);
    }
}
