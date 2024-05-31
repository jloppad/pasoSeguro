<?php

namespace App\Controller;

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
            return $this->redirectToRoute('registro');
        }

        if ($this->isGranted('ROLE_DOCENTE')) {
            return $this->redirectToRoute('curso');
        }

        if ($this->isGranted('ROLE_CONSERJE')) {
            return $this->redirectToRoute('exterior');
        }

        throw $this->createAccessDeniedException('No tienes permisos para acceder a esta página.');
    }

    #[IsGranted('ROLE_DOCENTE')]
    #[Route('/curso', name: 'curso')]
    public function curso(): Response
    {
        return $this->render("listados/curso.html.twig");
    }

    #[IsGranted('ROLE_ADMIN')]
    #[Route('/registro', name: 'registro')]
    public function registro(): Response
    {
        return $this->render("listados/registro.html.twig");
    }

    #[IsGranted('ROLE_CONSERJE')]
    #[Route('/exterior', name: 'exterior')]
    public function exterior(): Response
    {
        return $this->render("listados/exterior.html.twig");
    }
}