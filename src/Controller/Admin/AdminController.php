<?php

namespace App\Controller\Admin;

use App\Entity\Activity;
use App\Entity\Category;
use App\Entity\Contact;
use App\Entity\Coach;
use App\Entity\ImageUpload;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        $routeBuilder = $this->get(AdminUrlGenerator::class);
        return $this->redirect($routeBuilder->setController(AboutCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('WildComfortStudio');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::section('Menu');
        yield MenuItem::linktoCrud('Activités', 'fas fa-dumbbell', Activity::class);
        yield MenuItem::linkToCrud('Coach', 'fas fa-hands-helping', Coach::class);
        yield MenuItem::linkToCrud('Catégories d\'actualités', 'fas fa-list-ol', Category::class);
        yield MenuItem::linkToCrud('Images', 'fas fa-images ', ImageUpload::class);
        yield MenuItem::linkToCrud('Contact', 'fas fa-users', Contact::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user-cog', User::class);
    }
}
