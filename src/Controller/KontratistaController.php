<?php

namespace App\Controller;

use App\Entity\Kontratista;
use App\Form\KontratistaType;
use App\Repository\KontratistaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/kontratista")
 */
class KontratistaController extends AbstractController
{
    /**
     * @Route("/", name="kontratista_index", methods={"GET"})
     */
    public function index(KontratistaRepository $kontratistaRepository): Response
    {
        return $this->render('kontratista/index.html.twig', [
            'kontratistas' => $kontratistaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="kontratista_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $kontratistum = new Kontratista();
        $form = $this->createForm(KontratistaType::class, $kontratistum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($kontratistum);
            $entityManager->flush();

            return $this->redirectToRoute('kontratista_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('kontratista/new.html.twig', [
            'kontratistum' => $kontratistum,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="kontratista_show", methods={"GET"})
     */
    public function show(Kontratista $kontratistum): Response
    {
        return $this->render('kontratista/show.html.twig', [
            'kontratistum' => $kontratistum,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="kontratista_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Kontratista $kontratistum): Response
    {
        $form = $this->createForm(KontratistaType::class, $kontratistum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('kontratista_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('kontratista/edit.html.twig', [
            'kontratistum' => $kontratistum,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="kontratista_delete", methods={"POST"})
     */
    public function delete(Request $request, Kontratista $kontratistum): Response
    {
        if ($this->isCsrfTokenValid('delete'.$kontratistum->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($kontratistum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('kontratista_index', [], Response::HTTP_SEE_OTHER);
    }
}
