<?php

namespace App\Controller;

use App\Entity\Reservation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;

class ReservationController extends AbstractController
{
    /**
     * @Route("/reservation", name="get_reservations", methods={"GET"})
     */
    public function getAll(ManagerRegistry $doctrine)
    {
        $reservations = $doctrine->getRepository(Reservation::class)->findAll();

        return $this->json([
            "data" => $reservations,
        ]);
    }

    /**
     * @Route("/reservation/{id}", name="get_one_reservation", methods={"GET"})
     */
    public function getOne(ManagerRegistry $doctrine, string $id)
    {
        $reservation = $doctrine->getRepository(Reservation::class)->findOneBy(array("id" => $id));

        return $this->json([
            "data" => $reservation,
        ]);
    }
    
    /**
     * @Route("/reservation", name="create_reservation", methods={"POST"})
     */
    public function create(
        ManagerRegistry $doctrine,
        Request $request,
        SerializerInterface $serializer)
    {
        $entityManager = $doctrine->getManager();
        
        $reservation = $serializer->deserialize($request->getContent(), Reservation::class, "json");

        $entityManager->persist($reservation);
        $entityManager->flush();

        return $this->json([
            "message" => "Reservation created!",
            "data" => $reservation
        ]);
    }

    /**
     * @Route("/reservation/{id}", name="update_reservation", methods={"PUT"})
     */
    public function update(
        ManagerRegistry $doctrine,
        Request $request,
        SerializerInterface $serializer,
        int $id)
    {
        $entityManager = $doctrine->getManager();

        $reservation = $doctrine->getRepository(Reservation::class)->findOneBy(array("id" => $id));
        $newReservation = $serializer->deserialize($request->getContent(), Reservation::class, "json");

        $reservation->setdate_reservation($newReservation->getdate_reservation());
        
    
        $entityManager->persist($reservation);
        $entityManager->flush();

        return $this->json([
            "message" => "Reservation updated!",
            "data" => $reservation
        ]);
    }

    /**
     * @Route("/reservation/{id}", name="delete_reservation", methods={"DELETE"})
     */
    public function delete(ManagerRegistry $doctrine, int $id)
    {
        $entityManager = $doctrine->getManager();

        $reservation = $doctrine->getRepository(Reservation::class)->findOneBy(array("id" => $id));

        $entityManager->remove($reservation);
        $entityManager->flush();

        return $this->json([
            "message" => "Reservation deleted!",
            "reservation" => $reservation
        ]);
    }
}
