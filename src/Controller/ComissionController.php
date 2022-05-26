<?php

namespace App\Controller;

use App\Entity\Comission;
use App\Form\ComissionType;
use App\Repository\ComissionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/comission")
 */
class ComissionController extends AbstractController
{
    /**
     * @Route("/", name="app_comission_index", methods={"GET"})
     */
    public function index(ComissionRepository $comissionRepository): Response
    {
        return $this->render('comission/index.html.twig', [
            'comissions' => $comissionRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_comission_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ComissionRepository $comissionRepository): Response
    {
        $comission = new Comission();
        $comission->setUser($this->getUser());
        $form = $this->createForm(ComissionType::class, $comission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comissionRepository->add($comission);
            return $this->redirectToRoute('app_comission_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('comission/new.html.twig', [
            'comission' => $comission,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{Title}", name="app_comission_show", methods={"GET"})
     */
    public function show(Comission $comission): Response
    {
        return $this->render('comission/show.html.twig', [
            'comission' => $comission,
        ]);
    }

    /**
     * @Route("/{Title}/edit", name="app_comission_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Comission $comission, ComissionRepository $comissionRepository): Response
    {
        $form = $this->createForm(ComissionType::class, $comission);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $comissionRepository->add($comission);
            return $this->redirectToRoute('app_comission_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('comission/edit.html.twig', [
            'comission' => $comission,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{Title}", name="app_comission_delete", methods={"POST"})
     */
    public function delete(Request $request, Comission $comission, ComissionRepository $comissionRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$comission->getId(), $request->request->get('_token'))) {
            $comissionRepository->remove($comission);
        }

        return $this->redirectToRoute('app_comission_index', [], Response::HTTP_SEE_OTHER);
    }
}
