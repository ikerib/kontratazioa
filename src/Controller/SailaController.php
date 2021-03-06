<?php

namespace App\Controller;

use App\Entity\Saila;
use App\Form\SailaType;
use App\Repository\SailaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/saila")
 */
class SailaController extends AbstractController
{
    /**
     * @Route("/", name="saila_index", methods={"GET"})
     */
    public function index(SailaRepository $sailaRepository): Response
    {
        return $this->render('saila/index.html.twig', [
            'sailas' => $sailaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="saila_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $saila = new Saila();
        $form = $this->createForm(SailaType::class, $saila);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($saila);
            $entityManager->flush();

            return $this->redirectToRoute('saila_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('saila/new.html.twig', [
            'saila' => $saila,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="saila_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Saila $saila): Response
    {
        $form = $this->createForm(SailaType::class, $saila);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('saila_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('saila/edit.html.twig', [
            'saila' => $saila,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="saila_delete", methods={"POST"})
     */
    public function delete(Request $request, Saila $saila): Response
    {
        if ($this->isCsrfTokenValid('delete'.$saila->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($saila);
            $entityManager->flush();
        }

        return $this->redirectToRoute('saila_index', [], Response::HTTP_SEE_OTHER);
    }
}
