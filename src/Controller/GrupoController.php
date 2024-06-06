<?php

// src/Controller/GrupoController.php
namespace App\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GrupoRepository;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\HttpFoundation\Request;

#[IsGranted('ROLE_DOCENTE')]
class GrupoController extends AbstractController
{

    public function __construct(Security $security)
    {
        $this->security = $security;
    }

    #[Route('/seleccionar-grupo', name: 'seleccionar_grupo')]
    public function seleccionarGrupo(GrupoRepository $grupoRepository): Response
    {
        $user = $this->getUser();

        if ($this->isGranted('ROLE_ADMIN')) {
            $grupos = $grupoRepository->findByCurrentYear();
        } else {
            $grupos = $grupoRepository->findByDocente($user->getId());
        }

        return $this->render('listados/grupo/seleccionar_grupo.html.twig', [
            'grupos' => $grupos,
        ]);
    }


    #[Route('/grupo/{id}/estudiantes', name: 'grupo_estudiantes')]
    public function estudiantes($id, GrupoRepository $grupoRepository): Response
    {
        $estudiantes = $grupoRepository->findEstudiantesByGrupo($id);

        return $this->render('listados/grupo/estudiantes.html.twig', [
            'estudiantes' => $estudiantes,
        ]);
    }

    #[Route('/redirigir-grupo', name: 'redirigir_grupo')]
    public function redirigirGrupo(Request $request): Response
    {
        $grupoId = $request->get('grupo');
        return $this->redirectToRoute('grupo_estudiantes', ['id' => $grupoId]);
    }
}

