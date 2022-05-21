<?php

namespace App\Controller;
use App\Entity\ArtWork;
use App\Form\ArtWorkType;
use App\Repository\ArtWorkRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/artworks")
 */
class ArtWorkController extends AbstractController
{
    /**
     * @Route("/", name="app_art_work_index", methods={"GET"})
     */
    public function index(ArtWorkRepository $artWorkRepository): Response
    {
        return $this->render('art_work/index.html.twig', [
            'art_works' => $artWorkRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_art_work_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ArtWorkRepository $artWorkRepository): Response
    {
        $artWork = new ArtWork();
        $artWork->setUser($this->getUser());
        
        $form = $this->createForm(ArtWorkType::class, $artWork);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $artWorkRepository->add($artWork);
            return $this->redirectToRoute('app_art_work_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('art_work/new.html.twig', [
            'art_work' => $artWork,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{Title}", name="app_art_work_show", methods={"GET"})
     */
    public function show(ArtWork $artWork): Response
    {
        return $this->render('art_work/show.html.twig', [
            'art_work' => $artWork,
        ]);
    }

    /**
     * @Route("/{Title}/edit", name="app_art_work_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ArtWork $artWork, ArtWorkRepository $artWorkRepository): Response
    {
        $form = $this->createForm(ArtWorkType::class, $artWork);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $artWorkRepository->add($artWork);
            return $this->redirectToRoute('app_art_work_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('art_work/edit.html.twig', [
            'art_work' => $artWork,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{Title}", name="app_art_work_delete", methods={"POST"})
     */
    public function delete(Request $request, ArtWork $artWork, ArtWorkRepository $artWorkRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$artWork->getId(), $request->request->get('_token'))) {
            $artWorkRepository->remove($artWork);
        }

        return $this->redirectToRoute('app_art_work_index', [], Response::HTTP_SEE_OTHER);
    }
}
