<?php

namespace App\Controller;

use App\Entity\Equipement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;

class EquipementController extends AbstractController
{
    /**
     * @Route("/equipement", name="get_equipements", methods={"GET"})
     */
    public function getAll(ManagerRegistry $doctrine)
    {
        $equipements = $doctrine->getRepository(Equipement::class)->findAll();

        return $this->json([
            "data" => $equipements,
        ]);
    }

    /**
     * @Route("/equipement/{id}", name="get_one_equipement", methods={"GET"})
     */
    public function getOne(ManagerRegistry $doctrine, string $id)
    {
        $equipement = $doctrine->getRepository(Equipement::class)->findOneBy(array("id" => $id));

        return $this->json([
            "data" => $equipement,
        ]);
    }
    
    /**
     * @Route("/equipement", name="create_equipement", methods={"POST"})
     */
    public function create(
        ManagerRegistry $doctrine,
        Request $request,
        SerializerInterface $serializer)
    {
        $entityManager = $doctrine->getManager();
        
        $equipement = $serializer->deserialize($request->getContent(), Equipement::class, "json");

        $entityManager->persist($equipement);
        $entityManager->flush();

        return $this->json([
            "message" => "Equipement created!",
            "data" => $equipement
        ]);
    }

    /**
     * @Route("/equipement/{id}", name="update_equipement", methods={"PUT"})
     */
    public function update(
        ManagerRegistry $doctrine,
        Request $request,
        SerializerInterface $serializer,
        int $id)
    {
        $entityManager = $doctrine->getManager();

        $equipement = $doctrine->getRepository(Equipement::class)->findOneBy(array("id" => $id));
        $newEquipement = $serializer->deserialize($request->getContent(), Equipement::class, "json");

        $equipement->setTitre($newEquipement->getTitre());
        $equipement->setDescription($newEquipement->getDescription());
    
        $entityManager->persist($equipement);
        $entityManager->flush();

        return $this->json([
            "message" => "Equipement updated!",
            "data" => $equipement
        ]);
    }

    /**
     * @Route("/equipement/{id}", name="delete_equipement", methods={"DELETE"})
     */
    public function delete(ManagerRegistry $doctrine, int $id)
    {
        $entityManager = $doctrine->getManager();

        $equipement = $doctrine->getRepository(Equipement::class)->findOneBy(array("id" => $id));

        $entityManager->remove($equipement);
        $entityManager->flush();

        return $this->json([
            "message" => "Equipement deleted!",
            "equipement" => $equipement
        ]);
    }
}
