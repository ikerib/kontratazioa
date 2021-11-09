<?php

namespace App\Controller;

use App\Repository\KontratuaLoteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DefaultController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(KontratuaLoteRepository $kontratuaLoteRepository): Response
    {
        return $this->render('default/index.html.twig', [
            'loteak' => $kontratuaLoteRepository->getAllByProrroga(),
        ]);
    }
}
