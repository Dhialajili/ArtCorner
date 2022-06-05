<?php

namespace App\Controller;
use App\Entity\Reservation;
use App\Entity\ArtWork;
use App\Repository\ReservationRepository;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="app_reservation")
     */
    public function index(ReservationRepository $reservationRepository): Response
    {
        return $this->render('reservation/index.html.twig', [
            'reservations' => $reservationRepository->findAll(),
            
        ]);
    }

    /**
     * @Route("/the_reservation/{id}", name="the_reservation")
     */
    public function ordre(ArtWork $art_work , EntityManagerInterface $entityManager){
        $reservation= new Reservation();
        $reservation->setUser($this->getUser());
        $reservation->setOeuvre("ouvre_art");
        $reservation->setName($art_work->getTitle());
        $reservation->setImage($art_work->getImage());
        $reservation->setPrice($art_work->getPrice());
        $reservation->setStatus("En attendant");

        $entityManager->persist($reservation);
        $entityManager->flush();
        
        $this->addFlash('Reservation', $reservation->getName(). ' was added to the order');

        return $this->redirect($this->generateUrl('app_reservation'));


    }
     /**
     * @Route("/status/{id},{status}", name="status")
     */
    public function status($id , $status , EntityManagerInterface $entityManager ){

        $reservation = $entityManager->getRepository(Reservation::class)->find($id);

        $reservation->setStatus($status);
        $entityManager->flush();
        return $this->redirect(($this->generateUrl('app_reservation')));
    }
    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function delete($id , ReservationRepository $br , EntityManagerInterface $entityManager)
    {
        $reservation = $br->find($id);
        $entityManager->remove($reservation);
        $entityManager->flush();

        return $this->redirect($this->generateUrl('app_reservation'));
    }
}
