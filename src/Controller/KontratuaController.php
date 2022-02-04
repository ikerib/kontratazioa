<?php

namespace App\Controller;

use App\Entity\Fitxategia;
use App\Entity\Kontratua;
use App\Entity\KontratuaLote;
use App\Form\BilatzaileaType;
use App\Form\FitxategiaType;
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
    public function index(Request $request, KontratuaLoteRepository $kontratuaLoteRepository): Response
    {
        $myFilters = $this->getFinderParams($request->query->get('bilatzailea'));
        $query = $kontratuaLoteRepository->bilaketa($myFilters);
        $kontratuaLote = new KontratuaLote();
        $form = $this->createForm(BilatzaileaType::class, $kontratuaLote, [
            'method' => 'GET',
            'action' => $this->generateUrl('kontratua_index')
        ]);
        return $this->render('kontratua/index.html.twig', [
            'loteak' => $query,
            'form' => $form->createView()
        ]);
    }

    private function getFinderParams($filters): array
    {
        $myFilters = [];
        if ($filters)
        {
            foreach ($filters as $key => $value)
            {
                if (($key !== '_token') && ($value !== ''))
                {
                    $aFilter           = array_map('trim', explode('&', $value));
                    $myFilters[ $key ] = $aFilter;
                }
            }
        }

        return $myFilters;
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
            $fitxategiak = $kontratua->getFitxategiak();
            foreach ($fitxategiak as $key => $fitxategia) {
                $fitxategia->setKontratua($kontratua);
                $fitxategiak->set($key, $fitxategia);
            }
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($kontratua);
            $lote = new KontratuaLote();
            $lote->setKontratua($kontratua);
            $lote->setName('Lote1');
            $entityManager->persist($lote);
            $entityManager->flush();

            return $this->redirectToRoute('kontratua_edit', [
                'id' => $kontratua->getId(),
                'do' => 'addLote',
                'loteid' => $lote->getId()
            ]);
        }

        return $this->renderForm('kontratua/new.html.twig', [
            'kontratua' => $kontratua,
            'form' => $form,
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
            $fitxategiak = $kontratua->getFitxategiak();
            foreach ($fitxategiak as $key => $fitxategia) {
                $fitxategia->setKontratua($kontratua);
                $fitxategiak->set($key, $fitxategia);
            }

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($kontratua);
            $entityManager->flush();

            return $this->redirectToRoute('kontratua_index', [], Response::HTTP_SEE_OTHER);
        }

        $lote = new KontratuaLote();
        $lote->setKontratua($kontratua);
        $formNewLote = $this->createForm(KontratuaLoteType::class, $lote, [
            'action' => $this->generateUrl('kontratua_lote_new', ['kontratuid' => $kontratua->getId()]),
            'method' => 'POST',
        ]);

        $fitxategia = new Fitxategia();
        $fitxategia->setKontratua($kontratua);
        $formFitxategia = $this->createForm(FitxategiaType::class, $fitxategia, [
            'action' => $this->generateUrl('fitxategia_new', ['kontratuid' => $kontratua->getId()]),
            'method' => 'POST',
        ]);

        return $this->renderForm('kontratua/edit.html.twig', [
            'kontratua' => $kontratua,
            'form' => $form,
            'formNewLote' => $formNewLote,
            'formFitxategia' => $formFitxategia
        ]);
    }

    /**
     * @Route("/{id}", name="kontratua_delete", methods={"POST", "DELETE"})
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
