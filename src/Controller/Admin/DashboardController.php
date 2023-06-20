<?php

namespace App\Controller\Admin;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use App\Entity\Categories;
use App\Entity\Products;
use App\Entity\Transporter;


class DashboardController extends AbstractDashboardController
{
    #[Route('/admin/eshop', name: 'admin_index')]
    public function index(): Response
    {
        //return parent::index();

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(CategoriesCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user
        
        // if ($this->getUser()->getfirstName() === "jean") {
        //     $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        //     return $this->redirect($adminUrlGenerator->setController(CategoriesCrudController::class)->generateUrl());    }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('E Boutique');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Category', 'fas fa-shop', Categories::class);
        yield MenuItem::linkToCrud('Product', 'fa-solid fa-basket-shopping', Products::class);
        yield MenuItem::linkToCrud('Transporter', 'fa-solid fa-basket-shopping', Transporter::class);

    }
}
