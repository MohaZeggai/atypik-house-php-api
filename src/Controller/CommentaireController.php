<?php

namespace App\Controller;

use App\Entity\Commentaire;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;

class CommentaireController extends AbstractController
{
    /**
     * @Route("/commentaire", name="get_commentaires", methods={"GET"})
     */
    public function getAll(ManagerRegistry $doctrine)
    {
        $commentaires = $doctrine->getRepository(Commentaire::class)->findAll();

        return $this->json([
            "data" => $commentaires,
        ]);
    }

    /**
     * @Route("/commentaire/{id}", name="get_one_commentaire", methods={"GET"})
     */
    public function getOne(ManagerRegistry $doctrine, string $id)
    {
        $commentaire = $doctrine->getRepository(Commentaire::class)->findOneBy(array("id" => $id));

        return $this->json([
            "data" => $commentaire,
        ]);
    }
    
    /**
     * @Route("/commentaire", name="create_commentaire", methods={"POST"})
     */
    public function create(
        ManagerRegistry $doctrine,
        Request $request,
        SerializerInterface $serializer)
    {
        $entityManager = $doctrine->getManager();
        
        $commentaire = $serializer->deserialize($request->getContent(), Commentaire::class, "json");

        $entityManager->persist($commentaire);
        $entityManager->flush();

        return $this->json([
            "message" => "Commentaire created!",
            "data" => $commentaire
        ]);
    }

    /**
     * @Route("/commentaire/{id}", name="update_commentaire", methods={"PUT"})
     */
    public function update(
        ManagerRegistry $doctrine,
        Request $request,
        SerializerInterface $serializer,
        int $id)
    {
        $entityManager = $doctrine->getManager();

        $commentaire = $doctrine->getRepository(Commentaire::class)->findOneBy(array("id" => $id));
        $newCommentaire = $serializer->deserialize($request->getContent(), Commentaire::class, "json");

        $commentaire->setcomment($newCommentaire->getcommentaire());
        $commentaire->setdate_ajout($newCommentaire->getdate_ajout());
        $commentaire->setdate_modification($newCommentaire->getdate_modification());
    
        $entityManager->persist($commentaire);
        $entityManager->flush();

        return $this->json([
            "message" => "Commentaire updated!",
            "data" => $commentaire
        ]);
    }

    /**
     * @Route("/commentaire/{id}", name="delete_commentaire", methods={"DELETE"})
     */
    public function delete(ManagerRegistry $doctrine, int $id)
    {
        $entityManager = $doctrine->getManager();

        $commentaire = $doctrine->getRepository(Commentaire::class)->findOneBy(array("id" => $id));

        $entityManager->remove($commentaire);
        $entityManager->flush();

        return $this->json([
            "message" => "Commentaire deleted!",
            "commentaire" => $commentaire
        ]);
    }
}
