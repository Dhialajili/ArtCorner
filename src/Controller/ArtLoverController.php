<?php

namespace App\Controller;

use App\Entity\ArtLover;
use App\Form\ArtLoverType;
use App\Repository\ArtLoverRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/artlover")
 */
class ArtLoverController extends AbstractController
{
    /**
     * @Route("/", name="app_art_lover_index", methods={"GET"})
     */
    public function index(ArtLoverRepository $artLoverRepository): Response
    {
        return $this->render('art_lover/index.html.twig', [
            'art_lovers' => $artLoverRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_art_lover_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ArtLoverRepository $artLoverRepository): Response
    {
        $artLover = new ArtLover();
        $artLover->setUser($this->getUser());
        $form = $this->createForm(ArtLoverType::class, $artLover);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $artLoverRepository->add($artLover);
            return $this->redirectToRoute('app_profile', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('art_lover/new.html.twig', [
            'art_lover' => $artLover,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{username}", name="app_art_lover_show", methods={"GET"})
     */
    public function show(ArtLover $artLover): Response
    {
        return $this->render('art_lover/show.html.twig', [
            'art_lover' => $artLover,
        ]);
    }

    /**
     * @Route("/{username}/edit", name="app_art_lover_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ArtLover $artLover, ArtLoverRepository $artLoverRepository): Response
    {
        $form = $this->createForm(ArtLoverType::class, $artLover);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $artLoverRepository->add($artLover);
            return $this->redirectToRoute('app_profile', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('art_lover/edit.html.twig', [
            'art_lover' => $artLover,
            'form' => $form,
        ]);
    }

    
}
