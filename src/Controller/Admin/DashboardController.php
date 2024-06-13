<?php

namespace App\Controller\Admin;

use App\Entity\CursoAcademico;
use App\Entity\Estudiante;
use App\Entity\Grupo;
use App\Entity\Llave;
use App\Entity\Motivo;
use App\Entity\Persona;
use App\Entity\Registro;
use App\Entity\Usuario;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(RegistroCrudController::class)->generateUrl());

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
            ->setTitle('Paso Seguro')
            ->setFaviconPath('img/logo_recortado.png');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Registros', 'fas fa-list', Registro::class);
        yield MenuItem::linkToCrud('Personas', 'fas fa-list', Persona::class);
        yield MenuItem::linkToCrud('Usuarios', 'fas fa-list', Usuario::class);
        yield MenuItem::linkToCrud('Estudiantes', 'fas fa-list', Estudiante::class);
        yield MenuItem::linkToCrud('Grupos', 'fas fa-list', Grupo::class);
        yield MenuItem::linkToCrud('Motivos', 'fas fa-list', Motivo::class);
        yield MenuItem::linkToCrud('Llaves', 'fas fa-list', Llave::class);
        yield MenuItem::linkToCrud('Cursos Academicos', 'fas fa-list', CursoAcademico::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }

    public function configureUserMenu(UserInterface $user): \EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu
    {
        if (!$user instanceof Usuario) {
            throw new \Exception('Wrong user');
        }
        return parent::configureUserMenu($user)
            ->setName($user);
    }
}
