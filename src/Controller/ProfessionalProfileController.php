<?php

namespace App\Controller;
use App\Entity\User;
use App\Entity\ProfessionalProfile;
use App\Form\ProfessionalProfileType;
use App\Repository\ProfessionalProfileRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/professional/profile")
 */
class ProfessionalProfileController extends AbstractController
{
    /**
     * @Route("/", name="app_professional_profile_index", methods={"GET"})
     */
    public function index(ProfessionalProfileRepository $professionalProfileRepository): Response
    {
        return $this->render('professional_profile/index.html.twig', [
            'professional_profiles' => $professionalProfileRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="app_professional_profile_new", methods={"GET", "POST"})
     */
    public function new(Request $request, ProfessionalProfileRepository $professionalProfileRepository): Response
    {
        $professionalProfile = new ProfessionalProfile();
        $professionalProfile->setEmail($this->getUser());
        
        $form = $this->createForm(ProfessionalProfileType::class, $professionalProfile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $professionalProfileRepository->add($professionalProfile);
            return $this->redirectToRoute('app_professional_profile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('professional_profile/new.html.twig', [
            'professional_profile' => $professionalProfile,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{username}", name="app_professional_profile_show", methods={"GET"})
     */
    public function show(ProfessionalProfile $professionalProfile): Response
    {
        return $this->render('professional_profile/show.html.twig', [
            'professional_profile' => $professionalProfile,
        ]);
    }

    /**
     * @Route("/{username}/edit", name="app_professional_profile_edit", methods={"GET", "POST"})
     */
    public function edit(Request $request, ProfessionalProfile $professionalProfile, ProfessionalProfileRepository $professionalProfileRepository): Response
    {
        $form = $this->createForm(ProfessionalProfileType::class, $professionalProfile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $professionalProfileRepository->add($professionalProfile);
            return $this->redirectToRoute('app_professional_profile_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('professional_profile/edit.html.twig', [
            'professional_profile' => $professionalProfile,
            'form' => $form,
        ]);
    }

   
}
