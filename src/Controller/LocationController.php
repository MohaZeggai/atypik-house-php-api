<?php

namespace App\Controller;

use App\Entity\Location;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;

class LocationController extends AbstractController
{
    /**
     * @Route("/location", name="get_locations", methods={"GET"})
     */
    public function getAll(ManagerRegistry $doctrine)
    {
        $locations = $doctrine->getRepository(Location::class)->findAll();

        return $this->json([
            "data" => $locations,
        ]);
    }

    /**
     * @Route("/location/{id}", name="get_one_location", methods={"GET"})
     */
    public function getOne(ManagerRegistry $doctrine, string $id)
    {
        $location = $doctrine->getRepository(Location::class)->findOneBy(array("id" => $id));

        return $this->json([
            "data" => $location,
        ]);
    }
    
    /**
     * @Route("/location", name="create_location", methods={"POST"})
     */
    public function create(
        ManagerRegistry $doctrine,
        Request $request,
        SerializerInterface $serializer)
    {
        $entityManager = $doctrine->getManager();
        
        $location = $serializer->deserialize($request->getContent(), Location::class, "json");

        $entityManager->persist($location);
        $entityManager->flush();

        return $this->json([
            "message" => "Location created!",
            "data" => $location
        ]);
    }

    /**
     * @Route("/location/{id}", name="update_location", methods={"PUT"})
     */
    public function update(
        ManagerRegistry $doctrine,
        Request $request,
        SerializerInterface $serializer,
        int $id)
    {
        $entityManager = $doctrine->getManager();

        $location = $doctrine->getRepository(Location::class)->findOneBy(array("id" => $id));
        $newLocation = $serializer->deserialize($request->getContent(), Location::class, "json");

        $location->setTitre($newLocation->getTitre());
        $location->setType($newLocation->getType());
        $location->setSurface($newLocation->getSurface());
        $location->setDescription($newLocation->getDescription());
        $location->setPlanning($newLocation->getPlanning());
        $location->setPrix($newLocation->getPrix());
        $location->setAdresse($newLocation->getAdresse());
    
        $entityManager->persist($location);
        $entityManager->flush();

        return $this->json([
            "message" => "Location updated!",
            "data" => $location
        ]);
    }

    /**
     * @Route("/location/{id}", name="delete_location", methods={"DELETE"})
     */
    public function delete(ManagerRegistry $doctrine, int $id)
    {
        $entityManager = $doctrine->getManager();

        $location = $doctrine->getRepository(Location::class)->findOneBy(array("id" => $id));

        $entityManager->remove($location);
        $entityManager->flush();

        return $this->json([
            "message" => "Location deleted!",
            "location" => $location
        ]);
    }
}
