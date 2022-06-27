<?php

namespace App\Controller\Admin;

use App\Entity\Artist;
use App\Entity\ArtLover;
use App\Entity\ArtWork;
use App\Entity\Category;
use App\Entity\ProfessionalProfile;
use App\Entity\Style;
use App\Entity\Subject;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
         $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(ArtWorkCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle("Interface d'administration");
    }

    public function configureMenuItems(): iterable
    {
        
        yield MenuItem::linktoRoute('Back to the website', 'fas fa-home', 'app_home');
  
        yield MenuItem::linkToCrud('Users', 'fas fa-list', User::class);
        yield MenuItem::Section('Profils', 'fa fa-palette');
        yield MenuItem::linkToCrud('Artist','fas fa-list', Artist::class);
        yield MenuItem::linkToCrud('Professional','fas fa-list',ProfessionalProfile::class);
        yield MenuItem::linkToCrud('Amateur','fas fa-list', ArtLover::class);
        yield MenuItem::Section('Oeuvres', 'fa fa-palette');
        yield MenuItem::linkToCrud('Artwork', 'fas fa-palette', ArtWork::class);
        yield MenuItem::Section('Filtres', 'fa fa-palette');
        yield MenuItem::linkToCrud('Category', 'fas fa-tags', Category::class);
        yield MenuItem::linkToCrud('Subject', 'fas fa-tags', Subject::class);
        yield MenuItem::linkToCrud('Style', 'fas fa-tags', Style::class);
        
        
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }
}
