<?php

namespace App\Controller;

use App\Entity\Erabiltzailea;
use App\Form\ErabiltzaileaType;
use App\Repository\ErabiltzaileaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/erabiltzailea")
 */
class ErabiltzaileaController extends AbstractController
{
    /**
     * @Route("/", name="erabiltzailea_index", methods={"GET"})
     */
    public function index(ErabiltzaileaRepository $erabiltzaileaRepository): Response
    {
        return $this->render('erabiltzailea/index.html.twig', [
            'erabiltzaileas' => $erabiltzaileaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="erabiltzailea_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $erabiltzailea = new Erabiltzailea();
        $form = $this->createForm(ErabiltzaileaType::class, $erabiltzailea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($erabiltzailea);
            $entityManager->flush();

            return $this->redirectToRoute('erabiltzailea_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('erabiltzailea/new.html.twig', [
            'erabiltzailea' => $erabiltzailea,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="erabiltzailea_show", methods={"GET"})
     */
    public function show(Erabiltzailea $erabiltzailea): Response
    {
        return $this->render('erabiltzailea/show.html.twig', [
            'erabiltzailea' => $erabiltzailea,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="erabiltzailea_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Erabiltzailea $erabiltzailea): Response
    {
        $form = $this->createForm(ErabiltzaileaType::class, $erabiltzailea);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('erabiltzailea_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('erabiltzailea/edit.html.twig', [
            'erabiltzailea' => $erabiltzailea,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="erabiltzailea_delete", methods={"POST"})
     */
    public function delete(Request $request, Erabiltzailea $erabiltzailea): Response
    {
        if ($this->isCsrfTokenValid('delete'.$erabiltzailea->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($erabiltzailea);
            $entityManager->flush();
        }

        return $this->redirectToRoute('erabiltzailea_index', [], Response::HTTP_SEE_OTHER);
    }
}
