<?php

namespace App\Controller;

use App\Entity\KontratuaLote;
use App\Form\KontratuaLoteType;
use App\Repository\KontratuaLoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/kontratua/lote")
 */
class KontratuaLoteController extends AbstractController
{
    /**
     * @Route("/", name="kontratua_lote_index", methods={"GET"})
     */
    public function index(KontratuaLoteRepository $kontratuaLoteRepository): Response
    {
        return $this->render('kontratua_lote/index.html.twig', [
            'kontratua_lotes' => $kontratuaLoteRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="kontratua_lote_new", methods={"GET","POST"}, options={"expose"=true},)
     */
    public function new(Request $request): Response
    {
        $kontratuaLote = new KontratuaLote();
        $form = $this->createForm(KontratuaLoteType::class, $kontratuaLote, [
            'action' => $this->generateUrl('kontratua_lote_new')
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($kontratuaLote);
            $entityManager->flush();

            return $this->redirectToRoute('kontratua_edit', [ 'id' => $kontratuaLote->getKontratua()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('kontratua_lote/_form.html.twig', [
            'kontratua_lote' => $kontratuaLote,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="kontratua_lote_show", methods={"GET"})
     */
    public function show(KontratuaLote $kontratuaLote): Response
    {
        return $this->render('kontratua_lote/show.html.twig', [
            'kontratua_lote' => $kontratuaLote,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="kontratua_lote_edit", methods={"GET","POST"}, options={"expose"=true})
     */
    public function edit(Request $request, KontratuaLote $kontratuaLote): Response
    {
        $form = $this->createForm(KontratuaLoteType::class, $kontratuaLote, [
            'action' => $this->generateUrl('kontratua_lote_edit', ['id' => $kontratuaLote->getId()])
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('kontratua_edit', ['id' => $kontratuaLote->getKontratua()->getId()], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('kontratua_lote/_form.html.twig', [
            'kontratua_lote' => $kontratuaLote,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="kontratua_lote_delete", methods={"POST"})
     */
    public function delete(Request $request, KontratuaLote $kontratuaLote): Response
    {
        if ($this->isCsrfTokenValid('delete'.$kontratuaLote->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($kontratuaLote);
            $entityManager->flush();
        }

        return $this->redirectToRoute('kontratua_edit', [ 'id' => $kontratuaLote->getKontratua()->getId() ], Response::HTTP_SEE_OTHER);
    }
}
