<?php

namespace App\Controller;

use App\Entity\Fitxategia;
use App\Entity\Kontaktuak;
use App\Entity\Kontratua;
use App\Entity\KontratuaLote;
use App\Form\BilatzaileaType;
use App\Form\FitxategiaType;
use App\Form\KontratuaLoteType;
use App\Form\KontratuaType;
use App\Repository\KontaktuakRepository;
use App\Repository\KontratuaLoteRepository;
use App\Repository\KontratuaRepository;
use FOS\CKEditorBundle\Form\Type\CKEditorType;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
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
        $query = $kontratuaLoteRepository->getAllSortedBySaila($myFilters);
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

    /**
     * @Route("/abisuak", name="kontratua_abisuak", methods={"GET"})
     */
    public function abisuak(Request $request, KontratuaLoteRepository $kontratuaLoteRepository): Response
    {
        $myFilters = $this->getFinderParams($request->query->get('bilatzailea'));
        $kontratuak = $kontratuaLoteRepository->getAllSortedBySaila($myFilters);

        $kontratuaLote = new KontratuaLote();
        $form = $this->createForm(BilatzaileaType::class, $kontratuaLote, [
            'method' => 'GET',
            'action' => $this->generateUrl('kontratua_abisuak')
        ]);

        return $this->render('kontratua/abisuak.html.twig', [
            'kontratuak' => $kontratuak,
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/mail", name="kontratua_mail", methods={"POST"})
     */
    public function mail(Request $request,
                         MailerInterface $mailer,
                         KontratuaLoteRepository $kontratuaLoteRepository,
                         KontaktuakRepository $kontaktuakRepository): Response
    {
        $selected = $request->get('aukera');
        $myHtml = "";
        if ($selected) {
            $myHtml = "<table><thead><th>Kontratua</th><th>Lote</th></thead><tbody";
            foreach ($selected as $s) {
                /** @var KontratuaLote $kon */
                $kon = $kontratuaLoteRepository->find($s);
                $kontratuaIzena = $kon->getKontratua()->getIzenaEus();
                $lote = $kon->getName();
                $myHtml .= "<tr><td>$kontratuaIzena</td><td>$lote</td></tr>";
            }
            $myHtml .= "</tbody></table>";
        }

        $kontaktuak = $kontaktuakRepository->findAll();

        $defaultData = ['message' => 'Type your message here'];
        $form = $this->createFormBuilder($defaultData)
            ->add('nori', EntityType::class, [
                'class' => Kontaktuak::class,
                'attr' => [
                    'class' => 'select2'
                ],
                'choice_label' => 'email',
                'label' => 'Nori:',
                'multiple' => true
            ])
            ->add('gaia', TextType::class)
            ->add('editor', CKEditorType::class)
            ->add('send', SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // data is an array with "name", "email", and "message" keys
            $data = $form->getData();
            $nori = $form['nori']->getData();
            $arrTo = [];
            foreach ($nori as $n) {
                $arrTo[] = $n->getEmail();
            }

            $email = (new Email())
                ->from('ez-erantzun@pasaia.net')
                ->to(...$arrTo)
                //->cc('cc@example.com')
                //->bcc('bcc@example.com')
                //->replyTo('fabien@example.com')
                ->priority(Email::PRIORITY_HIGH)
                ->subject($data['gaia'])
//                ->text('Sending emails is fun again!')
                ->html($data['editor']);

            $mailer->send($email);
            return $this->redirectToRoute('kontaktuak_index');
        }

        $form->get('editor')->setData($myHtml);

        return $this->render('kontratua/mail.html.twig', [
            'kontratuak' => $selected,
            'kontaktuak' => $kontaktuak,
            'myHtml'     => $myHtml,
            'form'       => $form->createView()
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
