<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\Artist;
use App\Form\ArtistType;
use App\Repository\ArtistRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/artist/profile")
 */
class ArtistProfileController extends AbstractController
{
    /**
     * @Route("/", name="app_artist_profile_index", methods={"GET"})
     */
    public function index(ArtistRepository $artistRepository): Response
    {
        return $this->render('artist_profile/index.html.twig', [
            'artists' => $artistRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_artist_profile_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ArtistRepository $artistRepository): Response
    {
        $artist = new Artist();
        $artist->setUser($this->getUser());

        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $artistRepository->add($artist);
            return $this->redirectToRoute('app_artist_profile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('artist_profile/new.html.twig', [
            'artist' => $artist,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{username}", name="app_artist_profile_show", methods={"GET"})
     */
    public function show(Artist $artist): Response
    {
        return $this->render('artist_profile/show.html.twig', [
            'artist' => $artist,
        ]);
    }

    /**
     * @Route("/{username}/edit", name="app_artist_profile_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, Artist $artist, ArtistRepository $artistRepository): Response
    {
        $form = $this->createForm(ArtistType::class, $artist);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $artistRepository->add($artist);
            return $this->redirectToRoute('app_artist_profile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('artist_profile/edit.html.twig', [
            'artist' => $artist,
            'form' => $form,
        ]);
    }

   
}
