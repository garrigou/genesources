<?php

namespace App\Controller;

use App\Entity\Source;
use App\Repository\PersonneRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class MainController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(PersonneRepository $personneRepository): Response
    {
        $personnes = $personneRepository->findAll();

        return $this->render('main/index.html.twig', [
            'personnes' => $personnes
        ]);
    }

    #[Route('/source/{id}', name: 'index')]
    #[ParamConverter('source', class: 'App\Entity\Source')]
    public function source(Source $source): Response
    {
        return $this->render('main/source.html.twig', [
            'source' => $source
        ]);
    }
}
