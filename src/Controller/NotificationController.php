<?php

namespace App\Controller;

use App\Entity\Notification;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;

class NotificationController extends AbstractController
{
    /**
     * @Route("/notification", name="get_notifications", methods={"GET"})
     */
    public function getAll(ManagerRegistry $doctrine)
    {
        $notifications = $doctrine->getRepository(Notification::class)->findAll();

        return $this->json([
            "data" => $notifications,
        ]);
    }

    /**
     * @Route("/notification/{id}", name="get_one_notification", methods={"GET"})
     */
    public function getOne(ManagerRegistry $doctrine, string $id)
    {
        $notification = $doctrine->getRepository(Notification::class)->findOneBy(array("id" => $id));

        return $this->json([
            "data" => $notification,
        ]);
    }
    
    /**
     * @Route("/notification", name="create_notification", methods={"POST"})
     */
    public function create(
        ManagerRegistry $doctrine,
        Request $request,
        SerializerInterface $serializer)
    {
        $entityManager = $doctrine->getManager();
        
        $notification = $serializer->deserialize($request->getContent(), Notification::class, "json");

        $entityManager->persist($notification);
        $entityManager->flush();

        return $this->json([
            "message" => "Notification created!",
            "data" => $notification
        ]);
    }

    /**
     * @Route("/notification/{id}", name="update_notification", methods={"PUT"})
     */
    public function update(
        ManagerRegistry $doctrine,
        Request $request,
        SerializerInterface $serializer,
        int $id)
    {
        $entityManager = $doctrine->getManager();

        $notification = $doctrine->getRepository(Notification::class)->findOneBy(array("id" => $id));
        $newNotification = $serializer->deserialize($request->getContent(), Notification::class, "json");

        $notification->setcomment($newNotification->getcommentaire());
        $notification->setdate_ajout($newNotification->getdate_ajout());
        $notification->setdate_modification($newNotification->getdate_modification());
    
        $entityManager->persist($notification);
        $entityManager->flush();

        return $this->json([
            "message" => "Notification updated!",
            "data" => $notification
        ]);
    }

    /**
     * @Route("/notification/{id}", name="delete_notification", methods={"DELETE"})
     */
    public function delete(ManagerRegistry $doctrine, int $id)
    {
        $entityManager = $doctrine->getManager();

        $notification = $doctrine->getRepository(Notification::class)->findOneBy(array("id" => $id));

        $entityManager->remove($notification);
        $entityManager->flush();

        return $this->json([
            "message" => "Notification deleted!",
            "notification" => $notification
        ]);
    }
}
