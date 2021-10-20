<?php

namespace App\Controller;

use App\Entity\Kontratua;
use App\Entity\KontratuaLote;
use App\Form\KontratuaLoteType;
use App\Form\KontratuaType;
use App\Repository\KontratuaLoteRepository;
use App\Repository\KontratuaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/kontratua")
 */
class KontratuaController extends AbstractController
{
    /**
     * @Route("/", name="kontratua_index", methods={"GET"})
     */
    public function index(KontratuaLoteRepository $kontratuaLoteRepository): Response
    {
        return $this->render('kontratua/index.html.twig', [
            'loteak' => $kontratuaLoteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="kontratua_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $kontratua = new Kontratua();
        $form = $this->createForm(KontratuaType::class, $kontratua);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($kontratua);
            $entityManager->flush();

            return $this->redirectToRoute('kontratua_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('kontratua/new.html.twig', [
            'kontratua' => $kontratua,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="kontratua_show", methods={"GET"})
     */
    public function show(Kontratua $kontratua): Response
    {
        return $this->render('kontratua/show.html.twig', [
            'kontratua' => $kontratua,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="kontratua_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Kontratua $kontratua): Response
    {
        $form = $this->createForm(KontratuaType::class, $kontratua);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('kontratua_index', [], Response::HTTP_SEE_OTHER);
        }

        $lote = new KontratuaLote();
        $lote->setKontratua($kontratua);
        $formNewLote = $this->createForm(KontratuaLoteType::class, $lote, [
            'action' => $this->generateUrl('kontratua_lote_new'),
            'method' => 'POST',
        ]);

        return $this->renderForm('kontratua/edit.html.twig', [
            'kontratua' => $kontratua,
            'form' => $form,
            'formNewLote' => $formNewLote
        ]);
    }

    /**
     * @Route("/{id}", name="kontratua_delete", methods={"POST"})
     */
    public function delete(Request $request, Kontratua $kontratua): Response
    {
        if ($this->isCsrfTokenValid('delete'.$kontratua->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($kontratua);
            $entityManager->flush();
        }

        return $this->redirectToRoute('kontratua_index', [], Response::HTTP_SEE_OTHER);
    }
}
