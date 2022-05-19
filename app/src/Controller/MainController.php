<?php

namespace App\Controller;

use App\Entity\Personne;
use App\Entity\Source;
use App\Repository\EvenementRepository;
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

    #[Route('/source/{id}', name: 'source')]
    #[ParamConverter('source', class: 'App\Entity\Source')]
    public function source(Source $source): Response
    {
        return $this->render('main/source.html.twig', [
            'source' => $source
        ]);
    }

    #[Route('/personne/{id}', name: 'personne')]
    #[ParamConverter('personne', class: 'App\Entity\Personne')]
    public function personne(Personne $personne, EvenementRepository $evenementRepository, PersonneRepository $personneRepository): Response
    {
        $evenements = $evenementRepository->findByPersonne($personne);
        $fratrie = $personneRepository->getFratrie($personne);
        $enfants = $personneRepository->getEnfants($personne);
        return $this->render('main/personne.html.twig', [
            'personne' => $personne,
            'fratrie' => $fratrie,
            'enfants' => $enfants,
            'evenements' => $evenements
        ]);
    }
}
