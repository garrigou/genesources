<?php

namespace App\Controller\Admin;

use App\Entity\Evenement;
use App\Entity\Personne;
use App\Entity\Source;
use App\Entity\TypeEvenement;
use App\Entity\TypeSource;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(PersonneCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        //
        // if ('jane' === $this->getUser()->getUsername()) {
        //     return $this->redirect('...');
        // }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Www');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToCrud('Personnes', 'fa fa-person', Personne::class);
        yield MenuItem::linkToCrud('Sources', 'fa fa-book', Source::class);
        yield MenuItem::linkToCrud('Type de sources', 'fa fa-list', TypeSource::class);
        yield MenuItem::linkToCrud('Type d\'évenement ', 'fa fa-train', TypeEvenement::class);
        yield MenuItem::linkToCrud('Evénement ', 'fa fa-calendar', Evenement::class);
    }
}
