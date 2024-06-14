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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class DashboardController extends AbstractDashboardController
{
    /**
     * @throws NotFoundExceptionInterface
     * @throws ContainerExceptionInterface
     */
    #[IsGranted("ROLE_ADMIN")]
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
        yield MenuItem::linkToUrl('Administracion', 'fa fa-home', 'administracion');
        yield MenuItem::linkToCrud('Registros', 'fas fa-list', Registro::class);
        yield MenuItem::linkToCrud('Personas', 'fa-solid fa-people-group', Persona::class);
        yield MenuItem::linkToCrud('Usuarios', 'fa-solid fa-user', Usuario::class);
        yield MenuItem::linkToCrud('Estudiantes', 'fa-solid fa-graduation-cap', Estudiante::class);
        yield MenuItem::linkToCrud('Grupos', 'fa-solid fa-school', Grupo::class);
        yield MenuItem::linkToCrud('Motivos', 'fas fa-comments', Motivo::class);
        yield MenuItem::linkToCrud('Llaves', 'fa-solid fa-key', Llave::class);
        yield MenuItem::linkToCrud('Cursos Academicos', 'fa-solid fa-calendar', CursoAcademico::class);
        // yield MenuItem::linkToCrud('The Label', 'fas fa-list', EntityClass::class);
    }

    public function configureUserMenu(UserInterface $user): \EasyCorp\Bundle\EasyAdminBundle\Config\UserMenu
    {
        if (!$user instanceof Usuario) {
            throw new \Exception('Wrong user');
        }
        return parent::configureUserMenu($user)
            ->setName($user->getUserName());
    }
}
