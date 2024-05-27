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
        $plantilla = 'listados/exterior.html.twig';

        if ($this->isGranted('ROLE_DOCENTE')) {
            $plantilla = 'listados/curso.html.twig';
        }

        if ($this->isGranted('ROLE_ADMIN')) {
            $plantilla = 'listados/registro.html.twig';
        }

        return $this->render($plantilla);
    }

}