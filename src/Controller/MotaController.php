<?php

namespace App\Controller;

use App\Entity\Mota;
use App\Form\MotaType;
use App\Repository\MotaRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/mota")
 */
class MotaController extends AbstractController
{
    /**
     * @Route("/", name="mota_index", methods={"GET"})
     */
    public function index(MotaRepository $motaRepository): Response
    {
        return $this->render('mota/index.html.twig', [
            'motas' => $motaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="mota_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $motum = new Mota();
        $form = $this->createForm(MotaType::class, $motum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($motum);
            $entityManager->flush();

            return $this->redirectToRoute('mota_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mota/new.html.twig', [
            'motum' => $motum,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="mota_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Mota $motum): Response
    {
        $form = $this->createForm(MotaType::class, $motum);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('mota_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('mota/edit.html.twig', [
            'motum' => $motum,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="mota_delete", methods={"POST"})
     */
    public function delete(Request $request, Mota $motum): Response
    {
        if ($this->isCsrfTokenValid('delete'.$motum->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($motum);
            $entityManager->flush();
        }

        return $this->redirectToRoute('mota_index', [], Response::HTTP_SEE_OTHER);
    }
}
