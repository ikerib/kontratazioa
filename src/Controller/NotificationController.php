<?php

namespace App\Controller;

use App\Entity\Kontratua;
use App\Entity\Notification;
use App\Form\NotificationType;
use App\Repository\NotificationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/notification")
 */
class NotificationController extends AbstractController
{
    /**
     * @Route("/list", name="notification_index", methods={"GET"})
     */
    public function index(NotificationRepository $notificationRepository): Response
    {
        return $this->render('notification/index.html.twig', [
            'notifications' => $notificationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/header", name="notification_header", methods={"GET"})
     */
    public function header(NotificationRepository $notificationRepository): Response
    {
        return $this->render('notification/_notifications.html.twig', [
            'notifications' => $notificationRepository->getAllNotifications(),
        ]);
    }

    /**
     * @Route("/lote/{loteid}", name="notification_by_lote", methods={"GET"})
     */
    public function lote(NotificationRepository $notificationRepository, $loteid): Response
    {
        return $this->render('notification/index.html.twig', [
            'notifications' => $notificationRepository->getByLote($loteid),
        ]);
    }

    /**
     * @Route("/new", name="notification_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $notification = new Notification();
        $form = $this->createForm(NotificationType::class, $notification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($notification);
            $entityManager->flush();

            return $this->redirectToRoute('notification_index', [], Response::HTTP_SEE_OTHER);
        }

        $kontratuak = $this->getDoctrine()->getRepository(Kontratua::class)->getAllSortedByName();
        return $this->renderForm('notification/new.html.twig', [
            'kontratuak'    => $kontratuak,
            'notification'  => $notification,
            'form'          => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="notification_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Notification $notification): Response
    {
        $form = $this->createForm(NotificationType::class, $notification);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('notification_index', [], Response::HTTP_SEE_OTHER);
        }

        $kontratuak = $this->getDoctrine()->getRepository(Kontratua::class)->getAllSortedByName();
        return $this->renderForm('notification/edit.html.twig', [
            'kontratuak'    => $kontratuak,
            'notification'  => $notification,
            'form'          => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="notification_delete", methods={"POST"})
     */
    public function delete(Request $request, Notification $notification): Response
    {
        if ($this->isCsrfTokenValid('delete'.$notification->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($notification);
            $entityManager->flush();
        }

        return $this->redirectToRoute('notification_index', [], Response::HTTP_SEE_OTHER);
    }
}
