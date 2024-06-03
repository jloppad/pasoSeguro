<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\GrupoRepository;

class GrupoController extends AbstractController
{

    #[Route('/curso/{id}/estudiantes', name: 'curso_estudiantes')]
    public function estudiantes($id, GrupoRepository $grupoRepository): Response
    {
        $estudiantes = $grupoRepository->findEstudiantesByGrupo($id);

        return $this->render('listados/curso/estudiantes.html.twig', [
            'estudiantes' => $estudiantes,
        ]);
    }
}
