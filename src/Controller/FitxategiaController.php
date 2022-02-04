<?php

namespace App\Controller;

use App\Entity\Fitxategia;
use App\Form\FitxategiaType;
use App\Repository\FitxategiaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/fitxategia")
 */
class FitxategiaController extends AbstractController
{
    /**
     * @Route("/", name="fitxategia_index", methods={"GET"})
     */
    public function index(FitxategiaRepository $fitxategiaRepository): Response
    {
        return $this->render('fitxategia/index.html.twig', [
            'fitxategias' => $fitxategiaRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new/{kontratuid}", name="fitxategia_new", methods={"GET", "POST"}, options={"expose"=true},)
     */
    public function new(Request $request, $kontratuid): Response
    {
        $fitxategium = new Fitxategia();
        $form = $this->createForm(FitxategiaType::class, $fitxategium, [
            'action' => $this->generateUrl('fitxategia_new', ['kontratuid' => $kontratuid])
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $kontratua = $entityManager->getRepository('App:Kontratua')->find($kontratuid);
            $fitxategium->setKontratua($kontratua);
            $entityManager->persist($fitxategium);
            $entityManager->flush();

//            return $this->redirectToRoute('fitxategia_index', [], Response::HTTP_SEE_OTHER);
            return $this->redirectToRoute('kontratua_edit', [ 'id' => $kontratuid], Response::HTTP_SEE_OTHER);

        }

        return $this->renderForm('fitxategia/new.html.twig', [
            'fitxategium' => $fitxategium,
            'form' => $form,
        ]);
    }

    /**
     * @Route("/{id}", name="fitxategia_show", methods={"GET"})
     */
    public function show(Fitxategia $fitxategium): Response
    {
        return $this->render('fitxategia/show.html.twig', [
            'fitxategium' => $fitxategium,
        ]);
    }

    /**
     * @Route("/{id}/edit/{kontratuid}", name="fitxategia_edit", methods={"GET", "POST"}, options={"expose"=true},)
     */
    public function edit(Request $request, Fitxategia $fitxategium, EntityManagerInterface $entityManager, $kontratuid): Response
    {
        $form = $this->createForm(FitxategiaType::class, $fitxategium, [
            'action' => $this->generateUrl('fitxategia_edit', ['id' => $fitxategium->getId(), 'kontratuid' => $kontratuid])
        ]);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();
            return $this->redirectToRoute('kontratua_edit', [ 'id' => $kontratuid], Response::HTTP_SEE_OTHER);
            //return $this->redirectToRoute('fitxategia_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('fitxategia/edit.html.twig', [
            'fitxategia' => $fitxategium,
            'form' => $form,
        ]);
    }



    /**
     * @Route("/{id}/delete", name="fitxategia_delete", methods={"POST","DELETE"}, options={"expose"=true})
     */
    public function delete(Request $request, Fitxategia $fitxategium, EntityManagerInterface $entityManager): Response
    {
        $content = json_decode($request->getContent(), true, 512, JSON_THROW_ON_ERROR);
        $token = $content['token'];

        $kontratuid = $fitxategium->getKontratua()->getId();
        if ($this->isCsrfTokenValid('delete'.$fitxategium->getId(), $token)) {
            $entityManager->remove($fitxategium);
            $entityManager->flush();
        }

        //return $this->redirectToRoute('kontratua_edit', [ 'id' => $kontratuid], Response::HTTP_SEE_OTHER);
        //return $this->redirectToRoute('fitxategia_index', [], Response::HTTP_SEE_OTHER);
        return new JsonResponse([
            'success' => true,
            'data'    => [] // Your data here
        ]);
    }
}
