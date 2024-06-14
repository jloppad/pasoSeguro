<?php

namespace App\Controller;

use App\Controller\Admin\CursoAcademicoCrudController;
use App\Controller\Admin\EstudianteCrudController;
use App\Controller\Admin\GrupoCrudController;
use App\Controller\Admin\LlaveCrudController;
use App\Controller\Admin\MotivoCrudController;
use App\Controller\Admin\PersonaCrudController;
use App\Controller\Admin\RegistroCrudController;
use App\Controller\Admin\UsuarioCrudController;
use App\Repository\EstudianteRepository;
use App\Repository\RegistroRepository;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PrincipalController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/', name: 'home')]
    public function home(): Response
    {
        if ($this->isGranted('ROLE_ADMIN')) {
            return $this->redirectToRoute('administracion');
        }

        if ($this->isGranted('ROLE_DOCENTE')) {
            return $this->redirectToRoute('seleccionar_grupo');
        }

        if ($this->isGranted('ROLE_CONSERJE')) {
            return $this->redirectToRoute('exterior');
        }

        throw $this->createAccessDeniedException('No tienes permisos para acceder a esta página.');
    }

    #[IsGranted('ROLE_DOCENTE')]
    #[Route('/grupo', name: 'grupo')]
    public function grupo(): Response
    {
        return $this->render("listados/grupo/seleccionar_grupo.html.twig");
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/administracion', name: 'administracion')]
    public function registro(AdminUrlGenerator $adminUrlGenerator): Response
    {
        $urls = [
            'registros' => $adminUrlGenerator->setController(RegistroCrudController::class)->generateUrl(),
            'personas' => $adminUrlGenerator->setController(PersonaCrudController::class)->generateUrl(),
            'usuarios' => $adminUrlGenerator->setController(UsuarioCrudController::class)->generateUrl(),
            'estudiantes' => $adminUrlGenerator->setController(EstudianteCrudController::class)->generateUrl(),
            'grupos' => $adminUrlGenerator->setController(GrupoCrudController::class)->generateUrl(),
            'motivos' => $adminUrlGenerator->setController(MotivoCrudController::class)->generateUrl(),
            'llaves' => $adminUrlGenerator->setController(LlaveCrudController::class)->generateUrl(),
            'cursosAcademicos' => $adminUrlGenerator->setController(CursoAcademicoCrudController::class)->generateUrl(),
        ];

        return $this->render('listados/administracion.html.twig', [
            'urls' => $urls,
        ]);
    }

    #[IsGranted('ROLE_CONSERJE')]
    #[Route('/exterior', name: 'exterior')]
    public function exterior(RegistroRepository $registroRepository): Response
    {
        $registros = $registroRepository->findAllOut();
        return $this->render("listados/exterior.html.twig", [
            "registros" => $registros
            ]);
    }
}
